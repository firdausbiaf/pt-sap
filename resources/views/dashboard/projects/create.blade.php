@extends('layout.dashboard.main')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">

        <div class="card" style="width: 40rem;">
            <div class="card-header">
                Add New Project
            </div>

            <div class="card-body">
                <form action="{{ route('projects.store') }}" method="POST">
                    @csrf

                    {{-- Project Name --}}
                    <div class="mb-3">
                        <label class="form-label">Project Name</label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               value="{{ old('name') }}"
                               required>
                    </div>

                    {{-- Location --}}
                    <div class="mb-3">
                        <label class="form-label">Location</label>
                        <input type="text"
                               name="location"
                               class="form-control"
                               value="{{ old('location') }}"
                               required>
                    </div>

                    {{-- Project Value --}}
                    <div class="mb-3">
                        <label class="form-label">Project Value</label>
                        <input type="number"
                               name="project_value"
                               class="form-control"
                               value="{{ old('project_value') }}">
                    </div>

                    {{-- Start Date --}}
                    <div class="mb-3">
                        <label class="form-label">Start Date</label>
                        <input type="date"
                               name="start_date"
                               class="form-control"
                               value="{{ old('start_date') }}">
                    </div>

                    {{-- End Date --}}
                    <div class="mb-3">
                        <label class="form-label">End Date</label>
                        <input type="date"
                               name="end_date"
                               class="form-control"
                               value="{{ old('end_date') }}">
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

                    {{-- Use Subcontractor --}}
                    <div class="mb-3">
                        <label class="form-label">Use Subcontractor?</label>
                        <div class="form-check ms-4">
                            <input class="form-check-input"
                                type="radio"
                                name="use_subcon"
                                id="use_subcon_yes"
                                value="1"
                                {{ old('use_subcon') === '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="use_subcon_yes">
                                Yes
                            </label>
                        </div>

                        <div class="form-check ms-4">
                            <input class="form-check-input"
                                type="radio"
                                name="use_subcon"
                                id="use_subcon_no"
                                value="0"
                                {{ old('use_subcon', '0') === '0' ? 'checked' : '' }}>
                            <label class="form-check-label" for="use_subcon_no">
                                No
                            </label>
                        </div>
                    </div>

                    {{-- Owner --}}
                    <div class="mb-3">
                        <label class="form-label">Owner</label>
                        <select name="owner_id" class="form-select">
                            <option value="">-- Select Owner (optional) --</option>
                            @foreach ($members as $member)
                                <option value="{{ $member->id }}"
                                    {{ old('owner_id') == $member->id ? 'selected' : '' }}>
                                    {{ $member->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Contractor --}}
                    <div class="mb-3">
                        <label class="form-label">Contractor</label>
                        <select name="contractor_id" class="form-select">
                            <option value="">-- Select Contractor (optional) --</option>
                            @foreach ($members as $member)
                                <option value="{{ $member->id }}"
                                    {{ old('contractor_id') == $member->id ? 'selected' : '' }}>
                                    {{ $member->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('projects.index') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection
