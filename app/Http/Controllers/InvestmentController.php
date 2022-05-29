<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestInvestment;
use App\Services\InvestmentInterface;
use App\Traits\ApiResponse;

class InvestmentController extends Controller
{
    use ApiResponse;

    public function __construct(private InvestmentInterface $investment)
    {
    }

    public function store(RequestInvestment $request)
    {
        return $this->run(function () use ($request) {
            return $this->investment->createInvestment($request->investor_id, $request->value, $request->sold_in);
        });
    }

    public function showInvestmentProjection($id, $projectionDate)
    {
        return $this->run(function () use ($id, $projectionDate) {
            return $this->investment->getInvestmentProjection($id, $projectionDate);
        });
    }

    public function withdraw($id, $withdrawDate)
    {
        return $this->run(function () use ($id, $withdrawDate) {
            return $this->investment->withdrawInvestment($id, $withdrawDate);
        });
    }
}
