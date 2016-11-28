@extends('layouts.app')

@section('content')
    <div class="row">
        @include('layouts.partials.setting-nav')
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h3 style="margin: 0; font-size: 17px; margin-top: 10px; border-bottom: 1px #e5e5e5 solid; padding-bottom: 8px;">Public Profile</h3>
            <div class="row" style="margin-top: 12px;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <form action="{{ route('users.update', [Auth::user()->slug, ]) }}" method="POST" role="form" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                {!! method_field('patch') !!}
                                <div class="form-group">
                                    <label for="full_name">Full Name</label>
                                    <input type="text" name="full_name" id="full_name" class="form-control dim-input" value="@if(old('full_name')){{ old('full_name') }}@else{{Auth::user()->full_name}}@endif">
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" class="form-control dim-input" value="@if(old('email')){{ old('email') }}@else{{ Auth::user()->email }}@endif" required="required">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="bio">Bio</label>
                                    <textarea name="bio" id="bio" class="form-control dim-input" rows="3">@if(old('bio')){{ old('bio') }}@else{{ Auth::user()->bio }}@endif</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="url">URL</label>
                                    <input type="text" name="url" class="form-control dim-input" value="@if(old('url')){{ old('url') }}@else{{ Auth::user()->url }}@endif">
                                </div>
                                <div class="form-group">
                                    <label for="company">Company</label>
                                    <input type="text" name="company" class="form-control dim-input" value="@if(old('company')){{ old('company') }}@else{{ Auth::user()->company }}@endif">
                                </div>
                                <div class="form-group">
                                    <label for="location">Location</label>
                                    <input type="text" name="location" class="form-control dim-input" value="@if(old('location')){{ old('location') }}@else{{ Auth::user()->location }}@endif">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default" style="background-image: linear-gradient(#fcfcfc, #eee); font-size: 13px; font-weight: 600;">Update profile</button>
                                </div>  
                            </div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                <h4 style="font-size: 14px;">Profile Picture</h4>
                                <div class="user-profile-pic">
                                    @if(empty(Auth::user()->profile_image))
                                        <img src="/images/default.png" class="img-rounded" width="150" height="150" alt="Image" style="border: 1px solid rgba(0,0,0,0.1);">
                                    @else 
                                        <img src="/images/profile-pics/{{ Auth::user()->profile_image }}" class="img-rounded" width="150" height="150" alt="Image" style="border: 1px solid rgba(0,0,0,0.1);">
                                    @endif
                                </div>        
                                <div style="margin-top: 10px;">
                                    <div class="form-group{{ $errors->has('profile_image') ? ' has-error' : '' }}">
                                        <label class="btn btn-default btn-file btn-block" style="background-image: linear-gradient(#fcfcfc, #eee); font-size: 13px; font-weight: 600;">
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
        </div>
    </div>
@endsection
