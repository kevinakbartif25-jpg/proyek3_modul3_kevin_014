@extends('layouts.app')

@section('content')
<h1>Daftar Kegiatan</h1>

<!-- Tombol ke halaman Tambah -->
<a href="{{ route('activities.create') }}" style="padding: 5px 10px; background: #007bff; color: white; text-decoration: none;">+ Tambah Kegiatan</a>
<hr>

@forelse ($activities as $activity)
<article style="margin-bottom: 15px;">
    <h2>
        <a href="{{ route('activities.show', $activity) }}">
            {{ $activity->title }}
        </a>
    </h2>
    <p>{{ $activity->activity_date->format('d M Y') }} - Status: {{ $activity->status }}</p>
    
    <!-- Tombol Edit -->
    <a href="{{ route('activities.edit', $activity) }}">Edit</a> | 

    <!-- Tombol Hapus -->
    <form action="{{ route('activities.destroy', $activity) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
    </form>
</article>
@empty
    <p>Belum ada kegiatan.</p>
@endforelse
@endsection