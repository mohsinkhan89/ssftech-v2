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
        // Create Default Users with different roles
        User::updateOrCreate(
            ['email' => 'superadmin@ssftech.com'],
            [
                'name' => 'Super Administrator',
                'password' => Hash::make('password123'),
                'role' => 'administrator',
            ]
        );

        User::updateOrCreate(
            ['email' => 'admin@ssftech.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'author@ssftech.com'],
            [
                'name' => 'Author User',
                'password' => Hash::make('password123'),
                'role' => 'author',
            ]
        );

        // Seed Default Projects (so frontend displays them dynamically matching the original design)
        $defaultProjects = [
            [
                'title' => 'Inspire FM',
                'category' => 'website',
                'image_desktop' => 'frontend/assets/images/client-view/inspire-desktop.png',
                'image_tablet' => 'frontend/assets/images/client-view/inspire-desktop.png',
                'image_mobile' => 'frontend/assets/images/client-view/inspire-mobile.png',
                'project_url' => '#contact'
            ],
            [
                'title' => 'Granny Annexe',
                'category' => 'webapp',
                'image_desktop' => 'frontend/assets/images/client-view/granny-desktop.png',
                'image_tablet' => 'frontend/assets/images/client-view/granny-desktop.png',
                'image_mobile' => 'frontend/assets/images/client-view/granny-mobile.png',
                'project_url' => '#contact'
            ],
            [
                'title' => 'Finvest',
                'category' => 'ecommerce',
                'image_desktop' => 'frontend/assets/images/extracted/contact-card-shot.png',
                'image_tablet' => 'frontend/assets/images/extracted/contact-card-shot.png',
                'image_mobile' => 'frontend/assets/images/extracted/contact-card-shot.png',
                'project_url' => '#contact'
            ]
        ];

        foreach ($defaultProjects as $project) {
            Project::updateOrCreate(
                ['title' => $project['title']],
                $project
            );
        }

        // Seed Default Clients
        $defaultClients = [
            ['name' => 'TechNova', 'icon' => 'fa-solid fa-bolt'],
            ['name' => 'Digicorp', 'icon' => 'fa-solid fa-cubes'],
            ['name' => 'Finvest', 'icon' => 'fa-solid fa-chart-line'],
            ['name' => 'Marketly', 'icon' => 'fa-solid fa-shop'],
            ['name' => 'CloudMint', 'icon' => 'fa-solid fa-cloud'],
            ['name' => 'SecureX', 'icon' => 'fa-solid fa-shield-halved'],
            ['name' => 'LearnPro', 'icon' => 'fa-solid fa-graduation-cap'],
            ['name' => 'SwiftLogix', 'icon' => 'fa-solid fa-truck-fast'],
            ['name' => 'HealthGrid', 'icon' => 'fa-solid fa-heart-pulse'],
            ['name' => 'Foodora', 'icon' => 'fa-solid fa-utensils'],
            ['name' => 'BrandLab', 'icon' => 'fa-solid fa-pen-nib'],
            ['name' => 'Supportly', 'icon' => 'fa-solid fa-headset'],
        ];

        foreach ($defaultClients as $client) {
            \App\Models\Client::updateOrCreate(
                ['name' => $client['name']],
                $client
            );
        }
    }
}
