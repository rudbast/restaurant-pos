@extends('layouts.dashboard')

@section('title')
    @lang('sidemenu.administration') - @lang('sidemenu.menus')
@endsection

@section('module-category', trans('sidemenu.administration'))

@section('module-title', trans('sidemenu.menus'))

@section('sidemenu')
    @include('partials.sidemenu', [
        'menu' => 'admin',
        'submenu' => 'menus'
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
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>@lang('sidemenu.menus')</h5>

                <div class="ibox-tools">
                    <a href="{{ action('MenusController@store') }}"
                        class="btn btn-xs btn-success btn-outline modal-link modal-add">
                        @lang('form.action.add')
                    </a>
                </div><!-- /.ibox-tools -->
            </div><!-- /.ibox-title -->

            <div id="modal-form-add" class="modal fade" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xs-12 text-center">
                                    <h3>@lang('form.action.add')</h3>
                                </div>

                                @include('modules.menus.form', [
                                    'method' => 'post',
                                    'editable' => true,
                                    'update' => false,
                                    'simple' => false,
                                ])
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /#modal-form-add -->

            <div class="ibox-content">
                <div class="table-responsive">
                    <table id="menu-list" class="table table-striped table-bordered table-hover" >
                        <thead>
                            <tr>
                                <th>@lang('form.category.name')</th>
                                <th>@lang('form.menu.name')</th>
                                <th>@lang('form.menu.price')</th>
                                <th>@lang('form.action.name')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($menus as $menu)
                                <tr>
                                    <td>{{ $menu->category->name }}</td>
                                    <td>{{ $menu->name }}</td>
                                    <td>{{ number_format($menu->price, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        <span class="menu-info hidden">{{ action('MenusController@show', ['id' => $menu->id]) }}</span>

                                        <div class="btn-group custom-button-action">
                                            <a href="{{ action('MenusController@update', ['id' => $menu->id]) }}"
                                                class="btn btn-xs btn-info btn-outline modal-link modal-edit">
                                                @lang('form.action.edit')
                                            </a>
                                            <a href="{{ action('MenusController@destroy', ['id' => $menu->id]) }}"
                                                class="btn btn-xs btn-danger btn-outline modal-link modal-delete">
                                                @lang('form.action.delete')
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <style type="text/css" media="screen">
                        .custom-button-action > a {
                            margin-bottom: 0 !important;
                        }
                    </style>

                    <div id="modal-form-edit" class="modal fade" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-xs-12 text-center">
                                            <h3>@lang('form.action.edit')</h3>
                                        </div>

                                        @include('modules.menus.form', [
                                            'method' => 'put',
                                            'editable' => true,
                                            'update' => true,
                                            'simple' => false,
                                        ])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /#modal-form-edit -->

                    <div id="modal-form-delete" class="modal fade" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-xs-12 text-center">
                                            <h3>@lang('form.action.delete') ?</h3>
                                        </div>

                                        @include('modules.menus.form', [
                                            'method' => 'delete',
                                            'editable' => false,
                                            'update' => false,
                                            'simple' => true,
                                        ])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /#modal-form=delete -->
                </div>
            </div><!-- /.ibox-content -->
        </div><!-- /.ibox -->
    </div><!-- /.col -->
@endsection

@section('script-bottom')
    <script src="{{ asset('js/modal-form.js') }}" type="text/javascript" charset="utf-8"></script>

    <script type="text/javascript" charset="utf-8">
        $(function(){
            // Active datatables js.
            $('#menu-list').DataTable({
                pageLength: 10,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [],
                columnDefs: [
                    { sortable: false, targets: [ -1 ] },
                    { searchable: false, targets: [ -1 ] }
                ]
            });

            var modalAdd = $('#modal-form-add');
            var modalEdit = $('#modal-form-edit');
            var modalDelete = $('#modal-form-delete');

            // Set modal on hidden event to reset form values.
            setupModalsForms([modalAdd, modalEdit, modalDelete], {
                category: {
                    required: true
                },
                name: {
                    required: true
                },
                price: {
                    required: true
                }
            });

            /** Action click events. */
            $('a.modal-link').click(function (event) {
                event.preventDefault();

                var currentElement = $(this);
                var dataUrl = currentElement.parent().siblings('.menu-info').text();
                var formUrl = currentElement.attr('href');
                var requestAjax = true;
                var modalForm;

                if (currentElement.hasClass('modal-add')) {
                    modalForm = modalAdd;
                    requestAjax = false;
                } else if (currentElement.hasClass('modal-edit')) {
                    modalForm = modalEdit;
                } else if (currentElement.hasClass('modal-delete')) {
                    modalForm = modalDelete;
                }

                if (requestAjax) {
                    // Request data from given url and replace the info
                    // into the provided field in modal form.
                    $.ajax(dataUrl).done(function (menu) {
                        for (var info in menu) {
                            if (info == 'category') {
                                modalForm.find('select[name="' + info + '"]').val(menu[info].id);
                            }
                            modalForm.find('input[name="' + info + '"]').val(menu[info]);
                        }
                        setupModalFormUrl(modalForm, formUrl);
                    });
                } else {
                    setupModalFormUrl(modalForm, formUrl);
                }
            });
        });
    </script>
@endsection
