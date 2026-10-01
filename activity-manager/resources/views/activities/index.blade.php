@extends('layouts.app')

@section('content')
<h1>Daftar Kegiatan</h1>

<a href="{{ route('activities.create') }}" style="padding: 5px 10px; background: #007bff; color: white; text-decoration: none;">+ Tambah Kegiatan</a>
<a href="{{ route('activities.trash') }}" style="margin-left: 10px;">Data Terhapus</a>
<a href="{{ route('categories.index') }}" style="margin-left: 10px;">Kategori</a>
<hr>

@if (session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif
@if ($errors->has('status'))
    <p style="color:red;">{{ $errors->first('status') }}</p>
@endif

<!-- Search, filter, dan sort -->
<form method="GET" action="{{ route('activities.index') }}" style="margin-bottom: 15px;">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode / judul">

    <select name="category_id">
        <option value="">Semua kategori</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <select name="status">
        <option value="">Semua status</option>
        @foreach (['draft', 'published', 'completed'] as $option)
            <option value="{{ $option }}" @selected(request('status') === $option)>{{ $option }}</option>
        @endforeach
    </select>

    <select name="sort">
        <option value="latest" @selected(request('sort') !== 'oldest')>Terbaru</option>
        <option value="oldest" @selected(request('sort') === 'oldest')>Terlama</option>
    </select>

    <button type="submit">Terapkan</button>
    <a href="{{ route('activities.index') }}">Reset</a>
</form>

@forelse ($activities as $activity)
<article style="margin-bottom: 15px;">
    <h2>
        <a href="{{ route('activities.show', $activity) }}">{{ $activity->title }}</a>
    </h2>

    <p>Kode: {{ $activity->code }} | Kategori: {{ $activity->category->name }}</p>
    <p>{{ $activity->start_at?->format('d M Y H:i') ?? 'Belum dijadwalkan' }} - Status: {{ $activity->status }}</p>

    <a href="{{ route('activities.edit', $activity) }}">Edit</a> |

    @if ($activity->status === 'draft')
        <form action="{{ route('activities.publish', $activity) }}" method="POST" style="display:inline;">
            @csrf
            @method('PATCH')
            <button type="submit">Publish</button>
        </form> |
    @elseif ($activity->status === 'published')
        <form action="{{ route('activities.complete', $activity) }}" method="POST" style="display:inline;">
            @csrf
            @method('PATCH')
            <button type="submit">Complete</button>
        </form> |
    @endif

    <form action="{{ route('activities.destroy', $activity) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Pindahkan kegiatan ini ke data terhapus?')">Hapus</button>
    </form>
</article>
@empty
    <p>Belum ada kegiatan.</p>
@endforelse

<style>nav svg { width: 20px; height: 20px; }</style>
{{ $activities->links() }}
@endsection