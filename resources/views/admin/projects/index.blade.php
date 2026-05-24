<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Projects</h2>
            <a href="{{ route('admin.projects.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700">
                + Tambah Project
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b text-left text-gray-500">
                            <th class="pb-2 pr-4">Thumbnail</th>
                            <th class="pb-2 pr-4">Judul</th>
                            <th class="pb-2 pr-4">Tahun</th>
                            <th class="pb-2 pr-4">Tech Stack</th>
                            <th class="pb-2 pr-4">Published</th>
                            <th class="pb-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($projects as $project)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 pr-4">
                                @if($project->thumbnail)
                                    <img src="{{ $project->thumbnail_url }}" class="w-16 h-10 object-cover rounded">
                                @else
                                    <div class="w-16 h-10 bg-gray-100 rounded flex items-center justify-center text-gray-400 text-xs">No img</div>
                                @endif
                            </td>
                            <td class="py-3 pr-4 font-medium">
                                {{ $project->title }}
                                @if($project->is_featured)
                                    <span class="ml-1 bg-yellow-100 text-yellow-700 text-xs px-1.5 py-0.5 rounded">Featured</span>
                                @endif
                            </td>
                            <td class="py-3 pr-4 text-gray-500">{{ $project->year }}</td>
                            <td class="py-3 pr-4 text-gray-500">
                                @if($project->tech_stack)
                                    {{ implode(', ', array_slice($project->tech_stack, 0, 3)) }}
                                    @if(count($project->tech_stack) > 3)
                                        <span class="text-gray-400">+{{ count($project->tech_stack) - 3 }}</span>
                                    @endif
                                @endif
                            </td>
                            <td class="py-3 pr-4">
                                @if($project->is_published)
                                    <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded text-xs">Published</span>
                                @else
                                    <span class="bg-gray-100 text-gray-500 px-2 py-0.5 rounded text-xs">Draft</span>
                                @endif
                            </td>
                            <td class="py-3 flex gap-3">
                                <a href="{{ route('admin.projects.edit', $project) }}"
                                    class="text-blue-500 hover:text-blue-700 text-xs">Edit</a>
                                <form action="{{ route('admin.projects.destroy', $project) }}" method="POST"
                                    onsubmit="return confirm('Hapus project ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-xs">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                            <tr><td colspan="6" class="py-6 text-center text-gray-400">Belum ada project.</td></tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">{{ $projects->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>