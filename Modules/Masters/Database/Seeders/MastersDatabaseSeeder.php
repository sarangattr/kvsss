<?php

namespace Modules\Masters\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Masters\Entities\MasterDistricts;
use Modules\Masters\Entities\MasterCountries;
use Modules\Masters\Entities\MasterStates;

class MastersDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
        $this->initMatserData();
    }
    public function initMatserData()
    {
        $countries = [
            ["name" => "india", "short_name" => "IN", "code" => 91]
        ];

        $state = [
            ["name" => "kerala", "short_name" => "KL", "country_id" => 1]
        ];

        $district = [
            ["name" => "kochi", "state_id" => 1],
            ["name" => "thiruvananthapuram", "state_id" => 1],
        ];

        MasterCountries::insert($countries);
        MasterStates::insert($state);
        MasterDistricts::insert($district);
    }
}
