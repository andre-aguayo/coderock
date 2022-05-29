<?php

namespace App\Services;

use App\Mail\InvestorNotification;
use App\Models\Investment;
use App\Models\Investor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use DateTime;
use Exception;

class InvestmentService implements InvestmentInterface
{
    public function createInvestment(int $investorId, float $value, string $soldIn): Investment
    {
        if (strtotime('now') < strtotime($soldIn))
            throw new Exception('It is not possible to create investments in the future.');

        if ($value <= 0)
            throw new Exception('The investment must be greater than zero.');

        return Investment::create([
            "investor_id" => $investorId,
            "investment_type_id" => 1,
            "value" => $value,
            "sold_in" => $soldIn,
            "active" => true
        ]);
    }

    public function getInvestmentById(int $id, bool $respectActive = false): Investment
    {
        $investment = Investment::where("id", "=", $id);

        if ($respectActive)
            $investment->where("active", "=", true);

        $investment = $investment->first();

        if (empty($investment))
            throw new Exception('Investment not found or inactive.');

        return $investment;
    }

    public function getInvestmentProjection(int $id, string $projectionDate): array
    {
        $investment = $this->getInvestmentById($id, true);

        $this->verifyMinimumMonthOfInvestment($investment->sold_in, $projectionDate);

        return [
            "investment_initial" => $investment->value,
            "expected_withdraw" => $investment->value + $this->calculateGain($investment, $projectionDate),
            "expected_withdraw_with_tax" => $investment->value + $this->calculateGainWithTax($projectionDate, $investment)
        ];
    }

    public function getInvestmentProjectionWithTax(int $id, string $projectionDate): float
    {
        $investment = $this->getInvestmentById($id);

        $this->verifyMinimumMonthOfInvestment($investment->sold_in, $projectionDate);

        return $investment->value + $this->calculateGain($investment, $projectionDate);
    }

    public function withdrawInvestment(int $id, string $withdrawDate): Investor
    {
        DB::beginTransaction();
        try {

            $investment = $this->getInvestmentById($id, true);

            if (strtotime($investment->sold_in) > strtotime($withdrawDate))
                throw new Exception('Invalid date.');

            $investment->active = false;

            $gainWithTax = $this->calculateGainWithTax($withdrawDate, $investment);

            $investor = $investment->investor;
            $old_balance = $investor->balance;
            $investor->balance = $investor->balance + $investment->value + $gainWithTax;

            $investor->save();
            $investment->save();

            DB::commit();

            $investor->old_balance = $old_balance;
            $investor->investment_withdraw = $investment->value + $gainWithTax;
            $investor->investment_tax =  $this->calculateGain($investment, $withdrawDate);

            //$this->notificateWithdraw($investor); :Send notification

            return $investor;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Withdraw falied: ' . $e->getMessage());
        }
    }

    public function getInvestmentsOfInvestor(string $id)
    {
        return Investment::where("investor_id", '=', $id)->paginate(2);
    }

    /**
     * Description: Check if date is valid
     * 
     * @param string $soldIn "is the date of sale investment"
     * @param string $finalDate "is the date of withdraw investment"
     * 
     * @throws Exception "if date is invalid"
     */
    private function verifyMinimumMonthOfInvestment(string $soldIn, string $finalDate): bool
    {
        if (strtotime($soldIn) >= strtotime($finalDate))
            throw new Exception('The projection date cannot be less than the investment sale date.');

        return true;
    }

    /**
     * Description: Calculate the withdrawal amount with taxes  
     * 
     * @param string $soldIn "is the date of sale investment"
     * @param string $finalDate "is the date of withdraw investment"
     * @return int "Number of months"
     */
    private function monthDiff(string $soldIn, string $finalDate): int
    {
        $date1 = new DateTime($soldIn);
        $date2 = new DateTime($finalDate);

        $diffDate = $date1->diff($date2);

        return ($diffDate->m + (12 * $diffDate->y));
    }

    /**
     * Description: Calculate gain of investment  
     * 
     * @param Investment $investment
     * @param string $finalDate "is the date of withdrawal"
     * @return float "Gain without tax"
     */
    private function calculateGain(Investment $investment, string $finalDate): float
    {
        $investmentType = $investment->type;

        return $investment->value * pow((1 + ($investmentType->gain / 100)), $this->monthDiff($investment->sold_in, $finalDate)) - $investment->value;
    }

    /**
     * Description: Calculate the withdrawal amount with taxes  
     * 
     * @param string $finalDate "is the date of withdrawal"
     * @param Investment $investment
     * @return float "Gain with tax value"
     */
    private function calculateGainWithTax(string $finalDate, Investment $investment): float
    {
        $investmentType = $investment->type;

        $monthInterval = $this->monthDiff($investment->sold_in, $finalDate);

        $gain = $this->calculateGain($investment, $finalDate);

        switch (true) {
            case ($monthInterval < 12):
                $tax = $investmentType->tax_less_one_year;
                break;
            case ($monthInterval >= 12 && $monthInterval <= 24):
                $tax = $investmentType->tax_between_one_and_two_years;
                break;
            case ($monthInterval > 24):
                $tax =  $investmentType->tax_older_two_years;
                break;
        }

        return ($gain * (1 - ($tax / 100)));
    }

    /**
     * Description: Calculate the withdrawal amount with taxes  
     * 
     * @param Investor $investor "to send email"
     * @return bool "With erros?" 
     */
    private function notificateWithdraw(Investor $investor): bool
    {
        Mail::to($investor)->send(new InvestorNotification($investor));
        return empty(Mail::failures());
    }
}
