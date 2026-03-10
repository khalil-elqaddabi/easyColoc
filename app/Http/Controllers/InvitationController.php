<?php

namespace App\Http\Controllers;

use App\Http\Requests\AcceptInvitationRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\InviteToColocationRequest;
use App\Mail\InvitationEmail;
use App\Models\Colocation;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use \App\Http\Controllers\Auth\LoginController;
use \App\Http\Controllers\Auth\RegisterController;
use App\Http\Requests\InvitationAuthRequest;

class InvitationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
            /** @var User $user */

    public function index(Colocation $colocation)
    {
        Gate::authorize('can_invite_member', $colocation);

        $invitations = $colocation->invitations()->with(['colocation'])->latest()->limit(10)->get();

        return view('invitations.index', compact('colocation', 'invitations'));
    }

    public function invite(InviteToColocationRequest $request, Colocation $colocation)
    {
        Gate::authorize('can_invite_member', $colocation);

        $validated = $request->validated();
        $token = Str::random(32);

        $invitation = Invitation::create([
            'token' => $token,
            'email' => $validated['email'],
            'colocation_id' => $colocation->id,
        ]);

        $inviteLink = route('invitations.accept', $invitation);

        Mail::to($validated['email'])->send(new InvitationEmail($invitation));

        return redirect()->route('colocations.show', $colocation)->with('status', "Invitation sent! : {$inviteLink}");
    }

    public function accept(Invitation $invitation)
    {
        session(['invitation_id' => $invitation->id]);

        if (Auth::check()) {
            return $this->process(auth()->user(), $invitation);
        }

        return redirect(route('login'))->with('message', 'Complete login/register to join ' . $invitation->colocation->name);
    }

    public function process(Request $request, Invitation $invitation)
    {
        $user = auth::user();

        if (!$user || $user->email !== $invitation->email || $invitation->accepted_at) {
            abort(403, 'Invalid invitation');
        }

        $invitation->update(['accepted_at' => now()]);
        $user->colocations()->attach($invitation->colocation_id, ['role' => 'member']);

        return redirect()->route('colocations.show', $invitation->colocation)
            ->with('status', 'Welcome to ' . $invitation->colocation->name . '!');
    }


    public function refuse(Invitation $invitation)
    {
        $invitation->update(['refused_at' => now()]);

        return redirect()->route('login')->with('status', 'Invitation declined.');
    }
}
