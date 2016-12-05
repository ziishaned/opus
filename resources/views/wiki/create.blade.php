@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h3 style="margin: 0px;">New wiki</h3>
            <p style="margin-bottom: 10px;">A wiki contains all the pages with informative text for your project.</p>
            <form action="{{ route('wikis.store') }}" method="POST" role="form" style="margin-bottom: 15px;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <div class="input-group flat-input-con">
                                    <span class="input-group-addon input-label">Wiki path</span>
                                    <select class="form-control flat-ui-select" name="wiki_path" id="wiki-path" style="box-shadow: none; outline: none; border-color: rgba(34,36,38,.15) !important; border-left: 0px; height: 45px;">
                                        <optgroup label="User">
                                            <option value="user">{{ Auth::user()->full_name }}</option>
                                        </optgroup>
                                        <optgroup label="Organizations">
                                            @foreach($organizations as $organization)
                                                <option value="{{ $organization->id }}">{{ $organization->name }}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group{{ $errors->has('wiki_name') ? ' has-error' : '' }}">
                                <div class="input-group flat-input-con">
                                    <span class="input-group-addon input-label">Wiki name</span>
                                    <input type="text" name="wiki_name" id="wiki-name" class="form-control input" required="required" autocomplete="off">
                                </div>                                
                                @if ($errors->has('wiki_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('wiki_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group flat-input-con">
                        <span class="input-group-addon input-label" style="vertical-align: top; padding-top: 5px;">Outline</span>
                        <textarea name="outline" id="outline" class="form-control input" rows="3" style="padding: 0;"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div style="border: 1px solid rgba(34,36,38,.15); height: 97px; margin-left: 15px; margin-right: 15px; border-radius: 3px;">
                            <div class="pull-left" style="padding-left: 12px; padding-right: 15px;">
                                <p style="color: #9D9DA3; font-size: 14px;">Visibility Level</p>
                            </div>
                            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                <div class="radio" style="margin-top: 4px;">
                                    <label>
                                        <input type="radio" name="wiki_visibility" checked="checked" value="private">
                                        <span style="color: #333; font-weight: 500; font-size: 14px;"><i class="fa fa-lock"></i> Private <br></span> <span style="color: #555; font-size: 13px;">Project access must be granted explicitly to each user.</span>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="wiki_visibility" value="public">
                                        <span style="color: #333; font-weight: 500; font-size: 14px;"><i class="fa fa-globe"></i> Public <br></span> <span style="color: #555; font-size: 13px;">The project can be cloned without any authentication.</span>
                                    </label>
                                </div>    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group" id="page-description-input">
                    <label for="wiki-description" class="control-label">Description</label>
                    <textarea id="wiki-description" name="wiki_description"></textarea>
                </div>
                <input type="submit" class="btn btn-default" id="create-wiki-btn" value="Create Wiki">
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
@endsection