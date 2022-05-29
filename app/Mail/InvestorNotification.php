<?php

namespace App\Mail;

use App\Models\Investor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvestorNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(private Investor $investor)
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('view.name') //Onde estaria a view.blade.php criada para enviar o email
            ->with([
                "name" => $this->investor->name,
                "balance" => $this->player->balance,
                "old_balance" => $this->player->old_balance,
                "investment_withdraw" => $this->player->investment_withdraw,
                "investment_tax" => $this->player->investment_tax
            ]);
    }
}
