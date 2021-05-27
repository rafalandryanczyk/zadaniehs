<?php

namespace App\Repository\Eloquent;

use App\Models\Character;
use App\Repository\CharacterRepositoryInterface;

class CharacterRepository extends BaseRepository implements CharacterRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * CharacterRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Character $model)
    {
        $this->model = $model;
    }
}
