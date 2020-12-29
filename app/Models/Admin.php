<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;


class Admin extends Model implements AuthenticatableContract
{
    use HasFactory;
    use Authenticatable;

    // use HasFactory;
    use SoftDeletes;

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 20;

    /**  
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'admins';

    /**  
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'address',
        'phone',
        'date_of_birth',
        'gender',
        'permission',
        'basic_salary',
        'image',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $appends = [
        'turnover_month',
        'contract_month',
        'commission',
        'workday',
        'attendanceNow',
        'position',
    ];

    /**
     * The attributes that should be converted to Carbon.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function invoice() {
        return $this->hasMany('App\Models\Invoice', 'introduce_staff', 'id');
    }

    public function getAttendance() {
        $now = getdate();
        $month = $now['mon'] . '-' . $now['year'];
        return Attendance::where('month', $month)
                ->where('staff_id', $this->id)->first();
    }

    public function getWorkdayAttribute() {
        $now = getdate();
        $month = $now['mon'] . '-' . $now['year'];
        $day = Attendance::where('month', $month)
                ->where('staff_id', $this->id)->first();
        return $day->total_workday ?? null;
    }

    public function getPositionAttribute() {
        $position = '';
        switch ($this->permission) {
            case 1:
                $position = 'Chủ cửa hàng';
                break;
            case 2:
                $position = 'Nhân viên bán hàng';
                break;
            case 3:
                $position = 'Nhân viên kho';
            break;
            case 4:
                $position = 'Nhân viên thị trường';
            break;
            default:
                break;
        }
        return $position;
    }

    public function getTurnoverMonthAttribute()
    {
        $now = getdate();
        $totalCosts = Invoice::where('introduce_staff', $this->id)
                        ->whereMonth('created_at', $now['mon'])->pluck('total_cost');
        return array_sum($totalCosts->toArray());
    }

    public function getContractMonthAttribute()
    {
        $now = getdate();
        return Invoice::where('introduce_staff', $this->id)
                        ->whereMonth('created_at', $now['mon'])->get();
    }

    public function getCommissionAttribute() {
        $value = $this->turnover_month;
        switch (true) {
            case ($value < 20000000):
                // return -1;
                return 0;
            break;
            case ($value >= 20000000 && $value < 25000000):
                return 0;
            break;
            case ($value >= 25000000 && $value < 40000000):
                return 1000000;
            break;
            case ($value >= 40000000 && $value < 70000000):
                return 2500000;
            break;
            case ($value >= 70000000 && $value < 100000000):
                return 6000000;
            break;
            case ($value >= 100000000):
                return 15000000;
            break;
            default:
            break;
        }
    }

    /**
     * A user can have many messages
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getAttendanceNowAttribute()
    {
        $now = getdate();
        $month = $now['mon'] . '-' . $now['year'];
        if ($this->permission == 0) {
            return true;
        }
        if ($this->permission == 1) {
            $attendance = Attendance::where('staff_id', $this->id)->where('month', $month)->value('day_' . $now['mday']);
            switch ($attendance) {
                case 'W':
                    return true;
                break;
                case 'M':
                    return ($now['hours'] < 12) ? true : false;
                break;
                case 'A':
                    return ($now['hours'] > 12) ? true : false;
                break;
                default:
                return is_int($now['hours']);
                break;
            }
        }
        return false;

        
    }
}
