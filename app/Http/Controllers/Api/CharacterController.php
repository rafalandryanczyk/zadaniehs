<?php

namespace App\Http\Controllers\Api;

use App\Services\CharacterService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CharacterController extends Controller
{
    /**
     * @var CharacterService
     */
    protected $characterService;

    /**
     * @return void
     */
    public function __construct(CharacterService $characterService)
    {
        $this->characterService = $characterService;
    }

    public function listCharacters(Request $request)
    {
        $data = $request->all() ? $request->all() : [];
        return $this->characterService->listCharacters($data);
    }
}
