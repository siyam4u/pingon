@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading">Dashboard</div>
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <div class="links">
                    <a href="/ping">Ping</a>
                    <a href="/nslookup">Nslookup</a>
                    <a href="/whois">Whois</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
