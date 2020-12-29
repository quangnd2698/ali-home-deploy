<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Attendance;
use App\Models\AttendanceModel;
use DateTime;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function __construct()
    {
        // $this->middleware('superAdmin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $now = getdate();
        $now = getdate();
        $str = $now['year'] . '/' . $now['mon'] . '/' . '0';
        $month = $now['mon'] . '-' . $now['year'];
        // dd(\Auth::guard('admins')->user()->attendanceNow);
        $date = new DateTime($str);
        $staffs = Admin::query()->get();
        return view('admin/attendances/attendance', [
            'staffs' => $staffs,
            'date' => $date,
            'month' => $month,
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
        if (\Gate::allows('isAdmin')) {
            $date = getdate();
            $month = $date['mon'] . '-' . $date['year'];
            $params = $request->attendance;
            foreach ($params as $param) {
                $param['month'] = $month;
                $param['attendance_code'] = 'AT-' . $param['staff_id'] . '-' . $month;
                $param['total_workday'] = $this->getWordDay($param);
                Attendance::updateOrCreate(
                    ['attendance_code' => $param['attendance_code']],
                    $param
                );
            }
            alert()->success('Lưu', 'thành công');
            return redirect()->route('attendances.create');
        }
        return redirect()->to('403');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    public function getWordDay($param)
    {
        unset($param['staff_id']);
        unset($param['attendance_code']);
        unset($param['month']);
        $total = 0;
        foreach ($param as $item) {
            $total += $item ? ($item == 'W' ? 1 : 0.5) : 0;
        }
        return $total;
    }
}
