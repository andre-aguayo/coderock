<?php

namespace App\Services;

use App\Models\Investment;
use App\Models\Investor;
use Illuminate\Database\Eloquent\Collection;

interface InvestmentInterface
{
    /**
     * Description: Method used to create investment with name and balance
     * 
     * @param int $investorId "Investor idenfifier"
     * @param float $value "Invested amount"
     * @param string $soldIn "Date it was sold"
     * @throws \Exception "If $value is less than zero or sale date is in the future"
     * @return Investment "investment created"
     */
    public function createInvestment(int $investorId, float $value, string $soldIn): Investment;

    /**
     * Description: Method used to get investment by id
     * 
     * @param int $id "investment id"
     * @param bool $respectActive "to search only for active investments"
     * @throws \Exception "If investment not found."
     * @return Investment
     */
    public function getInvestmentById(int $id, bool $respectActive = false): Investment;

    /**
     * Description: Method used to calculate projection of investment
     * 
     * @param int $id "investment id"
     * @param string $projectionDate "Is the projection date of the investment calculation."
     * @throws \Exception
     * @return float "Returns the amount with tax"
     */
    public function getInvestmentProjection(int $id, string $projectionDate): array;

    /**
     * Description: Method used to withdraw the investment amount
     * 
     * @param int $id "investment id"
     * @param string $withdrawDate "date to withdraw investment"
     * @throws \Exception "If there are errors in the transaction."
     * @return Investor
     */
    public function withdrawInvestment(int $id, string $withdrawDate): Investor;

    /**
     * Description: Metod used to get the list of investments
     * 
     * @param int $id
     * @return Investment
     */
    public function getInvestmentsOfInvestor(string $id);
}
