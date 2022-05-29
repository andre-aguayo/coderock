<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestInvestor;
use App\Services\InvestmentInterface;
use App\Traits\ApiResponse;
use App\Services\InvestorInterface;
use Illuminate\Http\Request;

class InvestorController extends Controller
{

    use ApiResponse;

    public function __construct(private InvestorInterface $investor, private InvestmentInterface $investment)
    {
    }

    public function store(RequestInvestor $request)
    {
        return $this->run(function () use ($request) {
            return $this->investor->createInvestor($request->name, $request->initial_balance);
        });
    }

    public function show($id)
    {
        return $this->run(function () use ($id) {
            return  $this->investor->getInvestorById($id);
        });
    }

    public function showInvestments($id)
    {
        return $this->run(function () use ($id) {
            return $this->investment->getInvestmentsOfInvestor($id);
        });
    }
}
