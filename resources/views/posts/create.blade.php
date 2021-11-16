<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/top.css') }}">
    <div class="container lg:w-1/2 md:w-4/5 w-11/12 mx-auto mt-8 px-8 bg-image-create shadow-md rounded-md">
        <h2 class="text-center text-lg text-gray-700 font-bold pt-6 tracking-widest">Post Create</h2>

        <x-validation-errors :errors="$errors" />

        <form action="{{ route('posts.store') }}" method="POST" class="rounded pt-3 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2" for="entry_id">
                    チャレンジ選択
                </label>
                <select name="entry_id"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-pink-600 w-full py-2 px-3">
                    <option disabled selected value="">選択してください</option>
                    @foreach ($charenges as $charenge)
                        <option value="{{ $charenge->id }}" @if ($charenge->id == old('charenge_id')) selected @endif>{{ $charenge->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2" for="body">
                    活動内容
                </label>
                <textarea name="body" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-pink-600 w-full py-2 px-3" id="body" cols="30" rows="10"
                required placeholder="チャレンジ企画の感想、身体の変化や食事や運動について共有しよう！">{{ old('body') }}</textarea>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2" for="image">
                    画像
                </label>
                <input type="file" name="image" class="border-gray-300">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2" for="weight">
                    体重(kg)
                </label>
                <input type="number" name="weight"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full py-2 px-3"
                    placeholder="60" value="{{ old('weight') }}">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2" for="intake">
                    摂取カロリー(kcal)
                </label>
                <input type="number" name="intake"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full py-2 px-3"
                    placeholder="1800" value="{{ old('intake') }}">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2" for="consume">
                    消費カロリー(kcal)
                </label>
                <input type="number" name="consume"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full py-2 px-3"
                    placeholder="1200" value="{{ old('consume') }}">
            </div>
            <div class="mb-8">
                <label class="block text-gray-700 text-sm mb-2" for="created_at">
                    投稿日
                </label>
                <input type="date" name="created_at"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full py-2 px-3"
                    required placeholder="投稿日" value="{{ old('created_at') }}">
            </div>
            <div class="mb-4">
            <input type="submit" value="投稿する"
                class="w-full flex justify-center bg-gradient-to-r from-pink-500 to-purple-600 hover:bg-gradient-to-l hover:from-purple-500 hover:to-pink-600 text-gray-100 p-2 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500">
            </div>
        </form>
    </div>
</x-app-layout>
