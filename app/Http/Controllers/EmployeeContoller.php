<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Excel;

class EmployeeContoller extends Controller
{
    public function index()
    {
        return view('employees.index', []);
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
    
    public function update(Request $req, $id)
    {
        return redirect(route('employee.index'));
    }
    
    public function destroy($id)
    {
        return redirect(route('employee.index'));
    }

    public function import(Request $req) {
        $imports = Excel::import(new \App\Imports\ImportEmployee, request()->file('xl_file'));
        dd($import->failures());
        dd($import->errors());
        // foreach ($imports->failures() as $failure) {
        //     $failure->row(); // row that went wrong
        //     $failure->attribute(); // either heading key (if using heading row concern) or column index
        //     $failure->errors(); // Actual error messages from Laravel validator
        //     $failure->values(); // The values of the row that has failed.
        // }
    }

}
