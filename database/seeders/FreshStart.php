<?php

namespace Database\Seeders;

use App\Models\Customer;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Expense;
use App\Models\Project;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FreshStart extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
        ]);

        $expenses = [
            [
                'expense_name' => 'Salary',
                'slug' => 'salary',
            ],
            [
                'expense_name' => 'Rent',
                'slug' => 'rent',
            ],
            [
                'expense_name' => 'Developer Cost',
                'slug' => 'developer-cost',
            ],
            [
                'expense_name' => 'Up Work Connects',
                'slug' => 'up-work-connects',
            ],
            [
                'expense_name' => 'Other',
                'slug' => 'other',
            ],
        ];

        foreach($expenses as $item){
            Expense::create($item);
        }

        Customer::Create([
            'customer_name' => 'Test',
            'slug' => 'test',
            'email' => 'test@gmail.com',
        ]);
        Project::create([
            'customer_id' => 1,
            'project_name' => 'Test',
            'slug' => 'test',
            'cost' => 400,
            'type' => 'Fixed',
        ]);

        Setting::create([
            'app_name' => 'Cost Tracking',
            'description' => 'Cost tracking is a small project to track payment and expense with in Up work'
        ]);
    }
}
