{!! Form::open(['method' => $method]) !!}
    <div class="col-sm-12">
        <div class="form-group">
            {!! Form::text('name', null, [
                'class'       => 'form-control',
                'placeholder' => trans('form.payment.name'),
                ($editable ? '' : 'disabled'),
            ]) !!}
        </div>

        <div class="form-group">
            {!! Form::number('customer_fee', null, [
                'class'       => 'form-control',
                'placeholder' => trans('form.payment.customer_fee'),
                ($editable ? '' : 'disabled'),
                'min'         => 0,
            ]) !!}
        </div>

        <div class="form-group">
            {!! Form::number('provider_fee', null, [
                'class'       => 'form-control',
                'placeholder' => trans('form.payment.provider_fee'),
                ($editable ? '' : 'disabled'),
                'min'         => 0,
            ]) !!}
        </div>
    </div>

    <div class="col-xs-6 text-center">
        {!! Form::submit(trans('form.action.ok'), ['class' => 'btn btn-primary btn-outline btn-block btn-sm']) !!}
    </div>
{!! Form::close() !!}

<div class="col-xs-6 text-center">
    {!! Form::button(trans('form.action.cancel'), ['class' => 'btn btn-danger btn-outline btn-block btn-sm', 'data-dismiss' => 'modal']) !!}
</div>
