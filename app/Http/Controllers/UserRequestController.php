<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request as userRequest;

class UserRequestController extends Controller
{
    public function index(Request $request)
    {
        $userRequests = userRequest::where('user_id', $request->user()->id)->orderBy('id', 'desc')->get();
        return response($userRequests, 200);
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'question' => 'required',
        ]);

        $userRequest = userRequest::create([
            'user_id' => $request->user()->id,
            'title'   => $request->title,
            'question'   => $request->question,
            'is_replied' => 0
        ]);

        return response($userRequest, 200);

    }
}
