@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                            <div >Your Scrabble Games</div>
                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-secondary" href="{{url('/home')}}"> Back</a>
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
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">s/n</th>
                                <th scope="col">Game Title</th>
                                <th scope="col">Date</th>
                                <th scope="col">Player count</th>
                                <th scope="col">User Score</th>
                                <th scope="col">Game Details</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($games as $index => $game)
                                    <tr>
                                        <th>{{ $index + 1 }}</th>
                                        <td>{{$game->name}}</td>
                                        <td>{{$game->created_at}}</td>
                                        <td>{{$game->player_count}}</td>
                                        <td>{{$game->score}}</td>
                                        <td><a class='btn btn-info' href='{{ route('details.games', $game->id) }}'>View</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
