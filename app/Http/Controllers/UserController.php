<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('AddAccount');
    }

    private function SendEmail($to, $subject, $body, $redirect)
    {
        require base_path("vendor/autoload.php");
        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = "smtp.office365.com";
            $mail->SMTPAuth = true;
            $mail->Username = "idee-print@hotmail.com";
            $mail->Password = "eL75@I#f@RZFa7CWT0X7kHl";
            $mail->SMTPSecure = "tls";
            $mail->Port = 587;

            $mail->setFrom($mail->Username, "");
            $mail->addAddress($to);

            $mail->isHTML(true);
            $mail->Subject = $subject;

            $mail->Body = $body;

            $mail->send();

            if ($redirect) {
                return redirect()->route($redirect);
            }

            return true;
        } catch (Exception $e) {
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

        $Body = file_get_contents("http://templates.codecove.nl/diplomasuccess_password_email_setup.html");
        $Body = str_replace("[[VOORNAAM]]", $FirstName, $Body);
        $Body = str_replace("[[TOKEN]]", $PwSetToken, $Body);

        $this->SendEmail($Email, $Subject, $Body, "login");
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
