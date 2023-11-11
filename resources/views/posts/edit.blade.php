<x-app-layout>
    <div class="container lg:w-1/2 md:w-4/5 w-11/12 mx-auto mt-8 px-8 py-4 bg-white shadow-md rounded-md">
        <link rel="stylesheet" href="{{ asset('css/top.css') }}">
        <h2 class="text-center text-lg text-gray-700 font-bold pt-6 tracking-widest">Post Edit</h2>

        <x-validation-errors :errors="$errors" />
        <x-flash-message :message="session('notice')" />

        <form action="{{ route('posts.update', $post) }}" method="POST" class="rounded pt-3 pb-8 mb-4"
            enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2" for="body">
                    活動内容
                </label>
                <textarea name="body"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-pink-600 w-full py-2 px-3"
                    id="body" cols="30" rows="5">{{ old('body', $post->body) }}</textarea>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2" for="image">
                    画像
                </label>
                <img src="{{ $post->image_url }}" alt="" class="container mx-auto mb-4 md:w-1/2 sm:auto">
                <input type="file" name="image" class="border-gray-300">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2" for="weight_kg">
                    体重(kg)※任意
                </label>
                <input type="number" name="weight_kg"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full py-2 px-3"
                    placeholder="60" value="{{ old('weight_kg', $post->weight_kg) }}">
            </div>
            {{-- <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2" for="intake_kcal">
                    摂取カロリー(kcal)※任意
                </label>
                <input type="number" name="intake_kcal"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full py-2 px-3"
                    placeholder="1800" value="{{ old('intake_kcal', $post->intake_kcal) }}">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2" for="consume_kcal">
                    消費カロリー(kcal)※任意
                </label>
                <input type="number" name="consume_kcal"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full py-2 px-3"
                    placeholder="1200" value="{{ old('consume_kcal', $post->consume_kcal) }}">
            </div> --}}
            <div class="mb-8">
                <label class="block text-gray-700 text-sm mb-2" for="post_day">
                    投稿日
                </label>
                <input type="date" name="post_day"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full py-2 px-3"
                    value="{{ $post->post_day }}" required>
            </div>
            <div class="mb-4">
                <input type="submit" value="更新する"
                    class="w-full flex justify-center bg-gradient-to-r from-pink-500 to-purple-600 hover:bg-gradient-to-l hover:from-purple-500 hover:to-pink-600 text-gray-100 p-2 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500">
            </div>
        </form>
    </div>
    </div>
</x-app-layout>
