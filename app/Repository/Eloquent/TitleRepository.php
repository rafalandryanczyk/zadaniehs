<?php

namespace App\Repository\Eloquent;

use App\Models\Title;
use App\Repository\TitleRepositoryInterface;

class TitleRepository extends BaseRepository implements TitleRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * TitleRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Title $model)
    {
        $this->model = $model;
    }
}
