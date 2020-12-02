@extends('layouts.apps')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Category</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('category.index') }}"> Back</a>
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


    <form action="{{ url('addcategory') }}" method="POST" id="create_category" enctype="multipart/form-data">
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
		            <strong>Slug:</strong>
		            <input type="text" name="slug" class="form-control" placeholder="Slug">
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