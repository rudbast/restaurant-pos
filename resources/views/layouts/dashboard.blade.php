@extends('layouts.master')

@section('body')
    <body>
        <div id="wrapper">
            <nav class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav metismenu" id="side-menu">
                        <li class="nav-header">
                            <div class="dropdown profile-element">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <span class="clear">
                                        <span class="block m-t-xs">
                                            <strong class="font-bold">{{ auth()->user()->name }}</strong>
                                        </span>
                                        <span class="text-muted text-xs block">
                                            {{ auth()->user()->username }} <b class="caret"></b>
                                        </span>
                                    </span>
                                </a>

                                <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                    <li>
                                        <a href="{{ url('/logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            @lang('auth.logout')
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="logo-element">
                                {{ config('app.name') }}
                            </div>
                        </li>

                        @yield('sidemenu')
                    </ul>
                </div>
            </nav>

            <div id="page-wrapper" class="gray-bg">
                <div class="row border-bottom">
                    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                        <div class="navbar-header">
                            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-top-links navbar-right">
                            <li>
                                <a href="{{ url('/logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i> @lang('auth.logout')
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <div class="row wrapper border-bottom white-bg page-heading">
                    <div class="col-lg-10">
                        <h2>@yield('module-category')</h2>
                        <ol class="breadcrumb">
                            <li class="active">
                                <strong>@yield('module-title')</strong>
                            </li>
                        </ol>
                    </div>
                    <div class="col-lg-2"></div>
                </div>

                {{-- Logout Form --}}
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>

                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="row">
                        @yield('content')
                    </div>
                </div>

                <div class="footer">
                    <div>
                        <strong>Copyright</strong> {{ config('app.name') }} &copy; {{ date('Y') }}
                    </div>
                </div>
            </div>
        </div>

        @yield('script-bottom')
    </body>
@endsection
