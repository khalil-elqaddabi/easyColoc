<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'expense_id',      
        'payer_id', 
        'receiver_id', 
        'amount', 
        'paid_at'
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'paid_at' => 'datetime'
        ];
    }

    public function expense()
    {
        return $this->belongsTo(Expense::class);
    }

    public function payer()
    {
        return $this->belongsTo(User::class, 'payer_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function isPending(): bool
    {
        return is_null($this->paid_at);
    }

    public function markAsPaid(): void
    {
        $this->update(['paid_at' => now()]);
        $this->payer->increment('reputation');
    }
}
