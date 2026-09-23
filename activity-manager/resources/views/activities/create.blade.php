@extends('layouts.app')

@section('content')
<h1>Tambah Kegiatan Baru</h1>

<form action="{{ route('activities.store') }}" method="POST">
    @csrf

    <div>
        <label for="title">Judul:</label>
        <input
            type="text"
            id="title"
            name="title"
            value="{{ old('title') }}"
        >
        @error('title')
            <span style="color:red;">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="description">Deskripsi:</label>
        <textarea
            id="description"
            name="description"
        >{{ old('description') }}</textarea>
    </div>

    <div>
        <label for="activity_date">Tanggal:</label>
        <input
            type="date"
            id="activity_date"
            name="activity_date"
            value="{{ old('activity_date') }}"
        >
        @error('activity_date')
            <span style="color:red;">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="category">Kategori:</label>
        <input
            type="text"
            id="category"
            name="category"
            value="{{ old('category') }}"
        >
        @error('category')
            <span style="color:red;">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="status">Status:</label>
        <select id="status" name="status">
            <option value="Planned">Planned</option>
            <option value="Ongoing">Ongoing</option>
            <option value="Done">Done</option>
        </select>
    </div>

    <button type="submit">Simpan</button>
</form>

<a href="{{ route('activities.index') }}">Kembali</a>
@endsection