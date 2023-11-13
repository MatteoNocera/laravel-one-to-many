<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 10; $i++) {

            $project = new Project();

            $project->cover_image = 'placeholders' . $faker->image('public/storage/placeholders', 360, 360, 'animals', fullPath: false);

            $project->title = $faker->realText(50);
            $project->description = $faker->realText();
            $project->slug = Str::slug($project->title, '-');

            $project->save();
        }
    }
}
