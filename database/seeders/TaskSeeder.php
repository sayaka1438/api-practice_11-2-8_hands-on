<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // テストユーザー（ID: 1）に紐づくサンプルタスクを作成
        $tasks = [
            [
                'user_id' => 1,
                'title' => '企画書を作成する',
                'description' => '来週のミーティングに向けて企画書を作成する',
                'status' => 'pending',
                'due_date' => now()->addDays(7)->format('Y-m-d'),
            ],
            [
                'user_id' => 1,
                'title' => 'メールの返信',
                'description' => 'クライアントからのメールに返信する',
                'status' => 'in_progress',
                'due_date' => now()->addDays(1)->format('Y-m-d'),
            ],
            [
                'user_id' => 1,
                'title' => 'コードレビュー',
                'description' => 'チームメンバーのプルリクエストをレビューする',
                'status' => 'pending',
                'due_date' => now()->addDays(3)->format('Y-m-d'),
            ],
            [
                'user_id' => 1,
                'title' => '週次レポートの提出',
                'description' => '今週の進捗レポートを作成して提出する',
                'status' => 'completed',
                'due_date' => now()->subDays(1)->format('Y-m-d'),
            ],
            [
                'user_id' => 1,
                'title' => 'ドキュメントの更新',
                'description' => 'プロジェクトのREADMEを最新の状態に更新する',
                'status' => 'pending',
                'due_date' => null,
            ],
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}
