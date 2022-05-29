<?php

use App\Models\Investment;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investment_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('investment_id')->constrained('investments');
            $table->float('value', 10, 2, true);
            $table->boolean('active');
            $table->date('sold_in');
            $table->char('action', 1)->comment('C - Created, U - Updated, D - Deleted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('investment_logs');
    }
};
