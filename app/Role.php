<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'role_id'; // Define the primary key column name

    protected $fillable = [
        'name', 'privileges',
    ];

    // Define a relationship with users
    // public function users()
    // {
    //     return $this->hasMany(User::class, 'role_id', 'role_id');
    // }
}
