@extends('layouts.master')

@section('content')
    <div class="aside-content create-wiki-aside">
        <div class="row no-container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="page-header">
                    <img src="/img/icons/basic_notebook_pen.svg" width="28" height="28" class="icon"> Create Wiki
                </div>
                <form action="{{ route('wikis.update', [$team->slug, $wiki->category->slug, $wiki->slug ]) }}" method="POST" role="form" class="create-wiki-form">
                    {{ method_field('patch') }}
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            <h4>Basic information</h4>
                            <p class="text-muted">Beatae doloribus sapiente earum iusto hic labore porro facilis.</p>
                        </div>
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-8 col-lg-8">
                                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                        <label class="control-label" for="name">Name</label>
                                        <input type="text" name="name" value="{{ $wiki->name }}" class="form-control" id="name" required>
                                        @if($errors->has('name'))
                                            <p class="help-block has-error">{{ $errors->first('name') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
                                    <div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
                                        <label for="category" class="control-label">Category</label>
                                        <select name="category" id="category" class="form-control" required>
                                            <option value="">Select a category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" @if($wiki->category->id === $category->id) selected @endif>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('category'))
                                            <p class="help-block has-error">{{ $errors->first('category') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-8 col-sm-8 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label class="control-label" for="outline">Outline</label>
                                        <input type="text" name="outline" value="{{ $wiki->outline }}" id="outline" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="wiki-description">Description</label>
                        <textarea name="description" class="form-control" rows="22" id="wiki-description">{{ $wiki->description }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-success pull-right">Update</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
@endsection