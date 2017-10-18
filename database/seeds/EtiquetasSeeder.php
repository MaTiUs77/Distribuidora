<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class EtiquetasSeeder extends Seeder
{
    public function run()
    {

        $dataSet = [
            ['nombre' => 'Entregado'],
            ['nombre' => 'Reservado'],
            ['nombre' => 'Pendiente'],
            ['nombre' => 'A entregar'],
            ['nombre' => 'En proceso'],
            ['nombre' => 'Finalizado']
        ];

        DB::table('etiquetas')->insert($dataSet);
    }
}
