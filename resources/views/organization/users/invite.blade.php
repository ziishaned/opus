@extends('layouts.app')

@section('content')
    <div class="container">
        <div style="margin-bottom: 10px; margin-top: 10px; height: 50px;" class="hidden-xs">
            <div class="site-breadcrumb">
                <ul class="list-unstyled list-inline" style="margin-bottom: 0px;">
                    <li>
                        <a href="#">Facebook</a>
                    </li>
                    <li class="active">
                        <a href="#">Invite user</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div style="padding: 30px 0px; border-bottom: 1px solid #ccc;">
                    <h1 class="text-center" style="font-weight: 300; margin-bottom: 14px;">Invite users to <span style="font-weight: 500;">Facebook</span></h1>
                    <p class="text-center" style="font-size: 17px;">Invited users after joining organization will only be able to access to public wikis.</p>
                </div>
                <div style="margin-top: 15px;">
                    <form action="" method="POST" role="form" id="user-invitation-form">
                        <ul class="invitations-input-con list-unstyled">
                            <li>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1 hidden-md hidden-lg">
                                        <div class="remove-invitation-input-con">
                                            <button type="button" class="btn-link" id="remove-invitation-input" style="font-size: 17px; font-size: 17px; width: 100%;"><i class="fa fa-close"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                        <div class="form-group">
                                            <label for="">Email Address</label>
                                            <input type="text" class="form-control input" id="" placeholder="example@example.com">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                        <div class="form-group">
                                            <label for="">First Name</label>
                                            <input type="text" class="form-control input" id="" placeholder="Optional">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                        <div class="form-group">
                                            <label for="">Last Name</label>
                                            <input type="text" class="form-control input" id="" placeholder="Optional">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1 hidden-sm hidden-xs">
                                        <div class="remove-invitation-input-con" style="text-align: center; position: relative; top: 18px;">
                                            <a href="#" data-toggle="tooltip" data-placement="top" title="Remove invitation" class="btn-link" id="remove-invitation-input" style="font-size: 17px;"><i class="fa fa-close"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div style="background-color: #fdfdfd; border: 1px solid #ddd; border-radius: 3px; padding: 12px; margin-bottom: 18px;">
                                    <a href="#" style="font-size: 15px;" id="add-invitation-input"><i class="fa fa-plus-circle fa-fw fa-lg"></i> Add another invitation</a>   
                                </div>        
                            </div>
                        </div>
                        <div class="pull-right">
                            <button type="button" class="btn btn-success">Invite <span class="total-invitations">1</span> Person</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection