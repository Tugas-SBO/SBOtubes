<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // ====== MAIN MENU / HOME ======
    public function index()
    {
        $recommended = Hotel::active()->where('category', 'hotel')->latest()->take(3)->get();
        $traveling   = Hotel::active()->where('category', 'traveling')->latest()->take(3)->get();
        $all_hotels  = Hotel::active()->latest()->get();
        return view('home.index', compact('recommended', 'traveling', 'all_hotels'));
    }

    public function allHotels()
    {
        $hotels = Hotel::active()->latest()->get();
        return view('home.all', compact('hotels'));
    }

    // ====== HOTEL DETAIL / PAYMENT PAGE ======
    public function detail(Hotel $hotel)
    {
        return view('home.detail', compact('hotel'));
    }
}