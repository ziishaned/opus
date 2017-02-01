@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <div role="tabpanel">
                <ul class="nav nav-tabs nav-tabs-center" role="tablist">
                    <li>
                        <a href="{{ route('organizations.members', [$organization->slug, ]) }}">Members list</a> 
                    </li>
                    <li class="active">
                        <a href="{{ route('invite.users', [$organization->slug, ]) }}">Invite user</a>
                    </li>
                </ul>
                <div class="tab-content tab-bordered">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h1 class="text-center headin-no-margin mb10">Invite users to {{ $organization->name }}</h1>
                            <p class="text-center text-muted">Invited users after joining organization will only be able to access to public wikis.</p>        
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <form action="" method="POST" role="form" id="user-invitation-form">
                                <ul class="invitations-input-con list-unstyled">
                                    <li>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1 hidden-md hidden-lg">
                                                <div class="remove-invitation-input-con">
                                                    <button type="button" class="btn-link" id="remove-invitation-input"><i class="fa fa-close"></i></button>
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
                                                <div class="remove-invitation-input-con text-center" style="position: relative; top: 27px;">
                                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Remove invitation" class="btn-link" id="remove-invitation-input"><i class="fa fa-close"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="well well-sm">    
                                            <a href="#" id="add-invitation-input"><i class="fa fa-plus-circle fa-fw fa-lg"></i> Add another invitation</a>   
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
        </div>
    </section>
@endsection