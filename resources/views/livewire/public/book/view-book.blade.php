<div class="mx-1">
    <!-- Header -->
    <h1 class="text-2xl text-center my-2">Search Books</h1>

    <div class="my-3 flex flex-wrap place-content-center items-center gap-2">
        <!-- Search Name -->
        <div>
            <label for="search">Search</label>
            <input wire:model.live.debounce.200ms='search' type="text" name="search" id="search"
                class="input-form-violet">
        </div>

        <!-- Sort By -->
        <div>
            <label for="search">Sort</label>
            <select wire:model.live.debounce.200ms='sort' class="input-form-violet bg-white p-1" name="sort" id="">
                <option value="latest">Latest</option>
                <option value="oldest">Oldest</option>
            </select>
        </div>

        <!-- Sort By Author -->
        <div>
            <label for="author-sort">Sort By Author</label>
            <select wire:model.live.debounce.200ms='authorId' class="input-form-violet bg-white p-1" name="authorId"
                id="author-sort">
                <option disabled value="default-author">Choose Author</option>
                @foreach ($authors as $author)
                <option value="{{ $author->id }}">{{ $author->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Reset -->
        <div>
            <button wire:click='resetFilter' wire:target='resetFilter'
                wire:loading.delay.class='opacity-30 animate-pulse' class="button-violet-rounded mt-4">Reset</button>
        </div>

    </div>

    <!-- Books -->
    <div wire:loading.delay.remove class="my-2">
        <div class="flex flex-wrap items-center place-content-center gap-2">

            @if ($books->count())
            @foreach ($books as $book)
            <div class="rounded-xl bg-slate-50 hover:bg-violet-100 shadow-lg w-[20rem]">
                <img class="w-auto mx-auto rounded-t-xl" src="{{ asset('storage' . $book->image) }}" alt=""
                    loading="lazy">
                <div class="p-3">
                    <p class="text-lg my-1">{{ $book->name }}</p>
                    <p class="tet-lg my-1 text-sm">Written By: {{ $book->author->name }}</p>
                    <p class="truncate my-1 mb-2 text-sm">
                        {{ $book->description }}
                    </p>
                    <span class="rounded-lg p-2 w-auto bg-violet-200 text-black text-sm">
                        Total Downloads: {{ $book->download_count }}
                    </span>

                </div>
                <div class="flex items-center p-2 place-content-between">
                    <button wire:click="download('{{ $book->id }}')"
                        class="button-green-rounded rounded-xl py-1 px-2 text-xl">
                        <ion-icon wire:ignore name="download-outline"></ion-icon>
                    </button>

                    @auth
                    <button wire:click="favourite('{{ $book->id }}')" class="text-2xl"
                        x-data="{ fav: {{ $book->is_fav ? 'true' : 'false' }} }" x-on:click="fav = !fav">
                        <ion-icon wire:ignore x-show="fav" name="heart" class="text-pink-500"></ion-icon>
                        <ion-icon wire:ignore x-show="!fav" name="heart-outline" class="text-pink-500"></ion-icon>
                    </button>
                    @endauth

                    <a href="{{ route('books.single', ['id' => $book->id]) }}"
                        class="button-violet-rounded ounded-xl py-1 px-2 text-xl">
                        <ion-icon wire:ignore name="eye-outline" class="text-white"></ion-icon>
                    </a>
                </div>
            </div>
            @endforeach
            @else
            <p class="text-xl text-center">No books found!</p>
            @endif

        </div>
    </div>

    @if ($books->count())
    <!-- Pagination -->
    <div wire:loading.delay.remove class="my-2">
        {{ $books->links() }}
    </div>
    @endif

    <!-- Loading -->
    <div class="my-2 flex place-content-center">
        <img wire:loading.delay class="max-w-[16rem]" src="{{ asset('storage/default_images/clouds-spinner.gif') }}"
            alt="Loading Indicator Image" />
    </div>

</div>