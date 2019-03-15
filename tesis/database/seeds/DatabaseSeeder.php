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
    	//Seeders de la tabla tipo de trámite
        DB::table('request_types')->insert([
            'id'   => 1,
            'info' => "Materias en paralelo"
        ]);

       	DB::table('request_types')->insert([
            'id'   => 2,
            'info' => "Colisión de horarios"
        ]);

        DB::table('request_types')->insert([
            'id'   => 3,
            'info' => "Exceso de unidades de crédito"
        ]);

       	DB::table('request_types')->insert([
            'id'   => 4,
            'info' => "Proyecto de grado"
        ]);

       	//Seeders de la tabla estado
        DB::table('statuses')->insert([
            'id'   => 1,
            'info' => "Negado"
        ]);

       	DB::table('statuses')->insert([
            'id'   => 2,
            'info' => "En espera de ser procesada"
        ]);

        DB::table('statuses')->insert([
            'id'   => 3,
            'info' => "En proceso - Dirección"
        ]);

        DB::table('statuses')->insert([
            'id'   => 4,
            'info' => "En proceso - Consejo de Departamento"
        ]);

        DB::table('statuses')->insert([
            'id'   => 5,
            'info' => "En proceso - Consejo de Escuela"
        ]);

       	DB::table('statuses')->insert([
            'id'   => 6,
            'info' => "Aprobado"
        ]);

        DB::table('statuses')->insert([
            'id'   => 7,
            'info' => "Verificado-Secretaria de dirección"
        ]);

        DB::table('statuses')->insert([
            'id'   => 8,
            'info' => "Verificado-Secretaria de departamento"
        ]);

		//Seeders de la tabla tipo de areas
		DB::table('areas')->insert([
            'id'   => 1,
		  	'info' => 'Sistemas Computacionales',
		]);

		DB::table('areas')->insert([
            'id'   => 2,
		  	'info' => 'Control y Automatizacion',
		]);

		DB::table('areas')->insert([
            'id'   => 3,
		  	'info' => 'Investigacion de Operaciones',
		]);

		DB::table('areas')->insert([
            'id'   => 4,
		  	'info' => 'Escuela',
		]);
    }
}
