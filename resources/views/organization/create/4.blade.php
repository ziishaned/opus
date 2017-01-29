@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="create-organization">
                        <div class="create-organization-head">
                            <h2 class="text-center create-organization-heading marginless">Create a new organziation</h2>
                            <p class="text-center">Organization a centralized place for your company to document who you are, what you do, and how to achieve results.</p>
                        </div>
                        <div class="create-organization-body">
                            <ul class="nav nav-pills nav-justified thumbnail">
                                <li class="disabled">
                                    <a href="#" class="step-completed">
                                        <h4 class="list-group-item-heading"><i class="fa fa-check fa-fw fa-lg"></i> Step 1</h4>
                                        <p class="list-group-item-text">Provide us your email address</p>
                                    </a>
                                </li>
                                <li class="disabled">
                                    <a href="#" class="step-completed">
                                        <h4 class="list-group-item-heading"><i class="fa fa-check fa-fw fa-lg"></i> Step 2</h4>
                                        <p class="list-group-item-text">Email address verification</p>
                                    </a>
                                </li>
                                <li class="disabled">
                                    <a href="#" class="step-completed">
                                        <h4 class="list-group-item-heading"><i class="fa fa-check fa-fw fa-lg"></i> Step 3</h4>
                                        <p class="list-group-item-text">Personal information</p>
                                    </a>
                                </li>
                                <li class="active">
                                    <a href="#">
                                        <h4 class="list-group-item-heading">Step 4</h4>
                                        <p class="list-group-item-text">Create organization</p>
                                    </a>
                                </li>
                            </ul>        
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <h2 class="top0">Create organization</h2>
                    <p>Enter you organization name and also describe a little about your organziation.</p>
                </div>
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                    <form action="{{ route('organizations.store', $step) }}" method="POST" role="form" data-toggle="validator">
                        <div class="form-group{{ $errors->has('organization_name') ? ' has-error' : '' }}">
                            <label for="organization_name">Name</label>
                            <input type="text" class="form-control input" name="organization_name" id="organization_name" required="required" autocomplete="off">
                            <div class="help-block with-errors">
                                @if ($errors->has('organization_name'))
                                    <strong>{{ $errors->first('organization_name') }}</strong>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="organization-description">Description</label>
                            <textarea name="description" id="organization-description" class="form-control input" rows="4"></textarea>
                        </div>                
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
