@extends('layouts.main')
@section('content')


<div id="banner-app" class="landing-page" >
    <div class="logo">
        <a href="/search"><img src="https://www.dropbox.com/s/1znnm2hkyaw6w7d/logo-large.png?raw=1" alt=""></a>
    </div>
    <div class="slogan">
        <h2>Smart recipes for dump people who are lazy to think</h2>
    </div>
    <div class="btn">
        <a href="/search"><button>Enter the awesomeness</button></a>
    </div>
</div>

{{-- <script src="{{ mix('js/banner.js') }}"></script> --}}
@endsection
