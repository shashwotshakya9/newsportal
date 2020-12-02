@extends('layouts.apps')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Author</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('author.index') }}"> Back</a>
            </div>
        </div>
    </div>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ url('updateauthor',$author->id) }}" method="POST" enctype="multipart/form-data">
    	@csrf
        @method('PUT')

        <input type="hidden" name="id" value="{{ $author->id }}" id="id">
         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Name:</strong>
		            <input type="text" name="name" value="{{ $author->name }}" class="form-control" placeholder="Name">
		        </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Change Image:</strong>
                    <input id="image" type="file" name="image" class="btn-success">
                </div>
                <strong>Current Image:</strong><br>
                <img src="{{ url('uploads/author/'.$author->image) }}" alt="image" width="300px;" height="300px;" alt="image" />
		    </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Publish:</strong>
                    {{-- {!! Form::checkbox('publish', '1', array('class' => 'form-control')) !!} --}}
                    {!! Form::checkbox('publish', '0', array('class' => 'form-control')) !!}
                    {{-- <input type="checkbox" name="publish" class="switch-input" value="1" {{ old('publish') ? 'checked="checked"' : '' }}/> --}}
                    
		        </div>
            </div>   
            
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		      <button type="submit" class="btn btn-primary">Submit</button>
		    </div>
		</div>


    </form>


@endsection