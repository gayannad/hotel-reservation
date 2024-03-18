<?php

namespace App\Repositories;

use App\Enums\RoomStatus;
use App\Interfaces\RoomsRepositoryInterfaces;
use App\Models\Room;
use Illuminate\Support\Facades\Storage;

class RoomsRepository extends BaseRepository implements RoomsRepositoryInterfaces
{
    public function __construct(Room $room)
    {
        parent::__construct($room);
    }

    public function store(array $attributes)
    {
        $attributes['status'] = RoomStatus::AVAILABLE->value;
        $attributes['room_type_id'] = $attributes['type'];

        $room = $this->model->create($attributes);

        if (request()->hasFile('image')) {
            $image = $this->uploadImage($room->id);
            $room->update(['image' => $image]);
        }

    }

    private function uploadImage($roomId)
    {
        $diskName = 'public';
        $disk = Storage::disk($diskName);

        $path = request()->image->store('images/' . $roomId, $diskName);
        return $disk->url($path);
    }

}
