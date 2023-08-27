<div>
    <!-- label -->
    <h1 class="text-center text-xl my-2">View Authors</h1>

    <!-- Filter table --->
    <div class="p-2 flex flex-wrap gap-2">
        <!-- Search Name -->
        <div>
            <label for="search">Search</label>
            <input type="text" name="search" id="search" wire:model.live.debounce.200ms='search'
                class="input-form-violet">
        </div>

        <!-- Sort By -->
        <div>
            <label for="search">Sort</label>
            <select class="input-form-violet bg-white p-1" name="sort" wire:model.live.debounce.200ms='sort' id="">
                <option value="latest">Latest</option>
                <option value="oldest">Oldest</option>
            </select>
        </div>

        <!-- Reset --->
        <div class="mt-[1.25rem]">
            <button class="button-violet-rounded" wire:click='resetFilter' wire:target='resetFilter'
                wire:loading.class='opacity-30 animate-pulse'>Reset</button>
        </div>
    </div>

    <!-- Authors Table -->
    <div wire:loading.delay.short.remove class="overflow-auto rounded-lg shadow-md m-2 my-3">
        <table class="w-full border-collapse border bg-violet-100 border-violet-100">
            <thead class="border-b text-lg border-violet-100">
                <tr>
                    <th class="table-th"></th>
                    <th class="table-th">Name</th>
                    <th class="table-th">Books Count</th>
                    <th class="table-th">Created At</th>
                    <th class="table-th">Some Actions</th>
                </tr>
            </thead>
            <tbody class="border-b border-violet-100">
                @if ($authors->count())
                @foreach ($authors as $author)
                <tr class="border-b hover:bg-violet-200 border-violet-100" x-on:success.window="edit = false">
                    <td class="table-td">
                        <img id="profile-image" src="{{ asset('storage' . $author->image) }}"
                            class="max-w-[3rem] border rounded-full shadow" loading="lazy"
                            alt="{{ $author->name }}'s profile image" />
                    </td>
                    <td class="table-td">
                        {{ $author->name }}
                    </td>
                    <td class="table-td">
                        {{ $author->books_count }}
                    </td>
                    <td class="table-td">
                        {{ $author->created_at }}
                    </td>
                    <td class="table-td">
                        <div class="flex items-center place-content-around gap-2 ">

                            <!-- Edit -->
                            <a href="{{ route('admin.authors.edit', ['id' => $author->id]) }}"
                                class="button-white-rounded">Edit</a>

                            <!-- Delete --->
                            <button class="button-violet-rounded"
                                onclick='openPopupSubmit("Are you sure about deleteing the author, {{ $author->name }}?", "", true, "author-delete", {{ $author->id }})'>
                                Delete
                            </button>

                        </div>
                    </td>
                </tr>
                @endforeach
                @else
                <tr class="border-b hover:bg-violet-200 border-violet-100">
                    <td class="table-td text-center" colspan="5">No authors found!</td>
                </tr>
                @endif

            </tbody>
        </table>
    </div>

    <!-- loading indicator -->
    <div class="my-2 flex place-content-center">
        <img wire:loading.delay.short class="max-w-[10rem]"
            src="{{ asset('storage/default_images/clouds-spinner.gif') }}" alt="">
    </div>

    <!-- pagination button -->
    @if ($authors->count())
    <div wire:loading.delay.short.remove class="px-2 my-2">
        {{ $authors->links() }}
    </div>
    @endif
</div>