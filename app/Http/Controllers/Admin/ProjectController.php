<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        $projects = Project::orderBy('order')->orderByDesc('year')->paginate(15);
        return view('admin.projects.index', compact('projects'));
    }

    public function create(): View
    {
        return view('admin.projects.form', ['project' => new Project]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateProject($request);
        $data = $this->handleThumbnail($request, $data);

        Project::create($data);

        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil ditambahkan!');
    }

    public function edit(Project $project): View
    {
        return view('admin.projects.form', compact('project'));
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $data = $this->validateProject($request, $project);
        $data = $this->handleThumbnail($request, $data, $project);

        $project->update($data);

        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil diperbarui!');
    }

    public function destroy(Project $project): RedirectResponse
    {
        if ($project->thumbnail) {
            Storage::disk('public')->delete($project->thumbnail);
        }
        $project->delete();
        return back()->with('success', 'Project berhasil dihapus.');
    }

    private function validateProject(Request $request, ?Project $project = null): array
    {
        return $request->validate([
            'title'        => ['required', 'string', 'max:200'],
            'slug'         => ['nullable', 'string', 'max:220'],
            'description'  => ['required', 'string'],
            'live_url'     => ['nullable', 'url'],
            'github_url'   => ['nullable', 'url'],
            'tech_stack'   => ['nullable', 'string'],
            'year'         => ['required', 'integer', 'min:2000', 'max:' . (date('Y') + 1)],
            'order'        => ['integer', 'min:0'],
            'is_featured'  => ['boolean'],
            'is_published' => ['boolean'],
            'thumbnail'    => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);
    }

    private function handleThumbnail(Request $request, array $data, ?Project $existing = null): array
    {
        if (isset($data['tech_stack'])) {
            $data['tech_stack'] = array_map('trim', explode(',', $data['tech_stack']));
        }

        $data['slug'] = Str::slug($data['slug'] ?? $data['title']);

        if ($request->hasFile('thumbnail')) {
            if ($existing?->thumbnail) {
                Storage::disk('public')->delete($existing->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('projects', 'public');
        }

        return $data;
    }
}