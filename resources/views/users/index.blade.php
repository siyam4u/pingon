@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-body borders">
                                @foreach($users as $user)
                                    <div class="row">
                                        <div class="col-md-3"><img class="img-circle" src="{{ url('/') }}/{{$user->image}}" /></div>
                                        <div class="col-md-6 verticalAlignMiddle"><span>{{$user->name}}</span></div>
                                        <div class="col-md-3 verticalAlignMiddle"><a href="{{route('users.edit',$user->id)}}" class="btn btn-warning btn-lg">Edit</a></div>
                                    </div>
                                @endforeach
                            </div>
                </div>
                    </div>
                </div>
        </div>
    </div>
@endsection