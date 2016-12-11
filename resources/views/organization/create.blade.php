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
                        <textarea name="description" id="description" class="form-control input" rows="4" style="padding: 0;"></textarea>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary pull-right" id="create-organization-btn" value="Create Organization">
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
@endsection
