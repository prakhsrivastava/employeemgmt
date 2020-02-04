<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Excel;
use Carbon\Carbon;

class EmployeeContoller extends Controller
{
    public function index(Request $req)
    {
        $employees = \App\Models\Employee::paginate(10);
        
        return view('employees.index', compact('employees'));
    }
    
    public function create()
    {
        return view('employees.create');
    }
    
    public function store(Request $req)
    {

        return redirect(route('employee.index'));
    }
    
    public function show($id)
    {
        // return view('employees.show', compact('data' => $showData));
    }
    
    public function edit($id)
    {
        $empData = \App\Models\Employee::where('id', $id)->first();
        // prd($empData->toArray());
        return view('employees.edit', compact('empData'));
    }

    public function update(Request $req, $id)
    {
        return redirect(route('employee.index'));
    }
    
    public function destroy($id)
    {
        return redirect(route('employee.index'));
    }

    public function import(Request $req) 
    {
        $date = Carbon::createFromFormat('m/Y', $req->month);
        $import = new \App\Imports\ImportEmployee($date->format('m'), $date->format('Y'));
        $import->onlySheets('salary');

        $count = 0;
        try {
            $imports = Excel::import($import, request()->file('xl_file'));
            $count = $import->getSalaryRowCount();
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            // pr($e->errors());
            // pr($e->failures());
            foreach ($e->failures() as $failure) {
                $failure->row(); // row that went wrong
                $failure->attribute(); // either heading key (if using heading row concern) or column index
                $failure->errors(); // Actual error messages from Laravel validator
                $failure->values(); // The values of the row that has failed.
            }
        }
        return redirect()->route('emp.index')->with('success', $count.' Records Added');
    }

}
