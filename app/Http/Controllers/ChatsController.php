<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show chats
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('chat');
    }

    /**
     * Fetch all messages
     *
     * @return Message
     */
    public function fetchMessages()
    {
        // dd(1);
        return Message::with('admin')->get();
    }

    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return Response
     */
    public function sendMessage(Request $request)
    {
        $admin = Auth::guard('admins')->user();

        $message = $admin->messages()->create([
            'message' => $request->input('message')
        ]);

        broadcast(new MessageSent($admin, $message))->toOthers();
        return ['status' => 'Message Sent!'];
    }
}

