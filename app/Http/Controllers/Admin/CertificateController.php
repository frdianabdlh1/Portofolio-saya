<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    public function index(): View
    {
        $certificates = Certificate::orderBy('order')->orderByDesc('year')->paginate(15);
        return view('admin.certificates.index', compact('certificates'));
    }

    public function create(): View
    {
        return view('admin.certificates.form', ['certificate' => new Certificate]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateCertificate($request);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('certificates', 'public');
        }

        Certificate::create($data);

        return redirect()->route('admin.certificates.index')->with('success', 'Sertifikat berhasil ditambahkan!');
    }

    public function edit(Certificate $certificate): View
    {
        return view('admin.certificates.form', compact('certificate'));
    }

    public function update(Request $request, Certificate $certificate): RedirectResponse
    {
        $data = $this->validateCertificate($request);

        if ($request->hasFile('image')) {
            if ($certificate->image) {
                Storage::disk('public')->delete($certificate->image);
            }
            $data['image'] = $request->file('image')->store('certificates', 'public');
        }

        $certificate->update($data);

        return redirect()->route('admin.certificates.index')->with('success', 'Sertifikat berhasil diperbarui!');
    }

    public function destroy(Certificate $certificate): RedirectResponse
    {
        if ($certificate->image) {
            Storage::disk('public')->delete($certificate->image);
        }
        $certificate->delete();

        return back()->with('success', 'Sertifikat berhasil dihapus.');
    }

    private function validateCertificate(Request $request): array
    {
        return $request->validate([
            'name'           => ['required', 'string', 'max:200'],
            'issuer'         => ['required', 'string', 'max:200'],
            'year'           => ['required', 'integer', 'min:2000', 'max:' . (date('Y') + 1)],
            'credential_url' => ['nullable', 'url'],
            'emoji'          => ['nullable', 'string', 'max:10'],
            'order'          => ['integer', 'min:0'],
            'is_published'   => ['boolean'],
            'image'          => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);
    }
}