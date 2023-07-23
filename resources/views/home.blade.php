@extends('layouts.app')

@section('title', 'File Upload')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="container">
                @if (session()->has('successMessage'))
                    <div class="alert alert-success text-center" role="alert">
                        <h5>{{ session()->get('successMessage') }}</h5>
                    </div>
                @elseif (session()->has('deleteMessage'))
                    <div class="alert alert-danger text-center" role="alert">
                        <h5>{{ session()->get('deleteMessage') }}</h5>
                    </div>
                @endif
                <div class="card">
                    <div class="p-4 card-header">
                        <h3 class="d-inline">Files</h3>
                        <a href='{{ route('drive.create') }}' class="btn btn-outline-primary float-end">Add New File</a>
                    </div>

                    <div class="card-body">
                        @if (count($files) > 0)
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Size</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($files as $file)
                                        <tr>
                                            <td>{{ $file->name }}</td>
                                            <td>
                                                @if ($file->size / 1024 / 1024 < 1)
                                                    {{ floor($file->size / 1024) }} kB
                                                @else
                                                    {{ floor($file->size / 1024 / 1024) }} MB
                                                @endif
                                            </td>
                                            <td>
                                                @if (str_contains($file->type, 'office'))
                                                    application/office
                                                @elseif(str_contains($file->type, 'zip'))
                                                    application/zip
                                                @else
                                                    {{ $file->type }}
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('drive.destroy', $file->name) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href='{{ route('drive.show', $file->id) }}'
                                                        class="btn text-primary d-inline">View</a>
                                                    <input class="btn text-danger" type="submit" value="Delete">
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class=" p-2">
                                <h4 class="d-inline">
                                    There is no files uploaded yet
                                </h4>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
