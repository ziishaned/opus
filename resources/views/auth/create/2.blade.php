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
                                <li class="active">
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
                    <h2 class="top0">Validate your email address</h2>
                    <p>Enter validation code below that is sent to your email address <i>{{ Session::get('email') }}. <b>{{ Session::get('validation_key') }}</b></i></p>
                </div>
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                    <form action="{{ route('organizations.store', $step) }}" method="POST" role="form">
                        <div class="form-group {{ $errors->has('validation_key') ? ' has-error' : '' }}">
                            <label for="validation-key" class="control-label">Validation key</label>
                            <input type="number" id="validation-key" class="form-control" name="validation_key" required="required" autocomplete="off">
                            <div class="help-block with-errors">
                                @if ($errors->has('validation_key'))
                                    <strong>{{ $errors->first('validation_key') }}</strong>
                                @endif
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
