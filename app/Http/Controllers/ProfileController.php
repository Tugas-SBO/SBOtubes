<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // ====== PROFILE / MAIN MENU ======
    public function index()
    {
        return view('profile.index');
    }

    // ====== ACCOUNT SETTING ======
    public function accountSetting()
    {
        return view('profile.account_setting');
    }

    // ====== UPDATE ACCOUNT ======
    public function updateAccount(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username'   => 'sometimes|required|string|min:3|max:50|unique:users,username,' . $user->id,
            'phone'      => 'sometimes|nullable|string|max:20',
            'birth_date' => 'sometimes|nullable|date',
            'address'    => 'sometimes|nullable|string|max:255',
        ]);

        // Only update fields that were submitted
        if ($request->has('username')) {
            $user->username = $request->username;
        }
        if ($request->has('phone')) {
            $user->phone = $request->phone;
        }
        if ($request->has('birth_date')) {
            $user->birth_date = $request->birth_date;
        }
        if ($request->has('address')) {
            $user->address = $request->address;
        }

        $user->save();

        return redirect()->route('account.setting')->with('success', 'Profil berhasil diperbarui.');
    }

    // ====== HELP CENTER ======
    public function helpCenter()
    {
        return view('help.center');
    }
}
