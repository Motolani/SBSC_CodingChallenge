@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h4>Member Details</h4>
                    <br/>
                        <div>
                            <a type="button" class="btn btn-primary" href="{{url('/member/details')}}"> My Details</a>

                        </div>
                    <br/>
                    <hr>
                    <h4>Games</h4>
                    <br/>
                        <div class="row">
                            <div class="col-md-4">
                                <a type="button" class="btn btn-info" href="{{url('/game/create')}}"> Create Game</a>

                            </div>
                            <div class="col-md-4">
                                <a type="button" class="btn btn-success" href="{{url('/view/games')}}"> View Your Games</a>
                            </div>
                            <div class="col-md-4">
                                <a type="button" class="btn btn-warning" href="{{url('/leaderboard/games')}}"> Leaderboard </a>
                            </div>
                        </div>
                    <br/>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
