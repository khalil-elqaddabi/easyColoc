<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ColocationController extends Controller
{
    /**
     * Display a listing of user's colocations
     */
public function index()
{
    /**
     * @var User $user
     */
    $user = Auth::user();

    $colocations = $user->colocations()->latest()->paginate(10);

    return view('colocations.index', compact('colocations'));
}


    /**
     * Show form to create new colocation
     */
    public function create()
    {
        return view('colocations.create');
    }

    /**
     * Store new colocation
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $colocation = Colocation::create([
            'name' => $request->name,
            'status' => 'active',
        ]);

        $colocation->users()->attach(Auth::id());

        return redirect()->route('colocations.index')
            ->with('success', 'Colocation created successfully.');
    }

    /**
     * Display specific colocation
     */
    public function show(string $id)
    {
        $colocation = Colocation::with('users')->findOrFail($id);

        return view('colocations.show', compact('colocation'));
    }

    /**
     * Show edit form
     */
    public function edit(string $id)
    {
        $colocation = Colocation::findOrFail($id);

        return view('colocations.edit', compact('colocation'));
    }

    /**
     * Update colocation
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $colocation = Colocation::findOrFail($id);

        $colocation->update([
            'name' => $request->name,
        ]);

        return redirect()->route('colocations.index')
            ->with('success', 'Colocation updated successfully.');
    }

    /**
     * Cancel colocation (بدل delete)
     */
    public function destroy(string $id)
    {
        $colocation = Colocation::findOrFail($id);

        $colocation->update([
            'status' => 'canceled',
            'canceled_at' => now(),
        ]);

        return redirect()->route('colocations.index')
            ->with('success', 'Colocation canceled successfully.');
    }
}
