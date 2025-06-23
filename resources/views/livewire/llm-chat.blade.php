<?php
use Illuminate\Support\Facades\Http;
use function Livewire\Volt\state;

state([
    'prompt' => '',
    'response' => '',
]);

$submit = function () {
    $res = Http::withHeaders([
        'Authorization' => 'Bearer ' . config('services.openai.key'),
    ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-4',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                    ['role' => 'user', 'content' => $this->prompt],
                ],
            ]);

    if ($res->failed()) {
        $this->response = 'Error: ' . $res->status() . ' - ' . $res->body();
        return;
    }

    $this->response = $res->json('choices.0.message.content', 'No message in response.');
};

?>

<div class="space-y-4">
    <textarea wire:model="prompt" class="textarea textarea-bordered w-full" rows="5"
        placeholder="Ask something..."></textarea>
    <x-button wire:click="submit" class="btn-primary">Send</x-button>

    @if ($response)
        <div class="bg-gray-100 dark:bg-zinc-800 p-4 rounded">
            <!-- make text visible in both modes -->
            <p class="text-black dark:text-white">
                <strong>Response:</strong><br>
                {{ $response }}
            </p>
        </div>

    @endif
</div>