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
        InvestmentType::create([
            "name" => "standard",
            "gain" => 0.52,
            "tax_less_one_year" => 22.5,
            "tax_between_one_and_two_years" => 18.5,
            "tax_older_two_years" => 15
        ]);
    }

    private function createInvestor()
    {
        Investor::create(["name" => 'iurru', "balance" => 7000.01]);
    }
}
