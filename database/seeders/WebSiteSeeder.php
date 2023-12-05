<?php

namespace Database\Seeders;

use App\Models\WebSite;
use Illuminate\Database\Seeder;

class WebSiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WebSite::factory()->count(50)->create();
    }
}
