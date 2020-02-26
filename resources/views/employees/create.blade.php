@extends('layouts.app')

@push('css')

@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-4">
                            <h3>Alta de empleado</h3>
                        </div>

                        <div class="col-sm-8">
                            <div style="float:right;">
                                  <a href="{{route('employees.index')}}" class="btn btn-primary">Back</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>

                <div class="box-body">
                    {!! Form::open(['method' => 'POST', 'route' => 'employees.store', 'class' => 'form-horizontal']) !!}

                        @include('employees.partials.inputs')

                        <div class="btn-group pull-right" style="text-align:center;">
                            {!! Form::reset("Reset", ['class' => 'btn btn-warning']) !!}
                            {!! Form::submit("Agregar", ['class' => 'btn btn-success']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')

@endpush
@endsection
