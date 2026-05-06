<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'status_label' => $this->getStatusLabel(),
            'due_date' => $this->formatDueDate(),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }

    /**
     * ステータスの日本語ラベルを取得
     */
    private function getStatusLabel()
    {
        $labels = [
            'pending' => '未着手',
            'in_progress' => '進行中',
            'completed' => '完了',
        ];

        if (isset($labels[$this->status])) {
            return $labels[$this->status];
        }

        return $this->status;
    }

    /**
     * 期限日をフォーマット
     */
    private function formatDueDate()
    {
        if ($this->due_date) {
            return $this->due_date->format('Y-m-d');
        }

        return null;
    }
}
