<?php

namespace App\Services;

use App\Models\Investor;

class  InvestorService implements InvestorInterface
{
    public function createInvestor(string $name, float $balance): bool
    {
        return Investor::create(["name" => $name, "balance" => $balance]);
    }

    public function getInvestorById(int $id): Investor
    {
        return Investor::where("id", "=", $id);
    }

    public function getInvestorBalanceById(int $id): float
    {
        return $this->getInvestorById($id)->balance;
    }

    public function getInvestmentsOfInvestor(string $id): Investor
    {
        return $this->getInvestorById($id)->paginate(10);
    }
}
