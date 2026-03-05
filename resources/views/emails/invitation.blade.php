{{-- resources/views/emails/invitation.blade.php (Markdown) --}}
<x-mail::message>
# <span style="background: linear-gradient(135deg, #10b981, #059669); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 800;">You're invited to join {{ $invitation->colocation->name }}</span>

<x-mail::panel class="bg-gradient-to-r from-emerald-50 to-green-50 border-emerald-200">
You have been invited to join the colocation **{{ $invitation->colocation->name }}**.
</x-mail::panel>

<x-mail::button :url="route('invitations.accept', $invitation)" color="success" style="background: linear-gradient(135deg, #10b981, #059669); border: none; padding: 14px 32px; font-weight: 700; border-radius: 12px; box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);">
Join colocation
</x-mail::button>

**Thanks,**<br>
{{ config('app.name') }}
</x-mail::message>
