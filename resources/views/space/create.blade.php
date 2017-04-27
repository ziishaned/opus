@extends('layouts.master')

@section('content')
    <div class="create-category-form-con">
        <h1 class="header">Create space</h1>
        <form action="{{ route('spaces.store', [ $team->slug ]) }}" method="POST" role="form">
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name" class="control-label">Space Name</label>
                <input type="text" name="name" class="form-control" id="name" autocomplete="off" required>
                @if($errors->has('name'))
                    <p class="help-block has-error">{{ $errors->first('name') }}</p>
                @else
                    <p class="help-block">Enter space name here. e.g. Sales</p>
                @endif
            </div>
            <div class="form-group">
                <label class="control-label" for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="2"></textarea>
                <p class="help-block">Describe a little about space.</p>
            </div>
            <div style="margin-top: 15px;">
                <input type="submit" class="btn btn-success pull-right" value="Save">
                <a href="{{ route('dashboard', [$team->slug]) }}" class="btn btn-link pull-right">Cancel</a>
            </div>
        </form>
    </div>
@endsection