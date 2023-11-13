@extends('layouts.admin')

@section('content')
    <div class="container">

        <a class="btn btn-secondary mt-2" href="{{ route('projects.index') }}">
            <i class="fa-solid fa-arrow-left"></i> Back to Projects List
        </a>

        <h2 class="my-5 display-3 fw-bold text-muted">Your project n° : #{{ $project->id }}
        </h2>

        <div class="row py-4">

            <div class="col">
                <div class="card mb-3 shadow-lg bg-dark text-white">

                    <div class="row g-0 p-4">
                        <div class="col-lg-5 text-center py-2">

                            @if ($project->cover_image)
                                {{-- <img width="300" src="{{ asset('storage/placeholders' . $project->cover_image) }}"
                                        alt=""> --}}
                                <img class="img-fluid rounded-2"
                                    src="https://picsum.photos/400/400?random={{ $project->id }}">
                            @else
                                N/A
                            @endif
                            {{-- @if (str_contains($project->cover_image, 'http'))
                                <img class="img-fluid rounded-start" src="{{ $project->cover_image }}" alt="">
                            @else
                                N/A
                            @endif --}}

                        </div>
                        <div class="col-lg-7">
                            <div class="card-body">
                                <h5 class="card-title fs-4 my-4"><span class="text-white-50">Title:
                                    </span>{{ $project->title }}
                                </h5>

                                <p class="card-text fs-5 py-4"><span class="text-white-50">Description:
                                    </span>{{ $project->description }}</p>

                            </div>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-end bg-secondary bg-gradient align-items-center gap-4">

                        <a class="btn btn-outline-dark" href="http://127.0.0.1:8000/projects/{{ $project->id }}"
                            target="_blank" rel="noopener noreferrer">
                            <i class="fa-solid fa-link fa-lg"></i>
                        </a>

                        <a class="btn btn-outline-dark" href="https://github.com/MatteoNocera?tab=repositories"
                            target="_blank" rel="noopener noreferrer">
                            <i class="fa-brands fa-github fa-lg"></i>
                        </a>

                        {{-- <a href="{{ route('projects.edit', $project) }}" class="btn btn-secondary ms-4">Edit</a> --}}
                        <a href="{{ route('projects.edit', $project) }}" class="btn btn-outline-dark"><i
                                class="fa-solid fa-file-pen"></i></a>

                        <!-- Modal trigger button -->
                        {{-- <button type="button" class="btn btn-danger ms-4" data-bs-toggle="modal" data-bs-target="#modalId">
                            Delete
                        </button> --}}
                        <a type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalId">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>

                        <!-- Modal Body -->
                        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                        <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static"
                            data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg"
                                role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger">
                                        <h5 class="modal-title" id="modalTitleId">Delete Project</h5>

                                        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-5">
                                        <h4>Do you really want to delete this Project?</h4>
                                    </div>


                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>

                                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST">

                                            @csrf

                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger">Confirm</button>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>




    </div>
@endsection
