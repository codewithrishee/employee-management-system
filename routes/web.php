<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\LeaveController;
use App\Http\Controllers\Admin\PayrollController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\CompanySettingController;
use App\Http\Controllers\Employee\DashboardController as EmployeeDashboardController;
// use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Employee\ProfileController as EmployeeProfileController;
use App\Http\Controllers\Employee\AttendanceController as EmployeeAttendanceController;
use App\Http\Controllers\Employee\LeaveController as EmployeeLeaveController;
use App\Http\Controllers\Employee\PayrollController as EmployeePayrollController;



Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // PDF Export
    Route::get('/employees/pdf', [EmployeeController::class, 'exportPdf'])->name('employees.pdf');
    Route::get('/attendance/pdf', [AttendanceController::class, 'exportPdf'])->name('attendance.pdf');
    Route::get('/leaves/pdf', [LeaveController::class, 'exportPdf'])->name('leaves.pdf');
    Route::get('/payrolls/pdf', [PayrollController::class, 'exportPdf'])->name('payrolls.pdf');

    // Excel Export
    Route::get('/employees/excel', [EmployeeController::class, 'exportExcel'])
        ->name('employees.excel');

    // Reports
    Route::prefix('reports')->name('reports.')->group(function () {

        Route::get('/', [ReportController::class, 'index'])->name('index');
        Route::get('/employees', [ReportController::class, 'employees'])->name('employees');
        Route::get('/attendance', [ReportController::class, 'attendance'])->name('attendance');
        Route::get('/leaves', [ReportController::class, 'leaves'])->name('leaves');
        Route::get('/payrolls', [ReportController::class, 'payrolls'])->name('payrolls');

    });

    // Resources
    Route::resource('departments', DepartmentController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('attendance', AttendanceController::class);

    Route::resource('leaves', LeaveController::class)
        ->parameters([
            'leaves' => 'leave',
        ]);

    Route::patch('/leaves/{leave}/approve', [LeaveController::class, 'approve'])
        ->name('leaves.approve');

    Route::patch('/leaves/{leave}/reject', [LeaveController::class, 'reject'])
        ->name('leaves.reject');

    Route::resource('designations', DesignationController::class);
    Route::resource('payrolls', PayrollController::class);
    Route::resource('company-settings', CompanySettingController::class);
});

/*
|--------------------------------------------------------------------------
| Employee Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'employee'])->group(function () {

    // Dashboard
    Route::get('/employee/dashboard', [EmployeeDashboardController::class, 'index'])
        ->name('employee.dashboard');

    // Profile
    Route::get('/employee/profile', [EmployeeProfileController::class, 'index'])
        ->name('employee.profile');

    Route::get('/employee/profile/edit', [EmployeeProfileController::class, 'edit'])
        ->name('employee.profile.edit');

    Route::put('/employee/profile/update', [EmployeeProfileController::class, 'update'])
        ->name('employee.profile.update');

    // My Leaves
    Route::get('/employee/leaves', [EmployeeLeaveController::class, 'index'])
        ->name('employee.leaves.index');

    Route::get('/employee/leaves/create', [EmployeeLeaveController::class, 'create'])
        ->name('employee.leaves.create');

    Route::post('/employee/leaves', [EmployeeLeaveController::class, 'store'])
        ->name('employee.leaves.store');

    Route::get('/employee/change-password', [EmployeeProfileController::class, 'editPassword'])
        ->name('employee.password.edit');

    Route::put('/employee/change-password', [EmployeeProfileController::class, 'updatePassword'])
        ->name('employee.password.update');

    // My Attendance
    Route::get('/employee/attendance', [EmployeeAttendanceController::class, 'index'])
        ->name('employee.attendance');

    // My Payroll
    Route::get('/employee/payroll', [EmployeePayrollController::class, 'index'])
        ->name('employee.payroll');

});

require __DIR__ . '/auth.php';