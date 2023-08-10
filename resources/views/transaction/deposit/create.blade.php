@extends('layouts.master')
@section('content')
<div>
    <div>
        <a href="{{ route('user.transaction') }}" class="btn btn-outline-info">Transaction</a>
    </div>
    <div>
        <a href="{{ route('user.transaction.deposit') }}" class="btn btn-outline-info">Deposit</a>
    </div>
</div>
    <div class="row">
        <div class="col-6 offset-3">
            <form action="{{ route('user.transaction.deposit.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Amount</label>
                    <input type="number" name="amount" class="form-control" id="name" aria-describedby="emailHelp"
                        placeholder="Enter name">
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection
