<x-layouts.app :title="__('Journal Show')">

    <div class="card w-96 sm:w-136 md:w-168 bg-base-100 card-xl shadow-sm mx-auto">
        <div class="card-body">
            <h2 class="card-title"> {{ $journal->title }} </h2>
            <p>{{$journal->content}}</p>
            <div class="justify-end card-actions">
                <button class="btn btn-primary">Buy Now</button>
            </div>
        </div>
    </div>

</x-layouts.app>