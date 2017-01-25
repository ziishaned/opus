@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 40px;">
        <div class="row" id="ms-container">
            @foreach($categories as $category)
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <a href="#" class="category-showcase">
                        <div class="panel panel-default">
                            <div class="panel-body" style="box-shadow: 0 1px 2px rgba(0,0,0,0.05), 0 5px 10px rgba(0,0,0,0.05);">
                                <div class="category-body" style="margin-bottom: 15px;">
                                    <h3 style="font-weight: 400; margin-bottom: 10px; margin-top: 0px;">{{ $category->name }}</h3>
                                    <p style="font-size: 13px; line-height: 20px; color: #616161; -webkit-text-stroke: 0px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit suscipit error alias voluptates nihil nemo mollitia vitae tempora! Dolorum voluptates quisquam et voluptatem earum corporis, maxime eum iure consequatur quo.</p>
                                </div>
                                <div class="category-foot">
                                    <div class="pull-left">
                                        <p style="font-size: 13px; line-height: 20px; color: #616161; -webkit-text-stroke: 0px;"><span class="glyphicon glyphicon-book" style="width: 1.28571429em; text-align: center;"></span> <span>{{ $category->wikis->count() }}</span> Wikis</p>
                                    </div>
                                    <div class="pull-right" style="position: relative; top: -2px;">
                                        <ul style="margin-bottom: 0;" class="list-unstyled list-inline category-actions">
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
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
