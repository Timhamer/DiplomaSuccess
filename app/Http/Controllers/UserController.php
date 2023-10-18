<?php

namespace App\Http\Controllers;


use App\Mail\WelcomeEmail;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use Illuminate\Support\Facades\Mail;

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

    private function SendEmail($to, $subject, $redirect)
    {
        Mail::to($to)->send(new WelcomeEmail());
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
        $Email = $request->email;
        $Studentnumber = $request->studentnumber;
        $Role = $request->role;
        $FirstName = $request->firstname;
        $LastName = $request->lastname;
        $MiddleName = $request->middlename;

        if (!$this->IsValidType($Email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->with('error', 'Emailadres is onjuist.');
        }
        if (!$this->IsValidType($Studentnumber, FILTER_VALIDATE_INT)) {
            return redirect()->back()->with('error', 'Studentnummer is onjuist.');
        }
        if ($Role != "student" && $Role != "docent") {
            return redirect()->back()->with('error', 'Rol is onjuist.');
        }
        if (!$this->IsValidName($FirstName)) {
            return redirect()->back()->with('error', 'Voornaam is onjuist.');
        }
        if (!$this->IsValidName($LastName)) {
            return redirect()->back()->with('error', 'Achternaam is onjuist.');
        }
        if (!$this->IsValidName($MiddleName)) {
            return redirect()->back()->with('error', 'Tussenvoegsel is onjuist.');
        }

        $PwSetToken = bin2hex(random_bytes(16));
        $HashedPwSetToken = password_hash($PwSetToken, PASSWORD_DEFAULT);

        if ($Role == "student") {
            $Role = 1;
        } else {
            $Role = 2;
        }

        $user = new User;
        $user->email = $Email;
        $user->student_id = $Studentnumber;
        $user->role = $Role;
        $user->first_name = $FirstName;
        $user->last_name = $LastName;
        $user->middle_name = $MiddleName;
        $user->reset_token = $HashedPwSetToken;

        $user->save();

        $Subject = "DiplomaSucces - Account aanmaken";




        $this->SendEmail($Email, $Subject, "login");
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
