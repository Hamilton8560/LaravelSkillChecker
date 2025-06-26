<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class JournalController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();



        $journals = $user->journals()->with(['user'])->latest()->paginate(10);
        if (count($journals) === 0) {
            return view("journal.create");
        } else {
            $headers = [
                ['key' => 'id', 'label' => '#'],
                ['key' => 'title', 'label' => 'Title'],
                ['key' => 'content', 'label' => 'Content'],
                ['key' => 'created_at', 'label' => 'Date'],
                ['key' => 'edit', 'label' => 'Edit'],

            ];
            return view("journal.entries", compact('journals', 'headers', 'user'));
        }
    }
    public function show(Journal $journal)
    {
        $this->authorize('view', $journal);
        return view('journal.show', compact('journal'));
    }

    public function create()
    {

        return view("journal.create");
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:5',
        ]);

        $user = Auth::user();
        Journal::create([
            'user_id' => $user->id,
            'title' => $data['title'],
            'content' => $data['content'],
        ]);
        return redirect()
            ->route('journal.index')
            ->with('success', "Journal '{$data['title']}' saved!");
    }
    public function edit(Journal $journal)
    {
        return view("journal.edit", compact("journal"));
    }
    public function update(Request $request, Journal $journal) {}
    public function destroy(Journal $journal) {}
}
