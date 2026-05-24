<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($project->id) ? 'Edit Project' : 'Tambah Project Baru' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form
                    action="{{ isset($project->id) ? route('admin.projects.update', $project) : route('admin.projects.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="space-y-4">
                    @csrf
                    @if(isset($project->id)) @method('PUT') @endif

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Judul Project *</label>
                            <input type="text" name="title" value="{{ old('title', $project->title) }}"
                                class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500" required>
                            @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tahun *</label>
                            <input type="number" name="year" value="{{ old('year', $project->year ?? date('Y')) }}"
                                min="2000" max="{{ date('Y') + 1 }}"
                                class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500" required>
                            @error('year')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                        <input type="text" name="slug" value="{{ old('slug', $project->slug) }}"
                            placeholder="otomatis dari judul jika kosong"
                            class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi *</label>
                        <textarea name="description" rows="4"
                            class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500" required>{{ old('description', $project->description) }}</textarea>
                        @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tech Stack</label>
                        <input type="text" name="tech_stack"
                            value="{{ old('tech_stack', is_array($project->tech_stack) ? implode(', ', $project->tech_stack) : '') }}"
                            placeholder="React.js, Laravel, MySQL"
                            class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                        <p class="text-xs text-gray-400 mt-1">Pisahkan dengan koma</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Live URL</label>
                            <input type="url" name="live_url" value="{{ old('live_url', $project->live_url) }}"
                                placeholder="https://..."
                                class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                            @error('live_url')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">GitHub URL</label>
                            <input type="url" name="github_url" value="{{ old('github_url', $project->github_url) }}"
                                placeholder="https://github.com/..."
                                class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Thumbnail</label>
                        @if(isset($project->thumbnail) && $project->thumbnail)
                            <img src="{{ $project->thumbnail_url }}" class="w-24 h-16 object-cover rounded mb-2">
                            <p class="text-xs text-gray-400 mb-2">Upload baru untuk mengganti.</p>
                        @endif
                        <input type="file" name="thumbnail" accept="image/jpg,image/jpeg,image/png,image/webp"
                            class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                        <p class="text-xs text-gray-400 mt-1">JPG, PNG, WEBP — maks 4MB</p>
                        @error('thumbnail')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Urutan Tampil</label>
                        <input type="number" name="order" value="{{ old('order', $project->order ?? 0) }}"
                            min="0" style="max-width:120px"
                            class="border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                        <p class="text-xs text-gray-400 mt-1">Angka lebih kecil tampil lebih dulu</p>
                    </div>

                    <div class="space-y-2">
                        <div class="flex items-center gap-2">
                            <input type="hidden" name="is_published" value="0">
                            <input type="checkbox" name="is_published" id="is_published" value="1"
                                {{ old('is_published', $project->is_published ?? true) ? 'checked' : '' }}>
                            <label for="is_published" class="text-sm text-gray-700">Tampilkan di portfolio</label>
                        </div>
                        <div class="flex items-center gap-2">
                            <input type="hidden" name="is_featured" value="0">
                            <input type="checkbox" name="is_featured" id="is_featured" value="1"
                                {{ old('is_featured', $project->is_featured ?? false) ? 'checked' : '' }}>
                            <label for="is_featured" class="text-sm text-gray-700">Featured project</label>
                        </div>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded text-sm font-medium hover:bg-blue-700 transition">
                            {{ isset($project->id) ? 'Simpan Perubahan' : 'Tambah Project' }}
                        </button>
                        <a href="{{ route('admin.projects.index') }}"
                            class="bg-gray-100 text-gray-700 px-6 py-2 rounded text-sm font-medium hover:bg-gray-200 transition">
                            Batal
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>