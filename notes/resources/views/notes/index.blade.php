<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @auth
            <div class="max-w-2xl mx-auto mb-10 bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('notes.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <x-text-input name="title" placeholder="Judul..." class="block w-full border-none shadow-none text-xl font-bold focus:ring-0 px-0" autocomplete="off" />
                        </div>
                        <div class="mb-3">
                            <textarea name="content" placeholder="Buat catatan..." rows="3" class="block w-full border-none shadow-none focus:ring-0 px-0 resize-none text-gray-700" required></textarea>
                        </div>
                        
                        <div class="flex items-center justify-between mt-4 border-t border-gray-100 pt-4">
                            <label title="Pilih warna latar catatan" class="cursor-pointer">
                                <input type="color" name="color" value="#ffffff" class="w-8 h-8 rounded-full border-none cursor-pointer p-0 shadow-sm">
                            </label>
                            <x-primary-button>{{ __('Simpan') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
            @endauth
            <div class="columns-1 sm:columns-2 md:columns-3 lg:columns-4 gap-4 space-y-4">
                @foreach($notes as $note)
                    <div class="p-5 rounded-xl shadow-sm border border-gray-200 break-inside-avoid transition transform hover:-translate-y-1 hover:shadow-md" style="background-color: {{ $note->color }};">
                        <h3 class="font-bold text-lg mb-2 text-gray-900">{{ $note->title }}</h3>
                        <p class="text-gray-800 whitespace-pre-wrap leading-relaxed">{{ $note->content }}</p>

                        @auth
                            @if(Auth::id() === $note->user_id)
                                <div class="mt-4 pt-4 border-t border-gray-800 border-opacity-10 flex justify-end space-x-4 text-sm">
                                    <a href="{{ route('notes.edit', $note) }}" class="text-indigo-600 hover:text-indigo-800 font-semibold transition">Edit</a>
                                    <form action="{{ route('notes.destroy', $note) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus catatan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 font-semibold transition">Hapus</button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>
                @endforeach
            </div>

            @if($notes->isEmpty())
                <div class="flex flex-col items-center justify-center mt-20 text-gray-500">
                    <div class="text-6xl mb-4">📭</div>
                    <p class="text-lg font-medium">Belum ada catatan.</p>
                    @guest 
                        <p class="text-sm mt-2">Silakan <a href="{{ route('login') }}" class="text-indigo-600 underline">login</a> untuk mulai membuat catatan pertamamu.</p> 
                    @endguest
                </div>
            @endif
        </div>
    </div>
</x-app-layout>