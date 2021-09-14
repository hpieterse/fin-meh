@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center pt-40">
    <h1 class="text-5xl text-center">Welcome to YABT</h1>
    <p class="text-brand tracking-widest text-center">Yet Another Budget Tool <p>

     <x-icon-rabbit-fast-solid style="width: 100px" class="text-brand pt-10 pb-20"/>
     <div>
        <a href="{{ route('login') }}" class="mr-10 pl-10 text-2xl">{{ __('Login') }}</a>
        <a href="{{ route('register') }}" class="ml-10 pr-10 text-2xl">{{ __('Register') }}</a>
     </div>
<div>
@endsection