@extends('layouts.main')
@section('content')
    @guest
        <div class="not-logged-main">
            <div class="big-name text-center">
                <span>Exchequer</span>
            </div>
            <div class="need-login text-center">
                <span>You have to <a href="#" data-toggle="modal" data-target="#loginModal">Log in</a> or <a
                        href="/register">create an account</a> to start using the service!</span>
            </div>
        </div>
    @endguest
@endsection
