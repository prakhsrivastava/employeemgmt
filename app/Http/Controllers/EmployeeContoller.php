<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Employee;
use Carbon\Carbon;
use Validator;
use Excel;

class EmployeeContoller extends Controller
{
    public function index(Request $req)
    {
        $employees = \App\Models\Employee::get();
        
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
        $file = request()->file('xl_file');
        $destinationPath = 'uploads';
        $filename = rand().$file->getClientOriginalName();
        $file->move($destinationPath, $filename);
        $count = 0;
        $data = Excel::selectSheets('salary')->load($destinationPath.'/'.$filename, function ($reader) {
            // reader methods
            $reader->calculate();
        })->get();
        foreach ($data as $row) {
            $row = collect($row);
            $validator = Validator::make($row->all(), [
                'sr_no' => 'required|integer',
                'teacheremployees_name_designation' => 'required|unique:employees,employee_name|max:255',
            ]);
            
            if ($validator->fails()) {
                continue;
            }

            $employee = $row->only([
                'teacheremployees_name_designation',
                'pay_band_level'            
            ])->toArray();

            $employee['employee_name'] = $row['teacheremployees_name_designation'];
            unset($employee['teacheremployees_name_designation']);
            $emp_data = $row->only([
                'dob',
                'date_of_apptt',
                'date_of_incr',
                'pay',
                'grade_pay',
                'total',
                'da_17',
                'ha',
                'hra',
                'cca',
                'total_salary',
                'basic_da',
                'it',
                'nps',
                'co_operative_loan',
                'lic',
                'gr_ins',
                'total_dedu',
                'total_payment',
                'nps_govt_share',
            ])->toArray();
            $emp_data['month'] = $date->format('m');
            $emp_data['year'] = $date->format('Y');
            
            if (!empty($employee['employee_name'])) {
                ++$count;
                $emp = Employee::where('employee_name', $employee['employee_name'])->first();
                if (empty($emp)) {
                    $emp = Employee::create($employee);
                } else {
                    $emp->update($employee);
                }

                $emp_data = $emp->data()->where('month', $date->format('m'))
                    ->where('year', $date->format('Y'))
                    ->first();
                if (empty($emp_data)) {
                    $emp->data()->create($emp_data);
                } else {
                    $emp_data->update($emp_data);
                }
            }
        }

        return redirect()->route('emp.index')->with('success', $count.' Records Added');
    }
}
