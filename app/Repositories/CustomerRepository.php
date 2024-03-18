<?php

namespace App\Repositories;

use App\Interfaces\CustomerRepositoryInterfaces;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;

class CustomerRepository extends BaseRepository implements CustomerRepositoryInterfaces
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function index()
    {
        $customerRole = Role::where('name', 'customer')->first();
        return User::where('role_id', $customerRole->id)->get();
    }

    public function store(array $attributes)
    {
        $customerRole = Role::where('name', 'customer')->first();

        User::create([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'phone' => $attributes['phone'],
            'password' => bcrypt(Str::random(8)),
            'role_id' => $customerRole->id,
        ]);
    }

}
