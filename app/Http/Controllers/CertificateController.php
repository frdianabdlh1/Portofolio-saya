<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificate;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'           => 'required|string',
            'issuer'         => 'required|string',
            'year'           => 'required',
            'emoji'          => 'nullable|string',
            'image'          => 'nullable|image|max:2048',
            'credential_url' => 'nullable|url',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('certificates', 'public');
        }

        Certificate::create($data);
        return back()->with('success', 'Certificate added!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, Certificate $certificate)
    {
        $data = $request->validate([
            'name'           => 'required|string',
            'issuer'         => 'required|string',
            'year'           => 'required',
            'emoji'          => 'nullable|string',
            'image'          => 'nullable|image|max:2048',
            'credential_url' => 'nullable|url',
        ]);

        if ($request->hasFile('image')) {
            if ($certificate->image) {
                Storage::disk('public')->delete($certificate->image);
            }
            $data['image'] = $request->file('image')->store('certificates', 'public');
        }

        $certificate->update($data);
        return back()->with('success', 'Certificate updated!');
    }

    public function destroy(Certificate $certificate)
    {
        if ($certificate->image) {
            Storage::disk('public')->delete($certificate->image);
        }
        $certificate->delete();
        return back()->with('success', 'Certificate deleted!');
    }
}