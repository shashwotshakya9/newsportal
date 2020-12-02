@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Posts</h2>
            </div>
            <div class="pull-right">
                @can('post-create')
                <a class="btn btn-success" href="{{ route('posts.create') }}"> Create New Post</a>
                @endcan
            </div>
        </div>
    </div><br>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Author</th>
            <th>Details</th>
            <th>Images</th>
            <th width="280px">Action</th>
        </tr>
        </thead>
	    @foreach ($posts as $post )
	    <tr>
	        <td>{{ ++$i }}</td>
            <td>{{ $post->name }}</td>
            <td>@foreach($post->categories as $category)
                <span>{{ $category->name }}<br></span>
                @endforeach
            </td>            
            <td>{{ $post->author->name }}</td> 
            
            
            <td>{!! $post->detail !!}</td>
            <td><img src="{{ url('uploads/'.$post->image) }}" alt="image" width="100px;" height="100px;" alt="image" /> </td>
            <td>
                <form action="{{ route('posts.destroy',$post->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('posts.show',$post->id) }}">Show</a>
                    @can('post-edit')
                    <a class="btn btn-primary" href="{{ route('posts.edit',$post->id) }}">Edit</a>
                    @endcan
                    @csrf
                    @method('DELETE')
                    @can('post-delete')
                    
                    <button type="submit" class="btn btn-danger">Delete</button>
                    
                    @endcan
                    
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>
    {!! $posts->links() !!}
    {{-- {!! $categories->links() !!} --}}
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
    
    <script>
        // var content=tinymce.activeEditor.getContent('detail');
        // console.log(content);
        tinyMCE.get('detail').getContent();
    </script>
@endsection