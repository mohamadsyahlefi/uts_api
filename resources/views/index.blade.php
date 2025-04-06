@extends('layouts.app')

@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<a href="{{ route('tasks.create') }}" class="btn btn-custom mb-3">Tambah Tugas</a>
<div class="list-group">
    @foreach($tasks as $task)
        <div class="task-item list-group-item d-flex flex-column">
            <div>
                <h5>{{ $task->title }}</h5>
                <small>Dibuat: {{ $task->created_at->format('d-m-Y H:i:s') }}</small><br>
                <small>Diperbarui: {{ $task->updated_at->format('d-m-Y H:i:s') }}</small>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-2">
                <span class="badge status-badge {{ $task->status == 'Selesai' ? 'bg-success' : 'bg-warning' }}">
                    {{ $task->status }}
                </span>
            </div>
            <div class="mt-2">
                <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-info btn-sm">Detail</a>
                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection