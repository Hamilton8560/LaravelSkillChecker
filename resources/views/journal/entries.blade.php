<x-layouts.app :title="__('Journal')">
    @if (session('success'))
        <div class="text-green-600 font-semibold">
            {{ session('success') }}
        </div>
    @endif


    <button class="btn" onclick="my_modal_1.showModal()">open modal</button>
    <dialog id="my_modal_1" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold">{{ $user->name }} </h3>
            <p class="py-4">Do you wish to create a journal entry?</p>
            <div class="modal-action">
                <form method="dialog">
                    <!-- if there is a button in form, it will close the modal -->
                    <div class="gap-12">
                        <a href="{{route('journal.create')}}" class="btn">yes</a>
                        <button class="btn">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </dialog>

    <div class="overflow-x-auto">
        <table class="table table-zebra">
            <!-- head -->
            <thead>
                <tr>
                    @foreach ($headers as $header)
                        <th class="px-4 py-2">{{ $header['label'] }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <!-- row 1 -->
                @foreach ($journals as $journal)
                    <tr>

                        <th class="px-4 py-2">{{ $journal['id'] }}</th>
                        <th class="px-4 py-2">{{ $journal['title'] }}</th>
                        <th class="px-4 py-2">{{ $journal['content'] }}</th>
                        <th class="px-4 py-2">{{ $journal['created_at'] }}</th>
                        <th class="px-4 py-2"> <a href="{{route('journal.show', $journal->id)}}"
                                class="btn btn-xs sm:btn-sm md:btn-md lg:btn-md xl:btn-md">Edit</a></th>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $journals->links() }} {{-- For pagination --}}
</x-layouts.app>