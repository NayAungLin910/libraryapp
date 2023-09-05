<div class="bg-gradient-to-tl from-violet-500 to-violet-700">

    <!-- Popular Books -->
    <h2 class="text-xl text-center py-2 text-white font-bold">Popular Books</h2>
    <div class="flex items-center justify-center min-h-[50vh] py-2 px-[30px]">
        <div class="wrapper relative max-w-[1100px] w-full">
            <ion-icon wire:ignore id="left"
                class="h-[50px] w-[50px] bg-white text-center leading-[50px] rounded-[50%] cursor-pointer absolute first:left-[-22px] last:right-[-22px] translate-y-[-50%] top-[50%] shadow-xl"
                name="chevron-back-outline"></ion-icon>
            <ul
                class="carousel grid grid-flow-col auto-cols-[100%] lg:auto-cols-[calc((100%/3)-12px)] md:auto-cols-[calc((100%/3)-9px)] gap-[16px] overflow-x-auto snap-x snap-mandatory scrollbar-hide-webkit scrollbar-hide-ie scroll-smooth">

                @if ($popularBooks && $popularBooks->count())
                @foreach ($popularBooks as $pbook)
                <li class="card ">
                    <a href="{{ route('books.single', ['id' => $pbook->id]) }}">
                        <div class="rounded-xl bg-slate-50 hover:bg-violet-100 shadow-lg w-[20rem]">
                            <img class="w-auto mx-auto rounded-t-xl" src="{{ asset('storage' . $pbook->image) }}" alt=""
                                loading="lazy">
                            <div class="p-3">
                                <p class="text-lg my-1">{{ $pbook->name }}</p>
                                <p class="tet-lg my-1 text-sm">
                                    Written By:
                                    <a
                                        href="{{ route('books.view-pre', ['authorId' => $pbook->author->id, 'tagId' => 'default-tag']) }}">
                                        <span class="bg-violet-200 hover:bg-violet-400 text-black p-1 rounded-lg">
                                            {{ $pbook->author->name }}
                                        </span>
                                    </a>
                                </p>
                                <p class="truncate my-1 mb-2 text-sm">
                                    {{ $pbook->description }}
                                </p>
                                <span class="rounded-lg p-2 w-auto bg-violet-200 text-black text-sm">
                                    Total Downloads: {{ $pbook->download_count }}
                                </span>
                                <div class="flex flex-wrap mt-3 gap-1">
                                    @foreach ($pbook->tags as $tag)
                                    <a
                                        href="{{ route('books.view-pre', ['tagId' => $tag->id, 'authorId' => 'default-author']) }}">
                                        <span
                                            class="bg-violet-200 hover:bg-violet-400 p-1 text-black text-sm rounded-lg">
                                            {{ $tag->name }}
                                        </span>
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                @endforeach
                @else
                <h3 class="text-lg text-white text-center">No popular books found!</h3>
                @endif
            </ul>
            <ion-icon wire:ignore id="right"
                class="h-[50px] w-[50px] bg-white text-center leading-[50px] rounded-[50%] cursor-pointer absolute first:left-[-22px] last:right-[-22px] translate-y-[-50%] top-[50%] shadow-xl"
                name="chevron-forward-outline"></ion-icon>
        </div>
    </div>

    <!-- Latest Book -->
    <h2 class="text-xl text-center py-2 text-white font-bold">Latest Books</h2>
    <div class="flex items-center justify-center min-h-[50vh] py-2 px-[30px]">
        <div class="wrapper-2 relative max-w-[1100px] w-full">
            <ion-icon wire:ignore id="left-2"
                class="h-[50px] w-[50px] bg-white text-center leading-[50px] rounded-[50%] cursor-pointer absolute first:left-[-22px] last:right-[-22px] translate-y-[-50%] top-[50%] shadow-xl"
                name="chevron-back-outline"></ion-icon>
            <ul
                class="carousel-2 grid grid-flow-col auto-cols-[100%] lg:auto-cols-[calc((100%/3)-12px)] md:auto-cols-[calc((100%/3)-9px)] gap-[16px] overflow-x-auto snap-x snap-mandatory scrollbar-hide-webkit scrollbar-hide-ie scroll-smooth">
                @if ($latestBooks && $latestBooks->count())
                @foreach ($latestBooks as $lbook)
                <li class="card-2 ">
                    <a href="{{ route('books.single', ['id' => $lbook->id]) }}">
                        <div class="rounded-xl bg-slate-50 hover:bg-violet-100 shadow-lg w-[20rem]">
                            <img class="w-auto mx-auto rounded-t-xl" src="{{ asset('storage' . $lbook->image) }}" alt=""
                                loading="lazy">
                            <div class="p-3">
                                <p class="text-lg my-1">{{ $lbook->name }}</p>
                                <p class="tet-lg my-1 text-sm">
                                    Written By:
                                    <a
                                        href="{{ route('books.view-pre', ['authorId' => $lbook->author->id, 'tagId' => 'default-tag']) }}">
                                        <span class="bg-violet-200 hover:bg-violet-400 text-black p-1 rounded-lg">
                                            {{ $lbook->author->name }}
                                        </span>
                                    </a>
                                </p>
                                <p class="truncate my-1 mb-2 text-sm">
                                    {{ $lbook->description }}
                                </p>
                                <span class="rounded-lg p-2 w-auto bg-violet-200 text-black text-sm">
                                    Total Downloads: {{ $lbook->download_count }}
                                </span>
                                <div class="flex flex-wrap mt-3 gap-1">
                                    @foreach ($lbook->tags as $tag)
                                    <a
                                        href="{{ route('books.view-pre', ['tagId' => $tag->id, 'authorId' => 'default-author']) }}">
                                        <span
                                            class="bg-violet-200 hover:bg-violet-400 p-1 text-black text-sm rounded-lg">
                                            {{ $tag->name }}
                                        </span>
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                @endforeach
                @else
                <h3 class="text-lg text-white text-center">No popular books found!</h3>
                @endif
            </ul>
            <ion-icon wire:ignore id="right-2"
                class="h-[50px] w-[50px] bg-white text-center leading-[50px] rounded-[50%] cursor-pointer absolute first:left-[-22px] last:right-[-22px] translate-y-[-50%] top-[50%] shadow-xl"
                name="chevron-forward-outline"></ion-icon>
        </div>
    </div>

    @push('layout-script-stack')
    <script defer>
        const carousel = document.querySelector(".carousel")
        const arrowBtns = document.querySelectorAll(".wrapper ion-icon")
        const firstCardWidth = document.querySelector(".card").offsetWidth

        // Add event listeners for the arrow buttons to scroll the carousel left and right
        arrowBtns.forEach(btn => {
            btn.addEventListener("click", () => {
                carousel.scrollLeft += btn.id === "left" ? -firstCardWidth : firstCardWidth
            })
        })

        let isDragging = false, startX, startScrollLeft

        const dragStart = (e) => {
            isDragging = true
            carousel.classList.add("dragging")
            startX = e.pageX
                startScrollLeft = carousel.scrollLeft
        }

        const dragging = (e) => {
            if(!isDragging) return // if isDragging is false return from here
            carousel.scrollLeft = startScrollLeft - (e.pageX - startX)
        }

        const dragStop = () => {
            isDragging = false;
            carousel.classList.remove("dragging")
        }

        carousel.addEventListener("mousedown", dragStart)
        carousel.addEventListener("mousemove", dragging)
        document.addEventListener("mouseup", dragStop)

        // For another carousel

        const carousel2 = document.querySelector(".carousel-2")
        const arrowBtns2 = document.querySelectorAll(".wrapper-2 ion-icon")
        const firstCardWidth2 = document.querySelector(".card-2").offsetWidth

        // Add event listeners for the arrow buttons to scroll the carousel left and right
        arrowBtns2.forEach(btn => {
            btn.addEventListener("click", () => {
                carousel2.scrollLeft += btn.id === "left-2" ? -firstCardWidth2 : firstCardWidth2
            })
        })

        let isDragging2 = false, startX2, startScrollLeft2

        const dragStart2 = (e) => {
            isDragging2 = true
            carousel2.classList.add("dragging-2")
            startX2 = e.pageX
                startScrollLeft2 = carousel2.scrollLeft
        }

        const dragging2 = (e) => {
            if(!isDragging2) return // if isDragging2 is false return from here
            carousel2.scrollLeft = startScrollLeft2 - (e.pageX - startX2)
        }

        const dragStop2 = () => {
            isDragging2 = false;
            carousel2.classList.remove("dragging-2")
        }

        carousel2.addEventListener("mousedown", dragStart2)
        carousel2.addEventListener("mousemove", dragging2)
        document.addEventListener("mouseup", dragStop2)

    </script>
    @endpush
</div>