<?php

namespace App\Livewire;

use App\Models\Buff;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ActivateBuff extends Component
{
    //We expect the parent to pass in a BUff model instance
    public Buff $buff;

    public function activate()
    {
        $user = Auth::user();

        /** @var \App\Models\User $user */
        // Check if this buff is already active using UserBuff model directly
        $alreadyActive = \App\Models\UserBuff::where('user_id', $user->id)
            ->where('buff_id', $this->buff->id)
            ->active()
            ->exists();

        if ($alreadyActive && ! $this->buff->stackable) {
            $this->addError('buff', 'That buff is already active.');
            return;
        }

        // Check cooldown using UserBuff model directly
        $lastUsage = \App\Models\UserBuff::where('user_id', $user->id)
            ->where('buff_id', $this->buff->id)
            ->latest('ends_at')
            ->first();

        if ($lastUsage) {
            $endedAt = $lastUsage->ends_at;
            $hoursSince = $endedAt->diffInHours(now());
            if ($hoursSince < $this->buff->cooldown) {
                $remaining = $this->buff->cooldown - $hoursSince;
                $this->addError(
                    'buff',
                    "Still on cooldown: wait {$remaining} more hour(s)."
                );
                return;
            }
        }

        // Create new UserBuff record
        \App\Models\UserBuff::create([
            'user_id' => $user->id,
            'buff_id' => $this->buff->id,
            'starts_at' => now(),
            'ends_at' => now()->addMinutes($this->buff->duration),
        ]);

        // Fire a browser event so we can show a toast if desired
        $this->dispatch('buff-activated', [
            'message' => "{$this->buff->name} activated (+" . ($this->buff->multiplier * 100) . "% XP)",
        ]);
    }


    public function render()
    {
        return view('livewire.activate-buff');
    }
}
