@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <div> {{ $user_games[0]->title }} Players </div>
                        </div>
                        {{-- @if($user_games[0]->status == 0) --}}
                        @if($user_games[0]->status == 0)
                            <div class="col-md-2">
                                @if($user_games[0]->player_count < 5)
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Add Member
                                    </button>
                                @endIf
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#startGaneModal">
                                    Start Game
                                </button>
                            </div>
                            @elseif($user_games[0]->status == 1)
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#endGameModal">
                                        End Game
                                    </button>
                                </div>
                            @else
                            <div class="col-md-2">
                            </div>
                        @endIf
                        <div class="col-md-2">
                            <a class="btn btn-secondary" href="{{url('/view/games')}}"> Back</a>
                        </div>
                    </div>
                </div>


                <div class="card-body">
                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="justify-content-center">
                        @if($user_games[0]->status == 0)
                            <table class="table">
                                <div>
                                    <thead>
                                        <tr>
                                            <th scope="col">s/n</th>
                                            <th scope="col">Member Name</th>
                                            <th scope="col">Score</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($user_games as $index => $game)
                                            <tr>
                                                <th>{{ $index + 1 }}</th>
                                                <td>{{$game->member_name}}</td>
                                                <td>{{$game->score}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </div>
                            </table>
                        @elseif($user_games[0]->status == 1)
                            <table class="table">
                                <div>
                                    <thead>
                                        <tr>
                                            <th scope="col">s/n</th>
                                            <th scope="col">Member Name</th>
                                            <th scope="col">Score</th>
                                            <th scope="col">Update Score</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($user_games as $index => $game)
                                            <tr>
                                                <th>{{ $index + 1 }}</th>
                                                <td>{{$game->member_name}}</td>
                                                <td>{{$game->score}}</td>
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-info update-score-btn"
                                                    data-bs-toggle="modal" data-bs-target="#updateScoreModal{{ $game->user_id }}"
                                                    data-game-id="{{ $game->game_id }}"
                                                    data-member-id="{{ $game->user_id }}"
                                                    data-member-name="{{ $game->member_name }}">
                                                        Update
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </div>
                            </table>
                        @else
                        <table class="table">
                            <div>
                                <thead>
                                    <tr>
                                        <th scope="col">s/n</th>
                                        <th scope="col">Member Name</th>
                                        <th scope="col">Score</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user_games as $index => $game)
                                        <tr>
                                            <th>{{ $index + 1 }}</th>
                                            <td>{{$game->member_name}}</td>
                                            <td>{{$game->score}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </div>
                        </table>
                        @endIf
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="{{url('/add/player')}}">
                                    @csrf
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">

                                            <div class="col-md-4 ">
                                                <div>Add Player</div>
                                            </div>
                                            <div class="col-md-8 ">
                                                <select class="form-select" aria-label="Default select example" name="member_id">
                                                    <option selected>Select From Members</option>
                                                        @foreach($members as $member)
                                                            <option value="{{$member->id}}">{{$member->name}}</option>
                                                        @endforeach
                                                </select>
                                            </div>

                                            <input name="game_id" value="{{$user_games[0]->game_id}}" type="hidden">
                                        </div>
                                        {{-- <br>
                                        <div>
                                            <button class="btn btn-primary" type="submit"> Create</button>
                                        </div> --}}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button class="btn btn-primary" type="submit"> Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        </div>
                    </div>


                    <!-- Modal Start Game-->
                    <div class="modal fade" id="startGaneModal" tabindex="-1" aria-labelledby="startGameModalLabel" aria-hidden="true">

                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="{{url('/game/start')}}">
                                    @csrf
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="startGaneModalLabel">Modal title</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <p>You are about to start This Game</p>
                                            <input name="game_id" value="{{$user_games[0]->game_id}}" type="hidden">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button class="btn btn-success" type="submit"> Start</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        </div>
                    </div>

                    <!-- Modal End Game-->
                    <div class="modal fade" id="endGameModal" tabindex="-1" aria-labelledby="endGameModalLabel" aria-hidden="true">

                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="{{url('/game/end')}}">
                                    @csrf
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="endGameModalLabel">Modal title</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <p>You are about to End This Game</p>
                                            <input name="game_id" value="{{$user_games[0]->game_id}}" type="hidden">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button class="btn btn-danger" type="submit"> End</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        </div>
                    </div>

                    @foreach($user_games as $game)
                        <div class="modal fade" id="updateScoreModal{{ $game->user_id }}" tabindex="-1" aria-labelledby="updateScoreModalLabel{{ $game->user_id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form id="updateScoreForm{{ $game->user_id }}" method="POST" action="{{ url('/game/update/score') }}">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateScoreModalLabel{{ $game->user_id }}">Update {{ $game->member_name }}'s Score </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="game_id" value="{{ $game->game_id }}">
                                            <input type="hidden" name="member_id" value="{{ $game->user_id }}">
                                            <div class="mb-3">
                                                <label for="new_score{{ $game->user_id }}" class="form-label">New Score</label>
                                                <input type="number" class="form-control" id="new_score{{ $game->user_id }}" name="new_score" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Update Score</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    </div>
                </div>
            </div>
        </div>
@endsection
