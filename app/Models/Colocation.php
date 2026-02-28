<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Colocation extends Model
{
    protected $fillable = ['name', 'status', 'canceled_at'];

    /**
     * Get the users in this colocation.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'colocation_user',
            'colocation_id',
            'user_id'
        );
    }
}
