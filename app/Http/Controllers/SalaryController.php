<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Salary;
use App\Models\SalaryDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SalaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('superAdmin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salaries = Salary::query()->get();
        // // $salaries = Salary::findOrfail(1);
        // // $detail = SalaryDetail::query()->get();
        // dd($salaries);
        return view('admin/salaries/index', [
            'salaries' => $salaries
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $staffs = Admin::query()->get();
        // dd($staffs->first()->workday);
        return view('admin/salaries/salary_month', [
            'staffs' => $staffs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $now = getdate();
        $paramDetails  = $request->data;
        $salary_code = 'SLR' .'-' . $now['mon'] . '-' . $now['year'] . '/' . Str::random(2);
        $total_cost = 0;
        // dd($paramDetails);
        foreach ($paramDetails as $key => $paramDetail) {
            // dd($paramDetail);
            $paramDetail['salary_code'] = $salary_code;
            SalaryDetail::create($paramDetail);
            $total_cost += $paramDetail['last_salary'];
        }
        $param['month'] = $now['mon'] . '-' . $now['year'];
        $param['note'] = $request->note;
        $param['total_cost'] = $total_cost;
        $param['salary_code'] = $salary_code;
        Salary::create($param);
        alert()->success('Chốt', 'thành công');
        return redirect()->route('salaries.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $staffs = Admin::query()->get();
        return view('admin/salaries/salary_month', [
            'staffs' => $staffs,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function SlaryOfMonth(Request $request)
    {
        $staffs = Admin::query()->get();
        return view('admin/salaries/salary_month', [
            'staffs' => $staffs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getPayroll()
    {
        // dd(1);
        $staffs = Admin::query()->get();
        return view('admin/salaries/payroll', [
            'staffs' => $staffs,
        ]);
    }
}
