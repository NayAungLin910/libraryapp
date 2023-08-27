<div class="flex place-content-center ">
    <div class="mt-10 px-4 py-2 rounded-2xl bg-violet-500 text-white shadow-lg lg:w-1/3 w-full mx-2">

        <!-- Profile -->
        <img id="profile-image" src="{{ asset('storage' . $author->image) }}"
            class="my-2 max-w-[10rem] mx-auto border border-none shadow-lg rounded-full" loading="lazy"
            alt="{{ $author->name }}'s profile image" />

        <form wire:submit='submit'>

            <!-- Name --->
            <div class="my-2">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" wire:model='name' class="input-form-violet">
                @error('name')
                <span class="text-red-600 bg-white w-auto rounded p-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Image -->
            <div class="my-2" x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
                x-on:livewire-upload-finish="uploading = false; progress = 0;"
                x-on:livewire-upload-error="uploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">
                <label for="image">New Profile</label>

                <!-- Image Preview -->
                @if ($image && !$errors->first('image'))
                <img loading="lazy" src="{{ $image->temporaryUrl() ? $image->temporaryUrl() : '' }}"
                    class="w-[50%] rounded-lg mx-auto" alt="Image Preview">
                @endif

                <input type="file" id="{{ $iteration }}" name="image" wire:model='image' class="input-file-violet">
                
                @error('image')
                <span class="text-red-600 bg-white w-auto rounded p-1">{{ $message }}</span>
                @enderror

                <!-- Image Uplaod Progressbar --->
                <hr x-show="uploading" id="image-progress-bar"
                    class="border-4 border-cyan-400 shadow-lg shadow-cyan-400/50 cursor-pointer duration-500 rounded-lg"
                    :style="`width: ${progress}%;`" />
            </div>

            <!-- Description -->
            <div class="my-2">
                <label for="description">Description</label>
                <textarea class="input-form-violet h-28" name="description" id="description"
                    wire:model='description'></textarea>
                @error('description')
                <span class="text-red-600 bg-white w-auto rounded p-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit button -->
            <div class="flex place-content-around items-center mx-2">
                <a href="{{ route('admin.authors.view') }}" class="button-white-rounded">Back</a>
                <button type="submit" class="button-violet-rounded"
                    wire:loading.class="opacity-30 animate-pulse">Save</button>
            </div>

        </form>
    </div>
</div>