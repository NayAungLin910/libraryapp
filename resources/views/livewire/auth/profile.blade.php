<div>
    <div class="flex place-content-center">
        <div class="mt-10 px-4 py-2 rounded-2xl bg-slate-50 shadow-lg lg:w-1/3 w-full mx-2">

            <!-- Old Profile Image -->
            <img wire:ignore id="profile-image" class="rounded-full w-32 mx-auto shadow-lg"
                src="{{ '/storage' . Auth::user()->image }}" alt="{{ Auth::user()->name }}'s profile image">

            <form wire:submit='submit'>

                <!-- Name --->
                <div class="my-2">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" wire:model='name' class="input-form-violet">
                    @error('name')
                    <span class="text-red-600 bg-white w-auto rounded p-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email --->
                <div class="my-2">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" wire:model='email' class="input-form-violet">
                    @error('email')
                    <span class="text-red-600 bg-white w-auto rounded p-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Image -->
                <div class="my-2" x-data="{ uploading: false, progress: 0 }"
                    x-on:livewire-upload-start="uploading = true"
                    x-on:livewire-upload-finish="uploading = false; progress = 0;"
                    x-on:livewire-upload-error="uploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                    <label for="image">New Profile Image</label>

                    <!-- Image Preview -->
                    @if ($image && !$errors->first('image'))
                    <img loading="lazy" src="{{ $image->temporaryUrl() }}" class="w-[50%] rounded-lg mx-auto"
                        alt="Image Preview">
                    @endif

                    <input type="file" id="upload_{{ $iteration }}" name="image" wire:model='image'
                        class="input-file-violet">
                    @error('image')
                    <span class="text-red-600 bg-white w-auto rounded p-1">{{ $message }}</span>
                    @enderror

                    <!-- Image Uplaod Progressbar --->
                    <hr x-show="uploading" id="image-progress-bar"
                        class="border-4 border-pink-500 shadow-lg cursor-pointer duration-500 rounded-lg w-[5%]"
                        :style="`width: ${progress}%;`" />
                </div>

                <!-- Change Password -->
                <livewire:auth.change-password />

                <!-- Submit button -->
                <div class="flex place-content-center mx-2">
                    <button type="submit" class="button-violet-rounded mx-auto"
                        wire:target='submit' wire:loading.class="opacity-30 animate-pulse">Save</button>
                </div>

            </form>
        </div>
    </div>

    @if ($books->count())
    <div class="rounded-t-[3rem] mt-6 p-2 bg-violet-500 text-blak">
        <div class="mx-1">
            <!-- Header -->
            <h1 class="text-2xl text-center my-2 text-white mb-5">Your Favourite Books</h1>

            <!-- Books -->
            <div wire:loading.delay.remove class="my-2">
                <div class="flex flex-wrap items-center place-content-center gap-2">

                    @if ($books->count())
                    @foreach ($books as $book)
                    <div class="rounded-xl bg-violet-50 hover:bg-violet-200 shadow-lg w-[20rem]">
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

                            <button wire:click="favourite('{{ $book->id }}')" class="text-2xl">
                                <ion-icon wire:ignore name="heart" class="text-pink-500"></ion-icon>
                            </button>

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
            <div wire:loading.delay.remove class="my-4">
                {{ $books->links() }}
            </div>
            @endif

            <!-- Loading -->
            <div class="my-2 flex place-content-center">
                <img wire:loading.delay class="max-w-[16rem]"
                    src="{{ asset('storage/default_images/clouds-spinner.gif') }}" alt="Loading Indicator Image" />
            </div>

        </div>
    </div>
    @endif

</div>