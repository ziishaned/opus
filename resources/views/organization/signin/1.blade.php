@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-8 col-lg-offset-2">
            <h2 style="margin-bottom: 0px;">Sign in to organziation</h2>
            <p style="margin-bottom: 10px;">Enter the organization name to which you want to login.</p>
            <form action="{{ route('organizations.postsignin', $step) }}" method="POST" role="form" data-toggle="validator">
                <div class="form-group{{ $errors->has('organization_name') ? ' has-error' : '' }}">
                    <label for="organization-name" class="control-label">Organization name</label>
                    <input id="organization-name" value="{{ old('organization_name') }}" type="text" class="form-control input" name="organization_name" data-error="That organization name is required field." required>
                    <div class="help-block with-errors">
                        @if ($errors->has('organization_name'))
                            <strong>{{ $errors->first('organization_name') }}</strong>
                        @endif
                    </div>
                </div>
                <input type="submit" class="btn btn-primary pull-right" value="Submit">
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
@endsection
