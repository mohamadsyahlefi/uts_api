@extends('layouts.app')

@section('content')
<h2>Tambah Tugas</h2>
<form action="{{ route('tasks.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="title">Judul</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="form-group">
        <label for="description">Deskripsi</label>
        <textarea class="form-control" id="description" name="description"></textarea>
    </div>
    <div class="form-group select-status">
        <label for="status">Status</label>
        <select class="form-control" id="status" name="status">
            <option value="Belum Dikerjakan">Belum Dikerjakan</option>
            <option value="Selesai">Selesai</option>
        </select>
    </div>
    <button type="submit" class="btn btn-custom">Simpan</button>
    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection