@extends('layouts.main')
@section('content')
    <h3 class="register-heading text-center">Registration form</h3>
    <h5 class="register-descr text-center mb-4">You should sign up to use this service.</h5>
    <form action="javascript:void(null);" method="POST" class="col-12 registration-form">
        {{csrf_field()}}
        <div class="row">
                <div class="form-group col-6">
                    <input type="text" name="name" class="form-control" placeholder="Name *" required>
                </div>
                <div class="form-group col-6">
                    <input type="email" name="email" class="form-control" placeholder="Email *" required>
                </div>
                <div class="form-group col-6">
                    <input type="password" name="password" class="form-control" placeholder="Password *" required>
                </div>
                <div class="form-group col-6">
                    <input type="password" name="password_confirmation" class="form-control"
                           placeholder="Password Confirmation *" required>
                </div>
            <div class="col-12 registration-form__submit-button">
                <button type="submit" class="btn btn-secondary btn-lg float-right">Submit</button>
            </div>
        </div>
    </form>

@endsection
