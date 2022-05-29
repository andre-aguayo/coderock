<?php

namespace Database\Seeders;

use App\Models\InvestmentType;
use App\Models\Investor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->createInvestmentType();

        $this->createInvestor();
    }

    private function createInvestmentType()
    {
        InvestmentType::create(["name" => "standard", "tax" => 0.52]);
    }

    private function createInvestor()
    {
        Investor::create(["name" => 'iurru', "balance" => 7000.01]);
    }
}
