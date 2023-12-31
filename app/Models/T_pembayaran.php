<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class T_pembayaran extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 't_pembayaran';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'ID_PEMBAYARAN';

    public function metode_pembayaran(): BelongsTo {
        return $this->belongsTo(M_payment_gateway::class, 'ID_PAYMENT_GATEWAY');
    }
}
