@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h3 style="margin: 0px;">New Organization</h3>
            <p style="margin-bottom: 10px;">A organization contains all the private or open source wikis.</p>
            <form action="{{ route('organizations.store') }}" method="POST" role="form" style="margin-bottom: 15px;">
                <div class="form-group @if($errors->has('organization_name')) has-error  @endif">
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
                        <textarea name="description" id="description" class="form-control input" rows="3" style="padding: 0;"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div style="border: 1px solid rgba(34,36,38,.15); height: 97px; margin-left: 15px; margin-right: 15px; border-radius: 3px;">
                            <div class="pull-left" style="padding-left: 12px; padding-right: 15px; width: 142px;">
                                <p style="color: #666; font-size: 14px;">Visibility Level</p>
                            </div>
                            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                <div class="radio" style="margin-top: 4px;">
                                    <label>
                                        <input type="radio" name="organization_visibility" checked="checked" value="private">
                                        <span style="color: #333; font-weight: 500; font-size: 14px;"><i class="fa fa-lock"></i> Private <br></span> <span style="color: #555; font-size: 13px;">Project access must be granted explicitly to each user.</span>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="organization_visibility" value="public">
                                        <span style="color: #333; font-weight: 500; font-size: 14px;"><i class="fa fa-globe"></i> Public <br></span> <span style="color: #555; font-size: 13px;">The project can be cloned without any authentication.</span>
                                    </label>
                                </div>    
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn btn-default" id="create-organization-btn" value="Create Organization">
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
@endsection
