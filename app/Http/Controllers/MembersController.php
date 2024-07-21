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

        $member = $member->first();
        Log::info('member');
        Log::info($member);
        $mostRecentGame = $member->getMostRecentGameAttribute();

        $highestScoreGame = $member->getHighestScoreGameAttribute();
        $highestScore = $member->getHighestScoreAttribute();
        $highestScoreGameName = $highestScoreGame->name;
        $highestScoreDate = $highestScoreGame->created_at;

        $averageScore = $member->getAverageScoreAttribute();

        Log::info('highestScoreGame');
        Log::info($highestScoreGame);

        Log::info('mostRecentGame');
        Log::info($mostRecentGame);

        Log::info('averageScore');
        Log::info($averageScore);

        return view('members.index', compact('member', 'highestScore','highestScoreGameName','highestScoreDate','averageScore', 'mostRecentGame'));

    }

}
