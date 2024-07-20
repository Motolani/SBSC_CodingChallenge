<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class GamesController extends Controller
{
    //
    public function index(){
        $members = User::all();
        Log::info('members');
        Log::info($members);
        return view('games.create', compact('members'));
    }

    public function createGame(Request $request){
        $validator = Validator::make($request->all(), [
            'member_id' => ['required'],
            'title' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'required_fields' => $validator->errors()->all(),
                'message' => 'Missing field(s) | Validation Error',
                'status' => '500'
            ]);
        }

        Log::info($request);

    }
}

