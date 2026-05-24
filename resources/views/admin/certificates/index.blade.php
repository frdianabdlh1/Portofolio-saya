<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Certificates</h2>
            <a href="{{ route('admin.certificates.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700">
                + Tambah Certificate
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
                            <th class="pb-2 pr-4">Gambar</th>
                            <th class="pb-2 pr-4">Nama</th>
                            <th class="pb-2 pr-4">Penerbit</th>
                            <th class="pb-2 pr-4">Tahun</th>
                            <th class="pb-2 pr-4">Published</th>
                            <th class="pb-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($certificates as $cert)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 pr-4">
                                @if($cert->image_url)
                                    <img src="{{ $cert->image_url }}" class="w-12 h-12 object-cover rounded">
                                @else
                                    <span class="text-2xl">{{ $cert->emoji ?? '📄' }}</span>
                                @endif
                            </td>
                            <td class="py-3 pr-4 font-medium">{{ $cert->name }}</td>
                            <td class="py-3 pr-4 text-gray-500">{{ $cert->issuer }}</td>
                            <td class="py-3 pr-4 text-gray-500">{{ $cert->year }}</td>
                            <td class="py-3 pr-4">
                                @if($cert->is_published)
                                    <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded text-xs">Published</span>
                                @else
                                    <span class="bg-gray-100 text-gray-500 px-2 py-0.5 rounded text-xs">Draft</span>
                                @endif
                            </td>
                            <td class="py-3 flex gap-3">
                                <a href="{{ route('admin.certificates.edit', $cert) }}"
                                    class="text-blue-500 hover:text-blue-700 text-xs">Edit</a>
                                <form action="{{ route('admin.certificates.destroy', $cert) }}" method="POST"
                                    onsubmit="return confirm('Hapus certificate ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-xs">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                            <tr><td colspan="6" class="py-6 text-center text-gray-400">Belum ada certificate.</td></tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">{{ $certificates->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>