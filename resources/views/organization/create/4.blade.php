@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row" style="margin-top: 70px;">
            <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
                <h2 style="margin-bottom: 0px;">Create a new organziation</h2>
                <p style="margin-bottom: 10px;">Organization a centralized place for your company to document who you are, what you do, and how to achieve results.</p>
                <form action="{{ route('organizations.store', $step) }}" method="POST" role="form" data-toggle="validator">
                    <div class="form-group{{ $errors->has('organization_name') ? ' has-error' : '' }}">
                        <label for="organization_name">Organization name</label>
                        <input type="text" class="form-control input" name="organization_name" id="organization_name" required="required" data-error="Organization name field is required." autocomplete="off">
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
                    <input type="submit" class="btn btn-primary pull-right" value="Submit">
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
@endsection
