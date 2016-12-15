@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-8 col-lg-offset-2">
            <h2 style="margin-bottom: 0px;">Create a new organziation</h2>
            <p style="margin-bottom: 10px;">Organization a centralized place for your company to document who you are, what you do, and how to achieve results.</p>
            <form action="{{ route('organizations.store', $step) }}" method="POST" role="form" data-toggle="validator">
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="control-label">Email</label>
                    <input id="email" type="email" class="form-control input" name="email" data-error="That email address is invalid." required="">
                    <div class="help-block with-errors">
                        @if ($errors->has('email'))
                            <strong>{{ $errors->first('email') }}</strong>
                        @endif
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
                    </div> -->                
                <input type="submit" class="btn btn-primary pull-right" value="Submit">
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
@endsection
