<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepositRequest;
use App\Http\Requests\StoreWithdrawalRequest;
use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TransactionController extends Controller
{
    /**
     * All Transactions
     *
     * @return Illuminate\Contracts\View\View
     */
    public function index()
    {

        $data['transactions'] = Transaction::where('user_id', auth()->user()->id)->orderByDesc('id')->get();

        return view('transaction.index', $data);
    }

    /**
     * All Deposit
     *
     * @return Illuminate\Contracts\View\View
     */
    public function deposit()
    {
        $data['transactions'] = Transaction::where(['transaction_type' => 'deposit', 'user_id' => auth()->user()->id])
            ->orderByDesc('id')->get();

        return view('transaction.deposit.index', $data);
    }

    /**
     * Create Deposit
     *
     * @return Illuminate\Contracts\View\View
     */
    public function createDeposit()
    {
        return view('transaction.deposit.create');
    }

    /**
     * Store Deposit
     *
     * @return Illuminate\Contracts\View\View
     */
    public function storeDeposit(StoreDepositRequest $request)
    {
        $data['user_id'] = auth()->user()->id;
        $data['transaction_type'] = 'deposit';
        $data['fee'] = 0.0;
        $data['amount'] = $request->amount;
        $data['date'] = now();

        if (Transaction::insert($data)) {
            auth()->user()->increment('balance', $data['amount']);

            return redirect()->route('user.transaction.deposit');
        }

        return back()->withErrors('Something went wrong, please try again');
    }

    /**
     * All Deposit
     *
     * @return Illuminate\Contracts\View\View
     */
    public function withdrawal()
    {
        $data['transactions'] = Transaction::where(['transaction_type' => 'withdrawal', 'user_id' => auth()->user()->id])
            ->orderByDesc('id')->get();

        return view('transaction.withdrawal.index', $data);
    }

    /**
     * All Deposit
     *
     * @return Illuminate\Contracts\View\View
     */
    public function createWithdrawal()
    {
        return view('transaction.withdrawal.create');
    }

    /**
     * Store Deposit
     *
     * @return Illuminate\Contracts\View\View
     */
    public function storeWithdrawal(StoreWithdrawalRequest $request, TransactionService $service)
    {
        if ($service->store($request->validated())) {
            return redirect()->route('user.transaction.withdrawal');
        }

        return back()->withErrors('Something went wrong');
    }
}
