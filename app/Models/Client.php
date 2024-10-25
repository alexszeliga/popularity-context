<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Client extends Model
{
    /** @use HasFactory<\Database\Factories\ClientFactory> */
    use HasFactory, HasUuids;

    public function owner() : HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getScheme() : string
    {
        return $this->scheme ?? '';
    }

    public function getHostname() : string
    {
        return $this->hostname ?? '';
    }
}
