<?php

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
        Schema::create('investment_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('tax', 5, 2, true)
                ->comment('in percentage');
            $table->date('minimum_moths')
                ->nullable()
                ->comment('It is the minimum number of months. If null has no minimum time');
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
        Schema::dropIfExists('investment_types');
    }
};
