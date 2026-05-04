<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function checkout(Course $course)
    {
        if (auth()->user()->enrolledCourses()->where('course_id', $course->id)->exists()) {
            return back()->with('error', 'You already own this course.');
        }

        $paymentMode = \App\Models\SystemSetting::get('payment_mode', config('services.payment.mode', 'stripe'));

        if ($paymentMode === 'fake') {
            return redirect()->route('payment.fake', $course->id);
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $course->title,
                        ],
                        'unit_amount' => $course->price * 100, // Stripe uses cents
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}&course_id=' . $course->id,
                'cancel_url' => route('courses.show', $course->id),
                'customer_email' => auth()->user()->email,
            ]);

            return redirect($session->url);
        } catch (\Exception $e) {
            return back()->with('error', 'Payment configuration error: ' . $e->getMessage());
        }
    }

    public function fakePayment(Course $course)
    {
        $paymentMode = \App\Models\SystemSetting::get('payment_mode', config('services.payment.mode', 'stripe'));
        if ($paymentMode !== 'fake') {
            return redirect()->route('courses.show', $course->id);
        }

        return view('payment.fake', compact('course'));
    }

    public function processFakePayment(Request $request, Course $course)
    {
        $paymentMode = \App\Models\SystemSetting::get('payment_mode', config('services.payment.mode', 'stripe'));
        if ($paymentMode !== 'fake') {
            abort(403);
        }

        // Simulate processing time
        sleep(1);

        $fakeSessionId = 'fake_' . uniqid();

        return redirect()->route('payment.success', [
            'session_id' => $fakeSessionId,
            'course_id' => $course->id,
            'mode' => 'fake'
        ]);
    }

    public function success(Request $request)
    {
        $sessionId = $request->get('session_id');
        $courseId = $request->get('course_id');
        $mode = $request->get('mode', 'stripe');
        $course = Course::findOrFail($courseId);

        if ($mode === 'fake') {
            $isPaid = true; // Always paid in fake mode
            $paymentMethod = 'fake_demo';
        } else {
            Stripe::setApiKey(config('services.stripe.secret'));
            $session = Session::retrieve($sessionId);
            $isPaid = $session->payment_status === 'paid';
            $paymentMethod = 'stripe';
        }

        if ($isPaid) {
            // Check if order already exists to prevent duplicate
            $existingOrder = Order::where('transaction_id', $sessionId)->first();
            
            if (!$existingOrder) {
                // Create Order
                $order = Order::create([
                    'user_id' => auth()->id(),
                    'total_amount' => $course->price,
                    'status' => 'completed',
                    'payment_method' => $paymentMethod,
                    'transaction_id' => $sessionId,
                ]);

                OrderItem::create([
                    'order_id' => $order->id,
                    'course_id' => $course->id,
                    'price' => $course->price,
                ]);

                // Enroll user
                auth()->user()->enrollments()->create([
                    'course_id' => $course->id,
                    'price' => $course->price,
                    'progress' => 0,
                ]);
            }

            return redirect()->route('student.dashboard')->with('success', 'Thank you for your purchase!');
        }

        return redirect()->route('courses.show', $course->id)->with('error', 'Payment failed.');
    }
}
