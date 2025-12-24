<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $projects = Project::with([
            'owners',
            'contractors'
        ])->orderBy('created_at', 'asc')->get();

        return view('dashboard.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = User::where('role', 'member')->get();
        return view('dashboard.projects.create', compact('members'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'location'      => 'required|string|max:255',
            'project_value' => 'required|numeric|min:0',
            'start_date'    => 'required|date',
            'end_date'      => 'required|date|after_or_equal:start_date',
            'status'        => 'required|in:' . implode(',', Project::STATUSES),
            'use_subcon'    => 'required|boolean',
            'owner_id'      => 'nullable|exists:users,id',
            'contractor_id' => 'nullable|exists:users,id',
        ]);

        // minimal 1 relasi
        if (!$request->owner_id && !$request->contractor_id) {
            return back()
                ->withErrors(['user' => 'Project must have at least one owner or contractor.'])
                ->withInput();
        }

        DB::transaction(function () use ($request) {

            $project = Project::create([
                'name'          => $request->name,
                'location'      => $request->location,
                'project_value' => $request->project_value,
                'start_date'    => $request->start_date,
                'end_date'      => $request->end_date,
                'use_subcon'    => $request->use_subcon ?? false,
                'status'        => $request->status,
            ]);

            if ($request->owner_id) {
                $project->users()->attach($request->owner_id, [
                    'type' => 'owner'
                ]);
            }

            if ($request->contractor_id) {
                $project->users()->attach($request->contractor_id, [
                    'type' => 'contractor'
                ]);
            }
        });

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $project->load('users');
        return view('dashboard.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $project->load(['owners', 'contractors']);

        $owners = User::where('role', 'member')->get();
        $contractors = User::where('role', 'member')->get();

        return view('dashboard.projects.edit', compact(
            'project',
            'owners',
            'contractors'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'location'      => 'required|string|max:255',
            'project_value' => 'required|numeric|min:0',
            'start_date'    => 'required|date',
            'end_date'      => 'required|date|after_or_equal:start_date',
            'status'        => 'required|in:' . implode(',', Project::STATUSES),
            'use_subcon'    => 'required|boolean',
            'owner_id'      => 'nullable|exists:users,id',
            'contractor_id' => 'nullable|exists:users,id',
        ]);

        if (!$request->owner_id && !$request->contractor_id) {
            return back()
                ->withErrors(['user' => 'Project must have at least one owner or contractor.'])
                ->withInput();
        }

        DB::transaction(function () use ($request, $project) {

            $project->update([
                'name'          => $request->name,
                'location'      => $request->location,
                'project_value' => $request->project_value,
                'start_date'    => $request->start_date,
                'end_date'      => $request->end_date,
                'use_subcon'    => $request->use_subcon ?? false,
                'status'        => $request->status,
            ]);

            $syncData = [];

            if ($request->owner_id) {
                $syncData[$request->owner_id] = ['type' => 'owner'];
            }

            if ($request->contractor_id) {
                $syncData[$request->contractor_id] = ['type' => 'contractor'];
            }

            $project->users()->sync($syncData);
        });

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->users()->detach();
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
