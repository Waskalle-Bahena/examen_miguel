@extends('layouts.app')

@push('css')
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-4">
                            <h3>Empleados</h3>
                        </div>

                        <div class="col-sm-8">
                            <div style="float:right;">
                                  <a href="{{route('employees.create')}}" class="btn btn-primary">Alta de empleado</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body" style="overflow: auto;">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table" id="table-employees">
                        <thead class="thead-dark">
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Salario Dolares</th>
                                <th>Salario Pesos</th>
                                <th>Correo</th>
                                <th>Estatus</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('employees.partials.modal_show')
@push('js')
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" defer></script>

    <script>
        var dtTable = "";
        $(document).ready( function () {
            dtTable = $('#table-employees').DataTable({
                    ajax: '{{route('employees.index')}}',
                    processing: true,
                    columns: [
                        {data: 'codigo', name: 'codigo'},
                        {data: 'nombre', name: 'nombre'},
                        {data: 'salarioDolares', name: 'salarioDolares'},
                        {data: 'salarioPesos', name: 'salarioPesos'},
                        {data: 'correo', name: 'correo'},
                        {data: 'status', name: 'status'},
                        {data: 'options', name: 'options',orderable: false, searchable: false},
                    ]
            });


        } );
    </script>

    <script>
        function showInfo(id)
        {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "employees/"+ id,
                method: 'get',
            }).done(function(response) {
                $("#employee-modal").modal("show");
                $("#modal-body").html("");

                $("#modal-body").append("<p><b>Codigo: </b>" + response.employee.codigo + "</p><br>");
                $("#modal-body").append("<p><b>Nombre: </b>" + response.employee.nombre + "</p><br>");
                $("#modal-body").append("<p><b>Salario Dolares: </b>" + response.employee.salarioDolares + "</p><br>");
                $("#modal-body").append("<p><b>Salario Pesos: </b>" + response.employee.salarioPesos + "</p><br>");
                $("#modal-body").append("<p><b>Salario Direccion: </b>" + response.employee.direccion + "</p><br>");
                $("#modal-body").append("<p><b>Salario Telefono: </b>" + response.employee.telefono + "</p><br>");
                $("#modal-body").append("<p><b>Salario Correo: </b>" + response.employee.correo + "</p><br>");

                $("#modal-body").append("<hr>");
                $("#modal-body").append("<h4>Proyección De salario a 6 meses</h4>");

                let proyection = response.proyection;

                $("#modal-body").append("<p><b>Primer Mes: </b>" + proyection[0] + "</p><br>");
                $("#modal-body").append("<p><b>Segundo Mes: </b>" + proyection[1] + "</p><br>");
                $("#modal-body").append("<p><b>Tercer Mes: </b>" + proyection[2] + "</p><br>");
                $("#modal-body").append("<p><b>Cuarto Mes: </b>" + proyection[3] + "</p><br>");
                $("#modal-body").append("<p><b>Quinto Mes: </b>" + proyection[4] + "</p><br>");
                $("#modal-body").append("<p><b>Sexto Mes: </b>" + proyection[5] + "</p><br>");



            });

            //modal-body
        }
    </script>
    @include('sweet::alert')
@endpush
@endsection
