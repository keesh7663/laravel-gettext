<?php

namespace Xinax\LaravelGettext\Storages;

use Illuminate\Support\Facades\Session;

class SessionStorage implements Storage
{
    /**
     * Config container
     *
     * @type \Xinax\LaravelGettext\Config\Models\Config
     */
    protected $configuration;

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
        return $this->sessionGet('domain', $this->configuration->getDomain());
    }

    /**
     * Return a value from session with an optional default
     *
     * @param      $key
     * @param null $default
     *
     * @return mixed
     */
    protected function sessionGet($key, $default = null)
    {
        $token = $this->configuration->getSessionIdentifier() . '-' . $key;

        return Session::get($token, $default);
    }

    /**
     * @param String $domain
     *
     * @return $this
     */
    public function setDomain($domain): self
    {
        $this->sessionSet('domain', $domain);

        return $this;
    }

    /**
     * Sets a value in session session
     *
     * @param $key
     * @param $value
     *
     * @return mixed
     */
    protected function sessionSet($key, $value)
    {
        $token = $this->configuration->getSessionIdentifier() . '-' . $key;
        Session::put($token, $value);

        return $this;
    }

    /**
     * Getter for locale
     *
     * @return string
     */
    public function getLocale(): string
    {
        return $this->sessionGet('locale', $this->configuration->getLocale());
    }

    /**
     * @param String $locale
     *
     * @return $this
     */
    public function setLocale($locale): self
    {
        $this->sessionSet('locale', $locale);

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
     * Getter for locale
     *
     * @return string
     */
    public function getEncoding(): string
    {
        return $this->sessionGet('encoding', $this->configuration->getEncoding());
    }

    /**
     * @param string $encoding
     *
     * @return $this
     */
    public function setEncoding($encoding): self
    {
        $this->sessionSet('encoding', $encoding);

        return $this;
    }
}