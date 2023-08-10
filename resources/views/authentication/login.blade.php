@extends('layouts.master')
@section('content')
<h4 class="text-center">Login Form</h4>
<hr>
    <div class="row">
        <div class="col-6 offset-3">
            <form action="{{ route('user.authenticate') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp"
                        placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="account_type">Account Type</label>
                    <select class="form-control" id="account_type" name="account_type">
                        <option value="Individual">Individual</option>
                        <option value="Business">Business</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                        placeholder="Password">
                </div>

                <button type="submit" class="btn btn-primary">Login</button>
                <span>Do not have any account? <a href="{{ route('user.registration') }}">Register Now</a></span>
            </form>
        </div>
    </div>
@endsection
