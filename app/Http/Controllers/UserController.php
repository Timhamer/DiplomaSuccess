<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    function homeRedirect(Request $request)
    {
        if (session('user') == null) {
            return redirect()->route('login');
        } else {
            if (session('role') == 1) {
                return redirect()->route('stageoverzicht');
            } else {
                return redirect()->route('adduser'); //placeholder, veranderen naar studentenoverzicht
            }
        }
    }

    public function createLogin()
    {
        return view('login');
    }

    function loginUser(Request $request)
    {
        $Email = $request->email;
        $Password = $request->password;

        $user = User::where('email', $Email)->first();

        if ($user == null) {
            return redirect()->back()->with('error', 'Emailadres of wachtwoord is onjuist.');
        }

        if (password_verify($Password, $user->password)) {
            session(['user' => $user]);
            session(['role' => $user->role]);

            $request->session()->save() ;

            return redirect()->route('homeRedirect');
        } else {
            return redirect()->back()->with('error', 'Emailadres of wachtwoord is onjuist.');
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('AddAccount');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
