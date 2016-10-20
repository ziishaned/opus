@extends('layouts.app')

@section('content')
    <div class="row" style="margin-top: 20px;">
        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-lg-offset-2">
            <h3 style="margin: 0px; margin-bottom: 8px;">Create a new wiki</h3>
            <p class="text-muted">A wiki contains all the pages with informative text for your project.</p>   
            <hr>
            <form action="{{ route('wikis.store') }}" method="POST" role="form" style="margin-bottom: 15px;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                            <div class="form-group" style="margin: 0;">
                                <label for="" class="control-label">Owner</label>
                                <select id="organization-input" name="organization_id" placeholder="Find and select organization..">
                                    @if(!is_null($organizationId))
                                        <option value="{{ $organizationId }}" selected>{{ ViewHelper::getOrganizationName($organizationId) }}</option>
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
                    <button class="btn btn-success" id="add-page-description" style="margin-bottom: 12px;">Add Wiki Description</button>
                    <p class="well" style="padding: 7px; font-weight: 600; color: #777;"><i class="fa fa-info-circle"></i> Whenever this wiki will be opened this description will appear in front of user.</p>
                </div>
                <div class="form-group hide" id="page-description-input">
                    <textarea id="page-description" name="page_description"></textarea>
                </div>
                <input type="submit" class="btn btn-success hide pull-right" id="create-wiki-btn" value="Create Wiki">
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
@endsection