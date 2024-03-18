<?php

namespace App\Repositories;

use App\Interfaces\RoomTypeRepositoryInterfaces;
use App\Models\RoomType;

class RoomTypeRepository extends BaseRepository implements RoomTypeRepositoryInterfaces
{
    public function __construct(RoomType $room)
    {
        parent::__construct($room);
    }

}
