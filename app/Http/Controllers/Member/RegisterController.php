<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('member.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|email',
            'phone_number' => 'required|numeric|digits_between:10,15',
            'password' => 'required|min:6|max:50',
        ]);

        $data = $request->except('_token');

        $isEmailExist = User::where('email', $request->email)->first();

        if ($isEmailExist) {
            return back()->withErrors(['email' => 'This email already exist'])->withInput();
        }

        $data['role'] = 'member';
        $data['password'] = Hash::make($request->password);

        User::create($data);

        // return back()->with('success', 'Register success, please login');
        return redirect()->route('member.login');
    }
}
