<?php

namespace Xinax\LaravelGettext\Translators;

use Xinax\LaravelGettext\Adapters\AdapterInterface;
use Xinax\LaravelGettext\Config\Models\Config;
use Xinax\LaravelGettext\Exceptions\LocaleNotSupportedException;
use Xinax\LaravelGettext\Exceptions\UndefinedDomainException;
use Xinax\LaravelGettext\FileSystem;
use Xinax\LaravelGettext\Storages\Storage;

/**
 * Class implemented by the php-gettext module translator
 *
 * @package Xinax\LaravelGettext\Translators
 */
class Gettext extends BaseTranslator
{
    /**
     * Config container
     *
     * @type \Xinax\LaravelGettext\Config\Models\Config
     */
    protected $configuration;

    /**
     * Current encoding
     *
     * @type String
     */
    protected $encoding;

    /**
     * Current locale
     *
     * @type String
     */
    protected $locale;

    /**
     * Locale categories
     *
     * @type array
     */
    protected $categories;

    /**
     * Framework adapter
     *
     * @type \Xinax\LaravelGettext\Adapters\LaravelAdapter
     */
    protected $adapter;

    /**
     * File system helper
     *
     * @var FileSystem
     */
    protected $fileSystem;

    /**
     * @var String
     */
    protected $domain;

    /**
     * Gettext constructor.
     *
     * @param \Xinax\LaravelGettext\Config\Models\Config      $config
     * @param \Xinax\LaravelGettext\Adapters\AdapterInterface $adapter
     * @param \Xinax\LaravelGettext\FileSystem                $fileSystem
     * @param \Xinax\LaravelGettext\Storages\Storage          $storage
     *
     * @throws \Xinax\LaravelGettext\Exceptions\LocaleNotSupportedException
     */
    public function __construct(Config $config, AdapterInterface $adapter, FileSystem $fileSystem,
                         Storage $storage)
    {
        parent::__construct($config, $adapter, $fileSystem, $storage);

        // General domain
        $this->domain = $this->storage->getDomain();

        // Encoding is set from configuration
        $this->encoding = $this->storage->getEncoding();

        // Categories are set from configuration
        $this->categories = $this->configuration->getCategories();

        // Sets defaults for boot
        $locale = $this->storage->getLocale();

        $this->setLocale($locale);
    }


    /**
     * Sets the current locale code
     *
     * @param $locale
     *
     * @return string
     * @throws \Xinax\LaravelGettext\Exceptions\LocaleNotSupportedException
     */
    public function setLocale($locale)
    {
        if (!$this->isLocaleSupported($locale)) {
            throw new LocaleNotSupportedException(
                sprintf('Locale %s is not supported', $locale)
            );
        }

        try {
            $customLocale  = $this->configuration->getCustomLocale() ? "C." : $locale . ".";
            $gettextLocale = $customLocale . $this->getEncoding();

            // Update all categories set in config
            foreach ($this->categories as $category) {
                putenv("$category=$gettextLocale");
                setlocale(\constant($category), $gettextLocale);
            }

            parent::setLocale($locale);

            // Laravel built-in locale
            if ($this->configuration->isSyncLaravel()) {
                $this->adapter->setLocale($locale);
            }

            return $this->getLocale();
        } catch (\Exception $e) {
            $this->locale      = $this->configuration->getFallbackLocale();
            $exceptionPosition = $e->getFile() . ":" . $e->getLine();
            throw new \RuntimeException($exceptionPosition . $e->getMessage());

        }
    }

    /**
     * Returns a boolean that indicates if $locale
     * is supported by configuration
     *
     * @param $locale
     *
     * @return boolean
     */
    public function isLocaleSupported($locale): bool
    {
        if ($locale) {
            return \in_array($locale, $this->supportedLocales(), true);
        }

        return false;
    }

    /**
     * Gets the Current encoding.
     *
     * @return mixed
     */
    public function getEncoding()
    {
        return $this->encoding;
    }

    /**
     * Sets the Current encoding.
     *
     * @param mixed $encoding the encoding
     *
     * @return self
     */
    public function setEncoding($encoding)
    {
        $this->encoding = $encoding;

        return $this;
    }

    /**
     * Sets the current domain and updates gettext domain application
     *
     * @param   String $domain
     *
     * @throws  UndefinedDomainException    If domain is not defined
     * @return  self
     */
    public function setDomain($domain)
    {
        parent::setDomain($domain);

        $customLocale = $this->configuration->getCustomLocale() ? '/' . $this->getLocale() : '';

        bindtextdomain($domain, $this->fileSystem->getDomainPath() . $customLocale);
        bind_textdomain_codeset($domain, $this->getEncoding());

        $this->domain = textdomain($domain);


        return $this;
    }

    /**
     * Translates a message with gettext
     *
     * @param $message
     *
     * @return string
     */
    public function translate($message): string
    {
        return gettext($message);
    }

    /**
     * Translates a plural message with gettext
     *
     * @param $singular
     * @param $plural
     * @param $count
     *
     * @return string
     */
    public function translatePlural($singular, $plural, $count): string
    {
        return ngettext($singular, $plural, $count);
    }

    /**
     * @param $message
     * @param $amount
     *
     * @return string|void
     */
    public function translatePluralInline($message, $amount)
    {
        throw new \RuntimeException('Not supported by gettext, please use Symfony');
    }
}
