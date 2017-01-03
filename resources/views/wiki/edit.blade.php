@extends('layouts.app')

@section('content')
    <div class="container">
        <div style="margin-bottom: 10px; margin-top: 10px; height: 50px;">
            <div class="site-breadcrumb">
                <ul class="list-unstyled list-inline" style="margin-bottom: 0px;">
                    <li>
                        <a href="#">{{ $organization->name }}</a>
                    </li>
                    <li>
                        <a href="#">Wikis</a>
                    </li>
                    <li>
                        <a href="#">{{ $wiki->name }}</a>
                    </li>
                    <li class="active">
                        <a href="#">Edit wiki</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row" style="margin-top: 10px;">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h3 style="margin-top: 10px;">Edit wiki</h3>
                <p style="margin-bottom: 10px;">A wiki contains all the pages with informative text for your project.</p>
                <form action="{{ route('wikis.update', [$organization->slug, $wiki->slug]) }}" method="POST" role="form">
                 	{!! method_field('patch') !!}
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="control-label" id="wiki_name">Wiki name</label>
                                <input type="text" class="form-control input" name="wiki_name" id="wiki_name" value="{{ $wiki->name }}">
                                @if ($errors->has('wiki_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('wiki_name') }}</strong>
                                    </span>
                                @endif
                            </div>  
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <label for="wiki-visibility" class="control-label">Visibility Level</label>
                            <select name="wiki_visibility" id="wiki_visibility" class="form-control input" required="required">
                                <option value="private">Private</option>
                                <option value="public">Public</option>
                            </select>    
                            <div class="help-block with-errors">
                                @if ($errors->has('wiki_visibility'))
                                    <strong>{{ $errors->first('wiki_visibility') }}</strong>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="outline" class="control-label">Short Description</label>
                                <input type="text" name="outline" id="outline" class="form-control input" required="required">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <label for="wiki-visibility" class="control-label">Category</label>
                            <select name="category_id" id="category" class="form-control input" required="required">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>    
                        </div>
                    </div>
                	<div class="form-group">
                		<label for="wiki-description" class="control-label">Description</label>
            			<textarea name="wiki_description" id="wiki-description" class="form-control">{{ htmlentities($wiki->description) }}</textarea>
                	</div>
                	<ul class="list-unstyled list-inline">
                		<li>
    		                <input type="submit" class="btn btn-primary" value="Save">
                		</li>
                		<li>
                            <a href="{{ route('wikis.show', [$organization->slug, $wiki->slug]) }}" class="btn btn-default" onclick="if(window.confirm('Leave edit mode? \n All unsaved changes will be lost.')) {   } else { return false; }">Cancel</a>
                		</li>
                	</ul>
                    <div class="clearfix"></div>
                </form>
    	    </div>
    	</div>
    </div>
@endsection