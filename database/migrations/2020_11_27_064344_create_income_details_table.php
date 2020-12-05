<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_details_24', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('income_id')->unsigned()->nullable()->comment('Ingreso');
            $table->bigInteger('article_id')->unsigned()->nullable()->comment('Articulo');
            $table->integer('quantity')->comment('Cantidad');
            $table->float('sale_price', 10, 2)->default(0.00)->comment('Precio');
            $table->timestamps();

            #Relations
            $table->foreign('income_id')->references('id')->on('incomes_24')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('article_id')->references('id')->on('articles_24')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('income_details_24');
    }
}
