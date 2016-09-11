{!! Form::open(['method' => $method]) !!}
    <div class="col-sm-12">
        <div class="form-group">
            {!! Form::text('username', null, [
                'class'       => 'form-control',
                'placeholder' => trans('form.user.username'),
                ($editable ? '' : 'disabled'),
            ]) !!}
        </div>

        <div class="form-group">
            {!! Form::text('name', null, [
                'class'       => 'form-control',
                'placeholder' => trans('form.user.name'),
                ($editable ? '' : 'disabled'),
            ]) !!}
        </div>

        <div class="form-group">
            {!! Form::email('email', null, [
                'class'       => 'form-control',
                'placeholder' => trans('form.user.email'),
                ($editable ? '' : 'disabled'),
            ]) !!}
        </div>

        <div class="form-group">
            {!! Form::select('access[]', $accesses, null, [
                'class' => 'chosen-select text-left',
                'data-placeholder' => trans('form.access.name'),
                'multiple',
                ($editable ? '' : 'disabled'),
            ]) !!}
        </div>

        @unless ($simple)
            @if ($update)
                <div class="form-group text-left">
                    <label>
                        {!! Form::checkbox('setpassword', 'setpassword', false, ['class' => 'set-password-checkbox']) !!}
                        @lang('form.user.setpassword')
                    </label>
                </div>
            @endif

            <div class="set-password-field"{{ $update ? ' hidden' : '' }}>
                <div class="form-group">
                    {!! Form::password('password', [
                        'class'       => 'form-control',
                        'placeholder' => trans('form.user.password'),
                        ($update ? 'disabled' : ''),
                    ]) !!}
                </div>

                <div class="form-group">
                    {!! Form::password('password_confirmation', [
                        'class'       => 'form-control',
                        'placeholder' => trans('form.user.password_confirmation'),
                        ($update ? 'disabled' : ''),
                    ]) !!}
                </div>
            </div>
        @endif
    </div>

    <div class="col-xs-6 text-center">
        {!! Form::submit(trans('form.action.ok'), ['class' => 'btn btn-primary btn-outline btn-block btn-sm']) !!}
    </div>
{!! Form::close() !!}

<div class="col-xs-6 text-center">
    {!! Form::button(trans('form.action.cancel'), ['class' => 'btn btn-danger btn-outline btn-block btn-sm', 'data-dismiss' => 'modal']) !!}
</div>
