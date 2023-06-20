<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $irishCounties = [
            "CRK" => "Cork",
            "DBL" => "Dublin",
            "DNG" => "Donegal",
            "TIP" => "Tipperary",
            "WEX" => "Wexford",
        ];

        $countries = [
            ['code' => 'ire', 'name' => 'Ireland', 'counties' => json_encode($irishCounties)],
            ['code' => 'uk', 'name' => 'United Kingdom', 'counties' => null],
            ['code' => 'usa', 'name' => 'United States of America', 'counties' => null],
            ['code' => 'ger', 'name' => 'Germany', 'counties' => null],
        ];
        Country::insert($countries);
    }
}
