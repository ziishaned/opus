@extends('layouts.app')

@section('content')
    <div class="row">
        @include('layouts.partials.setting-nav')
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h3 style="margin: 0; font-size: 17px; margin-top: 10px; border-bottom: 1px #e5e5e5 solid; padding-bottom: 8px;">Public Profile</h3>
            <div class="row" style="margin-top: 12px;">
                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                    <form action="" method="POST" role="form">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control dim-input" id="name">
                        </div>
                        <div class="form-group">
                            <label for="name">Public email</label>
                            <select name="" id="input" class="form-control" required="required">
                                <option value="">{{ Auth::user()->email }}</option>
                                <option value="">Don't show my email address</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Bio</label>
                            <textarea name="" id="input" class="form-control dim-input" rows="3" required="required"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="name">URL</label>
                            <input type="text" name="name" class="form-control dim-input" id="name">
                        </div>
                        <div class="form-group">
                            <label for="name">Company</label>
                            <input type="text" name="name" class="form-control dim-input" id="name">
                        </div>
                        <div class="form-group">
                            <label for="name">Location</label>
                            <input type="text" name="name" class="form-control dim-input" id="name">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-default" style="background-image: linear-gradient(#fcfcfc, #eee); font-size: 13px; font-weight: 600;">Update profile</button>
                        </div>
                    </form>
                </div>
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                    <h4 style="font-size: 14px;">Profile Picture</h4>
                    <div class="user-profile-pic">
                        <img src="/images/default.png" class="img-rounded" width="150" height="150" alt="Image" style="border: 1px solid rgba(0,0,0,0.1);">
                    </div>        
                    <div style="margin-top: 10px;">
                        <label class="btn btn-default btn-file btn-block" style="background-image: linear-gradient(#fcfcfc, #eee); font-size: 13px; font-weight: 600;">
                            Upload new picture <input type="file" style="display: none;">
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
