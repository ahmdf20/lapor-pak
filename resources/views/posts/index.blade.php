@extends('layout.app')

@section('content')

<div class="d-flex justify-content-end">
    <a href="{{ route('post.create') }}" class="btn btn-outline-success">Tambahkan Post</a>
</div>

<table class="table table-hover mt-5">
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Title</th>
            <th colspan="2">Action</th>
        </tr>
    </thead>
    <tbody>


        @foreach ($posts as $post)
        @php
        $image = \App\Models\Image::find($post->image_id);
        @endphp
        <tr>
            <td scope="row"></td>
            <td>{{ $post->title }}</td>
            <td><img src="{{ storage_path('app/public/' . $image->path) }}" alt=""></td>
            <td><a href="{{ route('post.edit', $post->id) }}" class="badge badge-warning">Edit</a></td>
            <td>
                <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="badge badge-danger">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection