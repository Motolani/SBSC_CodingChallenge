@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                            <div >{{$member->name}}'s Details</div>
                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-secondary" href="{{url('/home')}}"> Back</a>
                        </div>
                    </div>
                </div>


                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <h4> Date Joined: </h4>
                            </br>
                            <h4> Phone: </h4>
                            </br>
                            <h4> Email: </h4>
                            </br>
                            <h4> Ave Score: </h4>
                            </br>
                            <h4> Highest Score: </h4>
                            </br>
                            <h4> Recent Games: </h4>
                            </br>
                        </div>

                        <div class="col-md-6">
                            <p>{{$member->joined_date}}</p>
                            <br/>
                            <p>{{$member->phone}}</p>
                            <br/>
                            <p>{{$member->email}} </p>
                            <br/>
                            <p>{{ $averageScore ? $averageScore : 'No average score available' }} </p>
                            <br/>
                            <p>{{ $highestScoreGame ? $highestScoreGame : 'Highest score not available'}} </p>
                            <br/>
                            <p>{{ $mostRecentGame ? $mostRecentGame : "No recent game"}} </p>
                            <br/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
