<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;

class DashboardReportsController extends Controller
{
    public function all()
    {
        return [
            'data' => [
                'register' => $this->registerChart()
            ]
        ];
    }

    private function registerChart(): array
    {
        $users = User::query()->whereBetween('created_at', [Carbon::now()->subDays(30), Carbon::now()])->get()->groupBy(function (User $user) {
            return $user->created_at->format('Y-m-d');
        })->map(function ($users) {
            return $users->count();
        });

        return [
            'datasets' => [
                [
                    'label' => 'Register',
                    'backgroundColor' => 'hsla(220,86%,57%,0.7)',
                    'data' => $users->values()
                ]
            ],
            'labels' => $users->keys()
        ];
    }
}
