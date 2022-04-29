<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\Pond;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Package::factory(2)->for(Pond::factory()->create())->create();
    }
}
