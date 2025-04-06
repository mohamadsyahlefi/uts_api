@extends('layouts.app')

@section('content')
<h2>Detail Tugas</h2>
<div class="task-item">
    <h5>{{ $task->title }}</h5>
    <p>{{ $task->description }}</p>
    <p><strong>Dibuat:</strong> {{ $task->created_at->format('d-m-Y H:i:s') }}</p>
    <p><strong>Diperbarui:</strong> {{ $task->updated_at->format('d-m-Y H:i:s') }}</p>
    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection