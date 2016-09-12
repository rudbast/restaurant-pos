@extends('layouts.master')

@section('title', '500 Error')

@section('body')
    <body class="gray-bg">
        <div class="middle-box text-center animated fadeInDown">
            <h1>500</h1>
            <h3 class="font-bold">@lang('errors.http.500.title')</h3>

            <div class="error-desc">
                @lang('errors.http.500.desc')
            </div>
        </div>
    </body>
@endsection
