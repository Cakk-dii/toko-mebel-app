@extends('layouts.app')

@section('title', isset($category) ? 'Edit Category' : 'Add Category')

@section('content')
<div class="container mt-4">
    <h1>{{ isset($category) ? 'Edit Category' : 'Add Category' }}</h1>

    <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" method="POST">
        @csrf
        @if (isset($category))
        @method('PUT')
        @endif

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $category->name ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $category->description ?? '') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">{{ isset($category) ? 'Update' : 'Save' }}</button>
        <!-- <input type="submit" class="btn btn-primary" name="submit" value=""> -->
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
