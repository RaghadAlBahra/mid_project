<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Space;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $customer = Customer::where('user_id', $request->user()->id)->first();
        if (! $customer) {
            return response()->json([
                'data' => [],
            ], 200);
        }
        $bookings = Booking::with(['space.center'])->where('customer_id', $customer->id)->latest()->paginate(10);
        return response()->json($bookings, 200);
    }



    public function store(StoreBookingRequest $request)
    {
        $user = $request->user();
        $customer = Customer::firstOrCreate(
            ['user_id' => $user->id],
            [
                'phone_number' => $user->phone_number ?? 'null',
                'address' => $user->address ?? 'null',
            ]
        );
        $space = Space::with('center')->findOrFail($request->space_id);

        if (! $space->center || $space->center->status !== 'Active') {
            return response()->json([
                'message' => 'Cannot book a space belonging to an inactive center.'
            ], 422);
        }

        if ($space->status !== 'Available') {
            return response()->json([
                'message' => 'Cannot book a space that is currently under maintenance or unavailable.',
            ], 422);
        }


        if ($request->number_of_people > $space->maximum_capacity) {
            return response()->json([
                'message' => 'Number of people exceeds the space maximum capacity.'
            ], 422);
        }

        $hasConflict = Booking::where('space_id', $space->id)
            ->where('booking_date', $request->booking_date)
            ->where('status', 'Confirmed')
            ->where(function ($query) use ($request) {
                $query->where('start_time', '<', $request->end_time)->where('end_time', '>', $request->start_time);
            })->exists();
        if ($hasConflict) {
            return response()->json([
                'message' => 'The requested time slot conflicts with an existing confirmed booking.',
            ], 422);
        }

        $start = strtotime($request->start_time);
        $end = strtotime($request->end_time);
        $hours = max(1, round(($end - $start) / 3600, 2));
        $totalPrice = round($hours * $space->hourly_price, 2);

        $booking = Booking::query()->create(array_merge($request->validated(), [
            'customer_id' => $customer->id,
            'total_price' => $totalPrice,
            'status'      => 'Pending',
        ]));

        return response()->json([
            'message' => 'Booking request created successfully.',
            'data' => $booking->load('space.center')
        ], 201);
    }


    public function show(Request $request, Booking $booking)
    {
        $customer = Customer::where('user_id', $request->user()->id)->first();
        if (! $customer || $booking->customer_id !== $customer->id) {
            return response()->json([
                'message' => 'Forbidden. You do not own this booking.',
            ], 403);
        }
        return response()->json([
            'data' => $booking->load('space.center')
        ], 200);
    }

    public function cancel(Request $request, Booking $booking)
    {
        $customer = Customer::where('user_id', $request->user()->id)->first();
        if (! $customer || $booking->customer_id !== $customer->id) {
            return response()->json([
                'message' => 'Forbidden. You do not own this booking.',
            ], 403);
        }


        if(! in_array($booking->status,['Pending','Confirmed'],true)){
                return response()->json([
                'message' => 'Only Pending or Confirmed bookings can be cancelled.',
            ], 422);
            }

            $booking->update([
                'status'=>'Cancelled'
            ]);

            return response()->json([
                'message' => 'Booking cancelled successfully.',
                'data'=>$booking->fresh()
            ],200);
    }
}
