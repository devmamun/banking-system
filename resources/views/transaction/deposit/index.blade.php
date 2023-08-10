@extends('layouts.master')
@section('content')
<div>
    <div>
        <a href="{{ route('user.transaction') }}" class="btn btn-outline-info">Transaction</a>
    </div>
    <div>
        <a href="{{ route('user.transaction.deposit.create') }}" class="btn btn-outline-info">Create Deposit</a>
    </div>
</div>
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Amount</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($transactions as $transaction)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $transaction->amount }}</td>
            <td>{{ $transaction->date }}</td>
        </tr>

    @endforeach
  </tbody>
</table>

@endsection
