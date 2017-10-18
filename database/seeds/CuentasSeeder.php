<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class CuentasSeeder extends Seeder
{
    public function run()
    {

        $dataSet = [
            ['tipo' => 'EFECTIVO','nombre' => 'Caja local'],
            ['tipo' => 'EFECTIVO','nombre' => 'Caja general'],

            ['tipo' => 'BANCO','nombre' => 'BBVA Matias'],
            ['tipo' => 'BANCO','nombre' => 'BBVA Fito'],
            ['tipo' => 'BANCO','nombre' => 'Mercadopago'],

            ['tipo' => 'A COBRAR','nombre' => 'Cheque tercero'],
            ['tipo' => 'A COBRAR','nombre' => 'VISA'],

            ['tipo' => 'A PAGAR','nombre' => 'Cheque propio'],
            ['tipo' => 'A PAGAR','nombre' => 'Visa corporativa']
        ];

        DB::table('cuentas')->insert($dataSet);
    }
}
