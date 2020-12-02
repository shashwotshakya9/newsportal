@extends('layouts.apps')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Author</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('author.index') }}"> Back</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $author->name }}
            </div>
        </div>
        <img src="{{ url('uploads/author/'.$author->image) }}" alt="image" width="300px;" height="300px;" alt="image" />
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Publish:</strong>
                <div id="data-container">{{ $author->publish }}</div>
            </div>
            
        </div>
    </div>
@endsection
