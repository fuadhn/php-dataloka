<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class T_detail_tagihan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 't_detail_tagihan';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'ID_DETAIL_TAGIHAN';

    public function tagihan_produk(): BelongsTo {
        return $this->belongsTo(T_tagihan_produk::class, 'ID_TAGIHAN');
    }
}
