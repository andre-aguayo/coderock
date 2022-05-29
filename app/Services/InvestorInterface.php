<?php

namespace App\Services;

use App\Models\Investor;

interface InvestorInterface
{
    /**
     * Description: Method used to create investor with name and balance
     * 
     * @param string $name "Investor name"
     * @param float $balance "Is the investor initial balance"
     * @return Investor "Investor created"
     */
    public function createInvestor(string $name, float $balance): Investor;

    /**
     * Description: Method used to get investor by id
     * 
     * @param int $id
     * @return Investor
     */
    public function getInvestorById(int $id): Investor;

    /**
     * Description: Method used to get investor balance by id 
     * 
     * @param int $id
     * @return float "Investor balance"
     */
    public function getInvestorBalanceById(int $id): float;
}
