<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $certificate->exists ? 'Edit Certificate' : 'Tambah Certificate' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form
                    action="{{ $certificate->exists ? route('admin.certificates.update', $certificate) : route('admin.certificates.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="space-y-4">
                    @csrf
                    @if($certificate->exists) @method('PUT') @endif

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Sertifikat *</label>
                            <input type="text" name="name" value="{{ old('name', $certificate->name) }}"
                                class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                            @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Penerbit *</label>
                            <input type="text" name="issuer" value="{{ old('issuer', $certificate->issuer) }}"
                                class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                            @error('issuer')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tahun *</label>
                            <input type="number" name="year" value="{{ old('year', $certificate->year ?? date('Y')) }}"
                                class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                            @error('year')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Emoji (opsional)</label>
                            <input type="text" name="emoji" value="{{ old('emoji', $certificate->emoji) }}"
                                class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500"
                                placeholder="🏆">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Sertifikat (opsional)</label>
                        @if($certificate->image_url)
                            <img src="{{ $certificate->image_url }}" class="w-24 h-24 object-cover rounded mb-2">
                            <p class="text-xs text-gray-400 mb-2">Upload baru untuk mengganti gambar lama.</p>
                        @endif
                        <input type="file" name="image" accept="image/*"
                            class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                        <p class="text-xs text-gray-400 mt-1">Max 2MB. Format: JPG, PNG, WebP</p>
                        @error('image')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">URL Credential (opsional)</label>
                        <input type="url" name="credential_url" value="{{ old('credential_url', $certificate->credential_url) }}"
                            class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500"
                            placeholder="https://...">
                        @error('credential_url')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Order</label>
                        <input type="number" name="order" value="{{ old('order', $certificate->order ?? 0) }}"
                            class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                    </div>

                    <div class="flex items-center gap-2">
                        <input type="hidden" name="is_published" value="0">
                        <input type="checkbox" name="is_published" value="1" id="is_published"
                            {{ old('is_published', $certificate->is_published) ? 'checked' : '' }}>
                        <label for="is_published" class="text-sm text-gray-700">Published (tampil di portfolio)</label>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded text-sm font-medium hover:bg-blue-700 transition">
                            {{ $certificate->exists ? 'Update' : 'Simpan' }}
                        </button>
                        <a href="{{ route('admin.certificates.index') }}"
                            class="bg-gray-100 text-gray-700 px-6 py-2 rounded text-sm font-medium hover:bg-gray-200 transition">
                            Batal
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>