@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            @include('layouts.partials.setting-nav')
        </div>
    </div>

    <div class="row" style="margin-top: 12px;">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="font-size: 14px; font-weight: 700;">
                    Email
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <form action="" method="POST" role="form">                    
                                <div class="form-group">
                                    <label for="">Old password</label>
                                    <input type="password" class="form-control dim-input" id="">
                                </div>
                                <div class="form-group">
                                    <label for="">New password</label>
                                    <input type="password" class="form-control dim-input" id="">
                                </div>
                                <div class="form-group">
                                    <label for="">Confirm new password</label>
                                    <input type="password" class="form-control dim-input" id="">
                                </div>
                                <button type="submit" class="btn btn-default" style="background-image: linear-gradient(#fcfcfc, #eee); font-size: 13px; font-weight: 600;">Update password</button> <a href="#">I forgot my password</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-danger">
                <div class="panel-heading" style="font-size: 14px; font-weight: 700;">
                    Delete account
                </div>
                <div class="panel-body">
                    <p>Once you delete your account, there is no going back. Please be certain.</p>
                    <button type="submit" class="btn btn-default" id="delete-account" style="background-image: linear-gradient(#fcfcfc, #eee); font-size: 13px; font-weight: 600;">Delete your account</button>
                </div>
            </div>
        </div>
    </div>
@endsection
