<li>

    <div class="flex items-center gap-2">
        <div wire:loading.delay class="max-w-[1rem]">
            <ion-icon wire:ignore name="reload-circle-outline" class="text-xl animate-spin mr-1"></ion-icon>
        </div>
        <div wire:loading.delay.remove class="max-w-[1rem]">
            <ion-icon wire:ignore name="search-outline" class="text-xl mr-1"></ion-icon>
        </div>

        <input wire:model.live.debounce.200ms='search' type="text" class="input-form-violet">
    </div>
    @if ($search)
    @if ($tags && $tags->count() || $books && $books->count())
    <div class="md:absolute z-30 ml-6 rounded-lg w-auto bg-white text-black shadow py-2 px-1 text-sm max-w-[20rem]">
        @if ($tags && $tags->count())
        <h2 class="text-violet-700 mb-2">Tags</h2>
        <div class="flex flex-wrap gap-2">
            @foreach ($tags as $tag)
            <a href="{{ route('books.view-pre', ['tagId' => $tag->id, 'authorId' => 'default-author']) }}">
                <span class="p-1 bg-violet-700 hover:bg-violet-800 text-white shadow rounded-lg">{{ $tag->name }}</span>
            </a>
            @endforeach
        </div>
        @endif
        @if ($tags || $books)
        <hr class="border my-2 border-b-violet-700">
        @endif
        @if ($books && $books->count())
        <h2 class="text-violet-700 mb-2">Books</h2>
        <div class="">
            @foreach ($books as $book)
            <a href="{{ route('books.single', ['id' => $book->id]) }}">
                <div class="flex flex-col items-center gap-1 hover:bg-gray-200 rounded-xl p-2">
                    <img src="{{ asset('storage' . $book->image) }}" class="rounded-lg max-w-[10rem]"
                        alt="{{ $book->name }}'s image">
                    <p>
                        {{ $book->name }}
                    </p>
                </div>
            </a>
            @endforeach
        </div>
        @endif
    </div>
    @else
    <div class="md:absolute ml-6 z-30 rounded-lg w-auto bg-white text-black shadow py-2 px-1 text-sm max-w-[20rem]">
        No matching information found!
    </div>
    @endif
    @endif

</li>