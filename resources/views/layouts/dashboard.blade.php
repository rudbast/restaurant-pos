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
                                            <strong class="font-bold">@yield('user-name')</strong>
                                        </span>
                                        <span class="text-muted text-xs block">
                                            @yield('user-role') <b class="caret"></b>
                                        </span>
                                    </span>
                                </a>

                                <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                    <li>
                                        <a href="{{ url('/logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                            Log out
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="logo-element">
                                The Grapes
                            </div>
                        </li>

                        @include('partials.sidemenu', [
                            'page' => '',
                        ])
                    </ul>
                </div>
            </nav>

            <div id="page-wrapper" class="gray-bg">
                <div class="row border-bottom">
                    <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                        <div class="navbar-header">
                            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                            <form role="search" class="navbar-form-custom" method="post" action="#">
                                <div class="form-group">
                                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                                </div>
                            </form>
                        </div>

                        <ul class="nav navbar-top-links navbar-right">
                            <li>
                                <a href="{{ url('/logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i> Log out
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>

                {{-- Logout Form --}}
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>

                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center m-t-lg">
                                <h1>
                                    Welcome in INSPINIA Static SeedProject
                                </h1>
                                <small>
                                    It is an application skeleton for a typical web app. You can use it to quickly bootstrap your webapp projects and dev environment for these projects.
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer">
                    <div>
                        <strong>Copyright</strong> The Grapes &copy; 2016
                    </div>
                </div>
            </div>
        </div>
    </body>
@endsection
