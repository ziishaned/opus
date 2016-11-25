@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            @include('layouts.partials.wiki-nav')
            <div class="row" style="margin-top: 10px;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <form action="{{ route('wikis.pages.store', $wiki->slug) }}" method="POST" role="form" style="margin-bottom: 15px;">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                    <div class="form-group" style="margin: 0;">
                                        <label for="" class="control-label" style="font-weight: 600;">Select Wiki</label>
                                        <select id="wiki-input" name="wiki_id" placeholder="Find and select wiki.." disabled="disabled">
                                            <option value="{{ $wiki->id }}" selected>{{ $wiki->name }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 separator" style="padding: 0; width: 10px; font-size: 30px; position: relative; top: 22px; font-family: 'Open Sans'; font-weight: 300;"></div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group{{ $errors->has('page_name') ? ' has-error' : '' }}" style="margin: 0;">
                                        <label for="page-name" class="control-label" style="font-weight: 600;">Page Name</label>
                                        <input type="text" name="page_name" id="page-name" class="form-control" required="required">
                                        @if ($errors->has('page_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('page_name') }}</strong>
                                            </span>
                                        @endif
                                        <p class="text-muted">Great page names are short and memorable.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                    <div class="form-group" style="margin: 0;">
                                        <label for="page-parent" class="control-label" style="font-weight: 600;">Page Parent</label>
                                        <select id="page-parent" name="page_parent" placeholder="Select page parent.."></select>
                                    </div>
                                    <p class="text-muted">Leave it blank if this page has no parent.</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="page-description-input">
                            <label for="page-description" style="font-weight: 600;">Description</label>
                            <textarea id="page-description" name="page_description"></textarea>
                        </div>
                        <input type="submit" class="btn btn-success pull-right" id="create-page-btn" value="Create Page">
                        <div class="clearfix"></div>
                    </form>        
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="row" style="margin-top: 20px;">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h3 style="margin: 0px 0px 8px;">Create Page in <span class="text-muted"><i>{{ $wiki->name }}</i></span> Wiki</h3>
            <p class="text-muted">A page contains the information of a project module.</p>
            <hr>
            <form action="{{ route('wikis.pages.store', $wiki->slug) }}" method="POST" role="form" style="margin-bottom: 15px;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                            <div class="form-group" style="margin: 0;">
                                <label for="" class="control-label">Select Wiki</label>
                                <select id="wiki-input" name="wiki_id" placeholder="Find and select wiki.." disabled="disabled">
                                    <option value="{{ $wiki->id }}" selected>{{ $wiki->name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 separator" style="padding: 0; width: 10px; font-size: 30px; position: relative; top: 22px; font-family: 'Open Sans'; font-weight: 300;"></div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group{{ $errors->has('page_name') ? ' has-error' : '' }}" style="margin: 0;">
                                <label for="page-name" class="control-label">Page Name</label>
                                <input type="text" name="page_name" id="page-name" class="form-control" required="required">
                                
                                @if ($errors->has('page_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('page_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <p class="text-muted">Great page names are short and memorable.</p>
                    <div class="row">
                    	<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                            <div class="form-group" style="margin: 0;">
                                <label for="page-parent" class="control-label">Page Parent</label>
                                <select id="page-parent" name="page_parent" placeholder="Select page parent.."></select>
                            </div>
		                    <p class="text-muted">Leave it blank if this page has no parent.</p>
                    	</div>
                    </div>
                </div>
                <div class="form-group" id="page-description-input">
                    <label for="page-description">Description</label>
                    <textarea id="page-description" name="page_description"></textarea>
                </div>
                <input type="submit" class="btn btn-success pull-right" id="create-page-btn" value="Create Page">
                <div class="clearfix"></div>
            </form>
        </div>
    </div> --}}
@endsection
