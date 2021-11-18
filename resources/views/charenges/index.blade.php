<x-app-layout>
    <div class="container max-w-7xl mx-auto px-4 md:px-12 pb-3 mt-3">
        <x-flash-message :message="session('notice')" />
        <div class="flex flex-wrap -mx-1 lg:-mx-4 mb-4">
            @foreach ($charenges as $charenge)
                <article class="w-full px-4 md:w-1/2 text-xl text-gray-800 leading-normal">
                    <a href="{{ route('charenges.show', $charenge) }}">
                        <div class="flex item-center text-sm">
                            <div class="border border-gray-900 px-2 h-7 leading-7 rounded-full">
                                {{ $charenge->user->name }}さんのチャレンジ企画</div>
                        </div>
                        <h2 class="font-bold font-sans break-normal text-gray-900 pt-6 pb-1 text-3xl md:text-4xl">
                            {{ $charenge->title }}</h2>
                        <p class="text-sm mb-2 md:text-base font-normal text-gray-600">
                            <span
                                class="text-purple-400 font-bold">{{ date('Y-m-d H:i:s', strtotime('-1 day')) < $charenge->created_at ? 'NEW' : '' }}</span>
                            {{ $charenge->date_diff }} に投稿
                        </p>
                        <img class="container mx-auto mb-4 md:w-4/5 sm:auto" src="{{ $charenge->image_url }}" alt="">
                        <p class="text-gray-700 text-base">{{ $charenge->body }}</p>
                    </a>
                </article>
            @endforeach
        </div>
    </div>
</x-app-layout>
