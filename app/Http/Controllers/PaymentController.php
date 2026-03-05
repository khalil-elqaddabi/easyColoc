<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{

    public function markPaid(Payment $payment)
    {
        $payment->load('expense');
        $colocation = $payment->colocation;
        $user = auth::user();

        abort_unless(
            $user->id === $payment->payer_id ||
                $user->id === $colocation->owner_id,
            403,
            'Only payer or owner can mark as paid.'
        );

        if (! $payment->isPending()) {
            return back()->withErrors(['payment' => 'Already paid.']);
        }

        $payment->markAsPaid();

        return back()->with('status', 'Payment recorded.');
    }
}
