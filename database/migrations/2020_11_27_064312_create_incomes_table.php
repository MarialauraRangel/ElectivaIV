<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomes_24', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('vaucher')->comment('Numero del comprobante');
            $table->float('total')->default(0.00);
            $table->enum('state', [0, 1])->default(1);
            $table->bigInteger('saler_id')->unsigned()->nullable()->comment('Vendedor');
            $table->bigInteger('provider_id')->unsigned()->nullable()->comment('Proveedor');
            $table->timestamps();

            
            #Relations
            $table->foreign('saler_id')->references('id')->on('users_24');
            $table->foreign('provider_id')->references('id')->on('users_24');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incomes_24');
    }
}
