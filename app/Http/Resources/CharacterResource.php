<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CharacterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' =>  $this->name,
            'gender' => $this->gender,
            'culture' => $this->culture,
            'titles' => ($this->titles) ? array_map(
                function ($title) {
                    return ['id' => $title['id'], 'name' => $title['name']];
                },
                $this->titles->toArray()
            ) : '',
            'url' => $this->url,
            'born' => $this->born,
            'died' => $this->died,
        ];
    }
}
