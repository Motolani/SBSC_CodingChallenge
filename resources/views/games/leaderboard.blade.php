@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                            <div >Top 10 Average Scores</div>
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

                    <div class="justify-content-center">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">s/n</th>
                                <th scope="col">Member Name</th>
                                <th scope="col">Average Score</th>
                                <th scope="col">Games Played</th>
                                <th scope="col">Date Joined</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($topAverageScores as $index => $game)
                                    <tr>
                                        <th>{{ $index + 1 }}</th>
                                        <td>{{$game->member->name}}</td>
                                        <td>{{$game->avg_score}}</td>
                                        <td>{{$game->member->games_played}}</td>
                                        <td>{{$game->member->joined_date}}</td>
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
