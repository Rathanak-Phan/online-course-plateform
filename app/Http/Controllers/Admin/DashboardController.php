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
            'pending_payments' => Order::where('status', 'pending')->whereNotNull('payment_proof')->count(),
            'pending_courses' => Course::where('status', 'draft')->count(), // Assuming draft means needs approval for now
            'recent_users' => User::latest()->take(5)->get(),
            'recent_orders' => Order::with('user')->latest()->take(5)->get(),
            'payment_mode' => \App\Models\SystemSetting::get('payment_mode', config('services.payment.mode', 'stripe')),
        ];

        return view('admin.dashboard', compact('stats'));
    }
    public function transactions()
    {
        $orders = Order::with('user')->latest()->paginate(15);
        return view('admin.transactions.index', compact('orders'));
    }

    public function settings()
    {
        $settings = [
            'payment_mode' => \App\Models\SystemSetting::get('payment_mode', config('services.payment.mode', 'stripe')),
            'platform_commission' => \App\Models\SystemSetting::get('platform_commission', '20'),
            'platform_name' => \App\Models\SystemSetting::get('platform_name', config('app.name')),
        ];
        return view('admin.settings.index', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        foreach ($request->except('_token') as $key => $value) {
            \App\Models\SystemSetting::set($key, $value);
        }
        return back()->with('success', 'Settings updated successfully.');
    }

    public function togglePaymentMode(Request $request)
    {
        $currentMode = \App\Models\SystemSetting::get('payment_mode', config('services.payment.mode', 'stripe'));
        $newMode = $currentMode === 'fake' ? 'stripe' : 'fake';
        
        \App\Models\SystemSetting::set('payment_mode', $newMode);
        
        return back()->with('success', "Payment mode switched to " . strtoupper($newMode));
    }
}
