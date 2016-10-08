@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h3 class="panel-title text-center" style="margin: 10px 0px 10px 0px; font-size: 22px;">Create an Organization</h3>
            <ul class="list-unstyled list-inline center-block text-center">
                <li class="text-left" style="margin-right: -5px; width: 220px; border-radius: 3px 0px 0px 3px; border: 1px solid #ddd; padding: 10px 10px 10px 10px; background-color: #fafafa; color: #ccc;">
                    <div class="row">
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                            <i class="fa fa-check fa-2x" style="color: #449d44;"></i>
                        </div>
                        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                            <h4 style="margin-top: 0px; margin-bottom: 0px; color: #767676;">Step 1:</h4>
                            <p style="margin-bottom: 0px; color: #767676;">Set up the organization</p>
                        </div>
                    </div>
                </li>
                <li class="text-left" style="width: 220px;border-radius: 0px 3px 3px 0px; border: 1px solid #ddd; padding: 10px 10px 10px 10px;">
                    <div class="row">
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                            <i class="fa fa-shield fa-2x" style="color: #4078c0;"></i>
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
            <form action="" method="POST" role="form">
                <div class="form-group">
                    <label for="" >Search by username, full name or email address</label>
                    <input type="text" name="organization_id" id="invite-to-organization-id" class="hide" value="{{ $organizationId  }}">
                    <div class="row">
                        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                            <select id="invite-people-input" class="repositories" placeholder="Find and select users..."> </select>
                        </div>
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                            <button type="button" class="btn btn-default" id="add-to-invite-list"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <ul class="list-unstyled user-invite-list"></ul>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Finish</button>
            </form>
        </div>
    </div>
@endsection
