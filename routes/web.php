<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('optimize', function () {
    Artisan::call('optimize:clear');
    return 'optimized';
});
Route::get('storage-link', function () {
    Artisan::call('storage:link');
    // $target = storage_path('app/public');
    // $link = $_SERVER['DOCUMENT_ROOT'].'/storage';
    // symlink($target, $link);
    return 'Storage Link updated';
});
Route::get('fresh-start', function () {
    Artisan::call('migrate:fresh --seed');
    return 'fresh start is done';
});

Route::get('/', function () {
    return redirect('login');
});


Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('dashboard', [AdminHomeController::class, 'dashboard'])->name('dashboard.index');



    Route::resource('customer', CustomerController::class, [
        'parameters' => [
            'customer' => 'customer:slug'
        ]
    ]);


    Route::post('project-payment/{project:slug}/store', [ProjectController::class, 'payment_store'])->name('project.payment.store');
    Route::delete('project-payment/{id}/delete', [ProjectController::class, 'payment_delete'])->name('project.payment.delete');

    Route::resource('project', ProjectController::class, [
        'parameters' => [
            'project' => 'project:slug'
        ]
    ]);

    Route::post('my-expense/store', [ExpenseController::class, 'expense_store'])->name('my.expense.store');
    Route::delete('my-expense/{id}/delete', [ExpenseController::class, 'expense_delete'])->name('my.expense.delete');

    Route::resource('expense', ExpenseController::class, [
        'parameters' => [
            'expense' => 'expense:slug'
        ]
    ]);

    Route::resource('employee', EmployeeController::class, [
        'parameters' => [
            'employee' => 'employee:slug'
        ]
    ]);
    Route::resource('attendance', AttendanceController::class, [
        'parameters' => [
            'attendance' => 'attendance:slug'
        ]
    ]);


    Route::resource('payment', PaymentController::class, [
        'parameters' => [
            'payment' => 'payment:slug'
        ]
    ]);

    Route::get('transaction', [TransactionController::class, 'index'])->name('transaction.index');

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
