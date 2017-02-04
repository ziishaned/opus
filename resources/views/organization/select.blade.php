@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <div class="row" style="margin-top: 80px;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-lg-offset-4">
                    <h1 class="text-center" style="margin-bottom: 20px;">Select a organization</h1>
                    <form action="{{ route('organizations.set.post') }}" method="POST" role="form">
                        <div class="form-group">
                            <select name="organization" class="form-control" required="required">
                                @foreach($organizations as $organization)
                                    <option value="{{ $organization->slug }}">{{ $organization->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Select</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
