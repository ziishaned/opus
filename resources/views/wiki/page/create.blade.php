@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            @include('layouts.partials.wiki-nav')
            <div class="row" style="margin-top: 10px;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <form action="{{ route('wikis.pages.store', $wiki->slug) }}" method="POST" role="form" style="margin-bottom: 15px;">
                        <input type="text" class="hide" name="wiki_id" value="{{ $wiki->id }}">
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group{{ $errors->has('page_name') ? ' has-error' : '' }}">
                                    <div class="input-group flat-input-con">
                                        <span class="input-group-addon input-label">Page Name</span>
                                        <input type="text" class="form-control input" name="page_name" required="required">
                                    </div>
                                    @if ($errors->has('page_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('page_name') }}</strong>
                                        </span>
                                    @endif
                                    <p class="text-muted">Great page names are short and memorable.</p>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <div class="input-group flat-input-con">
                                        <span class="input-group-addon input-label" style="width: 90px;">Page parent</span>
                                        <select class="form-control flat-ui-select" name="page_parent" id="timezone" style="box-shadow: none; outline: none; border: 1px solid #F0F0F1; border-left: 0px;">
                                            @foreach($wikiPages as $wikiPage)
                                                <option value="{{ $wikiPage->id }}">{{ $wikiPage->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <p class="text-muted">Leave it blank if this page has no parent.</p>
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
