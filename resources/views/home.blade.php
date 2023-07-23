@extends('layouts.app')

@section('title', 'Drive')

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
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Size</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($files as $file)
                                    <tr>
                                        <td>{{ $file->id }}</td>
                                        <td>{{ $file->name }}</td>
                                        <td>
                                            @if ($file->size / 1024 / 1024 < 1)
                                                {{ floor($file->size / 1024) }} kB
                                            @else
                                                {{ floor($file->size / 1024 / 1024) }} MB
                                            @endif
                                        </td>
                                        <td>{{ $file->type }}</td>
                                        <td>
                                            <form action="{{route('drive.destroy', $file->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <a href='{{route('drive.show', $file->id)}}' class="btn btn-outline-primary d-inline" style="padding: 8px 15px;">view</a>
                                                <input class="btn btn-outline-danger ml-4" type="submit" value="delete">
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
