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

        $options = [
            0 => "Inactivo",
            1 => "Activo"
        ];

        $selected_status = 1;

        return view('employees.create',["options" => $options,
                                        "selected_status" => $selected_status]);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
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
            ->editColumn('status', function($employee) {
                if($employee->status)
                    return "Activo";
                else
                    return "Inactivo";
            })
            ->editColumn('options',function($employee) {
                return view('employees.partials.options',['employee' => $employee]);
            })
            ->rawColumns(['options'])
            ->make(true);
    }
}
