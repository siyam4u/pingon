@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                @if(session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session()->get('message') }}
                                    </div>
                                @endif
                                    <form class="form-horizontal"  method="post" action="{{route('users.update', $user)}}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        {{ method_field('patch') }}

                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label for="name" class="col-md-4 control-label">Name</label>

                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>

                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label for="name" class="col-md-4 control-label">Image</label>

                                            <div class="col-md-6">
                                                @if ($user->image)
                                                <img class="img-circle" src="{{ url('/') }}/{{$user->image}}" />
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                            <label for="image" class="col-md-4 control-label">&nbsp;</label>
                                            <br>
                                            <div class="col-md-6">
                                                <input type="file" name="image">
                                                @if ($errors->has('image'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-4">
                                                <button type="submit" class="btn btn-primary">
                                                    Save
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                            </div>
                </div>
                    </div>
                </div>
        </div>
    </div>
@endsection