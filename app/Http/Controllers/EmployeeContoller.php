<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Employee;
use Carbon\Carbon;
use Validator;
use Excel;
use DB;

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
        return redirect(route('emp.index'));
    }
    
    public function show($id)
    {
        // return view('employees.show', compact('data' => $showData));
    }
    
    public function edit($id)
    {
        $empData = \App\Models\Employee::where('id', $id)->with('data')->first();
        // print "<pre>";print_r($empData->toArray());die;
        return view('employees.edit', compact('empData'));
    }

    public function getData(Request $req)
    {
        $empData = \App\Models\EmployeeData::where(['id' => $req->id])->first();
        
        return view('employees.edit_model', compact('empData'));
    }

    public function update(Request $req, $id)
    {
        $postData = $req->except('_token');
        $empData = \App\Models\EmployeeData::where('id', $id)->update($postData);
        return redirect()->back();
    }
    
    public function destroy($id)
    {
        Employee::find($id)->delete();
        return redirect(route('emp.index'));
    }

    public function import(Request $req) 
    {
        $date = Carbon::createFromFormat('d/m/Y', $req->month);
        $file = request()->file('xl_file');
        $destinationPath = 'uploads';
        $filename = rand().$file->getClientOriginalName();
        $file->move($destinationPath, $filename);
        $count = 0;
        $data = Excel::selectSheets('salary')->load($destinationPath.'/'.$filename, function ($reader) {
            // reader methods
            $reader->calculate();
            $reader->ignoreEmpty();
            // $reader->setSeparator('-');
        }, 'UTF-8')->get();
        foreach ($data as $row) {
            $row = collect($row);
            $validator = Validator::make($row->all(), [
                'sr_no' => 'required|integer',
                // 'teacheremployees_name_designation' => 'required|unique:employees,employee_name|max:255',
                'teacheremployees_name_designation' => 'required|max:255',
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
            $emp_data = [
                'month' => $date->format('m'),
                'year' => $date->format('Y'),
                'data' => $row->except([
                    's_no', 
                    'teacheremployees_name_designation'
                ])->toArray(),
            ];
            
            if (!empty($employee['employee_name'])) {
                ++$count;
                $emp = Employee::where('employee_name', $employee['employee_name'])
                    ->first();
                if (empty($emp)) {
                    $emp = Employee::create($employee);
                } else {
                    $emp->update($employee);
                }
                
                
                $empdata = $emp->data()->where('month', $date->format('m'))
                    ->where('year', $date->format('Y'))
                    ->first();
                if (empty($empdata)) {
                    $emp->data()->create($emp_data);
                } else {
                    $empdata->update($emp_data);
                }
            }
        }
        
        unlink($destinationPath.'/'.$filename);
        return redirect()->route('emp.index')->with('success', $count.' Records Added/Updated');
    }

    public function report() 
    {
        $tax_report = \App\Models\EmployeeData::with('employee')->get();
        $employees = [
            'gpf' => [],
            'nps' => []
        ];
        foreach ($tax_report as $report) {
            $flag = 'gpf';
            if (isset($report->data['nps'])) {
                $flag = 'nps';
            } 
            
            $data[$report->month.'/'.$report->year][$flag][] = $report->data;
            $employees[$flag][$report->employee->id] = $report->employee->toArray();
            $employees[$flag][$report->employee->id]['data'][] = collect($report->data)->merge(
                [
                    'year' => $report->year,
                    'month' => $report->month,
                ]
            );
        }
        
        $tax_report = [
            'gpf' => [],
            'nps' => []
        ];
        foreach ($data as $key => $taxes) {
            list($month, $year) = explode('/', $key);
            foreach ($taxes as $key => $value) {
                $value = collect($value);
                $tax_report[$key][] = array(
                    'month' => $month,
                    'year' => $year,
                    'hra' => $value->sum('hra'),
                    'total_salary' => $value->sum('total_salary'),
                    'lic' => $value->sum('lic'),
                    'it' => $value->sum('it'),
                    'gr_ins' => $value->sum('gr_ins'),
                    'gpf' => $value->sum('gpf'),
                    'gpf_loan' => $value->sum('gpf_loan'),
                    'nps' => $value->sum('nps'),
                    'nps_govt_share' => $value->sum('nps_govt_share'),
                );
            }
        }
        // dd($employees);
        
        return view('employees.report', compact(
            'tax_report', 
            'employees'
        ));
    }
}
