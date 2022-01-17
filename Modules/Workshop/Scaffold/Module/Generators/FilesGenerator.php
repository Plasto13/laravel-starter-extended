<?php

namespace Modules\Workshop\Scaffold\Module\Generators;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Str;

class FilesGenerator extends Generator
{
    /**
     * Generate the given files
     *
     * @param  array $files
     * @return void
     */
    public function generate(array $files)
    {
        foreach ($files as $stub => $file) {
            $this->writeFile(
                $this->getModulesPath($file),
                $this->getContentFor($stub)
            );
        }
    }

    /**
     * Generate the base module service provider
     * @return $this
     */
    public function generateModuleProvider()
    {
        $this->writeFile(
            $this->getModulesPath("Providers/{$this->name}ServiceProvider"),
            $this->getContentFor('module-service-provider.stub')
        );

        return $this;
    }

        /**
     * Generate the base module menu
     * @return $this
     */
    public function generateMenu()
    {
        $this->writeFile(
            $this->getModulesPath("Menu/{$this->name}Menu"),
            $this->getContentFor('sidebar-extender.stub')
        );

        return $this;
    }
        /**
     * Generate the base module language
     * @return $this
     */
    public function generateModuleLang()
    {
        $this->writeFile(
            $this->getModulesPath("Resources/lang/en/".strtolower(Str::plural($this->name))),
            $this->getContentFor('module-lang.stub')
        );

        return $this;
    }
    
    /**
     * Generate the base module api routers
     * @return $this
     */
    public function generateApiRouter()
    {
        $this->writeFile(
            $this->getModulesPath("Http/apiRoutes"),
            $this->getContentFor('routes-api.stub')
        );

        return $this;
    }

    /**
     * Get the content for the given file
     *
     * @param $stub
     * @return string
     * @throws FileNotFoundException
     */
    private function getContentFor($stub)
    {
        $stub = $this->finder->get($this->getStubPath($stub));

        return str_replace(
            [
                '$MODULE$',
                '$LOWERCASE_MODULE$',
                '$PLURAL_MODULE$',
                '$UPPERCASE_PLURAL_MODULE$',
                '$SIDEBAR_LISTENER_NAME$',
            ],
            [
                $this->name,
                strtolower($this->name),
                strtolower(Str::plural($this->name)),
                Str::plural($this->name),
                "Register{$this->name}Sidebar",
            ],
            $stub
        );
    }
}
