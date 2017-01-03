@extends('layouts.app')

@section('content')
    <div class="container">
        <div style="margin-bottom: 10px; margin-top: 10px; height: 50px;">
            <div class="site-breadcrumb">
                <ul class="list-unstyled list-inline" style="margin-bottom: 0px;">
                    <li>
                        <a href="#">Facebook</a>
                    </li>
                    <li>
                        <a href="#">Wikis</a>
                    </li>
                    <li class="active">
                        <a href="#">Create wiki</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h3 style="margin: 0px;">New wiki</h3>
                <p style="margin-bottom: 10px;">A wiki contains all the pages with informative text for your project.</p>
                <form action="{{ route('wikis.store', [$organization->slug]) }}" method="POST" role="form" style="margin-bottom: 15px;">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group{{ $errors->has('wiki_name') ? ' has-error' : '' }}">
                                <label for="wiki-name" class="control-label">Wiki name</label>
                                <input type="text" name="wiki_name" id="wiki-name" class="form-control input" required="required" autocomplete="off">          
                                @if ($errors->has('wiki_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('wiki_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <label for="wiki-visibility" class="control-label">Visibility Level</label>
                            <select name="wiki_visibility" id="wiki_visibility" class="form-control" required="required">
                                <option></option>
                                <option value="private">Private</option>
                                <option value="public">Public</option>
                            </select>    
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="outline" class="control-label">Short Description</label>
                                <input type="text" name="outline" id="outline" class="form-control input">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <label for="wiki-visibility" class="control-label">Category</label>
                            <select name="category" id="category" class="form-control" placeholder="Select a category" required="required">
                               <option></option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>    
                        </div>
                    </div>
                    <div class="form-group" id="page-description-input">
                        <label for="wiki-description" class="control-label">Description</label>
                        <textarea id="wiki-description" name="wiki_description"></textarea>
                    </div>
                    <input type="submit" class="btn btn-primary pull-right" id="create-wiki-btn" value="Create Wiki">
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
@endsection