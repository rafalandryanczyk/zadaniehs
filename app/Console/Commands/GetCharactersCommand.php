<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CharacterService;

class GetCharactersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'characters:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get characters.';

    /**
     * Undocumented variable
     *
     * @var CharacterService
     */
    protected $characterService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CharacterService $characterService)
    {
        $this->characterService = $characterService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Script is in progress...');
        $this->characterService->getCharacters();
        $this->info('Script was finished.');
    }
}
