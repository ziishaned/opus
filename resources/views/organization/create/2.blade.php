@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row" style="margin-top: 70px;">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-8 col-lg-offset-2">
                <h2>Validate your email address{{ Session::get('validation_key') }}</h2>
                <p style="margin-bottom: 10px;">Enter validation code below that is sent to your email address <i>ziishaned@gmail.com</i>.</p>
                <form action="{{ route('organizations.store', $step) }}" method="POST" role="form" data-toggle="validator">
                    <div class="form-group" style="width: 350px; margin: auto;">
                        <ul class="list-unstyled list-inline">
                            <li>
                                <input type="text" name="input_1" class="form-control input" maxlength="1" minlength="1" required="required" style="width: 45px; text-align: center;">
                            </li>
                            <li>
                                <input type="text" name="input_2" class="form-control input" maxlength="1" minlength="1" required="required" style="width: 45px; text-align: center;">
                            </li>
                            <li>
                                <input type="text" name="input_3" class="form-control input" maxlength="1" minlength="1" required="required" style="width: 45px; text-align: center;">
                            </li>
                            <li>
                                <input type="text" name="input_4" class="form-control input" maxlength="1" minlength="1" required="required" style="width: 45px; text-align: center;">
                            </li>
                            <li>
                                <input type="text" name="input_5" class="form-control input" maxlength="1" minlength="1" required="required" style="width: 45px; text-align: center;">
                            </li>
                            <li>
                                <input type="text" name="input_6" class="form-control input" maxlength="1" minlength="1" required="required" style="width: 45px; text-align: center;">
                            </li>
                        </ul>
                    </div>
                    <input type="submit" class="btn btn-primary pull-right" id="create-organization-btn" value="Submit">
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
@endsection
