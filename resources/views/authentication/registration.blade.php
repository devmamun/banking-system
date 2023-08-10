@extends('layouts.master')
@section('content')
<h4 class="text-center">Registration Form</h4>
<hr>
    <div class="row">
        <div class="col-6 offset-3">
            <form action="{{ route('user.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" id="name" aria-describedby="emailHelp"
                        placeholder="Enter name">
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" id="email" aria-describedby="emailHelp"
                        placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="account_type">Account Type</label>
                    <select class="form-control" id="account_type" name="account_type">
                        <option {{ old('account_type') == "Individual" ? "selected" : "" }} value="Individual">Individual</option>
                        <option {{ old('account_type') == "Business" ? "selected" : "" }} value="Business">Business</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                        placeholder="Password">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <span>Already have an account <a href="{{ route('login') }}">Login now</a></span>
            </form>
        </div>
    </div>
@endsection
