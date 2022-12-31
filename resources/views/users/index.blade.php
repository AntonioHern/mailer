@extends('layouts.app', ['activePage' => 'users', 'titlePage' => __('Usuarios')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Usuarios</h4>
                            <p class="card-category"> Aquí puede administrar usuarios</p>
                        </div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="alert alert-success">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <i class="material-icons">close</i>
                                            </button>
                                            <span>{{ session('status') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-12 text-right">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalUsuario">
                                        <i class="material-icons">person_add</i>
                                    </button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                    <tr>
                                        <th>
                                            Nombre
                                        </th>
                                        <th>
                                            Email
                                        </th>
                                        <th>
                                            Fecha de creación
                                        </th>
                                        <th class="text-right">
                                            Acciones
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @csrf
                                    @foreach($users as $user)
                                        <tr class="post{{$user->id}}">
                                            <td>
                                                {{$user->name}}
                                            </td>
                                            <td>
                                                {{$user->email}}
                                            </td>
                                            <td>
                                                {{$user->created_at}}
                                            </td>
                                            <td class="td-actions text-right">
                                                <a rel="tooltip" class="btn btn-success btn-link"
                                                   href="{{route('users.show',$user->id)}}"
                                                   data-original-title="" title="Editar" role="button"
                                                   data-toggle="tooltip" data-placement="bottom">
                                                    <i class="material-icons">edit</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                                <a rel="tooltip" class="btn btn-danger btn-link"
                                                   href="#"
                                                   data-original-title="" title="Eliminar" role="button"
                                                   data-id="{{$user->id}}"
                                                   data-toggle="tooltip" data-placement="bottom">
                                                    <i class="material-icons">delete</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade mb-5" id="modalUsuario" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog mb-5" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Añadir Usuario</h5>
                </div>
                <form class="form" method="post" action="{{ route('users.store') }}"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="card-body ">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('Name') }}" value="{{ old('name', auth()->user()->name) }}" required="true" aria-required="true"/>
                                    @if ($errors->has('name'))
                                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="{{ __('Email') }}" value="{{ old('email', auth()->user()->email) }}" required />
                                    @if ($errors->has('email'))
                                        <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="input-password" type="password" placeholder="{{ __('Contraseña') }}" value="" required />
                                        @if ($errors->has('password'))
                                            <span id="password-error" class="error text-danger" for="input-password">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input class="form-control" name="password_confirmation" id="input-password-confirmation" type="password" placeholder="{{ __('Confirmar contraseña') }}" value="" required />
                                    </div>
                                </div>
                            </div>


                    </div>
                    <div class="card-footer ml-auto mr-auto">
                        <button type="submit" class="btn btn-primary">{{ __('Añadir') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>






    <script>

        $(document).ready(function () {
            //no cierra la ventana modal mientras hayan errores
            @if (session('errors'))
            $('#modalUsuario').modal({show: true});
            @endif



        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

            $(document).on('click', '.btn-danger', function () {
                let id = $(this).data("id");
                $.ajax({
                    type: 'DELETE',
                    url: 'deleteuser/' + id,
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'id': id
                    },
                    success: function (data) {
                        $('.post' + id).fadeOut('slow');
                        swal({
                            title: "Usuario eliminado!",
                            icon: "success",
                        });
                        console.log("it Works, delete user " + id);
                    }, error: function (error) {
                        console.log(error)
                    }

                });
            });

        });
    </script>
@endsection







