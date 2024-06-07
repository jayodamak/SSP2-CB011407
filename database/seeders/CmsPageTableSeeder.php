<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CmsPage;

class CmsPageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cmsPagesRecords = [
            [
                'id' => 1,
                'title' => 'About Us',
                'url' => 'about-us',
                'description' => 'About Us',
                'meta_title' => 'About Us',
                'meta_description' => 'About Us',
                'meta_keywords' => 'about us, about',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'title' => 'Privacy Policy',
                'url' => 'privacy-policy',
                'description' => 'Privacy Policy',
                'meta_title' => 'Privacy Policy',
                'meta_description' => 'Privacy Policy',
                'meta_keywords' => 'Privacy Policy',
                'status' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'title' => 'Terms and Conditions',
                'url' => 'terms-and-conditions',
                'description' => 'Terms and Conditions',
                'meta_title' => 'Terms and Conditions',
                'meta_description' => 'Terms and Conditions',
                'meta_keywords' => 'Terms and Conditions',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        CmsPage::insert($cmsPagesRecords);
    }
}
