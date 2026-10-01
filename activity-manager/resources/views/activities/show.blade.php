@extends('layouts.app')

@section('content')
<h1>Detail Kegiatan</h1>
<article>
    <h2>{{ $activity->title }}</h2>
    <p>Mulai: {{ $activity->start_at?->format('d M Y H:i') ?? '-' }}</p>
    <p>Selesai: {{ $activity->end_at?->format('d M Y H:i') ?? '-' }}</p>
    <p>Lokasi: {{ $activity->location ?? '-' }}</p>
    <p>Kapasitas: {{ $activity->capacity ?? '-' }}</p>
    <p>Kode: {{ $activity->code }}</p>
    <p>Kategori: {{ $activity->category->name }}</p>
    <p>Status: {{ $activity->status }}</p>
    <p>Deskripsi: {{ $activity->description }}</p>
</article>
<a href="{{ route('activities.index') }}">Kembali ke Daftar</a>
@endsection