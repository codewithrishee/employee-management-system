<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Employee extends Model
{
 protected $fillable = [
    'user_id',
    'employee_id',
    'department_id',
    'designation_id',
    'name',
    'email',
    'phone',
    'salary',
    'joining_date',
    'gender',
    'date_of_birth',
    'address',
    'image',
    'status',
];

  public function department()
{
    return $this->belongsTo(Department::class);
}

public function designation()
{
    return $this->belongsTo(Designation::class);
}

public function attendances()
{
    return $this->hasMany(Attendance::class);
}

public function leaves()
{
    return $this->hasMany(Leave::class);
}
public function payrolls()
{
    return $this->hasMany(Payroll::class);
}
public function user()
{
    return $this->belongsTo(User::class);
}
}
