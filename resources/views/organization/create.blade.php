@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h3 class="panel-title text-center" style="margin: 10px 0px 10px 0px; font-size: 22px;">Create an Organization</h3>
            <ul class="list-unstyled list-inline center-block text-center">
                <li class="text-left" style="margin-right: -5px; width: 220px; border-radius: 3px 0px 0px 3px; border: 1px solid #ddd; padding: 10px 10px 10px 10px;">
                    <div class="row">
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                            <i class="fa fa-building-o fa-2x" style="color: #4078c0;"></i>
                        </div>
                        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                            <h4 style="margin-top: 0px; margin-bottom: 0px;">Step 1:</h4>
                            <p style="margin-bottom: 0px;">Set up the organization</p>
                        </div>
                    </div>
                </li>
                <li class="text-left" style="width: 220px; border-radius: 0px 3px 3px 0px; border: 1px solid #ddd; padding: 10px 10px 10px 10px; background-color: #fafafa; color: #ccc;">
                    <div class="row">
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                            <i class="fa fa-shield fa-2x"></i>
                        </div>
                        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                            <h4 style="margin-top: 0px; margin-bottom: 0px;">Step 2:</h4>
                            <p style="margin-bottom: 0px;">Invite members</p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-lg-offset-4">
            <h3 style="font-size: 16px; margin-top: 0;">Set up the organization</h3>
            <form action="{{ route('storeOrganization') }}" method="POST" role="form">
                <div class="form-group @if($errors->has('organization_name')) has-error  @endif">
                    <label for="organization_name" class="control-label">Organization name</label>
                    <input type="text" class="form-control" name="organization_name" id="organization_name">
                    @if($errors->has('organization_name'))
                        <p class="text-danger">{{ $errors->first('organization_name')  }}</p>
                    @endif
                </div>
                <button type="submit" class="btn btn-success">Create Organzation</button>
            </form>
        </div>
    </div>
@endsection
