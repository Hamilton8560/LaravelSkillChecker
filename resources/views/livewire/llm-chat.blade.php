<?php

use Illuminate\Support\Facades\Http;
use App\Models\Training;
use function Livewire\Volt\{state, computed};

state([
    'prompt' => '',
    'context' => '',
    'response' => '',
    'loading' => false,
]);

/**
 * Latest five trainings for the current user (with relationships).
 */
$trainings = computed(
    fn() =>
    Training::with(['category', 'method'])
        ->where('user_id', auth()->id())
        ->latest()
        ->limit(5)
        ->get()
);

/**
 * Sum of their durations – updates automatically when $trainings changes.
 */
$count = computed(fn() => $trainings()->sum('duration'));

/**
 * Append a training’s info to the prompt.
 */
$addToPrompt = function (int $id) {
    $t = Training::findOrFail($id);

    $this->prompt .= "\n--- LESSON ---\n"
        . $t->notes . "\n"
        . $t->task_description . "\n"
        . $t->what_you_learned . "\n";
};

/**
 * Send prompt+context to DeepSeek.
 */
$submit = function () {
    if (trim($this->prompt) === '') {
        return; // nothing to send
    }

    $this->loading = true;

    $res = Http::withHeaders([
        'Authorization' => 'Bearer ' . config('services.deepseek.key'),
    ])->post('https://api.deepseek.com/chat/completions', [
                'model' => 'deepseek-chat',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                    ['role' => 'user', 'content' => $this->prompt . $this->context],
                ],
            ]);

    $this->loading = false;

    if ($res->failed()) {
        $this->response = 'Error: ' . $res->status() . ' – ' . $res->body();
        return;
    }

    $this->response = $res->json('choices.0.message.content', 'No message in response.');
    $this->context = $this->response; // feed the answer back as context
    $this->prompt = '';              // clear textarea for next question
};
?>

<div class="space-y-6">

    <!-- Prompt input -->
    <textarea wire:model="prompt" wire:keydown.enter.prevent="!$event.shiftKey && $wire.submit()" rows="5"
        placeholder="Ask something…" class="textarea textarea-bordered w-full"></textarea>

    <!-- Spinner while submit runs -->
    <div wire:loading.flex wire:target="submit" class="justify-center">
        <span class="loading loading-bars loading-lg"></span>
    </div>
    <button wire:click="submit"></button>

    <!-- Response -->
    @isset($response)
        <div class="bg-gray-100 dark:bg-zinc-800 p-4 rounded">
            <strong>Response:</strong>
            <pre class="whitespace-pre-line text-sm">{{ $response }}</pre>
        </div>
    @endisset

    <!-- Totals -->
    <div class="text-lg">
        <span class="font-semibold">Total duration (latest 5): </span>{{ $this->count }}
    </div>

    <!-- Trainings grid -->
    <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @foreach ($this->trainings() as $train)
            <div class="card bg-slate-950 text-white shadow">
                <div class="card-body space-y-1">
                    <h2 class="card-title">{{ $train->category->name }}</h2>
                    <h4 class="text-sm text-gray-400">{{ $train->method->name }}</h4>

                    <p>Duration: {{ $train->duration }}</p>
                    <p>{{ $train->task_description }}</p>
                    <p>{{ $train->what_you_learned }}</p>
                    <p>RPE: {{ $train->RPE }}</p>
                    <p>Score: {{ $train->score }}</p>

                    <button wire:click="addToPrompt({{ $train->id }})" class="btn btn-primary btn-sm mt-2">
                        Add&nbsp;to&nbsp;Prompt
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Prompt preview -->
    <div class="mt-8">
        <strong>Prompt Preview:</strong>
        <pre class="whitespace-pre-line text-sm text-gray-500">{{ $prompt }}</pre>
    </div>
</div>