<?php

namespace Xinax\LaravelGettext\Storages;

interface Storage
{
    /**
     * Getter for domain
     *
     * @return string
     */
    public function getDomain(): string;

    /**
     * @param string $domain
     *
     * @return $this|\Xinax\LaravelGettext\Storages\MemoryStorage
     */
    public function setDomain($domain);

    /**
     * Getter for locale
     *
     * @return string
     */
    public function getLocale(): string;

    /**
     * @param string $locale
     *
     * @return $this|\Xinax\LaravelGettext\Storages\MemoryStorage
     */
    public function setLocale($locale);

    /**
     * Getter for locale
     *
     * @return string
     */
    public function getEncoding(): string;

    /**
     * @param string $encoding
     *
     * @return $this|\Xinax\LaravelGettext\Storages\MemoryStorage
     */
    public function setEncoding($encoding);

    /**
     * Getter for configuration
     *
     * @return \Xinax\LaravelGettext\Config\Models\Config
     */
    public function getConfiguration(): \Xinax\LaravelGettext\Config\Models\Config;
}