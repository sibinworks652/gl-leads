<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organisation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class OrganisationController extends Controller
{
    public function index(): View
    {
        $organisations = Organisation::withCount('users')
            ->latest()
            ->paginate(10);

        return view('admin.organisations.index', compact('organisations'));
    }

    public function create(): View
    {
        return view('admin.organisations.create', [
            'organisation' => new Organisation(),
        ]);
    }

    public function store(Request $request): JsonResponse|RedirectResponse
    {
        Organisation::create($this->validatedData($request));

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Organisation created successfully.',
                'redirect' => route('admin.organisations.index'),
            ]);
        }

        return redirect()
            ->route('admin.organisations.index')
            ->with('success', 'Organisation created successfully.');
    }

    public function edit(Organisation $organisation): View
    {
        return view('admin.organisations.edit', compact('organisation'));
    }

    public function update(Request $request, Organisation $organisation): JsonResponse|RedirectResponse
    {
        $organisation->update($this->validatedData($request, $organisation));

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Organisation updated successfully.',
                'redirect' => route('admin.organisations.index'),
            ]);
        }

        return redirect()
            ->route('admin.organisations.index')
            ->with('success', 'Organisation updated successfully.');
    }

    public function destroy(Organisation $organisation): RedirectResponse
    {
        if ($organisation->logo) {
            Storage::disk('public')->delete($organisation->logo);
        }

        $organisation->delete();

        return redirect()
            ->route('admin.organisations.index')
            ->with('success', 'Organisation deleted successfully.');
    }

    protected function validatedData(Request $request, ?Organisation $organisation = null): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['nullable', 'string', 'max:50'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('organisations', 'email')->ignore($organisation?->id),
            ],
            'phone' => ['nullable', 'string', 'max:30'],
            'address' => ['nullable', 'string', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'description' => ['nullable', 'string', 'max:1000'],
            'status' => ['required', 'boolean'],
        ]);

        $validated['slug'] = $this->generateUniqueSlug($validated['name'], $organisation);

        if ($request->hasFile('logo')) {
            if ($organisation?->logo) {
                Storage::disk('public')->delete($organisation->logo);
            }

            $validated['logo'] = $request->file('logo')->store('organisations/logos', 'public');
        }

        return $validated;
    }

    protected function generateUniqueSlug(string $name, ?Organisation $organisation = null): string
    {
        $baseSlug = Str::slug($name);
        $slug = $baseSlug;
        $counter = 1;

        while (
            Organisation::query()
                ->where('slug', $slug)
                ->when($organisation, fn ($query) => $query->whereKeyNot($organisation->id))
                ->exists()
        ) {
            $slug = $baseSlug.'-'.$counter;
            $counter++;
        }

        return $slug;
    }
}
