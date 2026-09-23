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
        <label for="category">Kategori:</label>
        <input
            type="text"
            id="category"
            name="category"
            value="{{ old('category', $activity->category) }}"
        >
        @error('category')
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