<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EskizService;

class SmsController extends Controller
{
    private $eskizService;

    public function __construct(EskizService $eskizService)
    {
        $this->eskizService = $eskizService;
    }

    /**
     * 📌 SMS jo‘natish formasi
     */
    public function showSMSForm()
    {
        return view('sms.sms');
    }

    /**
     * 📌 SMS jo‘natish
     */
    public function sendSms(Request $request)
{
    $request->validate([
        'phone' => ['required', 'regex:/^\+998[0-9]{9}$/'],
        'message' => ['required', 'max:160']
    ]);

    $response = $this->eskizService->send_Sms($request->phone, $request->message);

    // Blade'ga ma'lumotni qaytaramiz
    // return view('sms.sms', ['response' => $response]);
    return redirect()->route('posts.index')->with('success','sms muvaffaqiyatli yuborildi');
}


    /**
     * 📌 SMS statusini tekshirish
     */

}
