<?php

use Illuminate\Database\Seeder;

class RolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$rols = [
    		[
    			'id' => 1,
    			'name' => 'Administrador',
    			'slug' => 'admin',
    			'description' => 'Administador del sistema'
    		],
    		[
    			'id' => 2,
    			'name' => 'Usuario', 
    			'slug' => 'user',
    			'description' => 'Ususario Regular del sistema'
    		],
           
    		[
    			'id' => 3,
    			'name' => 'Proveedor',
    			'slug' => 'proveeedor',
    			'description' => 'Proveedor de productos'
    		]
           
       ];
       DB::table('rols_24')->insert($rols);
   }
}
