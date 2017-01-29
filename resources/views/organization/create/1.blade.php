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
                                <li class="active">
                                    <a href="#">
                                        <h4 class="list-group-item-heading">Step 1</h4>
                                        <p class="list-group-item-text">Provide us your email address</p>
                                    </a>
                                </li>
                                <li class="disabled">
                                    <a href="#">
                                        <h4 class="list-group-item-heading">Step 2</h4>
                                        <p class="list-group-item-text">Email address verification</p>
                                    </a>
                                </li>
                                <li class="disabled">
                                    <a href="#">
                                        <h4 class="list-group-item-heading">Step 3</h4>
                                        <p class="list-group-item-text">Personal information</p>
                                    </a>
                                </li>
                                <li class="disabled">
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
                    <h2 class="top0">Email address</h2>
                    <p>It will help you login to the organization and let us send you the organizational updates and help you change your password if you ever forget.</p>
                </div>
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
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
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
