@extends('layouts.app')

@section('content')
<h1>Edit Kegiatan</h1>

<p>Status saat ini: <strong>{{ $activity->status }}</strong></p>

<form action="{{ route('activities.update', $activity) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="title">Judul:</label>
        <input
            type="text"
            id="title"
            name="title"
            value="{{ old('title', $activity->title) }}"
        >
        @error('title')
            <span style="color:red;">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="code">Kode:</label>
        <input type="text" id="code" name="code" value="{{ old('code', $activity->code) }}">
        @error('code')
            <span style="color:red;">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="description">Deskripsi:</label>
        <textarea
            id="description"
            name="description"
        >{{ old('description', $activity->description) }}</textarea>
    </div>

    <div>
        <label for="location">Lokasi:</label>
        <input type="text" id="location" name="location" value="{{ old('location', $activity->location) }}">
        @error('location')
            <span style="color:red;">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="start_at">Mulai:</label>
        <input
            type="datetime-local"
            id="start_at"
            name="start_at"
            value="{{ old('start_at', $activity->start_at?->format('Y-m-d\TH:i')) }}"
        >
        @error('start_at')
            <span style="color:red;">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="end_at">Selesai:</label>
        <input
            type="datetime-local"
            id="end_at"
            name="end_at"
            value="{{ old('end_at', $activity->end_at?->format('Y-m-d\TH:i')) }}"
        >
        @error('end_at')
            <span style="color:red;">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="capacity">Kapasitas:</label>
        <input type="number" id="capacity" name="capacity" value="{{ old('capacity', $activity->capacity) }}">
        @error('capacity')
            <span style="color:red;">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="category_id">Kategori:</label>
        <select id="category_id" name="category_id">
            <option value="">-- Pilih kategori --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $activity->category_id) == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <span style="color:red;">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit">Perbarui</button>
</form>

<a href="{{ route('activities.index') }}">Kembali</a>
@endsection