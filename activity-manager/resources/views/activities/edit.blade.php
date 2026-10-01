@extends('layouts.app')

@section('content')
<h1>Edit Kegiatan</h1>

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
        <label for="activity_date">Tanggal:</label>
        <input
            type="date"
            id="activity_date"
            name="activity_date"
            value="{{ old('activity_date', $activity->activity_date->format('Y-m-d')) }}"
        >
        @error('activity_date')
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

    <div>
        <label for="status">Status:</label>
        <select id="status" name="status">
            <option value="Planned" @selected($activity->status == 'Planned')>
                Planned
            </option>
            <option value="Ongoing" @selected($activity->status == 'Ongoing')>
                Ongoing
            </option>
            <option value="Done" @selected($activity->status == 'Done')>
                Done
            </option>
        </select>
    </div>

    <button type="submit">Perbarui</button>
</form>

<a href="{{ route('activities.index') }}">Kembali</a>
@endsection