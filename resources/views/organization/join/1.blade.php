@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row" style="margin-top: 70px;">
            <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
                <div style="margin-bottom: 10px;">
                    <h2 style="margin-bottom: 0px;">Join organziation</h2>
                    <p>Enter the organization name to which you want to join.</p>
                </div>
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
                    <input type="submit" class="btn btn-primary pull-right" value="Submit">
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
@endsection
