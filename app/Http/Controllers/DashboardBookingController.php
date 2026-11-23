<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DashboardBookingController extends Controller
{
    private const STATUES = ['Pending', 'Confirmed', 'Rejected', 'Cancelled'];

    public function index(Request $request){
        $validated = $request->validate([
            'status'=>['nullable',Rule::in(self::STATUES)],
        ]);
        $selectedstatus = $validated['status'] ?? null;
        $bookings = Booking::with(['customer.user','space.center'])
        ->when($selectedstatus,function ($query, $status) {
            $query->where('status',$status);
        })
        ->latest()->paginate(10)->withQueryString();
        $statuses = self::STATUES;
        return view('admin.bookings.index',compact('bookings','statuses','selectedstatus'));
    }

    public function show(Booking $booking){
        $booking->load('customer.user','space.center');
        return view('admin.bookings.show',compact('booking'));
    }

    public function confirm(Booking $booking){
        if(in_array($booking->status,['Rejected','Cancelled'],true)){
            return back()->with('error','Cannot confirm a rejected or cancelled booking.');
        }

        $hasOverlap = Booking::where('space_id',$booking->space_id)
        ->where('booking_date',$booking->booking_date)
        ->where('status','Confirmed')
        ->where('id','!=',$booking->id)
        ->where(function($query) use  ($booking){
            $query->where('start_time','<',$booking->end_time)
            ->where('end_time','>',$booking->start_time);
        })->exists();

        if($hasOverlap){
            return back()->with('error', 'Cannot confirm this booking because it conflicts with an existing confirmed booking for this space.');
        }

        $booking->update([
            'status'=>'Confirmed',
        ]);


        return back()->with('success', 'Booking confirmed successfully.');
    }

    public function reject(Booking $booking){
        if($booking->status ==='Cancelled'){
            return back()->with('error', 'Cannot reject a cancelled booking.');
        }

        $booking->update([
            'status'=>'Rejected',
        ]);

        return back()->with('success', 'Booking rejected successfully.');
    }
}
