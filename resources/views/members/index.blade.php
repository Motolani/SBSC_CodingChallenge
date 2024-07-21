@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <div >{{$member->name}}'s Details</div>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Update Contact
                            </button>
                        </div>
                        <div class="col-md-2">
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
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4> Date Joined: </h4>
                                </div>

                                <div class="col-md-6">
                                    <p>{{$member->joined_date}}</p>
                                </div>
                            </div>
                            </br>

                            <div class="row">
                                <div class="col-md-6">
                                    <h4> Phone: </h4>
                                </div>

                                <div class="col-md-6">
                                    <p>{{$member->phone}}</p>
                                </div>
                            </div>
                            </br>

                            <div class="row">
                                <div class="col-md-6">
                                    <h4> Email: </h4>
                                </div>

                                <div class="col-md-6">
                                    <p>{{$member->email}} </p>
                                </div>
                            </div>
                            </br>

                            <div class="row">
                                <div class="col-md-6">
                                    <h4> Ave Score: </h4>
                                </div>

                                <div class="col-md-6">
                                    <p>{{ $averageScore ? $averageScore : 'No average score available' }} </p>
                                </div>

                            </div>
                            </br>

                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class=""> Highest Score Game Name: </h4>
                                </div>

                                <div class="col-md-6">
                                    <p>{{ $highestScoreGameName ? $highestScoreGameName : 'Highest score not available yet'}} </p>
                                </div>
                            </div>
                            </br>

                            <div class="row">
                                <div class="col-md-6">
                                    <h4> Highest Score: </h4>
                                </div>

                                <div class="col-md-6">
                                    <p>{{ $highestScore ? $highestScore : 'Highest score not available'}} </p>
                                </div>
                            </div>
                            </br>

                            <div class="row">
                                <div class="col-md-6">
                                    <h4> Highest Score Game Date: </h4>
                                </div>

                                <div class="col-md-6">
                                    <p>{{ $mostRecentGame ? $mostRecentGame : "No recent game"}} </p>
                                </div>
                            </div>
                            </br>

                            <div class="row">
                                <div class="col-md-6">
                                    <h4> Recent Games: </h4>
                                </div>

                                <div class="col-md-6">
                                    <p>{{ $mostRecentGame ? $mostRecentGame : "No recent game"}} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                                        <div>Update Details</div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8 ">
                                        <label> Email Address</label>
                                        <input id="title"
                                            type="email"
                                            name="email"
                                            value="{{ old('email', $member->email) }}"
                                            class="form-control @error('email') is-invalid @else is-valid @enderror">
                                    </div>
                                </div>
                            </br>
                                <div class="row">
                                    <div class="col-md-8 ">
                                        <label> Phone Number</label>
                                        <input id="title"
                                            type="title"
                                            name="title"
                                            value="{{ old('phone', $member->phone) }}"
                                            class="form-control @error('title') is-invalid @else is-valid @enderror">
                                    </div>
                                </div>
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
        </div>
    </div>
</div>
@endsection
