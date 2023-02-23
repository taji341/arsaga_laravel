<x-app-layout>
    <div class="mx-auto p-4 sm:p-6 lg:p-8">
        <form method="GET" action="{{ route('posts.index', ['id' => $current_folder_id]) }}">
            @csrf
            <label for="keyword">メモを検索</label>
                <input
                    name="keyword"
                    id="keyword"
                    type="text"
                    placeholder="メモ内容"
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    value="{{ $keyword }}" />
            <x-primary-button class="mt-4">検索する</x-primary-button>
        </form>
        <form>
            <label for="date">期限日検索</label>
                <input 
                    type="date"
                    name="from"
                    id="date"
                    placeholder="検索開始日"
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    value="{{ $from }}" />
            <label for="to"></label>
                <input type="date"
                name="to"
                id="to"
                placeholder="検索終了日"
                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                value="{{ $to }}" />
            <x-primary-button class="mt-4">検索する</x-primary-button>
        </form>
        <form method="POST" action="{{ route('folders.create') }}">
            @csrf
            <label for="title">フォルダを作成</label>
                <input
                    name="title"
                    id="title"
                    type="text"
                    placeholder="フォルダ名"
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
            <x-primary-button class="mt-4">作成する</x-primary-button>
        </form>
        <div>
            @foreach($folders as $folder)
                <a href="{{ route('posts.index', ['id' => $folder->id]) }}">
                    <x-secondary-button class="mt-4 {{ $current_folder_id === $folder->id ? 'bg-blue-300' : '' }}">
                        {{ $folder->title }}
                    </x-secondary-button>
                </a>
            @endforeach
        </div>
        <a href="{{ route('posts.create', ['id' => $current_folder_id]) }}" class="">
            <x-primary-button class="mt-4">
                <p>メモ新規作成</p>
            </x-primary-button>
        </a>
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @foreach ($posts as $post)
                <div class="p-6 flex space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-gray-800">{{ Auth::user()->name }}</span>
                                <small class="ml-2 text-sm text-gray-600">編集日{{ $post->created_at }}</small>
                                <small class="ml-2 text-sm text-gray">期限日{{ $post->date }}</small>
                            </div>
                            <x-dropdown>
                                <x-slot name="trigger">
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('posts.edit', ['id' => $current_folder_id, $post])">
                                        <p>編集する</p>
                                    </x-dropdown-link>
                                    <form method="POST" action="{{ route('posts.destroy', ['id' => $current_folder_id, $post]) }}">
                                        @csrf
                                        @method('delete')
                                        <x-dropdown-link :href="route('posts.destroy', ['id' => $current_folder_id, $post])" onclick="event.preventDefault(); this.closest('form').submit();">
                                            <p>削除する</p>
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                        <p class="mt-4 text-lg text-gray-900">{{ $post->message }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
<script>
    flatpickr(document.getElementById('to'), {
        locale: 'ja',
        dateFormat: "Y/m/d",
        minDate: new Date()
    });
</script>
