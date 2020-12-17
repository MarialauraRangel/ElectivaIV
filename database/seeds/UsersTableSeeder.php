<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Super',
                'lastname' => 'Admin',
                'phone' => '12345678',
                'dni' => '00000000',
                'type_dni' => 'V',
                'address' => 'Mi Casita',
                'photo' => 'usuario.png',
                'slug' => 'super-admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('12345678'),
                'state' => "1",
                'type' => 1
            ],
            [
                'name' => 'Marialaura',
                'lastname' => 'Rangel',
                'phone' => '04121419412',
                'dni' => '27187524',
                'type_dni' => 'V',
                'address' => 'Sabaneta',
                'photo' => 'foto.png',
                'slug' => 'Marialaura-Rangel',
                'email' => 'laurazzrangel760@gmail.com@gmail.com',
                'password' => bcrypt('12345678'),
                'state' => "1",
                'type' => 3
            ],

            [
                'name' => 'Cesar',
                'lastname' => 'Pimentel',
                'phone' => '12345678',
                'dni' => '00000011',
                'type_dni' => 'V',
                'address' => 'Mi Casita',
                'photo' => 'usuario.png',
                'slug' => 'cesar-pimentel',
                'email' => 'cesarpimentel@gmail.com',
                'password' => bcrypt('12345678'),
                'state' => "1",
                'type' => 4
            ]

        ];
        DB::table('users')->insert($users);
    }
}
