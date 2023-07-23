@extends('layouts.app')

@section('title', 'Add File')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="p-4 card-header">
                        <h3 class="d-inline">Add New File</h3>
                    </div>
                    <div class="card-body">
                        <form action="/drive" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file" id="file" class="btn btn-outline-primary"
                                accept=".jpg,.jpeg,.bmp,.png,.gif,.doc,.docx,.csv,.rtf,.xlsx,.xls,.pdf,.zip" required>
                            <button type="submit" class="btn btn-outline-primary p-2 mx-lg-2">Add file</button>
                            <span class="text-dark">Max size is 1000 MB</span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
