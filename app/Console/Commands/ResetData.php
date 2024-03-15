<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ResetData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:reset_data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'An artisan command that will reset the data from the database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Run the migrate:fresh --seed command
        $this->call('migrate:fresh', [
            '--seed' => true,
        ]);

        // Additional logic for your custom command (if needed)

        $this->info('My custom command completed successfully.');
    }
}