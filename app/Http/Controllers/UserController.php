<?php

namespace App\Http\Controllers;


use Exception;
use App\Models\User;
use App\RandomString;
use App\Mail\WelcomeEmail;
use App\RandomStringModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    function homeRedirect(Request $request)
    {
        if (session('user') == null) {
            return redirect()->route('login');
        }
            elseif (session('role') == 1) {
                                    return redirect()->route('stageoverzicht');
            } else {
                return redirect()->route('adduser'); //placeholder, veranderen naar studentenoverzicht
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

    private function SendEmail($user)
    {
        Mail::to($user->email)->send(new WelcomeEmail($user));
        return redirect()->route('adduser')->with('success', 'Account is aangemaakt.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $Email = $request->email;
        $Studentnumber = $request->studentnumber;
        $Role = $request->role;
        $FirstName = $request->firstname;
        $LastName = $request->lastname;
        $MiddleName = $request->middlename;

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'studentnumber' => 'required|numeric',
            'role' => 'required|in:student,docent',
            'firstname' => 'required|string|max:20',
            'middlename' => 'nullable|string|max:20',
            'lastname' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('adduser')
                ->withErrors($validator)
                ->withInput();
        }

        $PwSetToken = bin2hex(random_bytes(16));
        $HashedPwSetToken = password_hash($PwSetToken, PASSWORD_DEFAULT);

        if ($Role == "student") {
            $Role = 1;
        } else {
            $Role = 2;
        }

        do {
            $PwSetToken = bin2hex(random_bytes(16));
            $HashedPwSetToken = password_hash($PwSetToken, PASSWORD_DEFAULT);
        } while (User::where('reset_token', $HashedPwSetToken)->exists());

        $user = new User;
        $user->email = $Email;
        $user->student_id = $Studentnumber;
        $user->role = $Role;
        $user->first_name = $FirstName;
        $user->last_name = $LastName;
        $user->middle_name = $MiddleName;
        $user->reset_token = $HashedPwSetToken;


        $user->save();

        $this->SendEmail($user);
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
