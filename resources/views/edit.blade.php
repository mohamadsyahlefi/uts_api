@extends('layouts.app')

@section('content')
<h2>Edit Tugas</h2>
<form action="{{ route('tasks.update', $task->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="title">Judul</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ $task->title }}" required>
    </div>
    <div class="form-group">
        <label for="description">Deskripsi</label>
        <textarea class="form-control" id="description" name="description">{{ $task->description }}</textarea>
    </div>
    <div class="form-group select-status">
        <label for="status">Status</label>
        <select class="form-control" id="status" name="status">
            <option value="Belum Dikerjakan" {{ $task->status == 'Belum Dikerjakan' ? 'selected' : '' }}>Belum Dikerjakan</option>
            <option value="Selesai" {{ $task->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
        </select>
    </div>
    <button type="submit" class="btn btn-custom">Update</button>
    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection