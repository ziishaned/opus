@extends('layouts.app')

@section('content')
    <div class="row">
        @include('layouts.partials.setting-nav')
        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
            <h2>Add email address</h2>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <form action="" method="POST" role="form">                            
                        <div class="form-group">
                            <div class="input-group flat-input-con">
                                <span class="input-group-addon input-label" style="width: 45px;">Email</span>
                                <input type="text" class="form-control input" id="email" name="email" autocomplete="off">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Add</button>
                    </form>
                </div>
            </div>
            <hr>
            <h2>Linked Emails (2)</h2>
            <p style="margin-bottom: 7px;">Your Public Email will be displayed on your public profile.</p>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="list-unstyled email-list">
                        <li style="padding: 10px;">
                            <div class="row">
                                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                                    <p style="color: #5c5c5c; margin: 0;">ziishaned@gmail.com</p>        
                                </div>
                                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text-right">
                                    <span class="label label-success" style="padding: 4px 5px; font-size: 13px; font-style: normal; font-weight: normal; display: inline-block;">Primary Email</span>
                                    <span class="label label-info" style="background-color: #2d9fd8; padding: 4px 5px; font-size: 13px; font-style: normal; font-weight: normal; display: inline-block;">Public Email</span>
                                    <span class="label label-info" style="background-color: #2d9fd8; padding: 4px 5px; font-size: 13px; font-style: normal; font-weight: normal; display: inline-block;">Notification Email</span>
                                </div>
                            </div>
                        </li>
                        <li style="padding: 10px;">
                            <div class="row">
                                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                                    <p style="color: #5c5c5c; margin: 0;">ziishaned@gmail.com</p>        
                                </div>
                                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text-right">
                                    <button type="button" class="btn btn-xs btn-danger">Remove</button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
