@extends('layouts.app')

@section('content')
    <div class="row">
        @include('layouts.partials.setting-nav')
        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
            <h2>Profile</h2>
            <p style="margin-bottom: 6px;">This information will appear on your profile.</p>
            <form action="{{ route('users.update', [Auth::user()->slug, ]) }}" method="POST" role="form" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                        {!! method_field('patch') !!}
                        <div class="form-group">
                            <div class="input-group flat-input-con">
                                <span class="input-group-addon input-label">Full Name</span>
                                <input type="text" name="full_name" id="full_name" class="form-control input" value="@if(old('full_name')){{ old('full_name') }}@else{{Auth::user()->full_name}}@endif" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="input-group flat-input-con">
                                <span class="input-group-addon input-label">Email</span>
                                <input type="text" name="email" id="email" class="form-control input" value="@if(old('email')){{ old('email') }}@else{{ Auth::user()->email }}@endif" required="required" autocomplete="off">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group flat-input-con">
                                <span class="input-group-addon input-label" style="vertical-align: top; padding-top: 15px;">Bio</span>
                                <textarea name="bio" id="bio" class="form-control input" rows="3">@if(old('bio')){{ old('bio') }}@else{{ Auth::user()->bio }}@endif</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group flat-input-con">
                                <span class="input-group-addon input-label">URL</span>
                                <input type="text" name="url" class="form-control input" value="@if(old('url')){{ old('url') }}@else{{ Auth::user()->url }}@endif">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group flat-input-con">
                                <span class="input-group-addon input-label">Company</span>
                                <input type="text" name="company" class="form-control input" value="@if(old('company')){{ old('company') }}@else{{ Auth::user()->company }}@endif">
                            </div>                                    
                        </div>
                        <div class="form-group">
                            <div class="input-group flat-input-con">
                                <span class="input-group-addon input-label">Location</span>
                                <input type="text" name="location" class="form-control input" value="@if(old('location')){{ old('location') }}@else{{ Auth::user()->location }}@endif">
                            </div>                                    
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-default">Update</button>
                        </div>  
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <h4 style="margin-bottom: 12px;">Profile Picture</h4>
                        <div class="user-profile-pic">
                            @if(empty(Auth::user()->profile_image))
                                <img src="/images/default.png" class="img-rounded img-responsive" alt="Image" style="border: 1px solid rgba(0,0,0,0.1);">
                            @else 
                                <img src="/images/profile-pics/{{ Auth::user()->profile_image }}" class="img-rounded img-responsive" alt="Image" style="border: 1px solid rgba(0,0,0,0.1);">
                            @endif
                        </div>        
                        <div style="margin-top: 10px;">
                            <div class="form-group{{ $errors->has('profile_image') ? ' has-error' : '' }}">
                                <label class="btn btn-default btn-file btn-block">
                                    Upload new picture <input type="file" name="profile_image" style="display: none;">
                                </label>
                                @if ($errors->has('profile_image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('profile_image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
