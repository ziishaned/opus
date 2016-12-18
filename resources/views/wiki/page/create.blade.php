@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            @include('layouts.partials.wiki-nav')
            <div class="row" style="margin-top: 10px;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h3 style="margin: 0px;">New page</h3>
                    <p style="margin-bottom: 10px;">A wiki contains all the pages with informative text for your project.</p>
                    <form action="{{ route('wikis.pages.store', [$organization->slug, $wiki->slug]) }}" method="POST" role="form" style="margin-bottom: 15px;">
                        <input type="text" class="hide" name="wiki_id" value="{{ $wiki->id }}">
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group{{ $errors->has('page_name') ? ' has-error' : '' }}">
                                    <label for="page-name">Page Name</label>
                                    <input type="text" id="page-name" class="form-control input" name="page_name" required="required">
                                    @if ($errors->has('page_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('page_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="page-parent">Page parent</label>
                                    <select class="form-control" name="page_parent" id="page-parent">
                                        @foreach($wikiPages as $wikiPage)
                                            <option value="{{ $wikiPage->id }}">{{ $wikiPage->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="page-description-input">
                            <label for="page-description">Description</label>
                            <textarea id="page-description" name="page_description"></textarea>
                        </div>
                        <input type="submit" class="btn btn-default" id="create-page-btn" value="Create Page">
                        <div class="clearfix"></div>
                    </form>        
                </div>
            </div>
        </div>
    </div>
@endsection
