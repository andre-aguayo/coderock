<?php

namespace Tests;


use App\Models\Investor;
use App\Services\InvestorService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class InvestorTest extends TestCase
{

    use RefreshDatabase;
    private $investor;
    public function __construct()
    {
        $this->investor = (new InvestorService);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create_investor()
    {
        $this->investor->createInvestor('iurru2', -1500);
        $this->assertTrue(!empty(Investor::where('balance', '<', 0)->get()), 'Investor created with negative balance.');
    }
}
