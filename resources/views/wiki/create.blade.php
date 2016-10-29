@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h3 style="margin: 0px;">Create a new wiki</h3>
            <p class="text-muted" style="margin: 0;">A wiki contains all the pages with informative text for your project.</p>
            <hr>
            <form action="{{ route('wikis.store') }}" method="POST" role="form" style="margin-bottom: 15px;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                            <div class="form-group" style="margin: 0;">
                                <label for="" class="control-label">Owner</label>
                                <select id="organization-input" name="organization_id" placeholder="Find and select organization..">
                                    @if(!is_null($organization))
                                        <option value="{{ $organization->id }}" selected>{{ $organization->name }}</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 separator" style="padding: 0; width: 10px; font-size: 30px; position: relative; top: 22px; font-family: 'Open Sans'; font-weight: 300;"></div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group{{ $errors->has('wiki_name') ? ' has-error' : '' }}" style="margin: 0;">
                                <label for="wiki-name" class="control-label">Wiki Name</label>
                                <input type="text" name="wiki_name" id="wiki-name" class="form-control" required="required">
                                
                                @if ($errors->has('wiki_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('wiki_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <p class="text-muted">Great wiki names are short and memorable.</p>
                </div>
                <div class="form-group">
                    <label for="outline">Outline</label>
                    <input type="text" id="outline" name="outline" class="form-control">
                </div>
                <div class="form-group" id="page-description-input">
                    <label for="page-description">Description</label>
                    <textarea id="page-description" name="page_description"></textarea>
                </div>
                <input type="submit" class="btn btn-success pull-right" id="create-wiki-btn" value="Create Wiki">
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
@endsection