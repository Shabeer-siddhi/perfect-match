<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\CustomerAttribute;
use App\Models\Location\State;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        CustomerAttribute::insert([
            // [
            //     'attribute_name' => 'religion',
            //     'attribute_value' => 'Hinduism',
            // ],
            // [
            //     'attribute_name' => 'religion',
            //     'attribute_value' => 'Islam',
            // ],
            // [
            //     'attribute_name' => 'religion',
            //     'attribute_value' => 'Christianity',
            // ],
            // [
            //     'attribute_name' => 'religion',
            //     'attribute_value' => 'Buddhism',
            // ],
            // [
            //     'attribute_name' => 'religion',
            //     'attribute_value' => 'Jainism',
            // ],
            // [
            //     'attribute_name' => 'religion',
            //     'attribute_value' => 'Judaism',
            // ],
            [
                'attribute_name' => 'cast',
                'attribute_value' => 'Brahmin',
                'data_type' => 'Hinduism'
            ],
            [
                'attribute_name' => 'cast',
                'attribute_value' => 'Kshatriya',
                'data_type' => 'Hinduism'
            ],
            [
                'attribute_name' => 'cast',
                'attribute_value' => 'Vaishya',
                'data_type' => 'Hinduism'
            ],
            [
                'attribute_name' => 'cast',
                'attribute_value' => 'Shudra',
                'data_type' => 'Hinduism'
            ],
            [
                'attribute_name' => 'cast',
                'attribute_value' => 'Nair',
                'data_type' => 'Hinduism'
            ],
            [
                'attribute_name' => 'cast',
                'attribute_value' => 'Ezhava',
                'data_type' => 'Hinduism'
            ],
            [
                'attribute_name' => 'cast',
                'attribute_value' => 'Thiyya',
                'data_type' => 'Hinduism'
            ],
            [
                'attribute_name' => 'cast',
                'attribute_value' => 'Sunni',
                'data_type' => 'Islam'
            ],
            [
                'attribute_name' => 'cast',
                'attribute_value' => 'Mujahid',
                'data_type' => 'Islam'
            ],
            [
                'attribute_name' => 'cast',
                'attribute_value' => 'Jamaat',
                'data_type' => 'Islam'
            ],
            [
                'attribute_name' => 'cast',
                'attribute_value' => 'Rauther',
                'data_type' => 'Islam'
            ],
            [
                'attribute_name' => 'cast',
                'attribute_value' => 'Mappila',
                'data_type' => 'Islam'
            ],
            [
                'attribute_name' => 'cast',
                'attribute_value' => 'Protestant',
                'data_type' => 'Christianity'
            ],
            [
                'attribute_name' => 'cast',
                'attribute_value' => 'Catholic',
                'data_type' => 'Christianity'
            ],
            [
                'attribute_name' => 'cast',
                'attribute_value' => 'Syrian Orthodox',
                'data_type' => 'Christianity'
            ],
        ]);


        // CustomerAttribute::insert([
        //     [
        //         'attribute_name' => 'hobbies',
        //         'attribute_value' => 'Writing',
        //     ],
        //     [
        //         'attribute_name' => 'hobbies',
        //         'attribute_value' => 'Travelling',
        //     ],
        //     [
        //         'attribute_name' => 'hobbies',
        //         'attribute_value' => 'Cooking',
        //     ],
        //     [
        //         'attribute_name' => 'hobbies',
        //         'attribute_value' => 'Sports',
        //     ],
        //     [
        //         'attribute_name' => 'hobbies',
        //         'attribute_value' => 'Music',
        //     ],
        //     [
        //         'attribute_name' => 'hobbies',
        //         'attribute_value' => 'Gardening',
        //     ],
        //     [
        //         'attribute_name' => 'hobbies',
        //         'attribute_value' => 'Arts and crafts',
        //     ],
        //     [
        //         'attribute_name' => 'interests',
        //         'attribute_value' => 'Technology',
        //     ],
        //     [
        //         'attribute_name' => 'interests',
        //         'attribute_value' => 'Photography',
        //     ],
        //     [
        //         'attribute_name' => 'interests',
        //         'attribute_value' => 'Outdoor Activities',
        //     ],
        //     [
        //         'attribute_name' => 'interests',
        //         'attribute_value' => 'Fashion',
        //     ],
        //     [
        //         'attribute_name' => 'interests',
        //         'attribute_value' => 'Socializing',
        //     ],
        //     [
        //         'attribute_name' => 'interests',
        //         'attribute_value' => 'Fitness',
        //     ],
        //     [
        //         'attribute_name' => 'interests',
        //         'attribute_value' => 'Volunteering',
        //     ],
        //     [
        //         'attribute_name' => 'interests',
        //         'attribute_value' => 'Movies',
        //     ],
        //     [
        //         'attribute_name' => 'family_type',
        //         'attribute_value' => 'Nuclear',
        //     ],
        //     [
        //         'attribute_name' => 'family_type',
        //         'attribute_value' => 'Joint',
        //     ],
        //     [
        //         'attribute_name' => 'no_siblings',
        //         'attribute_value' => '1',
        //     ],
        //     [
        //         'attribute_name' => 'no_siblings',
        //         'attribute_value' => '2',
        //     ],
        //     [
        //         'attribute_name' => 'no_siblings',
        //         'attribute_value' => '3',
        //     ],
        //     [
        //         'attribute_name' => 'no_siblings',
        //         'attribute_value' => '4',
        //     ],
        //     [
        //         'attribute_name' => 'family_background',
        //         'attribute_value' => 'Nuclear',
        //     ],
        //     [
        //         'attribute_name' => 'family_background',
        //         'attribute_value' => 'Joint',
        //     ],
        //     [
        //         'attribute_name' => 'preferred_no_siblings',
        //         'attribute_value' => '1',
        //     ],
        //     [
        //         'attribute_name' => 'preferred_no_siblings',
        //         'attribute_value' => '2',
        //     ],
        //     [
        //         'attribute_name' => 'preferred_profession',
        //         'attribute_value' => 'IT/software',
        //     ],
        //     [
        //         'attribute_name' => 'preferred_profession',
        //         'attribute_value' => 'Education/Teaching',
        //     ],
        //     [
        //         'attribute_name' => 'preferred_profession',
        //         'attribute_value' => 'Healthcare/ Medicine',
        //     ],
        //     [
        //         'attribute_name' => 'preferred_profession',
        //         'attribute_value' => 'Engineering',
        //     ],
        //     [
        //         'attribute_name' => 'preferred_profession',
        //         'attribute_value' => 'Art/Entertainment',
        //     ],
        //     [
        //         'attribute_name' => 'preferred_profession',
        //         'attribute_value' => 'Self Employed',
        //     ],
        //     [
        //         'attribute_name' => 'preferred_profession',
        //         'attribute_value' => 'Business/Management',
        //     ],
        //     [
        //         'attribute_name' => 'preferred_profession',
        //         'attribute_value' => 'Finance/Accounting',
        //     ], [
        //         'attribute_name' => 'profession',
        //         'attribute_value' => 'IT/software',
        //     ],
        //     [
        //         'attribute_name' => 'profession',
        //         'attribute_value' => 'Education/Teaching',
        //     ],
        //     [
        //         'attribute_name' => 'profession',
        //         'attribute_value' => 'Healthcare/ Medicine',
        //     ],
        //     [
        //         'attribute_name' => 'profession',
        //         'attribute_value' => 'Engineering',
        //     ],
        //     [
        //         'attribute_name' => 'profession',
        //         'attribute_value' => 'Art/Entertainment',
        //     ],
        //     [
        //         'attribute_name' => 'profession',
        //         'attribute_value' => 'Self Employed',
        //     ],
        //     [
        //         'attribute_name' => 'profession',
        //         'attribute_value' => 'Business/Management',
        //     ],
        //     [
        //         'attribute_name' => 'profession',
        //         'attribute_value' => 'Finance/Accounting',
        //     ],
        //     [
        //         'attribute_name' => 'education',
        //         'attribute_value' => 'No formal education',
        //     ],
        //     [
        //         'attribute_name' => 'education',
        //         'attribute_value' => 'SSLC',
        //     ],
        //     [
        //         'attribute_name' => 'education',
        //         'attribute_value' => '+2',
        //     ],
        //     [
        //         'attribute_name' => 'education',
        //         'attribute_value' => 'Diploma',
        //     ],
        //     [
        //         'attribute_name' => 'education',
        //         'attribute_value' => "Bachelor's degree",
        //     ],
        //     [
        //         'attribute_name' => 'education',
        //         'attribute_value' => "Master's degree",
        //     ],
        //     [
        //         'attribute_name' => 'education',
        //         'attribute_value' => "Doctorate",
        //     ],
        // ]);
    }
}
