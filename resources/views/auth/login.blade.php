@extends('layouts.master')

@section('title', 'Masuk')

@section('body')
    <body class="gray-bg">
        <div class="middle-box text-center loginscreen animated fadeInDown">
            <div>
                <div>
                    <h1 class="logo-name">TG</h1>
                </div>

                <h3>The Grapes - Wine and Lounge</h3>

                <form class="m-t" role="form" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                        <input name="username" type="text" class="form-control" placeholder="Nama Pengguna" required="">

                        @if ($errors->has('username'))
                            <span class="help-block">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input name="password" type="password" class="form-control" placeholder="Kata Sandi" required="">

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary block full-width m-b">Masuk</button>

                    <a href="{{ url('/password/reset') }}"><small>Lupa kata sandi?</small></a>
                </form>

                <p class="m-t">
                    <small>
                        <strong>Copyright</strong> The Grapes &copy; 2016
                    </small>
                </p>
            </div>
        </div>
    </body>
@endsection
