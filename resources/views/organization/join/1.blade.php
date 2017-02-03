@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="create-organization">
                        <div class="create-organization-head">
                            <h2 class="text-center create-organization-heading marginless">Join organziation</h2>
                            <p class="text-center">Organization a centralized place for your company to document who you are, what you do, and how to achieve results.</p>
                        </div>
                        <div class="create-organization-body">
                            <ul class="nav nav-pills nav-justified thumbnail">
                                <li class="active">
                                    <a href="#">
                                        <h4 class="list-group-item-heading">Step 1</h4>
                                        <p class="list-group-item-text">Organization information</p>
                                    </a>
                                </li>
                                <li class="disabled">
                                    <a href="#">
                                        <h4 class="list-group-item-heading">Step 3</h4>
                                        <p class="list-group-item-text">Personal information</p>
                                    </a>
                                </li>
                            </ul>        
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <h2 class="top0">Organization</h2>
                    <p>Enter the organization name to which you want to join.</p>
                </div>
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                    <form action="{{ route('organizations.postjoin', $step) }}" method="POST" role="form">
                        <div class="form-group{{ $errors->has('organization_name') ? ' has-error' : '' }}">
                            <label for="organization-name" class="control-label">Organization name</label>
                            <input id="organization-name" value="{{ old('organization_name') }}" type="text" class="form-control input" name="organization_name" required>
                            <div class="help-block with-errors">
                                @if ($errors->has('organization_name'))
                                    <strong>{{ $errors->first('organization_name') }}</strong>
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
