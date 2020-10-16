<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Skill::firstOrCreate(['name' => 'Comunicación']);
        Skill::firstOrCreate(['name' => 'Empatía']);
        Skill::firstOrCreate(['name' => 'Liderazgo']);
    }
}
