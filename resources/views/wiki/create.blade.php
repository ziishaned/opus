@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h3 style="margin: 0px;">Create a new wiki</h3>
            <p style="margin-bottom: 10px;">A wiki contains all the pages with informative text for your project.</p>
            <form action="{{ route('wikis.store') }}" method="POST" role="form" style="margin-bottom: 15px;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <div class="input-group flat-input-con">
                                    <span class="input-group-addon input-label">Wiki path</span>
                                    <select class="form-control flat-ui-select" style="box-shadow: none; outline: none; border-color: rgba(34,36,38,.15) !important; border-left: 0px; height: 45px;">
                                        <optgroup label="Organization">
                                            <option value="volvo">Volvo</option>
                                            <option value="saab">Saab</option>
                                        </optgroup>
                                        <optgroup label="Users">
                                            <option value="mercedes">Mercedes</option>
                                            <option value="audi">Audi</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group{{ $errors->has('wiki_name') ? ' has-error' : '' }}">
                                <div class="input-group flat-input-con">
                                    <span class="input-group-addon input-label">Wiki name</span>
                                    <input type="text" name="wiki_name" id="wiki-name" class="form-control input" required="required" autocomplete="off">
                                </div>                                
                                @if ($errors->has('wiki_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('wiki_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group flat-input-con">
                        <span class="input-group-addon input-label" style="vertical-align: top; padding-top: 5px;">Outline</span>
                        <textarea name="outline" id="outline" class="form-control input" rows="3" style="padding: 0;"></textarea>
                    </div>
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