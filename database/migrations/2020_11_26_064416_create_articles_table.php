<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles_24', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('category_id')->unsigned()->nullable()->comment('Categoria');
            $table->string('slug')->unique()->comment('Identificador');
            $table->string('cod')->nullable()->comment('Codigo');
            $table->string('name')->comment('Nombre');
            $table->integer('stock')->unsigned()->nullable();
            $table->float('sale_price', 10, 2)->default(0.00)->comment('Precio_venta');
            $table->float('purchase_price', 10, 2)->default(0.00)->comment('Precio_compra');
            $table->string('description');
            $table->enum('state', [0, 1])->default(1)->comment('Estado');
            $table->string('photo')->default('usuario.png');
            $table->timestamps();

            #Relations
            $table->foreign('category_id')->references('id')->on('categories_24')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles_24');
    }
}
