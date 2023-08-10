<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TransactionService
{
    /**
     * Store
     *
     * @param array $data
     * @return bool
     */
    public function store($data)
    {
        $data['user_id'] = auth()->user()->id;
        $data['date'] = now();
        $data['transaction_type'] = 'withdrawal';
        $day = date('l');

        $withdrawalAmount = Transaction::where('user_id', auth()->user()->id)->where('transaction_type', 'withdrawal')->sum('amount');

        $currentMonthWithdrawalAmount = Transaction::where('user_id', auth()->user()->id)
                ->where('transaction_type', 'withdrawal')
                ->whereMonth('date', now()->month)
                ->sum('amount');

        if ($day == 'Friday' || $currentMonthWithdrawalAmount <= 5000) {
            $data['fee'] = 0;
        } else if (auth()->user()->type == 'Individual') {
            $data['fee'] = $data['amount'] * 0.015;
        } else {
            if ($withdrawalAmount > 50000) {
                $data['fee'] = $data['amount'] * 0.015;
            } else {
                $data['fee'] = $data['amount'] * 0.025;
            }
        }

        $total = $data['amount'] + $data['fee'];

        if (auth()->user()->balance < $total) {
            return redirect()->back()->withErrors('You do not have enough money');
        }

        auth()->user()->decrement('balance', $total);
        
        return Transaction::insert($data);
    }


}
