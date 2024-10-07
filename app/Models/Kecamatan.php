<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'kecamatans';

    protected $guarded = [];

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }
}
