@extends('layouts.master')

@section('title', 'Masuk')

@section('body')
    <body class="gray-bg">
        <div class="middle-box text-center loginscreen animated fadeInDown">
            <div>
                <div>
                    <h1 class="logo-name">TG</h1>
                </div>

                <h3>{{ config('app.name') }}</h3>

                <form class="m-t" role="form" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                        <input name="username" type="text" class="form-control" placeholder="@lang('form.user.username')" required="">

                        @if ($errors->has('username'))
                            <span class="help-block">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input name="password" type="password" class="form-control" placeholder="@lang('form.user.password')" required="">

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary block full-width m-b">@lang('auth.login')</button>

                    <a href="{{ url('/password/reset') }}"><small>@lang('auth.forgot')</small></a>
                </form>

                <p class="m-t">
                    <small>
                        <strong>Copyright</strong> {{ config('app.name') }} &copy; {{ date('Y') }}
                    </small>
                    <div>
                        @include('partials.setlocale')
                    </div>
                </p>
            </div>
        </div>
    </body>
@endsection
