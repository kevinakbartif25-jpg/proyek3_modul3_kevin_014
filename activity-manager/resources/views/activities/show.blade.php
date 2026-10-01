@extends('layouts.app')

@section('content')
<h1>Detail Kegiatan</h1>

@if (session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

<article>
    <h2>{{ $activity->title }}</h2>
    <p>Kode: {{ $activity->code }}</p>
    <p>Kategori: {{ $activity->category->name }}</p>
    <p>Mulai: {{ $activity->start_at?->format('d M Y H:i') ?? '-' }}</p>
    <p>Selesai: {{ $activity->end_at?->format('d M Y H:i') ?? '-' }}</p>
    <p>Lokasi: {{ $activity->location ?? '-' }}</p>
    <p>Kapasitas: {{ $activity->registered_count }} / {{ $activity->capacity ?? '-' }}</p>
    <p>Status: {{ $activity->status }}</p>
    <p>Deskripsi: {{ $activity->description }}</p>
</article>

<hr>
<h3>Pendaftaran Peserta</h3>

@error('registration')
    <p style="color:red;">{{ $message }}</p>
@enderror

<form action="{{ route('registrations.store', $activity) }}" method="POST">
    @csrf
    <div>
        <label for="participant_name">Nama:</label>
        <input type="text" id="participant_name" name="participant_name" value="{{ old('participant_name') }}">
        @error('participant_name')
            <span style="color:red;">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" value="{{ old('email') }}">
        @error('email')
            <span style="color:red;">{{ $message }}</span>
        @enderror
    </div>
    <button type="submit">Daftar</button>
</form>

<h4>Daftar Peserta ({{ $activity->registrations->count() }})</h4>
<ul>
    @forelse ($activity->registrations as $registration)
        <li>{{ $registration->participant_name }} - {{ $registration->email }}</li>
    @empty
        <li>Belum ada pendaftar.</li>
    @endforelse
</ul>

<a href="{{ route('activities.index') }}">Kembali ke Daftar</a>
@endsection