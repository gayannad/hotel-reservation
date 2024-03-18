<?php

namespace App\Interfaces;

interface RoomsRepositoryInterfaces
{
    public function index();
    public function store(array $attributes);
    public function update(array $attributes,$id);
    public function delete($id);
}
