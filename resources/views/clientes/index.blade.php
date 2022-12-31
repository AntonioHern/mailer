@extends('layouts.app', ['activePage' => 'clientes', 'titlePage' => __('Clientes')])
@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Clientes</h4>
                            <p class="card-category"> Aquí se muestran todos los clientes</p>
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
                                    <button type="button" class="btn btn-primary btn-just-icon mb-4" data-toggle="modal" data-target="#modalClientes">
                                        <i class="material-icons">add</i>
                                    </button>
                                </div>
                            </div>
                            <div class="table-hover">
                                <table class="table" id="clientes">
                                    <thead class=" text-primary">
                                    <tr>
                                        <th>
                                            Nombre
                                        </th>
                                        <th>
                                            Email
                                        </th>
                                        <th>
                                            Zona
                                        </th>
                                        <th>
                                            Cód. Post.
                                        </th>
                                        <th>
                                            Creación
                                        </th>
                                        <th class="text-right">
                                            Acciones
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @csrf
                                    @foreach($clientes as $cliente)
                                        <tr class="post{{$cliente->id}}">
                                            <td>
                                                {{$cliente->nombre}}
                                            </td>
                                            <td>
                                                {{$cliente->email}}
                                            </td>
                                            <td>
                                                {{$cliente->zona->nombre}}
                                            </td>
                                            <td>
                                                {{$cliente->codpostal}}
                                            </td>
                                            <td>
                                                {{$cliente->created_at->format('d-m-Y') }}
                                            </td>
                                            <td class="td-actions text-right">
                                                <a rel="tooltip" class="btn btn-success btn-edit btn-link"
                                                   href="#" data-toggle="modal" data-target="#modalClientesEdit"
                                                   data-original-title="" title="Editar" role="button"
                                                   data-id="{{$cliente->id}}"
                                                   data-nombre="{{$cliente->nombre}}"
                                                   data-email="{{$cliente->email}}"
                                                   data-zona="{{$cliente->zona->id}}"
                                                   data-codpostal="{{$cliente->codpostal}}"
                                                   data-toggle="tooltip" data-placement="bottom">
                                                    <i class="material-icons">edit</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                                <a rel="tooltip" class="btn btn-danger btn-link"
                                                   href="#"
                                                   data-original-title="" title="Eliminar" role="button"
                                                   data-id="{{$cliente->id}}"
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



    <!-- Modal añadir -->
    <div class="modal fade mb-5" id="modalClientes" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog mb-5" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Añadir cliente</h5>
                </div>
                <form class="form" method="post" action="{{ route('clientes.store') }}"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="card-body ">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <input class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" id="input-nombre-cliente" type="text" placeholder="{{ __('Nombre') }}" required="true" aria-required="true"/>
                                    @if ($errors->has('nombre'))
                                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('nombre') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" type="text" placeholder="{{ __('Email') }}" required="true" aria-required="true"/>
                                    @if ($errors->has('email'))
                                        <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group{{ $errors->has('zona') ? ' has-danger' : '' }}">
                                    <select class="form-control{{ $errors->has('zona') ? ' is-invalid' : '' }}" name="zona_id" id="zona" required="true" aria-required="true">
                                        <option value="">Selecciona una zona</option>
                                        @foreach($zonas as $zona)
                                            <option value="{{$zona->id}}">{{$zona->nombre}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('zona'))
                                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('zona') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group{{ $errors->has('codpostal') ? ' has-danger' : '' }}">
                                    <input class="form-control{{ $errors->has('codpostal') ? ' is-invalid' : '' }}" name="codpostal" id="codpostal" type="text" placeholder="{{ __('Cód Postal') }}"/>
                                    @if ($errors->has('codpostal'))
                                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->codpostal('codpostal') }}</span>
                                    @endif
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

    <!-- Modal editar -->
    <div class="modal fade mb-5" id="modalClientesEdit" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog mb-5" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar cliente</h5>
                </div>
                <form class="form" method="post" action="{{ route('clientes.update') }}"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="card-body ">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <input type="hidden" name="id" id="id-cliente" value="">
                                    <input class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" id="input-nombre-cliente-edit" type="text" placeholder="{{ __('Nombre') }}" required="true" aria-required="true"/>
                                    @if ($errors->has('nombre'))
                                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('nombre') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email-edit" type="text" placeholder="{{ __('Email') }}" required="true" aria-required="true"/>
                                    @if ($errors->has('email'))
                                        <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group{{ $errors->has('zona') ? ' has-danger' : '' }}">
                                    <select class="form-control{{ $errors->has('zona') ? ' is-invalid' : '' }}" name="zona_id" id="zona-edit" required="true" aria-required="true">
                                        <option value="">Selecciona una zona</option>
                                        @foreach($zonas as $zona)
                                            <option value="{{$zona->id}}">{{$zona->nombre}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('zona'))
                                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('zona') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group{{ $errors->has('codpostal') ? ' has-danger' : '' }}">
                                    <input class="form-control{{ $errors->has('codpostal') ? ' is-invalid' : '' }}" name="codpostal" id="codpostal-edit" type="text" placeholder="{{ __('Cód Postal') }}" required="true" aria-required="true"/>
                                    @if ($errors->has('codpostal'))
                                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->codpostal('codpostal') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer ml-auto mr-auto">
                        <button type="submit" class="btn btn-primary">{{ __('Actualizar') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#clientes').DataTable({

                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                },


            });
        });

        $(document).on('click', '.btn-danger', function () {
            let id = $(this).data("id");
            $.ajax({
                type: 'DELETE',
                url: 'delete-cliente/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': id
                },
                success: function (data) {
                    $('.post' + id).fadeOut('slow');
                    swal({
                        title: "Cliente eliminado!",
                        icon: "success",
                    });
                    console.log("it Works, delete cliente " + id);
                }, error: function (error) {
                    console.log(error)
                }
            });

        });

        $(document).on('click', '.btn-edit', function () {
            let id = $(this).data("id");
            let nombre = $(this).data("nombre");
            let email = $(this).data("email");
            let zona = $(this).data("zona");
            let codpostal = $(this).data("codpostal");


            $('#id-cliente').val(id);
            $('#input-nombre-cliente-edit').val(nombre);
            $('#email-edit').val(email);
            $('#zona-edit').val(zona);
            $('#codpostal-edit').val(codpostal);

        });

        //no cierra la ventana modal mientras haya errores
        @if (session('errors'))
        $('#modalClientes').modal({show: true});
        @endif
    </script>
@endsection
