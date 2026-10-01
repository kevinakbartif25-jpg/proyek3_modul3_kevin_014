@extends('layouts.app')

@section('content')
<h1>Detail Kegiatan</h1>
<article>
    <h2>{{ $activity->title }}</h2>
    <p>Tanggal: {{ $activity->activity_date->format('d M Y') }}</p>
    <p>Kode: {{ $activity->code }}</p>
    <p>Kategori: {{ $activity->category->name }}</p>
    <p>Status: {{ $activity->status }}</p>
    <p>Deskripsi: {{ $activity->description }}</p>
</article>
<a href="{{ route('activities.index') }}">Kembali ke Daftar</a>
@endsection