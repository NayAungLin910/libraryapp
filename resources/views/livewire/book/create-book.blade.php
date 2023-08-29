<div class="flex place-content-center ">
    <div class="mt-10 px-4 py-2 rounded-2xl bg-violet-500 text-white shadow-lg lg:w-2/5 w-full mx-2">
        <h1 class="text-xl text-center">Create Book</h1>

        <form wire:submit='submit'>

            <!-- Name --->
            <div class="my-2">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" wire:model='name' class="input-form-violet">
                @error('name')
                <span class="text-red-600 bg-white w-auto rounded p-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Author -->
            <div class="my-2">
                <label for="authorId">Choose Author</label>
                <select wire:model='authorId' name="authorId" id="authorId" class="input-form-violet h-10">
                    @foreach ($authors as $author)
                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                    @endforeach
                </select>
                @error('authorId')
                <span class="text-red-600 bg-white w-auto rounded p-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Image -->
            <div class="my-2" x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
                x-on:livewire-upload-finish="uploading = false; progress = 0;"
                x-on:livewire-upload-error="uploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">
                <label for="image">Image</label>

                <!-- Image Preview -->
                @if ($image && !$errors->first('image'))
                <img loading="lazy" src="{{ $image->temporaryUrl() }}" class="w-[50%] rounded-lg mx-auto"
                    alt="Image Preview">
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

            <!-- File -->
            <div class="my-2">
                <label for="file">File</label>
                <input type="file" id="{{ $iteration }}" name="file" wire:model='file' class="input-file-violet">
                @error('file')
                <span class="text-red-600 bg-white w-auto rounded p-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tags -->
            <div class="my-2">
                <label for="tagIds">Choose at least one related tag</label>
                <select wire:model='tagIds' name="tagIds[]" multiple="multiple" id="tagIds"
                    class="input-form-violet h-24">
                    @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
                @error('tagIds')
                <span class="text-red-600 bg-white w-auto rounded p-1">{{ $message }}</span>
                @enderror
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
            <div class="flex place-content-center mx-2">
                <button type="submit" class="button-violet-rounded mx-auto"
                    wire:loading.class="opacity-30 animate-pulse">Create</button>
            </div>

        </form>
    </div>
</div>