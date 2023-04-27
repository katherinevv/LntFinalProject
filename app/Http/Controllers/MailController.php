<?php

namespace App\Http\Controllers;
use App\Mail\SendMail;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function sendMail(Request $request){
        $message = $request->message;
        Mail::to('test@gmail.com')->send(new SendMail($message));

        return 'mail has been sent succesfully';
    }
}
