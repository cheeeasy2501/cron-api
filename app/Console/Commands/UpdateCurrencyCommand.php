<?php

namespace App\Console\Commands;

use App\Jobs\UpdateCurrencyJob;
use Illuminate\Console\Command;

class UpdateCurrencyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates currency rates via API';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(UpdateCurrencyJob $updateCurrencyJob)
    {
        dispatch($updateCurrencyJob);
    }
}
