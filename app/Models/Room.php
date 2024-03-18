<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name', 'description', 'capacity','price','status','image','room_type_id'];

    public function type()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }

}
