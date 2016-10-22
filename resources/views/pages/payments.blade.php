@extends('layouts.dashboard')

@section('title')
    @lang('sidemenu.administration') - @lang('sidemenu.payments')
@endsection

@section('module-category', trans('sidemenu.administration'))

@section('module-title', trans('sidemenu.payments'))

@section('sidemenu')
    @include('partials.sidemenu', [
        'menu' => 'admin',
        'submenu' => 'payments'
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
                <h5>@lang('sidemenu.payments')</h5>

                <div class="ibox-tools">
                    <a href="{{ action('PaymentsController@store') }}"
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

                                @include('modules.payments.form', [
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
                                <th>@lang('form.payment.name')</th>
                                <th>@lang('form.payment.customer_fee')</th>
                                <th>@lang('form.payment.provider_fee')</th>
                                <th>@lang('form.action.name')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                                <tr>
                                    <td>{{ $payment->name }}</td>
                                    <td>{{ number_format($payment->customer_fee, 0, ',', '.') }}</td>
                                    <td>{{ number_format($payment->provider_fee, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        <span class="payment-info hidden">{{ action('PaymentsController@show', ['id' => $payment->id]) }}</span>

                                        <div class="btn-group custom-button-action">
                                            <a href="{{ action('PaymentsController@update', ['id' => $payment->id]) }}"
                                                class="btn btn-xs btn-info btn-outline modal-link modal-edit">
                                                @lang('form.action.edit')
                                            </a>
                                            <a href="{{ action('PaymentsController@destroy', ['id' => $payment->id]) }}"
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

                                        @include('modules.payments.form', [
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

                                        @include('modules.payments.form', [
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
                name: {
                    required: true
                },
                customer_fee: {
                    required: true
                },
                provider_fee: {
                    required: true
                }
            });

            /** Action click events. */
            $('a.modal-link').click(function (event) {
                event.preventDefault();

                var currentElement = $(this);
                var dataUrl = currentElement.parent().siblings('.payment-info').text();
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
