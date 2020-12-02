@extends('layouts.apps')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Author</h2>
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


    <form action="{{ url('addauthor') }}" method="POST" id="create_author" enctype="multipart/form-data">
    	@csrf
        <input type="hidden" name="id" class="form-control" placeholder="id">
        <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Name:</strong>
		            <input type="text" name="name" class="form-control" placeholder="Name">
		        </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Add Image:</strong>
                    <input id="image" type="file" name="image" class="btn-success">
                </div>
		    </div>
                        
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
                    <strong>Publish:</strong>
                    {!! Form::checkbox('publish', '0', array('class' => 'form-control')) !!}    
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		            <button type="submit" class="btn btn-primary" value="">Submit</button>
		    </div>
		</div>
    </form>
       
@endsection