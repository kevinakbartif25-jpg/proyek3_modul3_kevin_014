@extends('layouts.app')

@section('content')
<h1>Data Kegiatan Terhapus</h1>

<a href="{{ route('activities.index') }}">&larr; Kembali ke Daftar Kegiatan</a>
<hr>

@if (session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

@forelse ($activities as $activity)
<article style="margin-bottom: 15px;">
    <h2>{{ $activity->title }}</h2>
    <p>Kode: {{ $activity->code }} | Kategori: {{ $activity->category->name }}</p>
    <p>Status: {{ $activity->status }} | Dihapus pada: {{ $activity->deleted_at->format('d M Y H:i') }}</p>

    <form action="{{ route('activities.restore', $activity->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('PATCH')
        <button type="submit">Restore</button>
    </form>
</article>
@empty
    <p>Tidak ada kegiatan yang dihapus.</p>
@endforelse

<style>nav svg { width: 20px; height: 20px; }</style>
{{ $activities->links() }}
@endsection