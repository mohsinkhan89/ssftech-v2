<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Project;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Default Admin User
        User::updateOrCreate(
            ['email' => 'admin@ssftech.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password123'),
            ]
        );

        // Seed Default Projects (so frontend displays them dynamically matching the original design)
        $defaultProjects = [
            [
                'title' => 'Inspire FM',
                'category' => 'website',
                'image' => 'frontend/assets/images/client-view/inspire-desktop.png',
                'project_url' => '#contact'
            ],
            [
                'title' => 'Granny Annexe',
                'category' => 'webapp',
                'image' => 'frontend/assets/images/client-view/granny-desktop.png',
                'project_url' => '#contact'
            ],
            [
                'title' => 'Finvest',
                'category' => 'ecommerce',
                'image' => 'frontend/assets/images/extracted/contact-card-shot.png',
                'project_url' => '#contact'
            ]
        ];

        foreach ($defaultProjects as $project) {
            Project::updateOrCreate(
                ['title' => $project['title']],
                $project
            );
        }
    }
}
