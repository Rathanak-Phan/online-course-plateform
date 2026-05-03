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

        Stripe::setApiKey(config('services.stripe.secret'));

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
    }

    public function success(Request $request)
    {
        $sessionId = $request->get('session_id');
        $courseId = $request->get('course_id');
        $course = Course::findOrFail($courseId);

        Stripe::setApiKey(config('services.stripe.secret'));
        $session = Session::retrieve($sessionId);

        if ($session->payment_status === 'paid') {
            // Check if order already exists to prevent duplicate
            $existingOrder = Order::where('transaction_id', $sessionId)->first();
            
            if (!$existingOrder) {
                // Create Order
                $order = Order::create([
                    'user_id' => auth()->id(),
                    'total_amount' => $course->price,
                    'status' => 'completed',
                    'payment_method' => 'stripe',
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
                    'progress' => 0,
                ]);
            }

            return redirect()->route('student.my-courses')->with('success', 'Thank you for your purchase!');
        }

        return redirect()->route('courses.show', $course->id)->with('error', 'Payment failed.');
    }
}
