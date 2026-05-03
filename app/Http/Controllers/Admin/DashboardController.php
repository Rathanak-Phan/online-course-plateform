<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_courses' => Course::count(),
            'total_revenue' => Order::where('status', 'completed')->sum('total_amount'),
            'recent_users' => User::latest()->take(5)->get(),
            'recent_orders' => Order::with('user')->latest()->take(5)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
