<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 固定のテストユーザーを作成（ID: 1）
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            // パスワードはデフォルトで 'password'
        ]);
    }
}
