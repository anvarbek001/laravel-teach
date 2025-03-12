<?php

namespace App\Http\Controllers;

use App\Mail\SomeMailable;
use App\Notifications\CustomFromNotification;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Faqat autentifikatsiya qilingan foydalanuvchilar
    }

    public function sendEmail(Request $request)
    {


        try {
            $messageContent = $request->input('message'); // Foydalanuvchining habar matni

            Mail::raw($messageContent, function ($message) use ($request) {
                $message->to($request->input('email')) // Foydalanuvchidan kelgan email manzil
                    ->subject('Test Email'); // Mavzu
            });

            return response()->json(['success' => true, 'message' => 'Email muvaffaqiyatli jo\'natildi!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }


    public function showMailForm()
    {
        return view('emails.myTestMail'); // Blade faylini ko'rsatish
    }
}
