@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 20px;">
    	<div class="row">
    	    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    	    	<h3>Edit page</h3>
                <p style="margin-bottom: 10px;">A wiki contains all the pages with informative text for your project.</p>
                <form action="{{ route('pages.update', [$organization->slug, $wiki->slug, $page->slug]) }}" method="POST" role="form" style="margin-bottom: 10px;">
                 	{!! method_field('patch') !!}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group{{ $errors->has('page_name') ? ' has-error' : '' }}">
                                <label for="page-name" class="control-label">Page Name</label>
                                <input type="text" id="page-name" class="form-control input" name="page_name" required="required" value="{{ $page->name }}">
                                @if ($errors->has('page_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('page_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="outline" class="control-label">Short Description</label>
                                <input type="text" name="outline" id="outline" class="form-control input" required="required" value="{{ $page->outline }}">
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="page-parent" class="control-label">Page parent</label>
                                <select class="form-control input" name="page_parent" id="page-parent">
                                    <option value=""></option>
                                    @foreach($wikiPages as $wikiPage)
                                        <option value="{{ $wikiPage->id }}" @if($wikiPage->id == $page->parent_id) selected @endif>{{ $wikiPage->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="page-description-input">
                        <label for="page-description">Description</label>
                        <textarea id="page-description" name="page_description">{{ $page->description }}</textarea>
                    </div>
                    <div class="pull-left">
		                <a href="{{ route('pages.show', [$organization->slug, $wiki->slug, $page->slug, ]) }}" onclick="if(confirm('All changes will be discarded?')) {event.preventDefault(); document.location = $(this).attr('href'); }" class="btn btn-default">Close</a>
                    </div>
                    <div class="pull-right">
                        <input type="submit" class="btn btn-success" value="Save">
                    </div>
                    <div class="clearfix"></div>
                </form>
    	    </div>
    	</div>
    </div>
@endsection