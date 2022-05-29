<?php

namespace App\Services;

use App\Models\Investor;

interface InvestorInterface
{
    /**
     * Description: Method used to create investor with name and balance
     * 
     * @param string $name "Investor name"
     * @param float $balance "Is the investor balance"
     * @return bool "created or not"
     */
    public function createInvestor(string $name, float $balance): bool;

    /**
     * Description: Method used to get investor by id
     * 
     * @param int $id
     * @return Investor
     */
    public function getInvestorById(int $id): Investor;

    /**
     * Description: Method used to get investor balance by investor uuid 
     * 
     * @param int $id
     * @return float "Investor balance"
     */
    public function getInvestorBalanceById(int $id): float;

    /**
     * Description: Metod used to get the list of investments
     * 
     * @param int $id
     * @return Collection
     */
    public function getInvestmentsOfInvestor(string $id): Investor;
}
