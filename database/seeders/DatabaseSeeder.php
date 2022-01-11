<?php

namespace Database\Seeders;

use App\Models\Abonado;
use App\Models\Provinces;
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
        // $this->call([
        //     // SampleDataSeeder::class
        //     ProvincesSeeder::class
        // ]);
        $this->provinceSeeder();
        $this->abonadosSeeder();
    }



    public function provinceSeeder()
    {
        Provinces::truncate();
        $provinces = [
            "Misiones", "Catamarca", "Salta", "Buenos Aires", "Santiago del estero", "Tucuman", "Corrientes", "Entre Rios",
        ];

        foreach ($provinces as $prov) {
            Provinces::create([
                "name" => $prov,
            ]);
            $this->command->info("Province $prov created!");
        }
    }

    public function abonadosSeeder()
    {
        Abonado::truncate();
        Abonado::create([
            "name" => "Abonado 1",
            "last_name" => "Abonado 1",
            "sex" => "masculino",
            "province_id" => 1,
        ]);
        $this->command->info("Abonado created!");
    }
}
