<?php namespace Ironquest\Providers;

use Illuminate\Support\ServiceProvider;
use Ironquest\Repos\Eloquent;
use \File as File;
use \ReflectionClass as ReflectionClass;
use Ironquest;

class RepoServiceProvider extends ServiceProvider
{
    protected $autoRegisterPath;

    /**
     * Register all repositories with the IOC.
     *
     * @return void
     */
    public function register() {
        $this->autoRegisterPath = app_path() . '/Ironquest/Repos/Eloquent/';
        foreach(File::allFiles(app_path() . '/Ironquest/Repos/Eloquent') as $file) {
            $this->registerByFile($file);
        }
    }

    /**
     * If a file is a repository, register it with the IOC.
     *
     * @param $file
     */
    private function registerByFile($file) {
        $class = str_replace($this->autoRegisterPath, '', str_replace('.php', '', $file));
        $namespacedClass = 'Ironquest\Repos\Eloquent\\' . $class;
        $model = str_replace('Repo', '', 'Ironquest\\' . $class);
        if ($this->classIsRepo($namespacedClass)) {
            $this->app->bind('\Ironquest\Repos\\' . $class . 'Interface', function()
            use ($namespacedClass, $model)
            {
                return new $namespacedClass(new $model());
            });
        }
    }

    /**
     * Check if a class is a repository.
     *
     * @param $class
     * @return bool
     */
    private function classIsRepo($class) {
        $testClass = new ReflectionClass($class);
        if (!$testClass->isAbstract()) {
            foreach(class_implements($class) as $interface) {
                if (str_contains($interface, 'RepoInterface')) {
                    return true;
                }
            }
        }
        return false;
    }
}

