@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div>
                        <h3 class="headin-no-margin mb5">Create wiki</h3>
                        <p class="text-muted">A wiki contains all the pages with informative text for your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    </div>
                    <hr>
                    <form action="{{ route('wikis.store', [$organization->slug]) }}" method="POST" role="form" class="mb15">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <h2 class="mt0">Basic information</h2>
                                <p class="text-muted">Beatae doloribus sapiente earum iusto hic labore porro facilis.</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
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
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="outline" class="control-label">Short Description</label>
                                            <input type="text" name="outline" id="outline" class="form-control input">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
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
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="wiki-visibility" class="control-label">Category</label>
                                            <select name="category_id" id="category" class="form-control input" required="required">
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="page-description-input">
                            <h2 class="headin-no-margin mb5">Description</h2>
                            <p class="text-muted mb20">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste pariatur nemo hic sunt.</p>
                            <textarea id="wiki-description" name="wiki_description"></textarea>
                        </div>
                        <input type="submit" class="btn btn-primary pull-right" id="create-wiki-btn" value="Create Wiki">
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection