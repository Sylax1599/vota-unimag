<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TodosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $useradmin=User::create([
            'nombre'=> 'Alex',
            'apellido'=>' Ortega',
            'codigo'=>'2016214051',
            'numero_identificacion' =>'1221981435',
            'password'=> Hash::make('admin'),
            'fullacces' => 'yes',
            'programa_id'=>'1',
            'rol_id'=>'1'
        ]);

    }
}
