<?php

namespace App\Services;

use App\Exceptions\SystemCommandException;

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
            if (config('app.env') === 'testing') return 0;
            
            return `$command`;

        } catch (\Throwable $th) {
            throw new SystemCommandException($th->getMessage(), $th->getCode(), $th);
        }
    }

}