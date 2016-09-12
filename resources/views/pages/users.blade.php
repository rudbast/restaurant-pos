@extends('layouts.dashboard')

@section('title')
    @lang('sidemenu.administration') - @lang('sidemenu.users')
@endsection

@section('module-category', trans('sidemenu.administration'))

@section('module-title', trans('sidemenu.users'))

@section('sidemenu')
    @include('partials.sidemenu', [
        'menu' => 'admin',
        'submenu' => 'users'
    ])
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-chosen.css') }}">
@endsection

@section('script-top')
    <script src="{{ asset('js/datatables.min.js') }}" type="text/javascript" charset="utf-8" async></script>
    <script src="{{ asset('js/chosen.jquery.js') }}" type="text/javascript" charset="utf-8" async></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}" type="text/javascript" charset="utf-8" async></script>
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>@lang('sidemenu.users')</h5>

                <div class="ibox-tools">
                    <a href="{{ action('UsersController@store') }}"
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

                                @include('modules.users.form', [
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
                    <table id="user-list" class="table table-striped table-bordered table-hover" >
                        <thead>
                            <tr>
                                <th>@lang('form.user.username')</th>
                                <th>@lang('form.user.name')</th>
                                <th>@lang('form.access.name')</th>
                                <th>@lang('form.action.name')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        @foreach ($user->accesses as $access)
                                            @unless ($loop->first)
                                                -
                                            @endunless
                                            {{ $access->name }}
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        <span class="user-info hidden">{{ action('UsersController@show', ['id' => $user->id]) }}</span>

                                        <div class="btn-group custom-button-action">
                                            <a href="{{ action('UsersController@update', ['id' => $user->id]) }}"
                                                class="btn btn-xs btn-info btn-outline modal-link modal-edit">
                                                @lang('form.action.edit')
                                            </a>
                                            {{-- Disable action delete for MAIN USER (Administrator) --}}
                                            @unless ($loop->first)
                                                <a href="{{ action('UsersController@destroy', ['id' => $user->id]) }}"
                                                    class="btn btn-xs btn-danger btn-outline modal-link modal-delete">
                                                    @lang('form.action.delete')
                                                </a>
                                            @endunless
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

                                        @include('modules.users.form', [
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

                                        @include('modules.users.form', [
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
            $('#user-list').DataTable({
                pageLength: 10,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [],
                columnDefs: [
                    { sortable: false, targets: [ -1 ] },
                    { searchable: false, targets: [ -1 ] }
                ]
            });

            // Activate select chosen js.
            $('.chosen-select').chosen({width: "100%"});

            $('.set-password-checkbox').change(function () {
                var setPassElement = $(this);
                var setPassFieldElement = setPassElement.closest('.form-group')
                                                        .siblings('.set-password-field');
                var setPassFieldInputElement = setPassElement.closest('.form-group')
                                                        .siblings('.set-password-field')
                                                        .find('.form-control');

                if (setPassElement.is(':checked')) {
                    setPassFieldElement.show();
                    setPassFieldInputElement.removeAttr('disabled');
                } else {
                    setPassFieldElement.hide();
                    setPassFieldInputElement.prop('disabled', true);
                }
            })

            var modalAdd = $('#modal-form-add');
            var modalEdit = $('#modal-form-edit');
            var modalDelete = $('#modal-form-delete');

            // Set modal on hidden event to reset form values.
            setupModalsForms([modalAdd, modalEdit, modalDelete], {
                username: {
                    required: true,
                    maxlength: 20
                },
                name: {
                    required: true,
                    maxlength: 30
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    minlength: 6
                }
            });

            /** Action click events. */
            $('a.modal-link').click(function (event) {
                event.preventDefault();

                var currentElement = $(this);
                var dataUrl = currentElement.parent().siblings('.user-info').text();
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
                    $.ajax(dataUrl).done(function (user) {
                        for (var info in user) {
                            if (info == 'accesses') {
                                let accesses = [];

                                user[info].forEach(function (access) {
                                    accesses.push(access.id);
                                });
                                modalForm.find('.chosen-select').val(accesses).trigger('chosen:updated');
                            }
                            modalForm.find('input[name="' + info + '"]').val(user[info]);
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
