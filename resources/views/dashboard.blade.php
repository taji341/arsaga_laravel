<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <p>メモ帳</p>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p>ログインしました！</p>
                </div>
            </div>
            <form method="POST" action="{{ route('folders.create') }}">
                @csrf
                <p class="mt-4">フォルダを作成</p>
                <textarea
                    name="title"
                    placeholder="FoldersName"
                    class="block w-25 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                >{{ old('title') }}</textarea>
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                <x-primary-button class="mt-4">作成する</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
