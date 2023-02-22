<x-app-layout>
    <div class="mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('posts.update', ['id' => $post->folder_id, 'post' => $post->id]) }}">
            @csrf
            @method('patch')
            <textarea
                name="message"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('message', $post->message) }}</textarea>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <div class="mt-4">
                <label for="date">期限日</label>
                <input 
                    type="text"
                    class="block border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="date"
                    id="date"
                    value="{{ old('date', $post->date) }}" />
                <x-input-error :messages="$errors->get('date')" class="mt-2" />
            </div>
            <x-primary-button class="mt-4 mb-4">
                <p>更新する</p>
            </x-primary-button>
        </form>
        <a href="{{ route('posts.index', ['id' => $post->folder_id]) }}">
            <x-secondary-button>
                <p>一覧へ戻る</p>
            </x-secondary-button>
        </a>
    </div>
</x-app-layout>
