<?php

namespace App\Http\Controllers;

use App\Mail\forgotpasswordEmail; //included
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; //included

class EmailController extends Controller
{

    // 1. Initial request from the "Forgot Password" form
    public function passwordForgot(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // Store the email in the session so we remember it for later on other pages
        session(['user_email' => $request->email]);

        // Send the initial email code
        $this->sendEmail($request->email);

        // Redirect user to the verification page
        return redirect()->route('verify_code'); //redirect user to verify code page
    }

    // 2. The "Resend Code" route hits this method
    public function resendCode()
    {
        // Retrieve the email we stored in the session earlier
        $email = session('user_email');

        // If the session expired or user accessed this directly, send them back
        if (!$email) {
            return redirect()->route('forgot_password')->withErrors(['email' => 'Session expired. Please enter your email again.']);
        }

        // Send a new code
        $this->sendEmail($email);

        return back()->with('status', 'A new verification code has been sent!');
    }

    // 3. Reusable isolated helper method to handle the actual email logic
    private function sendEmail($toEmail)
    {
        $fourDigitNumber = random_int(1000, 9999);
        
        // Save the code to the session or DB so you can verify it when they type it in!
        session(['verification_code' => $fourDigitNumber]); 

        $subject = "Your OTP";
        $message = "Enter OTP given below to reset your password";

        Mail::to($toEmail)->send(new forgotpasswordEmail($subject, $message, $fourDigitNumber));
    }

    //matching the recieved code with the sent one!
    public function verifyCode(Request $request){ 
        $recievedcode =  $request->digit1.$request->digit2.$request->digit3.$request->digit4;
        // return $recievedcode;
        $sentcode = session('verification_code');
        
        //if code  matched
        if($recievedcode == $sentcode){
            return redirect()->route('reset_password'); //redirect user to password_reset page to set new passwrd
        }else{
            return redirect()->route('verify_code')->withErrors(['status' => 'your input code is incorrect! please try again']); //redirect user to verify code page again to re-enter code
        }
    }
    
} 
