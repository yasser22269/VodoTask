@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">Notes</div>

                    <div class="card-body">
                        <a href="{{ route('notes.create') }}" class="btn btn-primary mb-3">Create Note</a>

                        <table class="table">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>content</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($notes as $note)
                                <tr>
                                    <td>{{ $note->title }}</td>
                                    <td>{{ Str::limit( $note->content,10) }}</td>
                                    <td>
                                        <a href="{{ route('notes.edit', $note) }}" class="btn btn-secondary">Edit</a>
                                        <form action="{{ route('notes.destroy', $note) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
