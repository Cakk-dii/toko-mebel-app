@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Categories</h1>
        @can('add categories')
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Add New Category</a>
        @endcan
    </div>

    <table id="myTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>NO</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->description }}</td>
                <td>
                    
                    @can('edit categories')
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    @endcan
                    @can('delete categories')
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                    </form>
                    @endcan
                </td>
            </tr>
            @endforeach
            
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#categories-table').DataTable();
    });
</script>
@endsection
