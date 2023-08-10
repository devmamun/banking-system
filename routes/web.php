<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Models\Transaction;

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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('users/registration', [UserController::class, 'registration'])->name('user.registration');
Route::post('users/store', [UserController::class, 'store'])->name('user.store');

Route::get('users/login', [UserController::class, 'login'])->name('login');
Route::post('users/authenticate', [UserController::class, 'authenticate'])->name('user.authenticate');

Route::group(['middleware' => ['auth']], function () {
    Route::get('users/transactions', [TransactionController::class, 'index'])->name('user.transaction');
    Route::get('users/transactions/deposit', [TransactionController::class, 'deposit'])->name('user.transaction.deposit');
    Route::get('users/transactions/deposit/create', [TransactionController::class, 'createDeposit'])->name('user.transaction.deposit.create');
    Route::post('users/transactions/deposit/store', [TransactionController::class, 'storeDeposit'])->name('user.transaction.deposit.store');

    Route::get('users/transactions/withdrawal', [TransactionController::class, 'withdrawal'])->name('user.transaction.withdrawal');
    Route::get('users/transactions/withdrawal/create', [TransactionController::class, 'createWithdrawal'])->name('user.transaction.withdrawal.create');
    Route::post('users/transactions/withdrawal/store', [TransactionController::class, 'storeWithdrawal'])->name('user.transaction.withdrawal.store');
});
