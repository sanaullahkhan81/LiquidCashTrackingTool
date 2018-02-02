<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurBalanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cur_balance', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cur_id')->unsigned()->nullable();
            $table->date('entry_date')->default(0.00);
            $table->decimal('amount', 15, 2)->nullable();
            $table->decimal('entered_amount', 15, 2)->default(0.00);
            $table->decimal('closing_amount', 15, 2)->default(0.00);
            $table->decimal('variance', 15, 2)->default(0.00);
            $table->timestamps();
            $table->softDeletes();
            $table->index(['deleted_at']);
            $table->unique(['cur_id', 'entry_date']);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cur_balance');
    }
}
