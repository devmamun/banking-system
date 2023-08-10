@extends('layouts.master')
@section('content')
<div class="d-flex">
    <div>
        <span>Balance</span>
        <span>{{ auth()->user()->balance }} Tk Only</span>
    </div>
    <div>
        <a href="{{ route('user.transaction.deposit') }}" class="btn btn-outline-primary">Deposit</a>
    </div>
    <div>
        <a href="{{ route('user.transaction.withdrawal') }}" class="btn btn-outline-info">Withdrawal</a>
    </div>
</div>
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Transaction Type</th>
      <th scope="col">Amount</th>
      <th scope="col">Fee</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($transactions as $transaction)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ ucfirst($transaction->transaction_type) }}</td>
            <td>{{ $transaction->amount }}</td>
            <td>{{ $transaction->fee }}</td>
            <td>{{ $transaction->date }}</td>
        </tr>
    @endforeach

  </tbody>
</table>

@endsection
