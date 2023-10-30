<?php

namespace App\Http\Controllers;


use Exception;
use App\Models\User;
use App\RandomString;
use App\Mail\WelcomeEmail;
use App\RandomStringModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\Courses;

class UserController extends Controller
{

    function teacherRedirect(){
        $users = User::where('role', 1)->get();
        $courses = Courses::all();

        foreach ($users as $user) {
            $user->exams = DB::select('SELECT * FROM exams WHERE user_id = ?', [$user->id]);
        }

        foreach ($users as $user) {
            foreach ($user->exams as $exam) {
                $exam->course = DB::select('SELECT * FROM courses WHERE id = ?', [$exam->course_id])[0];
            }
        }

        return view('studentDashboard', ['users' => $users, 'courses' => $courses]);
    }


    function homeRedirect(Request $request)
    {
        if (session('user') == null) {
            return redirect()->route('login');
        }
            elseif (session('role') == 1) {
                                    return redirect()->route('Home');
            } else {
                return redirect()->route('studentDashboard');
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

    public function logout()
    {

        session(['user'=> null]);
        return redirect()->route('login');
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
        // Mail::to($user->email)->send(new WelcomeEmail($user));
        // require base_path("vendor/autoload.php");
        // $mail = new PHPMailer(true);

        // try {
        //     $mail->SMTPDebug = 0;
        //     $mail->isSMTP();
        //     $mail->Host = "smtp.office365.com";
        //     $mail->SMTPAuth = true;
        //     $mail->Username = "idee-print@hotmail.com";
        //     $mail->Password = "eL75@I#f@RZFa7CWT0X7kHl";
        //     $mail->SMTPSecure = "tls";
        //     $mail->Port = 587;

        //     $mail->setFrom($mail->Username, "");
        //     $mail->addAddress($to);

        //     $mail->isHTML(true);
        //     $mail->Subject = $subject;

        //     $mail->Body = $body;

        //     $mail->send();

        //     if ($redirect) {
        //         return redirect()->route($redirect);
        //     }

        //     return true;
        // } catch (Exception $e) {
        //     return false;
        // }
    }

    public function IsValidType($Value, $Filter)
    {
        if (filter_var($Value, $Filter)) {
            return true;
        } else {
            return false;
        }
    }
    public function IsValidName($Name)
    {
        if (is_string($Name) && preg_match('/^[a-zA-Z]{2,20}$/', $Name)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
{
    // Validate the request data
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
            ->route('adduser') // Replace with your actual route name
            ->withErrors($validator)
            ->withInput();
    }

    // Generate a random unhashed token
    $PwSetToken = bin2hex(random_bytes(16));

    // Hash the token before storing it in the database
    $HashedPwSetToken = password_hash($PwSetToken, PASSWORD_DEFAULT);

    // Determine the role
    $Role = ($request->role === 'student') ? 1 : 2;

    // Check if the hashed token already exists in the database
    do {
        $PwSetToken = bin2hex(random_bytes(16));
        $HashedPwSetToken = password_hash($PwSetToken, PASSWORD_DEFAULT);
    } while (User::where('reset_token', $HashedPwSetToken)->exists());

    // Create a new user record with the hashed token
    $user = new User;
    $user->email = $request->email;
    $user->student_id = $request->studentnumber;
    $user->role = $Role;
    $user->first_name = $request->firstname;
    $user->last_name = $request->lastname;
    $user->middle_name = $request->middlename;
    $user->reset_token = $HashedPwSetToken;

    $user->save();

    // Send the email with the unhashed token
    Mail::to($user->email)->send(new WelcomeEmail($user, $PwSetToken));

    // Redirect or respond as needed
    return redirect()->route('login'); // Replace with your actual success route
}



public function activateAccount($code) {
    // Find the user with a matching hashed token
    $users = User::all(); // Retrieve all users from the database

    foreach ($users as $user) {
        if (Hash::check($code, $user->reset_token)) {
            // User found, $user will have the matching user
            return view('ActivateAccount', compact('user'));
        }
    }

    // Handle the case where the token doesn't match
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
            $user = User::find($request->user_id);

            if ($user) {
                $validatedData = $request->validate([
                    'password' => 'required|confirmed|min:8', // Ensure password and confirmation match
                ]);

                $user->password = Hash::make($validatedData['password']);
                $user->save();

                // You can redirect the user to their profile or another page after setting the password.
                return redirect()->route('login');
            }

            // Handle the case where the user is not found.
            return redirect()->route('login');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}


