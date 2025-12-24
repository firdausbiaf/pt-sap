@extends('layout.dashboard.main')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">

        <div class="card" style="width: 40rem;">
            <div class="card-header">
                Edit Project
            </div>

            <div class="card-body">
                <form action="{{ route('projects.update', $project->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Project Name --}}
                    <div class="mb-3">
                        <label class="form-label">Project Name</label>
                        <input type="text" name="name" class="form-control"
                               value="{{ old('name', $project->name) }}">
                    </div>

                    {{-- Location --}}
                    <div class="mb-3">
                        <label class="form-label">Location</label>
                        <input type="text" name="location" class="form-control"
                               value="{{ old('location', $project->location) }}">
                    </div>

                    {{-- Project Value --}}
                    <div class="mb-3">
                        <label class="form-label">Project Value</label>
                        <input type="number" name="project_value" class="form-control"
                               value="{{ old('project_value', $project->project_value) }}">
                    </div>

                    {{-- Start Date --}}
                    <div class="mb-3">
                        <label class="form-label">Start Date</label>
                        <input type="date" name="start_date" class="form-control"
                            value="{{ old('start_date', $project->start_date?->format('Y-m-d')) }}">
                    </div>

                    {{-- End Date --}}
                    <div class="mb-3">
                        <label class="form-label">End Date</label>
                        <input type="date" name="end_date" class="form-control"
                            value="{{ old('end_date', $project->end_date?->format('Y-m-d')) }}">
                    </div>

                    {{-- Status --}}
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            @foreach (\App\Models\Project::STATUSES as $status)
                                <option value="{{ $status }}"
                                    {{ (old('status', $project->status ?? '') == $status) ? 'selected' : '' }}>
                                    {{ ucfirst(str_replace('_', ' ', $status)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Subcon --}}
                    <div class="mb-3">
                        <label class="form-label d-block">Subcon</label>

                        <div class="form-check form-check-inline ms-4">
                            <input class="form-check-input"
                                type="radio"
                                name="is_subcon"
                                id="subcon_yes"
                                value="1"
                                {{ old('is_subcon', $project->is_subcon) == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="subcon_yes">
                                Yes
                            </label>
                        </div>

                        <div class="form-check form-check-inline ms-4">
                            <input class="form-check-input"
                                type="radio"
                                name="is_subcon"
                                id="subcon_no"
                                value="0"
                                {{ old('is_subcon', $project->is_subcon) == 0 ? 'checked' : '' }}>
                            <label class="form-check-label" for="subcon_no">
                                No
                            </label>
                        </div>
                    </div>

                    {{-- Owner --}}
                    <div class="mb-3">
                        <label class="form-label">Owner</label>
                        <select name="owner_id" class="form-select">
                            <option value="">-- Select Owner --</option>
                            @foreach ($owners as $owner)
                                <option value="{{ $owner->id }}"
                                    {{ optional($project->owners->first())->id === $owner->id ? 'selected' : '' }}>
                                    {{ $owner->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Contractor --}}
                    <div class="mb-3">
                        <label class="form-label">Contractor</label>
                        <select name="contractor_id" class="form-select">
                            <option value="">-- Select Contractor --</option>
                            @foreach ($contractors as $contractor)
                                <option value="{{ $contractor->id }}"
                                    {{ optional($project->contractors->first())->id === $contractor->id ? 'selected' : '' }}>
                                    {{ $contractor->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="d-flex justify-content-between">
                        <a href="{{ route('projects.index') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                        <button class="btn btn-primary">
                            Update
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection