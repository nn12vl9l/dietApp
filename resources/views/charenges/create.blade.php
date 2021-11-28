<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/top.css') }}">
    <div class="container lg:w-1/2 md:w-4/5 w-11/12 mx-auto mt-8 px-8 bg-image-charenge shadow-md rounded-md">
        <h2 class="text-center text-lg text-gray-700 font-bold pt-6 tracking-widest">Challenge Create</h2>

        <x-validation-errors :errors="$errors" />
        <x-flash-message :message="session('notice')" />

        <form action="{{ route('charenges.store') }}" method="POST" class="rounded pt-3 pb-8 mb-4"
            enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2" for="title">
                    タイトル
                </label>
                <input type="text" name="title"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full py-2 px-3"
                    placeholder="チャレンジの企画名" value="{{ old('title') }}">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2" for="body">
                    活動内容
                </label>
                <textarea name="body"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-pink-600 w-full py-2 px-3"
                    id="body" cols="30" rows="5"
                    placeholder="チャレンジ企画の詳細、参考URL、投稿方法等ご記入ください。">{{ old('body') }}</textarea>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2" for="image">
                    サムネイル画像
                </label>
                <input type="file" name="image" class="border-gray-300">
            </div>
            <div class="mb-8">
                <label class="block text-gray-700 text-sm mb-2" for="limit_data">
                    チャレンジ期間
                </label>
                <input type="date" name="limit_data"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full py-2 px-3"
                    value="{{ old('limit_data') }}">
            </div>
            <div class="mb-4">
                <input type="submit" value="チャレンジを公開"
                    class="w-full flex justify-center bg-gradient-to-r from-pink-500 to-purple-600 hover:bg-gradient-to-l hover:from-purple-500 hover:to-pink-600 text-gray-100 p-2 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500">
            </div>
        </form>
    </div>
</x-app-layout>
