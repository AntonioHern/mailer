@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Inicio')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            @if (session('status'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                    <span>{{ session('status') }}</span>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header card-header-tabs card-header-primary">
                            <div class="nav-tabs-navigation">
                                <div class="nav-tabs-wrapper">
                                    <span class="nav-tabs-title">Archivos</span>
                                    <ul class="nav nav-tabs" data-tabs="tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#profile" data-toggle="tab">
                                                <i class="material-icons">description</i> Archivos
                                                <div class="ripple-container"></div>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#profile" data-toggle="tab">
                                                <i class="material-icons upload">file_upload</i>
                                                <div class="ripple-container"></div>
                                            </a>
                                        </li>
                                        {{--                    <li class="nav-item">--}}
                                        {{--                      <a class="nav-link" href="#messages" data-toggle="tab">--}}
                                        {{--                        <i class="material-icons">code</i> Website--}}
                                        {{--                        <div class="ripple-container"></div>--}}
                                        {{--                      </a>--}}
                                        {{--                    </li>--}}
                                        {{--                    <li class="nav-item">--}}
                                        {{--                      <a class="nav-link" href="#settings" data-toggle="tab">--}}
                                        {{--                        <i class="material-icons">cloud</i> Server--}}
                                        {{--                        <div class="ripple-container"></div>--}}
                                        {{--                      </a>--}}
                                        {{--                    </li>--}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body documentos">
                            <div class="table-full-width">
                                <table class="table table-hover" id="documentos">
                                    <thead class="text-primary">
                                    <th>
                                        Nombre
                                    </th>
                                    <th>
                                        Acciones
                                    </th>
                                    </thead>
                                    @foreach($documentos as $documento)
                                        <tbody id="tr"{{$documento->id}}>
                                        <tr id="documento{{$documento->id}}">
                                            <td class="col">
                                                <a class="title" style="color: #5f5a5a" target="_blank"
                                                   href="{{route('documentos.show',$documento)}}">{{$documento->nombre}}</a>
                                                @if($documento->descripcion!=='null')
                                                    <textarea rows="2" id="{{$documento->id}}"
                                                              class="text-muted form-control-plaintext  description-file"
                                                              data-id="{{$documento->id}}"
                                                              placeholder="Describe el fichero">{{$documento->descripcion}}</textarea>
                                                @else
                                                    <textarea rows="2" id="{{$documento->id}}"
                                                              class="text-muted form-control-plaintext description-file"
                                                              data-id="{{$documento->id}}"
                                                              placeholder="Describe el fichero"></textarea>
                                                @endif
                                            </td>


                                            <td class="col">
                                          <span><i class="material-icons trash"
                                                   id="tras{{$documento->id}}"
                                                   data-id="{{$documento->id}}"
                                                   data-nombre="{{$documento->nombre}}">delete_forever</i></span>
                                            </td>
                                        </tr>

                                        </tbody>
                                    @endforeach

                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Fin panel izquierdo   -->

                <!-- Panels derecho   -->
                <div class="col-lg-6 col-md-12">
                    <div class="card">

                        <div class="card-header card-header-tabs card-header-warning">
                            <div class="nav-tabs-navigation">
                                <div class="nav-tabs-wrapper">
                                    <span class="nav-tabs-title">Campañas enviadas</span>
                                    <ul class="nav nav-tabs" data-tabs="tabs">
                                        <li class="nav-item">
                                            <a  class="nav-link active enviar-email" href="#"
                                                data-target="emailModal">
                                                <i class="material-icons">send</i> Enviar campaña
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>


                        <div class="card-body table-responsive documentos">
                            <table class="table table-hover" id="emails">
                                <thead class="text-warning">
                                <th>Zona</th>
                                <th>Archivo</th>
                                <th>Fecha</th>
                                </thead>
                                <tbody>
                                @foreach($envios ?? '' as $envio)
                                    <tr>
                                        <td>{{$envio->zona->nombre}}</td>
                                        <td>{{$envio->nombre_archivo}}</td>
                                        <td>{{$envio->created_at}}</td>
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

    <div class="row justify-content-center">
        <div class="col-8">
            <form action="{{route('documentos.store')}}" method="POST" enctype="multipart/form-data"
                  class="dropzone"
                  id="my-awesome-dropzone">
                <input type="hidden" name="nombre-archivo" value=""/>
                <button id="guardarFiles" class="btn btn-sm btn-primary float-right" data-target="">
                    <i class="material-icons">save_as</i>
                </button>
                {{ csrf_field() }}
                @csrf
            </form>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nueva campaña</h5>
                </div>
                <div class="modal-body">
                    <form action="{{url('correo')}}" method="post">
                        @csrf
                        <div class="card-body shadow">

                            <div class="form-group">
                                <input type="text" name="remitente" id="remitente" value="info@pacojavier.es"
                                       class="form-control{{ $errors->has('remitente') ? ' is-invalid' : '' }}"
                                       readonly>

                            </div>

                            <div class="form-group">
                                <select class="form-control{{ $errors->has('zonas') ? ' is-invalid' : '' }}" name="zona_id" id="zona" required="true" aria-required="true">
                                    <option value="">Selecciona una zona</option>
                                    @foreach($zonas ?? '' as $zona)
                                        <option value="{{$zona->id}}">{{$zona->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control{{ $errors->has('zonas') ? ' is-invalid' : '' }}" name="nombrearchivo" id="nombrearchivo" required="true" aria-required="true">
                                    <option value="">Selecciona un documento</option>
                                    @foreach($documentos ?? '' as $documento)
                                        <option value="{{$documento->nombre}}">{{$documento->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <select name="tipo_email[]" class="form-control text-dark" id="tipo_email" required>
                                    <option value="" placeholder="Tipo de email">Selecciona plantilla</option>
                                    <option value="emails.general">General</option>
                                    <option value="emails.vacio">Vacío</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" name="asunto" id="asunto"
                                       class="form-control{{ $errors->has('asunto') ? ' is-invalid' : '' }}"
                                       placeholder="Asunto" required>


                            </div>
                            <div class="form-group">
                                <textarea cols="10" rows="2" name="cuerpo" id="cuerpo"
                                          class="form-control{{ $errors->has('cuerpo') ? ' is-invalid' : '' }}"
                                          placeholder="Escriba aquí su mensaje" required></textarea>


                            </div>
                        </div>
                        @if(auth()->user())
                            <input type="hidden" name="enviador_id" id="enviador_id" value="{{auth()->user()->id}}">
                        @endif
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary btn-sm" id="enviar">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('js')
    <script>
        Dropzone.options.myAwesomeDropzone = {
            dictDefaultMessage: "Arrastre documentos",
            paramName: "file",
            acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg,.pdf,.docx,.doc",
            addRemoveLinks: true,
            autoProcessQueue: true,
            maxFilesize: null,
            parallelUploads: 20,
            maxFiles: 5,

            init: function () {

                var myDropzone = this;
                $('#guardarFiles').click(function (e) {
                    e.preventDefault();
                    myDropzone.processQueue();

                    location.reload();
                    $('#entradas_table').DataTable().ajax.reload();
                });
            },
            success: function (file, response) {
                console.log(response);
            },
        };

        //ELIMINAR DOCUMENTOS
        $(document).on('click', '.trash', function (e) {
            let id = $(this).data('id');
            let nombre = $(this).data('nombre');
            let numero_documentos = parseInt($('.badge').text());
            let documento = $(this).data('documento');

            swal({
                title: "¿Estás seguro?",
                text: "Una vez eliminado el documento no se podrá recuperar !",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: 'DELETE',
                            url: 'delete-documento' + '/' + id,
                            data: {
                                '_token': $('input[name=_token]').val(),
                                'id': id,
                            },
                            success: function (data) {
                                location.reload();
                                $('.badge').text(numero_documentos - 1);
                            }
                        });
                        swal("El documento ha sido eliminado!", {
                            icon: "success",
                        });

                    } //else {
                      //     swal("Your imaginary file is safe!");
                      // }
                });
        });

        $('.upload').click(function () {
            $('#my-awesome-dropzone').click();
        });

        //editar descripcion
        $('.description-file').click(function (e) {
            $(this).attr('contenteditable', true).addClass('bg-accordion');
            $(this).keypress(function (e) {
                e.stopImmediatePropagation();
                if (e.which === 13) {
                    e.preventDefault();
                    $(this).attr('contenteditable', false).removeClass('bg-accordion');
                    let datos = $(this).val().trim();
                    if (!datos) {
                        datos = 'null';
                    }
                    let id = $(this).data('id');
                    $.ajax({
                        type: 'POST',
                        url: 'update-documento' + '/' + id,
                        data: {
                            '_token': $('input[name=_token]').val(),
                            'id': id,
                            'descripcion': datos,
                            // 'estado_cocumento':null,
                        },
                        success: function (data) {
                            $(this).val(data.descripcion);
                            console.log(data);
                        }
                    });
                }
            });
        });

        $(document).on('click', '.enviar-email', function (e) {
            console.log('hola');
            $('#emailModal').modal('show');

        });
        $(document).ready(function () {
            $('#emails').DataTable({
                lengthMenu: [ [5, 10,20, -1], [5, 10, 20, "All"] ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                }
            });
            $('#documentos').DataTable({
                lengthMenu: [ [5, 10,20, -1], [5, 10, 20, "All"] ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                }
            });
        });

    </script>
@endpush
