@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 20px;">
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
                                <div class="help-block with-errors">
                                    @if ($errors->has('wiki_name'))
                                        <strong>{{ $errors->first('wiki_name') }}</strong>
                                    @endif
                                </div>
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