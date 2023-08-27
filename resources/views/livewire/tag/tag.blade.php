<div class="">

    <!-- Header --->
    <h1 class="text-2xl text-center">Tags</h1>

    <!-- Create Tag -->
    <h2 class="text-lg text-center my-2">Create Tag</h2>

    <div class="flex place-content-center m-2">
        <form wire:submit='submit' class="col-span-2 lg:w-1/2 w-full">

            <!-- Name -->
            <div class="my-2">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" wire:model='name' class="input-form-violet">
                @error('name')
                <span class="text-red-600 bg-white w-auto rounded p-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit -->
            <button type="submit" class="button-violet-rounded" wire:target='submit'
                wire:loading.class="opacity-30 animate-pulse">Create</button>

        </form>
    </div>

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

    <!-- Tags Table -->
    <div wire:loading.delay.short.remove class="overflow-auto rounded-lg shadow-md m-2 my-3">
        <table class="w-full border-collapse border bg-violet-100 border-violet-100">
            <thead class="border-b text-lg border-violet-100">
                <tr>
                    <th class="table-th">Name</th>
                    <th class="table-th">Books Count</th>
                    <th class="table-th">Created At</th>
                    <th class="table-th">Some Actions</th>
                </tr>
            </thead>
            <tbody class="border-b border-violet-100">
                @if ($tags->count())
                @foreach ($tags as $tag)
                <tr class="border-b hover:bg-violet-200 border-violet-100" x-data="{ edit: false }"
                    x-on:success.window="edit = false">
                    <td x-show="!edit" class="table-td">
                        {{ $tag->name }}
                    </td>
                    <td x-show="edit" class="table-td">
                        <input wire:model='edit' class="input-form-violet px-1 m-0 w-auto" type="text"
                            placeholder="{{ $tag->name }}">
                        @error('edit')
                        <div class="text-red-600 bg-white w-auto rounded my-1">{{ $message }}</div>
                        @enderror
                    </td>
                    <td class="table-td">
                        {{ $tag->books_count }}
                    </td>
                    <td class="table-td">
                        {{ $tag->created_at }}
                    </td>
                    <td class="table-td">
                        <div class="flex items-center place-content-around gap-2 ">

                            <!-- Edit -->
                            <button x-on:click="edit = !edit" x-show="!edit" class="button-white-rounded">Edit</button>

                            <!-- Save Update -->
                            <button x-show="edit" wire:click="update('{{ $tag->id }}')" class="button-violet-rounded"
                                wire:target='submit' wire:loading.class="opacity-30 animate-pulse">Save</button>

                            <!-- Cancel Update -->
                            <button x-on:click="edit = !edit" x-show="edit" class="button-white-rounded"
                                wire:click='cancel'>Cancel</button>

                            <!-- Delete --->
                            <button class="button-violet-rounded"
                                onclick='openPopupSubmit("Are you sure about deleteing the tag, {{ $tag->name }}?", "", true, "tag-delete", {{ $tag->id }})'>
                                Delete
                            </button>

                        </div>
                    </td>
                </tr>
                @endforeach
                @else
                <tr class="border-b hover:bg-violet-200 border-violet-100">
                    <td class="table-td text-center" colspan="5">No tags found!</td>
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
    @if ($tags->count())
    <div wire:loading.delay.short.remove class="px-2 my-2">
        {{ $tags->links() }}
    </div>
    @endif

</div>