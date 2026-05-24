<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- STATS --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white shadow-sm rounded-lg p-5">
                    <div class="text-2xl font-bold text-gray-800">{{ $stats['projects'] }}</div>
                    <div class="text-sm text-gray-500 mt-1">Projects</div>
                </div>
                <div class="bg-white shadow-sm rounded-lg p-5">
                    <div class="text-2xl font-bold text-gray-800">{{ $stats['certificates'] }}</div>
                    <div class="text-sm text-gray-500 mt-1">Certificates</div>
                </div>
                <div class="bg-white shadow-sm rounded-lg p-5">
                    <div class="text-2xl font-bold text-gray-800">{{ $stats['messages'] }}</div>
                    <div class="text-sm text-gray-500 mt-1">Messages
                        @if($stats['unread'] > 0)
                            <span class="ml-1 bg-red-100 text-red-600 text-xs px-1.5 py-0.5 rounded-full">{{ $stats['unread'] }} unread</span>
                        @endif
                    </div>
                </div>
                <div class="bg-white shadow-sm rounded-lg p-5">
                    <div class="text-2xl font-bold text-gray-800">{{ $stats['comments'] }}</div>
                    <div class="text-sm text-gray-500 mt-1">Comments
                        @if($stats['pending'] > 0)
                            <span class="ml-1 bg-yellow-100 text-yellow-600 text-xs px-1.5 py-0.5 rounded-full">{{ $stats['pending'] }} pending</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- QUICK LINKS --}}
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h3 class="text-sm font-semibold text-gray-700 mb-4">Kelola</h3>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('admin.projects.index') }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700">Projects</a>
                    <a href="{{ route('admin.certificates.index') }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700">Certificates</a>
                    <a href="{{ route('admin.messages.index') }}"
                        class="bg-gray-100 text-gray-700 px-4 py-2 rounded text-sm hover:bg-gray-200">Messages</a>
                    <a href="{{ route('admin.comments.index') }}"
                        class="bg-gray-100 text-gray-700 px-4 py-2 rounded text-sm hover:bg-gray-200">Comments</a>
                </div>
            </div>

            {{-- LATEST MESSAGES --}}
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h3 class="text-sm font-semibold text-gray-700 mb-4">Pesan Terbaru</h3>
                @forelse($latestMessages as $msg)
                <div class="border-b py-3 text-sm">
                    <div class="flex justify-between">
                        <span class="font-medium">{{ $msg->name }}</span>
                        <span class="text-gray-400 text-xs">{{ $msg->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="text-gray-500 truncate">{{ $msg->subject }}</div>
                </div>
                @empty
                    <p class="text-gray-400 text-sm">Belum ada pesan.</p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>s