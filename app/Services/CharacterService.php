<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use App\Repository\CharacterRepositoryInterface;
use App\Repository\TitleRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Resources\CharacterResource;

class CharacterService
{

    /**
     * @var CharacterRepositoryInterface
     */
    protected $charaterRepository;

    /**
     * @var TitleRepositoryInterface
     */
    protected $titleRepository;

    /**
     * @return void
     */
    public function __construct(CharacterRepositoryInterface $charaterRepository, TitleRepositoryInterface $titleRepository)
    {
        $this->charaterRepository = $charaterRepository;
        $this->titleRepository = $titleRepository;
    }

    /**
     * Get and save characters from remote API.
     *
     * @return void
     */
    public function getCharacters()
    {
        try {
            $client = new Client(['base_uri' => 'https://www.anapioficeandfire.com/api/']);
            $response = $client->request('GET', 'characters?page=1&pageSize=50');
            $data = json_decode($response->getBody()->getContents(), true);
            foreach ($data as $item) {
                try {
                    $character = $this->charaterRepository->create([
                        'name' => $item['name'],
                        'url' => $item['url'],
                        'gender' => $item['gender'],
                        'culture' => $item['culture'],
                        'born' => $item['born'],
                        'died' => $item['died']
                    ]);

                    foreach ($item['titles'] as $name) {
                        if (empty($name)) continue;
                        $title = $this->titleRepository->findByField('name', $name);
                        if (!$title) {
                            $title = $this->titleRepository->create([
                                'name' => $name,
                            ]);
                        }

                        $character->titles()->attach($title->id);
                    }
                } catch (Exception $exception) {
                    Log::error('Issue with single character process.', [
                        'line' => $exception->getLine(),
                        'file' => $exception->getFile(),
                        'message' => $exception->getMessage(),
                        'method' => __FUNCTION__,
                        'character' => $item
                    ]);
                }
            }
        } catch (Exception $exception) {
            Log::error('Issue in character service.', [
                'line' => $exception->getLine(),
                'file' => $exception->getFile(),
                'message' => $exception->getMessage(),
                'method' => __FUNCTION__,
            ]);
        }
    }

    /**
     * List characters from db with pagination.
     *
     * @return Collection
     */
    public function listCharacters(array $data)
    {
        try {
            $where = [];

            if (isset($data['name']) && !empty($data['name'])) {
                $where['name'] = $data['name'];
            }
            if (isset($data['gender']) && !empty($data['gender'])) {
                $where['gender'] = $data['gender'];
            }

            $characters = $this->charaterRepository->whereWithPagination($where);

            return CharacterResource::collection($characters);
        } catch (Exception $exception) {
            Log::error('Issue in character service.', [
                'line' => $exception->getLine(),
                'file' => $exception->getFile(),
                'message' => $exception->getMessage(),
                'method' => __FUNCTION__,
            ]);
        }
    }
}
