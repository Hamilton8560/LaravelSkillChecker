<div>
    <x-ui.card 
        class="w-150 mx-auto flex-col items-center justify-center"
        :title="'Update Your Learning Objective: ' . $objective->created_at"
        >
    <div class="h-28 !w-128 mx-auto p-2">
    <x-form.textarea class="h-14 !w-128 mx-auto p-2" 
    label="Learning Objective"
    hint="its not necessary to change"
    placeholder="{{$objective->objectives}}"
    />
      </div>
         <flux:menu.separator/>
    <div class="h-28 !w-128 mx-auto p-2">
    <x-form.textarea 
    label="Explain in Your own words what it is"
    hint="help"
    />
    </div>
    </x-ui.card>
</div>
