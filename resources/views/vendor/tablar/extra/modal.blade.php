<div class="modal modal-blur fade" id="modal-user-report" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {!! Form::open(['route' => 'usuarios.store', 'method' => 'POST']) !!}


                <div class="mb-3">
                    {!! Form::label('name', 'Nombre', ['class' => 'form-label']) !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>

                <div class="mb-3">
                    {!! Form::label('email', 'Email', ['class' => 'form-label']) !!}
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                </div>

                <div class="mb-3">
                    {!! Form::label('password', 'Contraseña', ['class' => 'form-label']) !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>

                <div class="mb-3">
                    {!! Form::label('password_confirmation', 'Confirmar contraseña', ['class' => 'form-label']) !!}
                    {!! Form::password('comfirm-password', ['class' => 'form-control']) !!}
                </div>

                <div class="mb-3">
                    {!! Form::label('roles', 'Rol', ['class' => 'form-label']) !!}
                    {{ Form::select('roles[]', $roles, [], ['class' => 'form-control']) }}
                </div>

                <br>

                <div class= "col-x-12 col-sm-12 col-md-12 text-center">
                    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

