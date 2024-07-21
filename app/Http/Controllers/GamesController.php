<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Score;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class GamesController extends Controller
{
    //
    public function create(){
        $members = User::all();
        Log::info('members');
        Log::info($members);
        return view('games.create', compact('members'));
    }

    public function createGame(Request $request){
        $validator = Validator::make($request->all(), [
            'member_id' => ['required', 'integer'],
            'title' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->with('error', 'Failed to create game');
        }

        Log::info($request);
        Log::info(Carbon::now()->toString());

        $game = new Game();
        $game->name = $request->title;
        $game->player_count = 2;
        $game->game_admin_id = Auth::id();
        $game->date = Carbon::now();
        $saveGame = $game->save();

        $particpants = [$request->member_id, Auth::id()];
        if($saveGame){
            foreach ($particpants as $memberId) {
                $score = new Score();
                $score->game_id = $game->id;
                $score->user_id = $memberId;
                $score->save();
            }
        }

        return redirect()->route('create.game')
        ->with('message', 'Game Successfully Created');

    }

    public function index()
    {
       $userGames = Score::join('games','scores.game_id','games.id')
        ->where('scores.user_id', Auth::id())
        ->select('games.*','scores.score as score');
        // ->groupBy('games.id');


        if($userGames->exists())
        {
            $games= $userGames->get();
            Log::info($games);
        }else{
            $games= [];
        }
        return view('games.index', compact('games'));
    }

    public function gameDetails(Request $request, $game)
    {
        $members = User::all();
        Log::info('game');
        Log::info($game);
        $user_games = Score::join('games','scores.game_id','games.id')
        ->join('users','scores.user_id','users.id')
        ->where('scores.game_id', $game)
        ->select('games.name as title', 'games.status', 'games.player_count','users.name as member_name','scores.*')
        ->get();

        Log::info('userGames');
        Log::info($user_games);

        // $getPlayers = Score::where('game_id', 4)->with('member')->get();
        // Log::info('getPlayers');
        // Log::info($getPlayers);
        // foreach($getPlayers as $player)
        // {
        //     Log::info('each player');
        //     Log::info($player->member);


        //     $gamesPlayed = $player->member->games_played;
        //     $Players = $player->member->games_played;

        //     Log::info('players');
        //     Log::info($members);
        // }


        return view('games.details', compact('user_games', 'members'));

    }

    public function addPlayer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'member_id' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->with('error', 'Select a Member');
        }

        Log::info('request');
        Log::info($request);

        $check = Score::where('game_id', $request->game_id)->where('user_id', $request->member_id)->exists();
        Log::info('here');
        if($check){
            Log::info('inside');
            return redirect()->back()
            ->with('error', 'Player already in game');
        }
        $theGame = Game::where('id', $request->game_id)->first();
        $newPlayerCount = $theGame->player_count + 1;
        Game::where('id', $request->game_id)->update([
            'player_count' => $newPlayerCount,
        ]);

        $score = new Score();
        $score->game_id = $request->game_id;
        $score->user_id = $request->member_id;
        $saved = $score->save();

        if($saved){
            return redirect()->back()
            ->with('message', 'Player Successfully Added');
        }else{
            return redirect()->back()
            ->with('error', 'Failed to Added Player');
        }

    }

    public function startGame(Request $request)
    {
        $startGame = DB::table('games')->where('id', $request->game_id)->update([
            'status' => 1
        ]);

        if($startGame ){
            return redirect()->back()
            ->with('message', 'Game Started');
        }else{
            return redirect()->back()
            ->with('error', 'Failed to Start Game');
        }
    }

    public function endGame(Request $request)
    {

        $getPlayers = Score::where('game_id', $request->game_id)->with('member')->get();
        foreach($getPlayers as $player){
            $gamesPlayed = $player->member->games_played +1;
            User::where('id', $player->member->id)->update([
                'games_played' => $gamesPlayed,
            ]);
        }

        Log::info($getPlayers);

        $endGame = DB::table('games')->where('id', $request->game_id)->update([
            'status' => 2
        ]);

        if($endGame){
            return redirect()->back()
            ->with('message', 'Game Ended');
        }else{
            return redirect()->back()
            ->with('error', 'Failed to End Game');
        }
    }

    public function updateScore(Request $request)
    {
        Log::info('request');
        Log::info($request);

        $validator = Validator::make($request->all(), [
            'new_score' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->with('error', 'No Score Value Entered');
        }

        Score::where('game_id', $request->game_id)->where('user_id', $request->member_id)->update([
            "score" => $request->new_score,
        ]);

        $member = User::where('id', $request->member_id)->first();


        return redirect()->back()
            ->with('message', $member->name.'s Score Successfully Updated');
    }

    public function leaderboard(Request $request)
    {
        $topAverageScores = Score::select('user_id')
            ->selectRaw('AVG(score) as avg_score')
            ->groupBy('user_id')
            ->orderByDesc('avg_score')
            ->limit(10)
            ->with('member')
            ->get();

        Log::info('topAverageScores');
        Log::info($topAverageScores);

        return view('games.leaderboard', compact('topAverageScores'));
    }
}

