<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class NoteController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $notes = Note::latest()->get();

        return view('notes.index', compact('notes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'   => 'nullable|string|max:255',
            'content' => 'required|string',
            'color'   => 'nullable|string|max:7',
        ]);

        Auth::user()->notes()->create($validated);

        return redirect()->route('notes.index')->with('success', 'Catatan berhasil dibuat!');
    }

    public function edit(Note $note)
    {
        if ($note->user_id !== Auth::id()) {
            abort(403, 'Anda tidak berhak mengedit catatan ini.');
        }

        return view('notes.edit', compact('note'));
    }

    public function update(Request $request, Note $note)
    {
        if ($note->user_id !== Auth::id()) {
            abort(403, 'Anda tidak berhak mengedit catatan ini.');
        }

        $validated = $request->validate([
            'title'     => 'nullable|string|max:255',
            'content'   => 'required|string',
            'color'     => 'nullable|string|max:7',
        ]);

        $note->update($validated);

        return redirect()->route('notes.index')->with('success', 'Catatan diperbarui.');
    }

    public function destroy(Note $note)
    {
        if ($note->user_id !== Auth::id()) {
            abort(403, 'Anda tidak berhak menghapus catatan ini.');
        }

        $note->delete();

        return redirect()->route('notes.index')->with('success', 'Catatan berhasil dihapus.');
    }
}