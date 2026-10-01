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
        <label for="code">Kode:</label>
        <input type="text" id="code" name="code" value="{{ old('code') }}">
        @error('code')
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
        <label for="location">Lokasi:</label>
        <input type="text" id="location" name="location" value="{{ old('location') }}">
        @error('location') <span style="color:red;">{{ $message }}</span> @enderror
    </div>
    <div>
        <label for="start_at">Mulai:</label>
        <input type="datetime-local" id="start_at" name="start_at" value="{{ old('start_at') }}">
        @error('start_at') <span style="color:red;">{{ $message }}</span> @enderror
    </div>
    <div>
        <label for="end_at">Selesai:</label>
        <input type="datetime-local" id="end_at" name="end_at" value="{{ old('end_at') }}">
        @error('end_at') <span style="color:red;">{{ $message }}</span> @enderror
    </div>
    <div>
        <label for="capacity">Kapasitas:</label>
        <input type="number" id="capacity" name="capacity" value="{{ old('capacity') }}">
        @error('capacity') <span style="color:red;">{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="category_id">Kategori:</label>
        <select id="category_id" name="category_id">
            <option value="">-- Pilih kategori --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
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