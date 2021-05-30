<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request as userRequest;

class ManagerResponseController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'answer' => 'required',
            'request_id' => 'required',
        ]);

        $managerResponse = userRequest::where('id', $request->request_id)->update([
            'answer' => $request->answer,
            'is_replied' => 1
        ]);

        return response($managerResponse, 200);
    }

    public function getAllRequests(Request $request)
    {
        $userRequests = userRequest::orderBy('id', 'desc')->get();
        return response($userRequests, 200);
    }

    public function getOptionalRequests(Request $request)
    {
        $request->validate([
            'answered' => 'required|in:0,1'
        ]);

        $requestsForManager = userRequest::where('is_replied', $request->query('answered'))->orderBy('id', 'desc')->get();
        return response($requestsForManager, 200);
    }
}
