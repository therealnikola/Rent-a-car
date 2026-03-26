<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Category;
use App\Models\RentalRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Dashboard – moja vozila
     */
    public function index()
    {
        $myVehicle = Vehicle::where('user_id', Auth::id())->get();
        return view('home.index', compact('myVehicle'));
    }

    /**
     * Forma za dodavanje vozila
     */
    public function newVehicle()
    {
        $categories = Category::all();
        return view('home.new-vehicle', compact('categories'));
    }
    public function deleteVehicle($id)
{
    $vehicle = Vehicle::where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    $vehicle->delete();

    return redirect()->route('home')
        ->with('msg', 'Vozilo je uspešno obrisano.');
}

    /**
     * Čuvanje nove vozila
     */
  public function storeVehicle(Request $request)
{
    $request->validate([
        'name' => 'required',
        'description' => 'required',
        'price_per_day' => 'required|numeric',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $imageName = null;

    if ($request->hasFile('image')) {
        $imageName = time() . '_' . $request->image->getClientOriginalName();
        $request->image->move(public_path('vehicle_images'), $imageName);
    }

    Vehicle::create([
        'name' => $request->name,
        'description' => $request->description,
        'price_per_day' => $request->price_per_day,
        'category_id' => $request->category_id,
        'user_id' => auth()->id(),
        'image1' => $imageName 
    ]);

    return redirect()->route('home')
        ->with('msg', 'Proizvod je uspešno dodat.');
}

    /**
     * Zahtevi koje sam primio
     */
    public function requests()
{
    // ADMIN CHECK
    if (Auth::user()->email !== config('app.admin_email')) {
        abort(403);
    }

    $requests = RentalRequest::where('receiver_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->get();

    return view('home.requests', compact('requests'));
}

    /**
     * Prihvatanje / odbijanje zahteva
     */
    public function updateRequest($id, $status)
{
    // ADMIN CHECK
    if (Auth::user()->email !== config('app.admin_email')) {
        abort(403);
    }

    if (!in_array($status, ['accepted', 'rejected'])) {
        abort(404);
    }

    $request = RentalRequest::where('id', $id)
        ->where('receiver_id', Auth::id()) // SAMO SVOJI ZAHTEVI
        ->firstOrFail();

    $request->status = $status;
    $request->save();

    return redirect()->back()->with('msg', 'Status zahteva ažuriran');
}

public function editVehicle($id)
{
    $vehicle = Vehicle::findOrFail($id);
    $categories = Category::all();
    return view('home.edit-vehicle', compact('vehicle', 'categories'));
}

public function updateVehicle(Request $request, $id)
{
    $vehicle = Vehicle::findOrFail($id);
    
    $data = $request->validate([
        'name' => 'required',
        'price_per_day' => 'required|numeric',
        'category_id' => 'required',
        'description' => 'nullable'
    ]);

    // Ako se doda nova slika, obradi je ovde (slično kao u store metodi)

    $vehicle->update($data);

    return redirect()->route('home')->with('success', 'Vozilo uspešno izmenjeno!');
}

}
