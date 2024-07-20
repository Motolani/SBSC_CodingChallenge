<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MembersController extends Controller
{
    //
    public function index()
    {
        $members = User::all();
        return view('members.index', compact('members'));
    }

    public function memberDetails(Request $request)
    {

        $memberId = Auth::id();
        Log::info('memberId');
        Log::info($memberId);
        // Retrieve the member by ID
        $member = User::where('id',$memberId);

        // if (!$member->exists()) {
        //     return response()->json([
        //         'message' => 'Member not found',
        //         'status' => '404'
        //     ], 404);
        // }


        $member = $member->first();
        Log::info('member');
        Log::info($member);
        $mostRecentGame = $member->getMostRecentGameAttribute();

        // Access the highest_score_game attribute
        // $highestScoreGame = $member->highest_score_game;
        $highestScoreGame = $member->getHighestScoreGameAttribute();
        Log::info('highestScoreGame');
        Log::info($highestScoreGame);

        // Access the average_score attribute
        // $averageScore = $member->average_score;
        $averageScore = $member->getAverageScoreAttribute();
        Log::info('averageScore');
        Log::info($averageScore);

        // Access the most recent game attribute
        // $mostRecentGame = $member->most_recent_game;
        $averageScore = $member->getAverageScoreAttribute();
        Log::info('mostRecentGame');
        Log::info($mostRecentGame);

        return view('members.index', compact('member', 'highestScoreGame','averageScore', 'mostRecentGame'));

    }

}
