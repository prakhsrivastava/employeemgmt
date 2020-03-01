<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Dompdf\Dompdf;
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
    
    public function store($id, Request $req)
    {
        $data = $req->all();
        $emp = \App\Models\Employee::where('id', $id)
            ->first();
        $emp->update($data);

        return redirect(route('emp.edit', [$id]));
    }

    public function edit($id)
    {
        $empData = \App\Models\Employee::where('id', $id)
            ->with('data')
            ->with('arriear')
            ->first();
        
        if (empty($empData)) {
            return redirect(route('emp.index'));
        }
        $headers = \App\Models\ExcelHeader::orderBy('show_order')
            ->get()
            ->except([1, 2])
            ->pluck('header', 'slug');

        return view('employees.edit', compact(
            'empData', 
            'headers'
        ));
    }

    public function getData(Request $req)
    {
        $empData = \App\Models\EmployeeData::where(['id' => $req->id])
            ->first();
        
        return view('employees.edit_model', compact('empData'));
    }

    public function update(Request $req, $id)
    {
        $postData = $req->except('_token');
        $empData = \App\Models\EmployeeData::where('id', $id)
            ->update($postData);
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
        $headers = Excel::selectSheets('salary')
            ->load($destinationPath.'/'.$filename, function ($reader) {
            // reader methods
            $reader->noHeading();
        }, 'UTF-8')->first();        
        foreach ($headers as $key => $header) {
            $header = preg_replace('/\s+/is', ' ', $header);
            $sluggedHead = $this->createSlug($header, '_');

            $exclHeader = \App\Models\ExcelHeader::where('header', $header)
                    ->first();
            if (empty($exclHeader) && !empty($header)) {
                $show_order = $key + 1;
                $exclHeader = \App\Models\ExcelHeader::where('show_order', $show_order)
                    ->first();
                if (!empty($exclHeader)) {
                    $exclHeader = \App\Models\ExcelHeader::select(
                        DB::raw('max(show_order) as show_order')
                    )
                    ->first();
                    $show_order = $exclHeader['show_order'] + 1;
                }

                $excl = \App\Models\ExcelHeader::create([
                    'header' => $header,
                    'show_order' => $show_order,
                    'slug' => $sluggedHead,
                ]);
            } else if (!empty($exclHeader)) {
                $exclHeader->update([
                    'header' => $header,
                    'slug' => $sluggedHead,
                ]);
            }
        }
        
        $data = Excel::selectSheets('salary')->load($destinationPath.'/'.$filename, function ($reader) {
            // reader methods
            $reader->calculate();
            $reader->ignoreEmpty();
            // $reader->setSeparator('-');
        }, 'UTF-8')->get();
        unlink($destinationPath . '/' . $filename);

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
                $emp = \App\Models\Employee::where('employee_name', $employee['employee_name'])
                    ->first();
                if (empty($emp)) {
                    $emp = \App\Models\Employee::create($employee);
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
        
        return redirect()->route('emp.index')->with('success', $count.' Records Added/Updated');
    }

    public function report(Request $req) 
    {
        $session_start = date('Y');
        $session_end = date('Y') + 1;
        if ($req->has('session_start') && $req->has('session_end')) {
            $session_start = $req->session_start;
            $session_end = $req->session_end;
        }
        $data = array();

        $tax_report = \App\Models\EmployeeData::where('year', '>=', $session_start)
            ->where('year', '<=', $session_end)
            ->with('employee')
            ->with('employee.arriear')
            ->get();
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
            'gpf' => [
                'arriear' => \App\Models\EmployeeArriear::where('session_start', '>=', $session_start)
                    ->where('session_end', '<=', $session_end)
                    ->whereIn('employee_id', array_keys($employees['gpf']))
                    ->get()
            ],
            'nps' => [
                'arriear' => \App\Models\EmployeeArriear::where('session_start', '>=', $session_start)
                    ->where('session_end', '<=', $session_end)
                    ->whereIn('employee_id', array_keys($employees['nps']))
                    ->get()
            ],            
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
        // dd($tax_report);
        
        return view('employees.report', compact(
            'tax_report', 
            'session_start', 
            'session_end', 
            'employees'
        ));
    }

    private function createSlug($header, $separator) {
        $sluggedHead = preg_replace('![' . preg_quote($separator) . ']+!u', $separator, $header);

        // Remove all characters that are not the separator, letters, numbers, or whitespace.
        $sluggedHead = preg_replace('![^' . preg_quote($separator) . '\pL\pN\s]+!u', '', mb_strtolower($sluggedHead));

        // Replace all separator characters and whitespace by a single separator
        $sluggedHead = preg_replace('![' . preg_quote($separator) . '\s]+!u', $separator, $sluggedHead);

        return trim($sluggedHead, $separator);
    }

    public function addArriear($employee_id, Request $req) {
        $data = $req->except('_token');
        $data['employee_id'] = $employee_id;

        while ($data['session_end'] > $data['session_start']) {
            $arriear = \App\Models\EmployeeArriear::updateOrCreate([
                'employee_id' => $employee_id,
                'session_start' => $data['session_start'],
                'session_end' => $data['session_end']
            ], $data);

            $data['session_start']++;
        }

        return redirect(route('emp.edit', [$employee_id]));
    }

    public function print($id, Request $req) {
        $dompdf = new Dompdf();
        $dompdf->set_option('defaultFont', 'Courier');
        $dompdf->set_option('isHtml5ParserEnabled', true);
        $html = '<html>
        <style>
            .table {
                table-layout: fixed;
            }
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
                padding: 5px;
                width: 100%;
            }
        </style>
        <body>';
        if ((int)$id) {
            $empData = \App\Models\Employee::where('id', $id)
                ->with('data')
                ->with('arriear')
                ->first();

            $type = 'gpf';
            $employee = collect($empData)->only('employee_name');
            $employee['data'] = collect($empData['data'])->pluck('data')
                ->map(function ($array, $key) use($empData) {
                    return collect($array)->merge([
                        'year' => collect($empData['data'])->pluck('year')[$key],
                        'month' => collect($empData['data'])->pluck('month')[$key],
                    ])->toArray();
                });
            if ($employee['data']->sum('nps') > 0) {
                $type = 'nps';
            }
            $employee['arriear'] = collect($empData['arriear'])
                ->reject(function ($arriear) use($empData) {
                    $data = collect($empData['data']);
                    if (!($data->contains('year', $arriear['session_start']) 
                        || $data->contains('year', $arriear['session_end']))) {
                            return true;
                    }
                });

            $html .= view('employees.partials.single_report', [
                'employee' => $employee,
                'type' => $type
            ]);
        } else {
            $session_start = $req->session_start;
            $session_end = $req->session_end;
            $type = $req->type;
            $tax_report = \App\Models\EmployeeData::where('year', '>=', $session_start)
                ->where('year', '<=', $session_end)
                ->with('employee')
                ->with('employee.arriear')
                ->get();

            $employees = array();
            $data = array();
            foreach ($tax_report as $report) {
                if (isset($report->data[$type])) {
                    $data[$report->month.'/'.$report->year][$type][] = $report->data;
                    $employees[$type][$report->employee->id] = $report->employee->toArray();
                    $employees[$type][$report->employee->id]['data'][] = collect($report->data)->merge(
                        [
                            'year' => $report->year,
                            'month' => $report->month,
                        ]
                    );
                }
            }

            $tax_report = [
                $type => [
                    'arriear' => \App\Models\EmployeeArriear::where('session_start', '>=', $session_start)
                        ->where('session_end', '<=', $session_end)
                        ->whereIn('employee_id', array_keys($employees[$type]))
                        ->get(),
                ],
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

            $html .= view('employees.partials.type_table', [
                'type' => $type,
                'reports' => $tax_report,
                'employees' => $employees
            ]);
        }
        $html .= '</body>
        </html>';
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('report.pdf', [
            'Attachment' => 0
        ]);
    }
}
