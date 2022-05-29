<?php

namespace App\Observers;

use App\Models\Investor;
use App\Models\InvestorLog;

class InvestorObserver
{
    public function created(Investor $investor)
    {
        $this->insertLog($investor, 'C');
    }

    public function deleted(Investor $investor)
    {
        $this->insertLog($investor, 'D');
    }

    public function updating(Investor $investor)
    {
        $this->insertLog($investor, 'U');
    }

    private function insertLog(Investor $investor, $action)
    {
        InvestorLog::query()->create([
            'investor_id' => $investor->id,
            'name' => $investor->name,
            'balance' => $investor->balance,
            'action' => $action
        ]);
    }
}
