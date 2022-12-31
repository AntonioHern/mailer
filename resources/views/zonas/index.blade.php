@extends('layouts.app', ['activePage' => 'zonas', 'titlePage' => __('Zonas')])
@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Zonas</h4>
                            <p class="card-category"> Aquí se muestran todas las zonas</p>
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
                                    <button type="button" class="btn btn-primary btn-just-icon mb-4" data-toggle="modal" data-target="#modalZonas">
                                        <i class="material-icons">add_location</i>
                                    </button>
                                </div>
                            </div>
                            <div class="table-hover">
                                <table class="table" id="zonas">
                                    <thead class=" text-primary">
                                    <tr>
                                        <th>
                                            Nombre
                                        </th>
                                        <th>
                                            Usuario Creación
                                        </th>
                                        <th>
                                            Creación
                                        </th>
                                        <th>
                                            Modificación
                                        </th>
                                        <th class="text-right">
                                            Acciones
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @csrf
                                    @foreach($zonas as $zona)
                                        <tr class="post{{$zona->id}}">
                                            <td>
                                                {{$zona->nombre}}
                                            </td>
                                            <td>
                                                {{$zona->user->name}}
                                            </td>
                                            <td>
                                                {{$zona->created_at->format('d-m-Y')}}
                                            </td>
                                            <td>
                                                {{$zona->updated_at}}
                                            </td>
                                            <td class="td-actions text-right">
                                                <a rel="tooltip" class="btn btn-success btn-edit btn-link"
                                                   href="#" data-toggle="modal" data-target="#modalZonasEdit"
                                                   data-original-title="" title="Editar" role="button"
                                                   data-id="{{$zona->id}}"
                                                   data-nombre="{{$zona->nombre}}"
                                                   data-toggle="tooltip" data-placement="bottom">
                                                    <i class="material-icons">edit</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                                <a rel="tooltip" class="btn btn-danger btn-link"
                                                   href="#"
                                                   data-original-title="" title="Eliminar" role="button"
                                                   data-id="{{$zona->id}}"
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
    <div class="modal fade mb-5" id="modalZonas" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog mb-5" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Añadir zona</h5>
                </div>
                <form class="form" method="post" action="{{ route('zonas.store') }}"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="card-body ">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group{{ $errors->has('nombre') ? ' has-danger' : '' }}">
                                    <input class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" id="input-nombre-zona" type="text" placeholder="{{ __('Nombre') }}" required="true" aria-required="true"/>
                                    @if ($errors->has('nombre'))
                                        <span id="nombre-error" class="error text-danger" for="input-nombre">{{ $errors->first('nombre') }}</span>
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
    <div class="modal fade mb-5" id="modalZonasEdit" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog mb-5" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modificar zona</h5>
                </div>
                <form class="form" method="post" action="{{ route('zonas.update') }}"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="card-body ">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group{{ $errors->has('nombre') ? ' has-danger' : '' }}">
                                    <input class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" id="nombre-zona"/>
                                    <input type="hidden" name="id" id="id-zona" value="">

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer ml-auto mr-auto">
                        <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>



        $(document).ready(function () {
            $('#zonas').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                }
            });
            //no cierra la ventana modal mientras haya errores
            @if (session('errors'))
            $('#modalZonas').modal({show: true});
            @endif
        });


        $(document).on('click', '.btn-danger', function () {
            let id = $(this).data("id");
            $.ajax({
                type: 'DELETE',
                url: 'delete-zona/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': id
                },
                success: function (data) {
                    $('.post' + id).fadeOut('slow');
                    swal({
                        title: "Zona eliminada!",
                        icon: "success",
                    });
                    console.log("it Works, delete zona " + id);
                }, error: function (error) {
                    swal({
                        title: "No se puede eliminar la zona,tiene clientes asociados elimine antes los clientes!",
                        icon: "error",
                    });
                }

            });
        });

        $(document).on('click', '.btn-edit', function () {
            let id = $(this).data("id");
            let nombre = $(this).data("nombre");
            $('#id-zona').val(id);
            $('#nombre-zona').val(nombre);

        });


    </script>


@endsection
