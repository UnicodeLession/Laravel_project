<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Controller extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-controller {name} {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Controller Module';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $folderNotExist = null;
        $name = $this->argument('name');
        $module = $this->argument('module');
        if (!File::exists(base_path('modules/'.$module))) {
            // phải tồn tại module thì mới bắt đầu tạo Controller
            return $this->error('Module does not exists!');
        }
        $srcFolder = base_path('modules/'.$module.'/src');
        if (!File::exists($srcFolder)) {
            return $this->error('src folder does not exist!');
        }
        $httpFolder = base_path('modules/'.$module.'/src/Http');
        if (!File::exists($httpFolder)) {
            return $this->error('Http folder does not exist!');
        }
        $controllerFolder = base_path('modules/'.$module.'/src/Http/Controllers');
        if (!File::exists($controllerFolder)){
            return $this->error('Controller folder does not exist!');
        }

        $controllerFileTemplate = app_path('Console/Commands/Templates/Controller.txt');

        $controllerContent = File::get($controllerFileTemplate);
        $controllerContent = str_replace('{name}', $name, $controllerContent);
        $controllerContent = str_replace('{module}', $module, $controllerContent);
        $controllerContent = str_replace('{module_lowercase}', strtolower($module), $controllerContent);
        if (!File::exists($controllerFolder . '/' . $name . '.php')) {
            File::put($controllerFolder . '/' . $name . '.php', $controllerContent);
            return $this->info($name.' created successfully!');
        } else {
            return $this->error($name.' already exists!');
        }
    }
}
