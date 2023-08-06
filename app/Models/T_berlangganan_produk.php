<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class T_berlangganan_produk extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 't_berlangganan_produk';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'ID_BERLANGGANAN';

    public function detail_tagihan(): BelongsTo {
        return $this->belongsTo(T_detail_tagihan::class, 'ID_BERLANGGANAN');
    }

    public function paket_produk(): BelongsTo {
        return $this->belongsTo(M_paket_produk::class, 'ID_PAKET_PRODUK');
    }

    public function pelanggan(): BelongsTo {
        return $this->belongsTo(M_pelanggan::class, 'ID_PELANGGAN');
    }
}
