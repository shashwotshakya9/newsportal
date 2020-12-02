@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Authors Module</h2>
            </div>
            <div class="pull-right">
                @can('author-create')
                <a class="btn btn-success" href="{{ route('author.create') }}"> Create New Author</a>
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
            <th>Image</th>
            <th>Publish</th>
            
            <th width="280px">Action</th>
        </tr>
        </thead>
	    @foreach ($authors as $author)
	    <tr>
	        <td>{{ ++$i }}</td>
            <td>{{ $author->name }}</td>
            <td><img src="{{ url('uploads/author/'.$author->image) }}" alt="image" width="100px;" height="100px;" alt="image" /></td>
            <td>{{ $author->publish }}</td>
            
            <td>
                <form action="{{ route('author.destroy',$author->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('author.show',$author->id) }}">Show</a>
                    @can('author-edit')
                    <a class="btn btn-primary" href="{{ route('author.edit',$author->id) }}">Edit</a>
                    @endcan
                    @csrf
                    @method('DELETE')
                    @can('author-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                    
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>


    {!! $authors->links() !!}



@endsection