<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('expensetype_id');
            $table->foreign('expensetype_id')->references('id')->on('expensetypes');
            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->double('amount',8,2);
            $table->string('description');
            $table->string('addby', 20)->default('admin');
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
        Schema::dropIfExists('expenses');
    }
}
