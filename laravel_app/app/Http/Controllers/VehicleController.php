<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Category;
use App\Models\RentalRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
{
    $vehicle = Vehicle::with('category')->get();
    $categories = Category::all();

    return view('vehicle.index', compact('vehicle', 'categories'));
}


     public function show($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('vehicle.show', compact('vehicle'));
    }

    public function single($id)
    {
        $item = Vehicle::findOrFail($id);

        if (Auth::check() && Auth::id() !== $item->user_id) {
            $item->increment('views');
        }

        return view('single', compact('item'));
    }

    public function sendRequest(Request $request, $id)
{
    $request->validate([
        'days' => 'required|integer|min:1',
        'text' => 'nullable|string|max:1000'
    ]);

    $vehicle = Vehicle::findOrFail($id);

    RentalRequest::create([
        'sender_id' => auth()->id(),
        'receiver_id' => $vehicle->user_id,
        'vehicle_id' => $vehicle->id,
        'days' => $request->days,   
        'status' => 'pending',
        'text' => $request->text
    ]);

    return back()->with('msg', 'Zahtev za iznajmljivanje je poslat.');
}


    public function myRentals()
{
    $rentals = RentalRequest::with('vehicle')
        ->where('sender_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->get();

    return view('user.rentals', compact('rentals'));
}
}
