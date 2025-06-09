
<div>
       {{-- Flash message --}}
    @if (session()->has('message'))
        <div class="p-2 mb-4 bg-green-100 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif
        {{-- “+ New Category” --}}
    <div class="mb-4">
        <x-button
            label="+ New Learning Objective"
            link="{{ route('objectives.create') }}"
            class="btn-primary"
        />
    </div>
<x-ui.card>
    <x-table.data-table :headers=$headers>
    @foreach($all_objectives as $obj)
      <x-table.table-row :clickable="true">
  <x-table.table-cell>{{$obj->objectives}}</x-table.cell>
    @if ($obj->explained)
         <x-table.table-cell>{{$obj->explained}}</x-table.cell>
    @else
    <x-table.table-cell>Not Finished</x-table.cell>
@endif
  <x-table.table-cell>{{$obj->category?->name}}</x-table.cell>
      <x-table.table-cell>{{$obj->created_at->toDateString() }}</x-table.cell>
          <x-table.table-cell>{{$obj->updated_at->toDateString() }}</x-table.cell>
                <x-table.table-cell> <x-button
                                label="Edit"
                                link="{{ route('objectives.edit', ['objective' => $obj->id]) }}"

                                class="btn-sm btn-outline"
                            /></x-table.cell>
  </x-table.row>
    @endforeach
    </x-table.data-table>
</x-ui.card>
</div>
