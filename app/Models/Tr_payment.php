<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tr_payment extends Model
{
    use HasFactory;

    protected $table = 'tr_payment';
    protected $guarded = [
        'id'
    ];

    public function items()
    {
        return $this->hasMany(Tr_cart::class, 'payment_id', 'id');
    }

    public function biodata()
    {
        return $this->belongsTo(Tr_biodata::class, 'bio_id', 'id');
    }
}
