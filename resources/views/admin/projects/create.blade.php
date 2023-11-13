@extends('layouts.admin')

@section('content')
    <div class="container">

        <a class="btn btn-secondary mt-2" href="{{ route('projects.index') }}">
            <i class="fa-solid fa-arrow-left"></i> Back to Projects List
        </a>

        <h2 class="my-5 display-3 fw-bold text-muted">Create New Project</h1>

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card shadow">
                <div class="card-body">
                    <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">

                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" @error('title') is-invalid @enderror name="title"
                                id="title" aria-describedby="help_title" placeholder="Type new project title here"
                                value="{{ old('title', $project->title) }}">
                            <small id="help_title" class="form-text text-muted">Type max 50 characters</small>
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="type_id" class="form-label">Types</label>
                            <select class="form-select" name="type_id" id="type_id">
                                <option selected disabled>Select a type</option>
                                <option value="">None</option>

                                @forelse ($types as $type)
                                    <option value="{{ $type->id }}" {{ $type->id == old('type_id') ? 'selected' : '' }}>
                                        {{ $type->name }}</option>
                                @empty
                                @endforelse

                            </select>
                        </div>
                        @error('type_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" @error('description') is-invalid @enderror
                                name="description" id="description" aria-describedby="help_description"
                                placeholder="Type new project description here"value="{{ old('description', $project->description) }}">
                            <small id="help_description" class="form-text text-muted">Type max 50 characters</small>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="cover_image" class="form-label">Choose file</label>
                            <input type="file" class="form-control" name="cover_image" id="cover_image" placeholder=""
                                aria-describedby="fileHelpId">
                            <div id="fileHelpId" class="form-text">Add an Image, MAX 500kb</div>
                            @error('cover_image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button class="btn btn-primary" type="submit">Save</button>

                    </form>
                </div>
            </div>
    </div>
@endsection
