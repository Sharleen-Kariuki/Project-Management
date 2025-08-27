<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    public function run()
    {
        Company::create(['name' => 'WizGlobal Kenya Ltd']);
        Company::create(['name' => 'Xamara Solutions']);
    }
}
