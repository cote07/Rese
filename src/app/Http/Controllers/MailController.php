<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\NotificationMail;

class MailController extends Controller
{
    public function mail()
    {
        $users = User::whereHas('roles', function ($query) {
            $query->where('id', 3);
        })->get();
        return view('send', compact('users'));
    }

    public function send(Request $request)
    {
        $fromEmail = auth()->user()->email;

        $recipient = User::find($request->recipient_id);

        $subject = $request->input('subject');
        $messageContent = $request->input('message');

        Mail::to($recipient->email)->send(new NotificationMail($subject, $messageContent, $fromEmail));

        return redirect()->back()->with('success', 'メールを送信しました');
    }
}
