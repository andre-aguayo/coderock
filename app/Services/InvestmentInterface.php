<?php

namespace App\Services;

use App\Models\Investment;
use App\Models\Investor;

interface InvestmentInterface
{
    /**
     * Description: Method used to create investment with name and balance
     * 
     * @param int $investorId "Investor idenfifier"
     * @param float $value "Invested amount"
     * @param string $soldIn "Date it was sold"
     * @return bool "created or not"
     */
    public function createInvestment(int $investorId, float $value, string $soldIn): bool;

    /**
     * Description: Method used to get investment by id
     * 
     * @param int $id "investment id"
     * @return Investment
     */
    public function getInvestmentById(int $id): Investment;

    /**
     * Description: Method used to get investment by id
     * 
     * @param int $id "investment id"
     * @return float "Returns the amount with tax"
     */
    public function getInvestmentProjection(int $id, string $projectionDate): float;

    /**
     * Description: Method used to get investment by id
     * 
     * @param int $id "investment id"
     * @return bool "created or not"
     */
    public function withdrawInvestment(int $id): ?Investor;
}
