@extends('layout.dashboard.main')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center align-items-center">

        <div class="card" style="width: 32rem;">
            <div class="card-header">
                Project Detail
            </div>

            <div class="card-body">
                <ul class="list-group list-group-flush">

                    <li class="list-group-item">
                        <b>ID :</b> {{ $project->id }}
                    </li>

                    <li class="list-group-item">
                        <b>Project Name :</b> {{ $project->name }}
                    </li>

                    <li class="list-group-item">
                        <b>Location :</b> {{ $project->location }}
                    </li>

                    <li class="list-group-item">
                        <b>Project Value :</b>
                        {{ number_format($project->project_value, 0, ',', '.') }}
                    </li>

                    <li class="list-group-item">
                        <b>Start Date :</b> {{ $project->start_date }}
                    </li>

                    <li class="list-group-item">
                        <b>End Date :</b> {{ $project->end_date }}
                    </li>

                    <li class="list-group-item">
                        <b>Duration :</b> {{ $project->duration_days }} days
                    </li>

                    <li class="list-group-item">
                        <b>Status :</b> {{ $project->status_label }}
                    </li>

                    <li class="list-group-item">
                        <b>Subcon :</b>
                        {{ $project->is_subcon ? 'Yes' : 'No' }}
                    </li>

                    {{-- OWNERS --}}
                    <li class="list-group-item">
                        <b>Owner(s) :</b>
                        @if ($project->owners->count())
                            <ul class="mb-0">
                                @foreach ($project->owners as $owner)
                                    <li>{{ $owner->name }}</li>
                                @endforeach
                            </ul>
                        @else
                            -
                        @endif
                    </li>

                    {{-- CONTRACTORS --}}
                    <li class="list-group-item">
                        <b>Contractor(s) :</b>
                        @if ($project->contractors->count())
                            <ul class="mb-0">
                                @foreach ($project->contractors as $contractor)
                                    <li>{{ $contractor->name }}</li>
                                @endforeach
                            </ul>
                        @else
                            -
                        @endif
                    </li>

                </ul>
            </div>

            <div class="card-footer text-center">
                <a href="{{ route('projects.index') }}" class="btn btn-success">
                    Back
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
