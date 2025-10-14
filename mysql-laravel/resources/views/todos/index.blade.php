@extends('layouts.app')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>সব Todo</h2>
        <a href="{{ route('todos.create') }}" class="btn btn-primary">+ নতুন Todo</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($todos->count() > 0)
        <div style="display: grid; gap: 15px;">
            @foreach($todos as $todo)
                <div style="border: 1px solid #e2e8f0; border-radius: 8px; padding: 15px; 
                            {{ $todo->is_completed ? 'background: #f0fdf4;' : '' }}">
                    <div style="display: flex; justify-content: space-between; align-items: start;">
                        <div style="flex: 1;">
                            <h3 style="margin-bottom: 5px; 
                                {{ $todo->is_completed ? 'text-decoration: line-through; color: #6b7280;' : '' }}">
                                {{ $todo->title }}
                            </h3>
                            @if($todo->description)
                                <p style="color: #6b7280; margin-bottom: 10px;">
                                    {{ $todo->description }}
                                </p>
                            @endif
                            <small style="color: #9ca3af;">
                                তৈরি: {{ $todo->created_at->format('d M Y, h:i A') }}
                            </small>
                        </div>
                        
                        <div style="display: flex; gap: 5px; margin-left: 15px;">
                            <form action="{{ route('todos.toggle', $todo) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn {{ $todo->is_completed ? 'btn-warning' : 'btn-success' }}">
                                    {{ $todo->is_completed ? '↩️ অসম্পূর্ণ' : '✓ সম্পূর্ণ' }}
                                </button>
                            </form>

                            <a href="{{ route('todos.edit', $todo) }}" class="btn btn-primary">✏️ Edit</a>

                            <form action="{{ route('todos.destroy', $todo) }}" method="POST" 
                                  style="display: inline;"
                                  onsubmit="return confirm('আপনি কি নিশ্চিত?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">🗑️ Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div style="text-align: center; padding: 40px; color: #6b7280;">
            <p>কোন Todo নেই। নতুন Todo যোগ করুন!</p>
        </div>
    @endif
@endsection