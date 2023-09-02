<div class="m-2 py-2">
    <div class="rounded-2xl shadow-lg lg:w-1/3 mx-auto bg-slate-100">
        <img src="{{ asset('storage' . $book->image) }}" class=" w-full rounded-t-2xl" alt="{{ $book->name }}'s image">
        <div class="p-3">
            <h1 class="text-xl text-center">{{ $book->name }}</h1>
            <p class="my-2">
                {{ $book->description }}
            </p>
            <span class="rounded-lg p-2 w-auto bg-violet-200 text-black text-sm">
                Total Downloads: {{ $book->download_count }}
            </span>
            <p class="mt-2">
                Written By:
                <a href="{{ route('books.view-pre', ['authorId' => $book->author->id, 'tagId' => 'default-tag']) }}">
                    <span class="bg-violet-200 hover:bg-violet-400 text-black p-1 rounded-lg">
                        {{ $book->author->name }}
                    </span>
                </a>
            </p>
            <div class="flex flex-wrap mt-3 gap-1">
                @foreach ($book->tags as $tag)
                <a href="{{ route('books.view-pre', ['tagId' => $tag->id, 'authorId' => 'default-author']) }}">
                    <span class="bg-violet-200 p-1 text-black rounded-lg hover:bg-violet-400">
                        {{ $tag->name }}
                    </span>
                </a>
                @endforeach
            </div>
        </div>
        <div class="flex place-content-between items-center p-3" x-data="{ cart: false }">
            <a class="button-violet-rounded" href="{{ route('books.view') }}">
                Back
            </a>

            @auth
            <button wire:click="favourite('{{ $book->id }}')" class="text-3xl pr-6"
                x-data="{ fav: {{ $book->is_fav ? 'true' : 'false' }} }" x-on:click="fav = !fav">
                <ion-icon wire:ignore x-show="fav" name="heart" class="text-pink-500"></ion-icon>
                <ion-icon wire:ignore x-show="!fav" name="heart-outline" class="text-pink-500"></ion-icon>
            </button>
            @endauth

            <!-- Download -->
            <button wire:click="$dispatch('book-download', { id: {{ $book->id }} })"
                class="button-green-rounded rounded-xl py-1 px-2 text-xl">
                <ion-icon wire:ignore name="download-outline"></ion-icon>
            </button>

        </div>
    </div>
</div>