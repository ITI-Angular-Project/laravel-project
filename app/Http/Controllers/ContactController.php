<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function showForm()
    {
        return view('pages.main.contact-us');
    }

    public function sendEmail(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|max:100',
            'message' => 'required|string',
        ]);


        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'bodyMessage' => $request->message,
        ];

        Mail::send('pages.main.emails.contact', $data, function ($message) use ($data) {

            $message->to('ahmed.alla159159@gmail.com')
                ->subject('New Contact Message From ' . $data['name'])
                ->from($data['email'], $data['name']);
        });

        return back()->with('success', 'Message Is Send Successfully ✅');
    }
}
