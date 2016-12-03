@extends('layouts.app')

@section('content')
    <div class="row">
        @include('layouts.partials.setting-nav')
        
        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
            <h2>How you receive notifications</h2>
            <hr>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h4 style="margin-bottom: 0;">Watching</h4>
                    <p>Receive notification when someone update any wiki that you are watching.</p>
                    <ul class="list-inline list-unstyled" style="margin: 0;">
                        <li style="padding-left: 0;">
                            <div class="checkbox" style="margin: 0; margin-top: 5px;">
                                <label>
                                    <input type="checkbox" value="">
                                    Email
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox" style="margin: 0; margin-top: 5px;">
                                <label>
                                    <input type="checkbox" value="">
                                    Web
                                </label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h4 style="margin-bottom: 0;">Mention</h4>
                    <p>Receive notification if someone mention you in a comment.</p>
                    <ul class="list-inline list-unstyled" style="margin: 0;">
                        <li style="padding-left: 0;">
                            <div class="checkbox" style="margin: 0; margin-top: 5px;">
                                <label>
                                    <input type="checkbox" value="">
                                    Email
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox" style="margin: 0; margin-top: 5px;">
                                <label>
                                    <input type="checkbox" value="">
                                    Web
                                </label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <hr>
        </div>
    </div>
@endsection
