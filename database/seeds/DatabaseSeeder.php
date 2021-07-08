<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        \App\Models\User::create([
            'name' => 'Psicologo',
            'email' => 'psicologo@gmail.com',
            'password' => bcrypt('psico'),
        ]);

        \App\Models\User::create([
            'name' => 'Docente',
            'email' => 'docente@gmail.com',
            'password' => bcrypt('12345'),
        ]);


        \App\Models\Students::create([
            'name'=>'Marina', 
            'surnames'=>'Pariona Moreno', 
            'age'=>"35",
            'phone'=>"935658750",
            'grade'=>"5to"
        ]);
        \App\Models\Students::create([
            'name'=>'Deyci', 
            'surnames'=>'Tinco Carrasco', 
            'age'=>"31",
            'phone'=>"921380902",
            'grade'=>"4to"
        ]);
        \App\Models\Students::create([
            'name'=>'Edmundo', 
            'surnames'=>'Pozo Cruz', 
            'age'=>"61",
            'phone'=>"123456789",
            'grade'=>"3er"
        ]);
    }
}
