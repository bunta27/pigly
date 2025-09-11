<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\WeightLog;
use App\Models\WeightTarget;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'testuser',
                'password' => Hash::make('password123'),
            ]
        );

        $user->weightLogs()->delete();

        $start = now()->subDays(34)->startOfDay();

        WeightLog::factory()
        ->count(35)
        ->sequence(fn ($sequence) => [
            'date' => $start->copy()->addDays($sequence->index)->toDateString(),
        ])
        ->for($user)
        ->create();

        $user->weightTarget()->delete();

        WeightTarget::factory()
            ->for($user)
            ->create();
    }
}
