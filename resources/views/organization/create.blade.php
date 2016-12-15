@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-8 col-lg-offset-2">
            <h2 style="margin-bottom: 10px;">Create a new organziation</h2>
            <form action="{{ route('organizations.store', $step) }}" method="POST" role="form" style="margin-bottom: 15px;">
                <div class="form-group">
                    <label for="">Your email address</label>
                    <div class="input-group flat-input-con">
                        <span class="input-group-addon input-label">Email</span>
                        <input id="email" type="email" class="form-control input" name="email" value="" data-error="That email address is invalid" required="">
                    </div>
                </div>
                <!-- <div class="form-group @if($errors->has('organization_name')) has-error  @endif">
                                    <div class="input-group flat-input-con">
                                        <span class="input-group-addon input-label">Organization name</span>
                                        <input type="text" class="form-control input" name="organization_name" id="organization_name" required="required" autocomplete="off">
                                    </div>                                
                                    @if ($errors->has('organization_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('organization_name')  }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <div class="input-group flat-input-con">
                                        <span class="input-group-addon input-label" style="vertical-align: top; padding-top: 5px; width: 142px;">Description</span>
                                        <textarea name="description" id="organization-description" class="form-control input" rows="4" style="padding: 0;"></textarea>
                                    </div>
                                </div>
                                 -->            
                <input type="submit" class="btn btn-primary pull-right" id="create-organization-btn" value="Submit">
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
@endsection
