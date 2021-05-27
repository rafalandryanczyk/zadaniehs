<?php

namespace App\Http\Controllers;

use App\Services\CharacterService;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Requests\CharacterUpdateRequest;
use App\Repository\CharacterRepositoryInterface;

class CharacterController extends Controller
{
    /**
     * @var CharacterService
     */
    protected $characterService;

    /**
     * @var CharacterRepositoryInterface
     */
    protected $characterRepository;

    /**
     * @return void
     */
    public function __construct(CharacterService $characterService, CharacterRepositoryInterface $characterRepository)
    {
        $this->characterService = $characterService;
        $this->characterRepository = $characterRepository;
    }

    /**
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        $data = $request->all() ? $request->all() : [];
        $characters = $this->characterService->listCharacters($data);
        return Inertia::render('Character/Index', ['characters' => $characters, 'request' => $data]);
    }

    /**
     * @param int $id
     * @return void
     */
    public function edit(int $id)
    {
        $character = $this->characterRepository->findById($id);
        return Inertia::render('Character/Edit', ['character' => $character]);
    }

    /**
     * @param CharacterUpdateRequest $request
     * @return void
     */
    public function update(CharacterUpdateRequest $request)
    {
        $this->characterRepository->update($request->id, $request->all());
        return redirect()->back();
    }
}
