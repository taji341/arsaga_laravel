<x-app-layout>
    <div class="mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" enctype="multipart/form-data" action="{{ route('posts.store', ['id' => $folder_id]) }}">
            @csrf
            <label for="message">メモを作成</label>
            <textarea
                name="message"
                id="message"
                placeholder="メモを入力"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('message') }}</textarea>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <div class="mt-4">
                <label for="date" class="mt-4">期限日</label>
                <input 
                    type="text"
                    class="block border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    name="date"
                    id="date"
                    value="{{ old('date') }}" />
                <x-input-error :messages="$errors->get('date')" class="mt-2" />
              </div>
              <div class="mt-4">
                <label for="img" class="mt-4">画像ファイル(必須ではありません)</label>
                <input 
                    type="file"
                    name="img"
                    id="img"
                    class="block">
              </div>
            <x-primary-button class="mt-4 mb-4">
                <p>作成する</p>
            </x-primary-button>
        </form>
        <a href="{{ route('posts.index', ['id' => $folder_id]) }}">
            <x-secondary-button>
                <p>一覧へ戻る</p>
            </x-secondary-button>
        </a>
    </div>
</x-app-layout>
