@extends('layouts.app')

@section('content')
<div class="d-flex flex-column align-items-center pt-5">
    <h1 class="text-5xl">Welcome to Fin Meh</h1>
    <livewire:counter /> 
     <x-icon-meh-light style="width: 100px" class="text-secondary py-5"/>
     <div>
        <a href="{{ route('login') }}" class="mr-5 pl-4 h3">{{ __('Login') }}</a>
        <a href="{{ route('register') }}" class="ml-5 h3">{{ __('Register') }}</a>
     </div>
<div>
@endsection