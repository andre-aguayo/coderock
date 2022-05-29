<?php

namespace App\Observers;

use App\Models\Investment;
use App\Models\InvestmentLog;

class InvestmentObserver
{
    public function created(Investment $investment)
    {
        $this->insertLog($investment, 'C');
    }

    public function deleted(Investment $investment)
    {
        $this->insertLog($investment, 'D');
    }

    public function updating(Investment $investment)
    {
        $this->insertLog($investment, 'U');
    }

    private function insertLog(Investment $investment, $action)
    {
        InvestmentLog::query()->create([
            'investment_id' => $investment->id,
            'investor_id' => $investment->investor_id,
            'value' => $investment->value,
            'active' => $investment->active,
            'sold_in' => $investment->sold_in,
            'action' => $action
        ]);
    }
}
