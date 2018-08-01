@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">nslookup</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('nslookup') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('ipAdd') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Ip Address/ Domain Name</label>

                                <div class="col-md-6">
                                    <input id="ipAdd" type="text" class="form-control" name="ipAdd" value="{{ old('ipAdd') }}" required autofocus>

                                    @if ($errors->has('ipAdd'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('ipAdd') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Lookup
                                    </button>
                                </div>
                            </div>
                            <div class="form-group">
                                @foreach($pingResult as $key=>$val)
                                    <div class="col-md-8 col-md-offset-4">{{$pingResult[$key]}}</div>
                                @endforeach
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
