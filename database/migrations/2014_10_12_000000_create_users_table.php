<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void 
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('lastname');
            $table->string('photo')->default('usuario.png');
            $table->string('slug')->unique();
            $table->string('phone')->nullable();
            $table->string('dni');
            $table->string('type_dni');
            $table->string('address')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->enum('state', [0, 1])->default(1);
            $table->enum('type', [1, 2, 3, 4])->default(1);
            $table->rememberToken();
            $table->timestamps();

            // Admin = 1
            //Vendedor = 2
            //Cliente = 3
            // Proveedor = 4
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_24');
    }
}
