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

                    {{ __('You are logged in!') }}
                    <br/>
                    <br/>
                        <div>
                            <a type="button" class="btn btn-primary" href="{{url('/member/details')}}"> Member Details</a>

                        </div>
                    <br/>
                    <br/>
                    <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <a type="button" class="btn btn-info" href="{{url('/game/create')}}"> Create Game</a>

                            </div>
                            <div class="col-md-4">
                                <a type="button" class="btn btn-success" href="#"> View Your Games</a>
                                 {{-- in the view, add option to add players to the game, max of 5 --}}
                            </div>
                        </div>
                    <br/>
                    <br/>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
