<?php

namespace Database\Seeders;

use App\Models\Reviewer;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReviewersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reviewer::factory(5)->create();
    }
}
