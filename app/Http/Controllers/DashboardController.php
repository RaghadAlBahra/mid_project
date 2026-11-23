<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Center;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Space;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'centers_count' => Center::count(),
            'spaces_count' => Space::count(),
            'employees_count' => Employee::count(),
            'customers_count' => Customer::count(),
            'bookings_by_status' => [
                'Pending' => Booking::where('status', 'Pending')->count(),
                'Confirmed' => Booking::where('status', 'Confirmed')->count(),
                'Rejected' => Booking::where('status', 'Rejected')->count(),
                'Cancelled' => Booking::where('status', 'Cancelled')->count(),
            ]
        ];
        return view('admin.dashboard',compact('stats'));
    }
}
