<div class="form-group{{ $errors->has('codigo') ? ' has-error' : '' }}">
    {!! Form::label('codigo', 'Código:', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::text('codigo', null, ['class' => 'form-control', 'required' => 'required']) !!}
        <small class="text-danger">{{ $errors->first('codigo') }}</small>
    </div>
</div>

<div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
    {!! Form::label('nombre', 'Nombre:', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::text('nombre', null, ['class' => 'form-control', 'required' => 'required']) !!}
        <small class="text-danger">{{ $errors->first('nombre') }}</small>
    </div>
</div>

<div class="form-group{{ $errors->has('salarioDolares') ? ' has-error' : '' }}">
    {!! Form::label('salarioDolares', 'Salario en Dolares:', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::text('salarioDolares', null, ['class' => 'form-control', 'onfocusout' => 'calculateAmount()','required' => 'required']) !!}
        <small class="text-danger">{{ $errors->first('salarioDolares') }}</small>
    </div>
</div>

<div class="form-group{{ $errors->has('salarioPesos') ? ' has-error' : '' }}">
    {!! Form::label('salarioPesos', 'Salario en Pesos:', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::text('salarioPesos', null, ['class' => 'form-control', 'required' => 'required']) !!}
        <small class="text-danger">{{ $errors->first('salarioPesos') }}</small>
    </div>
</div>

<div class="form-group{{ $errors->has('direccion') ? ' has-error' : '' }}">
    {!! Form::label('direccion', 'Dirección:', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::text('direccion', null, ['class' => 'form-control', 'required' => 'required']) !!}
        <small class="text-danger">{{ $errors->first('direccion') }}</small>
    </div>
</div>

<div class="form-group{{ $errors->has('estado') ? ' has-error' : '' }}">
    {!! Form::label('estado', 'Estado:', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::text('estado', null, ['class' => 'form-control', 'required' => 'required']) !!}
        <small class="text-danger">{{ $errors->first('estado') }}</small>
    </div>
</div>

<div class="form-group{{ $errors->has('ciudad') ? ' has-error' : '' }}">
    {!! Form::label('ciudad', 'Ciudad:', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::text('ciudad', null, ['class' => 'form-control', 'required' => 'required']) !!}
        <small class="text-danger">{{ $errors->first('ciudad') }}</small>
    </div>
</div>

<div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
    {!! Form::label('telefono', 'Telefono:', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::text('telefono', null, ['class' => 'form-control', 'required' => 'required']) !!}
        <small class="text-danger">{{ $errors->first('telefono') }}</small>
    </div>
</div>

<div class="form-group{{ $errors->has('correo') ? ' has-error' : '' }}">
    {!! Form::label('correo', 'Correo', ['class' =>'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::email('correo', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'eg: foo@bar.com']) !!}
        <small class="text-danger">{{ $errors->first('correo') }}</small>
    </div>
</div>

<div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
    {!! Form::label('status', 'Estatus:', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::select('status', $options, $selected_status, ['class' => 'form-control', 'required' => 'required']) !!}
        <small class="text-danger">{{ $errors->first('status') }}</small>
    </div>
</div>

@push('js')
    <script>

        function calculateAmount()
        {

            $.ajax({
                url: "https://www.banxico.org.mx/SieAPIRest/service/v1/series/SF43718/datos",
                data: {
                    token: "0fce7d85c76c9afa6f8ef05f95d50a11c62573c637d28706e28f2a81e84264e5",
                },
                jsonp : 'callback',
		        dataType : 'jsonp'
            }).done(function(response) {
                var series=response.bmx.series;

                var datos = "";
                var serie = response.bmx.series[0];
                datos = serie.datos;
                dato_actual = datos[datos.length - 1];
                let paridad = dato_actual.dato;

                let salario_dolares = $("#salarioDolares").val();


                let cantidad_pesos = (Number(salario_dolares) * Number(paridad));

                $("#salarioPesos").val(cantidad_pesos);
            });
        }
    </script>
@endpush
