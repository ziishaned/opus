@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="m20">
                        <h2 class="mt0">Categories</h2>
                        <p class="text-muted marginless">Below is the list of categories showing the number of wikis in each. Click to show the wikis inside it.</p>        
                    </div>
                </div>
            </div>
            <div class="row" id="ms-container">
                @foreach($categories as $category)
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 ms-item">
                        <a href="#" class="category-item" data-category-id="{{ $category->id }}" data-organization-slug="{{ $organization->slug }}">
                            <div class="panel panel-default category-item-inner">
                                <div class="panel-body">
                                    <div class="category-body m10">
                                        <h3 class="mt0" id="category-name">{{ $category->name }}</h3>
                                        @if(!empty($category->outline))
                                            <p class="text-muted marginless emoji-text" id="category-outline">{!! $category->outline !!}</p>
                                        @endif
                                    </div>
                                    <div class="category-foot">
                                        <div class="row v-center">
                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                <p class="marginless"><span class="glyphicon glyphicon-book"></span> <span>{{ $category->wikis->count() }}</span> Wikis</p>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
                                                <ul class="marginless list-unstyled list-inline category-actions">
                                                    <li>
                                                        <button class="btn btn-link" id="edit-category"><i class="fa fa-pencil fa-fw"></i></button>
                                                    </li>
                                                    <li>
                                                        <button class="btn btn-link delete-btn" onclick="if(confirm('Are you sure you want to delete this category?')) {event.preventDefault(); document.getElementById('delete-category').submit();}"><i class="fa fa-trash-o fa-fw"></i></button>
                                                        <form id="delete-category" action="{{ route('organizations.categories.destroy', [$organization->slug, $category->id]) }}" method="POST" style="display: none;">
                                                            {!! method_field('delete') !!}
                                                            {!! csrf_field() !!}
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
