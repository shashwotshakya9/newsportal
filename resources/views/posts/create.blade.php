@extends('layouts.apps')



@section('content')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Post</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('posts.index') }}"> Back</a>
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
    <form action="{{ url('addposts') }}" method="POST" id="create_post" enctype="multipart/form-data">
    	@csrf
        <div class="row">  
        
         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Name:</strong>
		            <input type="text" name="name" class="form-control" placeholder="Name">
		        </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">    
                    {{ Form::label('categories', 'Categories:') }}
                    <select class="form-control select2-multi" name="categories[]" multiple="multiple">
                        @foreach($categories as $category)
                            <option value='{{ $category->id }}'>{{ $category->name }}</option>
                        @endforeach
				    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">    
            {{ Form::label('author_id', 'Author:') }}
				<select class="form-control" name="author_id">
					@foreach($authors as $author)
						<option value='{{ $author->id }}'>{{ $author->name }}</option>
					@endforeach
                </select>
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
		            <strong>Content:</strong>
		            <textarea class="form-control detail" height="400px" id="detail" name="detail" placeholder="Enter Content"></textarea>
                    
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
                    <strong>Publish:</strong>
                    {{-- <input type="hidden" value="0" name="publish" class="switch-input"> --}}
                    <input type="checkbox" name="publish" class="switch-input" value="1" />
		        </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		            <button type="submit" class="btn btn-primary" value="">Submit</button>
		    </div>
		</div>
    </form>
    
<script type="text/javascript" src="{{ URL::asset('js/select2.min.js') }}"></script>
<script type="text/javascript">
    $('.select2-multi').select2();
</script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>  
<script type="text/javascript">
    tinymce.init({
        selector: 'textarea.detail',
        height: 400,
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount'
        ],
        toolbar: 'undo redo | formatselect | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | help',
        content_css: '//www.tiny.cloud/css/codepen.min.css'
    });
</script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>


<script>
    // var content=tinymce.activeEditor.getContent('detail');
    // console.log(content);
    tinyMCE.get('detail').getContent();
</script>
    
@endsection
