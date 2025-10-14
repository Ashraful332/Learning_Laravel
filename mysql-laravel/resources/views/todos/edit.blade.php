@extends('layouts.app')

@section('content')
    <h2 style="margin-bottom: 20px;">Todo এডিট করুন</h2>

    <form action="{{ route('todos.update', $todo) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div>
            <label for="title">Title *</label>
            <input type="text" id="title" name="title" value="{{ old('title', $todo->title) }}" required>
            @error('title')
                <span style="color: red; font-size: 12px;">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4">{{ old('description', $todo->description) }}</textarea>
            @error('description')
                <span style="color: red; font-size: 12px;">{{ $message }}</span>
            @enderror
        </div>

        <div style="margin-top: 20px; display: flex; gap: 10px;">
            <button type="submit" class="btn btn-success">আপডেট করুন</button>
            <a href="{{ route('todos.index') }}" class="btn btn-danger">Cancel</a>
        </div>
    </form>
@endsection