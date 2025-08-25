<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    public function toArray($request)
    {
        $totalUsers = User::count();

        return [
            'data' => UserResoucer::collection($this->collection),
            'infos' => [
                'self' => $totalUsers,
            ],
        ];
    }
}
