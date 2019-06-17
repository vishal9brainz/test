<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class List extends JsonResource
{

    public function toArray($request)
    {
      return [
            'id'        =>$this->id,
            'dateTime'  =>(string) $this->rides_DateTime,
            'from_place'=>(string) $this->from_place,
            'to_place'  =>(string) $this->to_place,
            'no_of_seats' =>(string) $this->seats,
            'usersInfo' =>
            [
                'name'  =>(string) $this->users->name,
                'email'  =>(string) $this->users->email,
                'mobile'  =>(string) $this->users->mobile,
            ],
             'routes'    =>[
                'route_list'    =>(string) $this->routes;
            ],
        ];
    }
}
