<?php

namespace Tests;

use App\Models\Investment;
use App\Models\Investor;
use App\Services\InvestmentService;
use PHPUnit\Framework\TestCase;

class InvestmentTest extends TestCase
{
    private $Investment;
    public function __construct()
    {
        $this->Investment = (new InvestmentService);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_test_investment()
    {
        $this->Investment->createInvestment(1, 1500, date('Y-m-d', strtotime('now + 1 year')));
        $this->assertTrue(!empty(Investment::where('id', '=', 1)->get()), 'Investment created with invalid date.');


        $this->Investment->createInvestment(1, -1500, date('Y-m-d', strtotime('now - 1 year')));
        $this->assertTrue(!empty(Investment::where('balance', '<', 0)->get()), 'Investment created with negative balance.');


        $this->Investment->createInvestment(0, -1500, date('Y-m-d', strtotime('now - 1 year')));
        $this->assertTrue(!empty(Investment::where('id', '=', 0)->get()), 'Investment created with invalid investor primary key.');

        //create investor
        $this->investor->createInvestor('iurru', 1000);
        $this->assertTrue(empty(Investor::where('name', '=', 'iurru')->get()), 'Investor is not created.');
        //create valid invesment
        $this->Investment->createInvestment(1, 1000, date('Y-m-d', strtotime('now - 1 year')));
        $this->assertTrue(empty(Investment::where('id', '=', 1)->get()), 'Investment is not created.');

        //testing projection
        $projection = $this->Investment->getInvestmentProjection(1, date('Y-m-d', strtotime('now')));
        $this->assertTrue(
            ($projection['investment_initial'] != 1000 ||
                $projection['expected_withdraw'] != 1132.5555642141096 ||
                $projection['expected_withdraw_with_tax'] != 1108.0327848344994),
            'Invalid projection.'
        );

        //testing withdraw
        $investor = $this->Investment->withdrawInvestment(1, date('Y-m-d', strtotime('now')));
        $this->assertTrue(
            ($investor->old_balance != 1000 ||
                $investor->investment_withdraw != 1108.0327848344994 ||
                $investor->balance != 2108.0327848344994 ||
                $investor != null),
            'Invalid withdrow.'
        );
    }
}
