@extends('layouts.front-master')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-9 order-lg-last dashboard-content">
            <h2>Edit Account Information</h2>
            
            <form action="#">
                <div class="row">
                    <div class="col-sm-11">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group required-field">
                                    <label for="acc-name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{$customer->name}}" required>
                                </div><!-- End .form-group -->
                            </div><!-- End .col-md-4 -->
                            <div class="col-md-6">
                                <div class="form-group required-field">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{$customer->email}}" required>
                                </div><!-- End .form-group -->
                            </div><!-- End .col-md-4 -->
                        </div><!-- End .row -->
                    </div><!-- End .col-sm-11 -->
                </div><!-- End .row -->

               

                <div class="mb-2"></div><!-- margin -->

                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="change-pass-checkbox" value="1">
                    <label class="custom-control-label" for="change-pass-checkbox">Change Password</label>
                </div><!-- End .custom-checkbox -->

                <div id="account-chage-pass">
                    <h3 class="mb-2">Change Password</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group required-field">
                                <label for="acc-pass2">Password</label>
                                <input type="password" class="form-control" id="acc-pass2" name="acc-pass2">
                            </div><!-- End .form-group -->
                        </div><!-- End .col-md-6 -->

                        <div class="col-md-6">
                            <div class="form-group required-field">
                                <label for="acc-pass3">Confirm Password</label>
                                <input type="password" class="form-control" id="acc-pass3" name="acc-pass3">
                            </div><!-- End .form-group -->
                        </div><!-- End .col-md-6 -->
                    </div><!-- End .row -->
                </div><!-- End #account-chage-pass -->

                <div class="required text-right">* Required Field</div>
                <div class="form-footer">
                    <a href="#"><i class="icon-angle-double-left"></i>Back</a>

                    <div class="form-footer-right">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div><!-- End .form-footer -->
            </form>
        </div><!-- End .col-lg-9 -->

       @include('front.include.account-sidebar')
    </div><!-- End .row -->
</div><!-- End .container -->
@endsection