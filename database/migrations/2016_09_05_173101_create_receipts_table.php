<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('table_id')->unsigned()->nullable();
            $table->integer('total');
            $table->integer('paid');
            $table->integer('payment_id')->unsigned();
            $table->string('payment_info');
            $table->dateTime('check_in_at');
            $table->dateTime('check_out_at');
            $table->timestamps();
        });

        Schema::table('receipts', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('restrict')->onUpdate('cascade');

            $table->foreign('table_id')
                ->references('id')->on('tables')
                ->onDelete('set null')->onUpdate('cascade');

            $table->foreign('payment_id')
                ->references('id')->on('payments')
                ->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receipts');
    }
}
