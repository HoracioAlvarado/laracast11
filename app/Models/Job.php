<?php 
namespace App\Models;

use Illuminate\Support\Arr;

class Job {
    public static function all(): array
    {
        return [
            [
                'id' => 1,
                'title' => 'Director',
                'salary' => '$40,000'
            ],
            [
                'id' => 2,
                'title' => 'Programmer',
                'salary' => '$10,000'
            ],
            [
                'id' => 3,
                'title' => 'Teacher',
                'salary' => '$8,000'
            ]
        ];
    }

    public static function findOrFail(int $id): ?array
    {
        $job = Arr::first(static::all(), fn($job) => $job['id'] == $id );

        if (! $job) {
            abort(404);
        }

        return $job;
    }
}