@extends('layouts.dashboard')

@section('title')
    @lang('sidemenu.orders')
@endsection

@section('module-category', trans('sidemenu.orders'))

@section('module-title', trans('sidemenu.orders'))

@section('sidemenu')
    @include('partials.sidemenu', [
        'menu' => 'orders',
        'submenu' => '',
    ])
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}">
@endsection

@section('script-top')
    <script src="{{ asset('js/datatables.min.js') }}" type="text/javascript" charset="utf-8" defer></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}" type="text/javascript" charset="utf-8" defer></script>
@endsection

@section('content')
    <div class="col-xs-12 col-sm-5 col-md-4">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Menu</h5>
            </div><!-- /.ibox-title -->

            <div class="ibox-content">
                <div class="table-responsive">
                   <table id="menu-list" class="table table-striped table-bordered table-hover" >
                        <thead>
                            <tr>
                                <th>Menu Name</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Rice</td>
                                <td class="text-center">
                                    <input type="number" name="quantity" class="text-right" min="0" value="0">
                                </td>
                            </tr>
                            <tr>
                                <td>Spaghetti</td>
                                <td class="text-center">
                                    <input type="number" name="quantity" class="text-right" min="0" value="0">
                                </td>
                            </tr>
                            <tr>
                                <td>Burger</td>
                                <td class="text-center">
                                    <input type="number" name="quantity" class="text-right" min="0" value="0">
                                </td>
                            </tr>
                            <tr>
                                <td>Chicken Spatula</td>
                                <td class="text-center">
                                    <input type="number" name="quantity" class="text-right" min="0" value="0">
                                </td>
                            </tr>
                            <tr>
                                <td>Pizza</td>
                                <td class="text-center">
                                    <input type="number" name="quantity" class="text-right" min="0" value="0">
                                </td>
                            </tr>
                            <tr>
                                <td>La fonte</td>
                                <td class="text-center">
                                    <input type="number" name="quantity" class="text-right" min="0" value="0">
                                </td>
                            </tr>
                            <tr>
                                <td>MingLee</td>
                                <td class="text-center">
                                    <input type="number" name="quantity" class="text-right" min="0" value="0">
                                </td>
                            </tr>
                            <tr>
                                <td>Golang</td>
                                <td class="text-center">
                                    <input type="number" name="quantity" class="text-right" min="0" value="0">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div><!-- /.ibox-content -->
        </div><!-- /.ibox -->
    </div><!-- /.col -->

    <div class="col-xs-12 col-sm-7 col-md-8">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Order List</h5>
            </div><!-- /.ibox-title -->

            <div class="ibox-content">
                ORDER LIST GOES HERE
            </div><!-- /.ibox-content -->
        </div><!-- /.ibox -->
    </div><!-- /.col -->

    <div class="col-md-8">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Waiting List</h5>
            </div><!-- /.ibox-title -->

            <div class="ibox-content">
                WAITING LIST GOES HERE
            </div><!-- /.ibox-content -->
        </div><!-- /.ibox -->
    </div><!-- /.col -->
@endsection

@section('script-bottom')
    <script src="{{ asset('js/modal-form.js') }}" type="text/javascript" charset="utf-8"></script>

    <script type="text/javascript" charset="utf-8">
        $(function() {
            $('#menu-list').DataTable({
                pageLength: 10,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [],
            });
        });
    </script>
@endsection
