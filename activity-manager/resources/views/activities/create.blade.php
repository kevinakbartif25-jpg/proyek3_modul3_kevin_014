@extends('layouts.app')

@section('content')
<h1>Tambah Kegiatan Baru</h1>
<form action="{{ route('activities.store') }}" method="POST">
    @csrf
    <div>
        <label>Judul:</label>
        <input type="text" name="title" value="{{ old('title') }}">
        @error('title') <span style="color:red;">{{ $message }}</span> @enderror
    </div>
    <div>
        <label>Deskripsi:</label>
        <textarea name="description">{{ old('description') }}</textarea>
    </div>
    <div>
        <label>Tanggal:</label>
        <input type="date" name="activity_date" value="{{ old('activity_date') }}">
        @error('activity_date') <span style="color:red;">{{ $message }}</span> @enderror
    </div>
    <div>
        <label>Kategori:</label>
        <input type="text" name="category" value="{{ old('category') }}">
        @error('category') <span style="color:red;">{{ $message }}</span> @enderror
    </div>
    <div>
        <label>Status:</label>
        <select name="status">
            <option value="Planned">Planned</option>
            <option value="Ongoing">Ongoing</option>
            <option value="Done">Done</option>
        </select>
    </div>
    <button type="submit">Simpan</button>
</form>
<a href="{{ route('activities.index') }}">Kembali</a>
@endsection