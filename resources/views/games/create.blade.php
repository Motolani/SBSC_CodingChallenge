@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                            <div >Create a Scrabble Game</div>
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

                    <div class="justify-content-center">
                        <form method="POST" action="#">
                            @csrf

                            <div class="row">

                                <div class="col-md-4 ">
                                    <label for="email">Title Game</label>
                                </div>
                                <div class="col-md-8 ">

                                <input id="title"
                                    type="title"
                                    name="title"
                                    class="form-control @error('title') is-invalid @else is-valid @enderror">
                                </div>
                            </div>
                            <br>

                            <div class="row">

                                <div class="col-md-4 ">
                                    <div>Select Player</div>
                                </div>
                                <div class="col-md-8 ">
                                    <select class="form-select" aria-label="Default select example" name="member_id">
                                        <option selected>Select From Members</option>
                                            @foreach($members as $member)
                                                <option value="{{$member->id}}">{{$member->name}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div>
                                <button class="btn btn-primary" type="submit"> Create</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
