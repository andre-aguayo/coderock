<?php

namespace App\Services;

use App\Models\Investment;
use App\Models\Investor;
use Illuminate\Support\Facades\DB;
use DateTime;
use Exception;

class InvestmentService implements InvestmentInterface
{
    public function createInvestment(int $investorId, float $value, string $soldIn): bool
    {
        return Investment::create(["investor_id" => $investorId, "value" => $value, "sold_in" => $soldIn]);
    }

    public function getInvestmentById(int $id): Investment
    {
        return Investment::where("id", "=", $id);
    }

    public function getInvestmentProjection(int $id, string $projectionDate): float
    {
        $investment = Investment::where('id', '=', $id);
        $investmentType = $investment->type;

        $this->verifyMinimumMonthOfInvestment($investmentType->minimum_moths, $investment->sold_in);

        return $investment->value * (1 + $investmentType->tax / 100) ^ $this->monthDiff($investment->sold_in, $projectionDate);
    }

    public function withdrawInvestment(int $id): ?Investor
    {
        DB::beginTransaction();
        try {
            $investment = Investment::where('id', '=', $id)->update(["active" => false]);

            $investor = $investment->investor;
            $investor->balance = $investor->balance + $investment->value;
            $investor->save();

            DB::commit();
            return $investor;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Withdraw falied.');
        }
    }

    private function verifyMinimumMonthOfInvestment(string $minimumMonths, string $soldIn)
    {
        $currentDate = strtotime('now');
        $minimumDate = strtotime($soldIn . " + $minimumMonths months");
        if (!is_null($minimumMonths) && $currentDate < $minimumDate)
            throw new Exception('Did not reach the deadline.');
    }

    private function monthDiff(string $soldIn, string $projection): int
    {
        $date1 = new DateTime($soldIn);
        $date2 = new DateTime($projection);

        return ($date1->diff($date2))->m;
    }
}
