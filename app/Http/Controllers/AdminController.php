<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // ====== ADMIN LOGIN PAGE ======
    public function showLogin()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    // ====== ADMIN LOGIN POST ======
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)
                    ->where('role', 'admin')
                    ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['username' => 'Username atau password admin salah.'])
                     ->withInput(['username' => $request->username]);
    }

    // ====== ADMIN LOGOUT ======
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    // ====== DASHBOARD ======
    public function dashboard()
    {
        $totalHotels     = Hotel::count();
        $activeHotels    = Hotel::active()->count();
        $hotelCategory   = Hotel::where('category', 'hotel')->count();
        $travelCategory  = Hotel::where('category', 'traveling')->count();
        $recentHotels    = Hotel::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalHotels', 'activeHotels',
            'hotelCategory', 'travelCategory', 'recentHotels'
        ));
    }

    // ====== HOTEL LIST ======
    public function hotels()
    {
        $hotels = Hotel::latest()->paginate(10);
        return view('admin.hotels.index', compact('hotels'));
    }

    // ====== CREATE HOTEL FORM ======
    public function createHotel()
    {
        return view('admin.hotels.create');
    }

    // ====== STORE HOTEL ======
    public function storeHotel(Request $request)
    {
        $request->validate([
            'name'            => 'required|string|max:255',
            'description'     => 'nullable|string',
            'image'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'location'        => 'nullable|string|max:255',
            'price_per_night' => 'required|numeric|min:0',
            'category'        => 'required|in:hotel,traveling',
        ]);

        $data = $request->except('image');
        $data['has_ac']         = $request->has('has_ac');
        $data['has_wifi']       = $request->has('has_wifi');
        $data['has_restaurant'] = $request->has('has_restaurant');
        $data['has_front_desk'] = $request->has('has_front_desk');
        $data['has_parking']    = $request->has('has_parking');
        $data['has_pool']       = $request->has('has_pool');
        $data['has_gym']        = $request->has('has_gym');
        $data['has_laundry']    = $request->has('has_laundry');
        $data['is_active']      = $request->has('is_active');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('hotels', 'public');
        }

        Hotel::create($data);

        return redirect()->route('admin.hotels')->with('success', 'Hotel berhasil ditambahkan!');
    }

    // ====== EDIT HOTEL FORM ======
    public function editHotel(Hotel $hotel)
    {
        return view('admin.hotels.edit', compact('hotel'));
    }

    // ====== UPDATE HOTEL ======
    public function updateHotel(Request $request, Hotel $hotel)
    {
        $request->validate([
            'name'            => 'required|string|max:255',
            'description'     => 'nullable|string',
            'image'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'location'        => 'nullable|string|max:255',
            'price_per_night' => 'required|numeric|min:0',
            'category'        => 'required|in:hotel,traveling',
        ]);

        $data = $request->except('image');
        $data['has_ac']         = $request->has('has_ac');
        $data['has_wifi']       = $request->has('has_wifi');
        $data['has_restaurant'] = $request->has('has_restaurant');
        $data['has_front_desk'] = $request->has('has_front_desk');
        $data['has_parking']    = $request->has('has_parking');
        $data['has_pool']       = $request->has('has_pool');
        $data['has_gym']        = $request->has('has_gym');
        $data['has_laundry']    = $request->has('has_laundry');
        $data['is_active']      = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($hotel->image) Storage::disk('public')->delete($hotel->image);
            $data['image'] = $request->file('image')->store('hotels', 'public');
        }

        $hotel->update($data);

        return redirect()->route('admin.hotels')->with('success', 'Hotel berhasil diperbarui!');
    }

    // ====== DELETE HOTEL ======
    public function deleteHotel(Hotel $hotel)
    {
        if ($hotel->image) Storage::disk('public')->delete($hotel->image);
        $hotel->delete();
        return redirect()->route('admin.hotels')->with('success', 'Hotel berhasil dihapus!');
    }
}
