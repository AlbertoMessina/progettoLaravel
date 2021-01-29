@extends('templates.layout')
@section('webSection' , 'Dashboard')
@section('css')
<link rel="stylesheet" href="{{asset('css/userProfile.css')}}">
<link rel="stylesheet" href="{{asset('css/snackbar.css')}}">
@stop
@section('content')
<div class="container">
    <div class="row justify-content-center">
    
        <div class="card">
            <div class="card-header">{{ __('Dashboard') }}</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                {{ __('You are logged in!') }}
            </div>
        </div>
    
    </div>
</div>
@stop

