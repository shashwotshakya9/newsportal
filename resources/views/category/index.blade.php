@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Catagories</h2>
            </div>
            <div class="pull-right">
                @can('category-create')
                <a class="btn btn-success" href="{{ route('category.create') }}"> Create New Category</a>
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
            <th>Slug</th>
            <th>Publish</th>
            
            <th width="280px">Action</th>
        </tr>
        </thead>
	    @foreach ($categories as $category)
	    <tr>
	        <td>{{ ++$i }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->slug }}</td>
            <td>{{ $category->publish }}</td>
            
            <td>
                <form action="{{ route('category.destroy',$category->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('category.show',$category->id) }}">Show</a>

                    @can('category-edit')
                    <a class="btn btn-primary" href="{{ route('category.edit',$category->id) }}">Edit</a>
                    @endcan

                    @csrf
                    @method('DELETE')
                    @can('category-delete')
                    
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                    
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>


    {!! $categories->links() !!}



@endsection