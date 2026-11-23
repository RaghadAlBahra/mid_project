<?php

namespace App\Http\Controllers;

use App\Http\Requests\AvailableSpacesRequest;
use App\Models\Center;
use App\Models\Space;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function indexCenters()
    {
        $centers = Center::query()->latest()->paginate(10);
        return response()->json([
            'message' => 'Centers retrieved successfully.',
            'data' => $centers
        ]);
    }

    public function showCenter(Center $center)
    {
        $center->load('spaces');
        return response()->json([
            'message' => 'Center details retrieved successfully.',
            'data' => $center,
        ]);
    }

    public function centerSpaces(Center $center) {
       $spaces = $center->spaces()->latest()->paginate(10);
        return response()->json([
            'message' => 'Center spaces retrieved successfully.',
            'data' => $spaces,
        ]);
    }

    public function showSpace(Space $space) {
    $space->load('center');
    return response()->json([
            'message' => 'Space details retrieved successfully.',
            'data' => $space,
        ]);

    }


    public function availableSpaces(AvailableSpacesRequest $request) {
        $validated = $request->validated();
        $spaces = Space::with('center')
        ->where('maximum_capacity','>=',$validated['number_of_people'])
        ->when(! empty($validated['center_id']), function ($query) use ($validated){
            $query->where('center_id',$validated['center_id']);
        })
        ->whereDoesntHave('bookings',function ($query) use ($validated){

            $query->where('booking_date', $validated['booking_date'])
                ->where('status', 'Confirmed')
                ->where('start_time', '<', $validated['end_time'])
                ->where('end_time', '>', $validated['start_time']);
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

        return response()->json([
        'message' => 'Available spaces retrieved successfully.',
        'data' => $spaces,
    ]);

    }
}
