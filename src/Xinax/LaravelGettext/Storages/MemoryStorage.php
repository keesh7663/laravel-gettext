<?php

namespace Xinax\LaravelGettext\Storages;

class MemoryStorage implements Storage
{
    /**
     * Config container
     *
     * @type \Xinax\LaravelGettext\Config\Models\Config
     */
    protected $configuration;

    /**
     * @var String
     */
    protected $domain;

    /**
     * Current locale
     *
     * @type String
     */
    protected $locale;

    /**
     * Current encoding
     *
     * @type String
     */
    protected $encoding;

    /**
     * SessionStorage constructor.
     *
     * @param \Xinax\LaravelGettext\Config\Models\Config $configuration
     */
    public function __construct(\Xinax\LaravelGettext\Config\Models\Config $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * Getter for domain
     *
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain ?: $this->configuration->getDomain();
    }

    /**
     * @param String $domain
     *
     * @return $this
     */
    public function setDomain($domain): self
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * Getter for locale
     *
     * @return string
     */
    public function getLocale(): string
    {
        return $this->locale ?: $this->configuration->getLocale();
    }

    /**
     * @param String $locale
     *
     * @return $this
     */
    public function setLocale($locale): self
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Getter for configuration
     *
     * @return \Xinax\LaravelGettext\Config\Models\Config
     */
    public function getConfiguration(): \Xinax\LaravelGettext\Config\Models\Config
    {
        return $this->configuration;
    }

    /**
     * Getter for encoding
     *
     * @return string
     */
    public function getEncoding(): string
    {
        return $this->encoding ?: $this->configuration->getEncoding();
    }

    /**
     * @param String $encoding
     *
     * @return $this
     */
    public function setEncoding($encoding): self
    {
        $this->encoding = $encoding;

        return $this;
    }


}