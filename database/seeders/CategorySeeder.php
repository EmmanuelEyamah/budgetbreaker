<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $parentCategories = [
            [
                'name' => 'Giving & Values',
                'percentage' => 15.00,
                'children' => [
                    ['name' => 'Church', 'percentage' => 10.00],
                    ['name' => 'Charity / Requests', 'percentage' => 5.00],
                ]
            ],
            [
                'name' => 'Fixed Operating Costs',
                'percentage' => 14.00,
                'children' => [
                    ['name' => 'Paid Tools', 'percentage' => 8.00],
                    ['name' => 'Internet / Data', 'percentage' => 4.00],
                    ['name' => 'Light Bill', 'percentage' => 2.00],
                ]
            ],
            [
                'name' => 'Family & Relationship',
                'percentage' => 9.00,
                'children' => [
                    ['name' => 'Mother', 'percentage' => 5.00],
                    ['name' => 'Girlfriend', 'percentage' => 4.00],
                ]
            ],
            [
                'name' => 'Personal Self-Investment',
                'percentage' => 15.00,
                'children' => [
                    ['name' => 'Appearance & Grooming', 'percentage' => 3.00],
                    ['name' => 'Clothing & Lifestyle Assets', 'percentage' => 3.00],
                    ['name' => 'Gadgets & Personal Tech', 'percentage' => 9.00],
                ]
            ],
            [
                'name' => 'Business Growth',
                'percentage' => 12.00,
                'children' => [
                    ['name' => 'Company Setup & Admin', 'percentage' => 6.00],
                    ['name' => 'Marketing & Ads', 'percentage' => 3.00],
                    ['name' => 'Operations & Experiments', 'percentage' => 3.00],
                ]
            ],
            [
                'name' => 'Feeding',
                'percentage' => 10.00,
                'children' => [
                    ['name' => 'Monthly Stocking', 'percentage' => 5.00],
                    ['name' => 'Weekly Feeding', 'percentage' => 5.00],
                ]
            ],
            [
                'name' => 'Savings',
                'percentage' => 25.00,
                'children' => [
                    ['name' => 'Long-Term Annual Savings', 'percentage' => 10.00],
                    ['name' => 'Planned Purchases', 'percentage' => 7.00],
                    ['name' => 'Emergency Fund', 'percentage' => 5.00],
                    ['name' => 'Short-Term Buffer', 'percentage' => 3.00],
                ]
            ],
        ];

        foreach ($parentCategories as $parentData) {
            $parent = Category::create([
                'name' => $parentData['name'],
                'percentage' => $parentData['percentage'],
            ]);

            foreach ($parentData['children'] as $childData) {
                Category::create([
                    'name' => $childData['name'],
                    'percentage' => $childData['percentage'],
                    'parent_id' => $parent->id,
                ]);
            }
        }
    }
}
