<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function trashed()
    {
        $users = User::onlyTrashed()->latest()->paginate(10);

        return view('admin.users.trashed', compact('users'));
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User banned successfully');
    }

    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->route('admin.users.trashed')
            ->with('success', 'User restored successfully');
    }

    public function forceDestroy($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->forceDelete();

        return redirect()->route('admin.users.trashed')
            ->with('success', 'User permanently deleted');
    }

    public function myColocations()
    {
        $colocations = Auth::user()->colocations;

        return view('colocations.my', compact('colocations'));
    }
}
