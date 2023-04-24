<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tr_cart extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id'
    ];

    public function katalog()
    {
        return $this->belongsTo(Ms_catalogue::class, 'catalogue_id', 'id');
    }

    public function hargasize()
    {
        return $this->belongsTo(Ms_sizeharga::class, 'hargasize_id', 'id');
    }
}
