<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\TeamMember;
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
        Project::factory(25)
               ->hasAttached(TeamMember::factory(rand(1, 14))->create())
               ->create();
        TeamMember::factory(15)->create();
    }
}
