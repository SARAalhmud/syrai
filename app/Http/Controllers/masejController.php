<?php

namespace App\Http\Controllers;

use App\Models\masej;
use Illuminate\Http\Request;

class masejController extends Controller



{

   public function inbox()
{
    $user = auth()->user();

    if ($user->expert) {
        $recipientColumn = 'experts_id';
        $recipientId = $user->expert->id;
    } elseif ($user->beginner) {
        $recipientColumn = 'beginners_id';
        $recipientId = $user->beginner->id;
    } elseif ($user->student) {
        $recipientColumn = 'students_id';
        $recipientId = $user->student->id;
    } elseif ($user->company) {
        $recipientColumn = 'companies_id';
        $recipientId = $user->company->id;
    } else {
        $recipientColumn = null;
        $recipientId = null;
    }

    if ($recipientColumn && $recipientId) {
        $messages = Masej::where($recipientColumn, $recipientId)->latest()->get();
    } else {
        $messages = collect();
    }

    return view('masaj', compact('messages'));
}


    public function send(Request $request)
    {
        $request->validate([
            'senderName' => 'required|string|max:255',
            'senderEmail' => 'required|email',
            'messageSubject' => 'required|string',
            'messageContent' => 'required|string',
            'receiver_id' => 'required|integer',
            'receiver_type' => 'required|in:expert,student,company,beginner',
        ]);

        $message = new masej();
        $message->senderName = $request->senderName;
        $message->senderEmail = $request->senderEmail;
        $message->messageSubject = $request->messageSubject;
        $message->messageContent = $request->messageContent;

        // تحديد المستلم حسب النوع
        switch ($request->receiver_type) {
            case 'expert':
                $message->experts_id = $request->receiver_id;
                break;
            case 'student':
                $message->students_id = $request->receiver_id;
                break;
            case 'beginner':
                $message->beginners_id = $request->receiver_id;
                break;
            case 'company':
                $message->companies_id = $request->receiver_id;
                break;
        }

        $message->save();

        return back()->with('success', 'تم إرسال الرسالة بنجاح.');
    }
}
