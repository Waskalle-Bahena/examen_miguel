<?php

namespace App\Http\Controllers;

use DataTables;
use App\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            return $this->toDatatable();
        }

        return view('employees.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        if(Employee::create($request->all())) {
            alert()->basic('Empleado creado correctamente', 'Alta de empleado');
        } else {
            alert()->error('Ah ocurrido un error al intentar crear el empleado, favor de verificar los campos');
        }

        return redirect()->route('employees.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        $data = [
            'employee' => $employee,
            'proyection' => $employee->proyection
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('employees.edit', ['employee' => $employee]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        if($employee->update($request->all())) {
            alert()->basic('Empleado actualizado correctamente', 'Edición de empleado');
        } else {
            alert()->error('Ah ocurrido un error al intentar actualizar el empleado, favor de verificar los campos');
        }

        return redirect()->route('employees.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        if($employee->status) {
            $employee->status = 0;
        } else {
            $employee->status = 1;
        }

        $employee->update();

        return response()->json("Correcto");
    }

    protected function toDatatable()
    {
        $employees = Employee::all();

        return DataTables::of($employees)
            ->editColumn('salarioDolares',function($employee) {
                $amount_formatted = number_format($employee->salarioDolares,2,'.',',');
                return $amount_formatted;
            })
            ->editColumn('status', function($employee) {
                if($employee->status)
                    return "Activo";
                else
                    return "Inactivo";
            })
            ->editColumn('salarioPesos',function($employee) {
                $amount_formatted = number_format($employee->salarioPesos,2,'.',',');

                return $amount_formatted;
            })
            ->editColumn('options',function($employee) {
                return view('employees.partials.options',['employee' => $employee]);
            })
            ->rawColumns(['options'])
            ->make(true);
    }
}
