@extends('layouts.app')

@section('title', 'File View')

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
                        <h3 class="d-inline">File View</h3>
                        <a href='{{ route('drive.create') }}' class="btn btn-outline-primary float-end">Add New File</a>
                    </div>

                    <div class="card-body">
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
                                        @if(str_contains($file->type, 'office'))
                                            application/office
                                        @elseif(str_contains($file->type, 'zip'))
                                            application/zip
                                        @else
                                            {{$file->type}}
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{route('drive.destroy', $file->name)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input class="btn text-danger ml-4" type="submit" value="delete">
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="py-5 text-center">
                            @if(explode('/', $file->type)[0] === 'image')
                                <img class="img-fluid" src="/files/{{$file->name}}">
                            @else
                                <img class="img-fluid" src="/assets/imgs/file.png">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
