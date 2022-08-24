<?php

namespace App\Models;

use App\Models\Type;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function type() {
        return $this->belongsTo(Type::class);
    }

    public function unit() {
        return $this->belongsTo(Unit::class);
    }
}
