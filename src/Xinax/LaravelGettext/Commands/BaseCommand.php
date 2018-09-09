<?php

namespace Xinax\LaravelGettext\Commands;

use Illuminate\Console\Command;
use Xinax\LaravelGettext\Config\ConfigManager;
use Xinax\LaravelGettext\FileSystem;

class BaseCommand extends Command
{
    /**
     * Filesystem helper
     *
     * @var \Xinax\LaravelGettext\FileSystem
     */
    protected $fileSystem;

    /**
     * Package configuration data
     *
     * @var array
     */
    protected $configuration;

    /**
     * Prepares the package environment for gettext commands
     *
     * @return void
     * @throws \Xinax\LaravelGettext\Exceptions\RequiredConfigurationKeyException
     */
    protected function prepare(): void
    {
        $configManager = ConfigManager::create();

        $this->fileSystem = new FileSystem(
            $configManager->get(),
            app_path(),
            storage_path()
        );

        $this->configuration = $configManager->get();
    }
}
