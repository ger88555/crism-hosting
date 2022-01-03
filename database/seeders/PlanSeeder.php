<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Plan::factory()->create(['hosting' => true, 'domain' => true, 'vpn' => false, 'email' => false]);
        \App\Models\Plan::factory()->create(['hosting' => true, 'domain' => true, 'vpn' => true, 'email' => false]);
        \App\Models\Plan::factory()->create(['hosting' => true, 'domain' => true, 'vpn' => true, 'email' => true]);
    }
}
