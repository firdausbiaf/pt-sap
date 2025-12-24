@extends('layout.dashboard.main')

@section('content')
<div class="table-responsive col-lg-10 mx-5 mt-4">

    <h2>Project Data</h2>
    <br>

    {{-- CREATE BUTTON --}}
    <a href="{{ route('projects.create') }}" class="btn btn-primary mx-2">
        Create Project
    </a>

    <br><br>

    {{-- TABLE --}}
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Project Name</th>
                    <th scope="col">Location</th>
                    <th scope="col">Owner(s)</th>
                    <th scope="col">Contractor(s)</th>
                    <th scope="col">Project Value</th>
                    <th scope="col">Duration (Days)</th>
                    <th scope="col">Use Subcon</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>

            <tbody>

                {{-- EMPTY STATE --}}
                @if ($projects->isEmpty())
                    <tr>
                        <td colspan="9" class="text-center text-muted">
                            No projects available.
                        </td>
                    </tr>
                @else

                    @foreach ($projects as $project)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $project->name }}</td>
                        <td>{{ $project->location }}</td>

                        {{-- OWNERS --}}
                        <td>
                            @forelse ($project->owners as $owner)
                                <span class="badge bg-secondary">
                                    {{ $owner->name }}
                                </span>
                            @empty
                                -
                            @endforelse
                        </td>

                        {{-- CONTRACTORS --}}
                        <td>
                            @forelse ($project->contractors as $contractor)
                                <span class="badge bg-dark">
                                    {{ $contractor->name }}
                                </span>
                            @empty
                                -
                            @endforelse
                        </td>

                        <td>
                            {{ number_format($project->project_value, 0, ',', '.') }}
                        </td>

                        <td>
                            {{ $project->duration_days }}
                        </td>

                        <td>
                            @if ($project->use_subcon)
                                <span class="badge bg-success">Yes</span>
                            @else
                                <span class="badge bg-secondary">No</span>
                            @endif
                        </td>

                        <td>
                            {{ $project->status_label }}
                        </td>

                        {{-- ACTION --}}
                        <td>
                            <a href="{{ route('projects.show', $project->id) }}"
                               class="badge bg-info"
                               style="text-decoration: none;">
                                Show
                            </a>

                            <a href="{{ route('projects.edit', $project->id) }}"
                               class="badge bg-warning"
                               style="text-decoration: none;">
                                Edit
                            </a>

                            <form action="{{ route('projects.destroy', $project->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="badge bg-danger border-0"
                                        onclick="return confirm('Are you sure you want to delete this project?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                @endif

            </tbody>
        </table>
    </div>

</div>
@endsection
