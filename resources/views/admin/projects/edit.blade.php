@extends('layouts.admin')

@section('content')
    <div class="container py-4">

        <a class="btn btn-secondary mt-2" href="{{ route('projects.index') }}">
            <i class="fa-solid fa-arrow-left"></i> Back to Projects List
        </a>

        <div class="row row-cols-1 justify-content-around">
            <div class="col">
                <h2 class="my-5 display-3 fw-bold text-muted">Edit Project Id: #{{ $project->id }}</h1>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <form action="{{ route('projects.update', $project) }}" method="post" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" id="title"
                                class="form-control @error('title') is-invalid @enderror" placeholder=""
                                value="{{ old('title', $project->title) }}"
                                aria-describedby="project_id:{{ $project->id }}">
                            <small id="project_id:{{ $project->id }}"></small>
                        </div>

                        <div class="mb-3">
                            <label for="type_id" class="form-label">Types</label>
                            <select class="form-select @error('type_id') is-invalid @enderror" name="type_id"
                                id="type_id">
                                <option selected disabled>Select a type</option>
                                <option value="">None</option>

                                @forelse ($types as $type)
                                    <option value="{{ $type->id }}"
                                        {{ $type->id == old('type_id', $project->type_id) ? 'selected' : '' }}>
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
                            <textarea type="text" rows="7" name="description" id="description"
                                class="form-control @error('description') is-invalid @enderror">{{ old('description', $project->description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="cover_image" class="form-label">Update Project Image</label>
                            <input type="file" class="form-control" name="cover_image" id="cover_image" placeholder=""
                                aria-describedby="fileHelpId">

                        </div>

                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>

                        <a class="btn btn-secondary" href="{{ route('projects.index') }}">
                            Cancel
                        </a>

                    </form>

            </div>
        </div>
    </div>
@endsection
