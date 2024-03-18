<?php

namespace App\Interfaces;

interface RoomTypeRepositoryInterfaces
{
    public function index();
    public function store(array $attributes);
    public function update(array $attributes,$id);
    public function delete($id);
}
