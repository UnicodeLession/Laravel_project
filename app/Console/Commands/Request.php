<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Request extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-request {name} {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Request Module';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');
        $module = $this->argument('module');

        if (!File::exists(base_path('modules/' . $module))) {
            return $this->error('Module '.$module.' does not exists!');
        }

        $srcFolder = base_path('modules/' . $module . '/src');

        if (!File::exists($srcFolder)) {
            return $this->error('src Folder inside the '.$module.' not exists');
        }
        $httpFolder = base_path('modules/' . $module . '/src/Http');

        if (!File::exists($httpFolder)) {
            return $this->error('Http Folder inside the '.$module.' not exists');
        }
        $requestFolder = base_path('modules/' . $module . '/src/Http/Requests');

        if (!File::exists($requestFolder)) {
            File::makeDirectory($requestFolder, 0755, true, true);
        }
        if (File::exists($requestFolder)) {
            $requestFile = app_path('Console/Commands/Templates/Request.txt');
            $requestContent = File::get($requestFile);
            $requestContent = str_replace('{module}', $module, $requestContent);
            $requestContent = str_replace('{name}', $name, $requestContent);

            if (!File::exists($requestFolder . '/' . $name . '.php')) {
                File::put($requestFolder . '/' . $name . '.php', $requestContent);

                return $this->info($name.' created successfully!');
            } else {
                return $this->error($name.' already exists!');
            }

        }
    }
}
