<?php

namespace App\Services;

use App\Models\Investor;
use Exception;

class  InvestorService implements InvestorInterface
{
    public function createInvestor(string $name, float $balance): Investor
    {
        return Investor::create(["name" => $name, "balance" => $balance]);
    }

    public function getInvestorById(int $id): Investor
    {
        $investor = Investor::where("id", "=", $id)->first();

        if (empty($investor))
            throw new Exception('Investor not found.');

        return $investor;
    }

    public function getInvestorBalanceById(int $id): float
    {
        return $this->getInvestorById($id)->balance;
    }
}
