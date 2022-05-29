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
            $table->float('gain', 5, 2, true)
                ->comment('in percentage');
            $table->float('tax_less_one_year', 5, 2, true)
                ->comment('in percentage');
            $table->float('tax_between_one_and_two_years', 5, 2, true)
                ->comment('in percentage');
            $table->float('tax_older_two_years', 5, 2, true)
                ->comment('in percentage');
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
