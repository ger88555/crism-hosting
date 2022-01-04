<?php

namespace App\Services;

use App\Exceptions\SystemCommandException;
use Illuminate\Support\Facades\Log;

/**
 * A test-friendly shell execution wrapper.
 */
class SystemCommandService {

    /**
     * Run a command and get it's output.
     *
     * @param string $command 
     * @return mixed The comand output
     */
    public function run($command)
    {
        try {
            Log::info("About to run: '$command'");
            if (config('app.env') === 'testing') return 0;
            
            $output = `$command`;
            Log::info("Output for '$command':\n$output\n");

            return $output;

        } catch (\Throwable $th) {
            throw new SystemCommandException($th->getMessage(), $th->getCode(), $th);
        }
    }

}