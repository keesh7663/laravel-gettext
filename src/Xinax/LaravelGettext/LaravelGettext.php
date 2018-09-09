<?php

namespace Xinax\LaravelGettext;

use Xinax\LaravelGettext\Composers\LanguageSelector;
use Xinax\LaravelGettext\Translators\TranslatorInterface;

class LaravelGettext
{
    /**
     * Translator handler
     *
     * @var TranslatorInterface
     */
    protected $translator;
    private   $encoding;

    /**
     * @param TranslatorInterface $gettext
     */
    public function __construct(TranslatorInterface $gettext)
    {
        $this->translator = $gettext;
    }

    /**
     * Get the current encoding
     *
     * @return string
     */
    public function getEncoding(): string
    {
        return $this->translator->getEncoding();
    }

    /**
     * Set the current encoding
     *
     * @param string $encoding
     *
     * @return $this
     */
    public function setEncoding($encoding): self
    {
        $this->encoding = $encoding;

        return $this;
    }

    /**
     * Set current locale
     *
     * @param string $locale
     *
     * @return $this
     */
    public function setLocale($locale): self
    {
        if ($locale !== $this->getLocale()) {
            $this->translator->setLocale($locale);
        }

        return $this;
    }

    /**
     * Gets the Current locale.
     *
     * @return string
     */
    public function getLocale(): string
    {
        return $this->translator->getLocale();
    }

    /**
     * Get the language portion of the locale
     * (ex. en_GB returns en)
     *
     * @param string|null $locale
     *
     * @return string|null
     */
    public function getLocaleLanguage($locale = null): ?string
    {
        if ($locale === null) {
            $locale = $this->getLocale();
        }

        $localeArray = explode('_', $locale);

        if (!isset($localeArray[0])) {
            return null;
        }

        return $localeArray[0];
    }

    /**
     * Get the language selector object
     *
     * @param array $labels
     *
     * @return LanguageSelector
     */
    public function getSelector(array $labels = []): LanguageSelector
    {
        return LanguageSelector::create($this, $labels);
    }

    /**
     * Sets the current domain
     *
     * @param string $domain
     *
     * @return $this
     * @throws \Xinax\LaravelGettext\Exceptions\UndefinedDomainException
     */
    public function setDomain($domain): self
    {
        $this->translator->setDomain($domain);

        return $this;
    }

    /**
     * Returns the current domain
     *
     * @return string
     */
    public function getDomain(): string
    {
        return $this->translator->getDomain();
    }

    /**
     * Translates a message with the current handler
     *
     * @param $message
     *
     * @return string
     */
    public function translate($message): string
    {
        return $this->translator->translate($message);
    }

    /**
     * Translates a plural string with the current handler
     *
     * @param $singular
     * @param $plural
     * @param $count
     *
     * @return string
     */
    public function translatePlural($singular, $plural, $count): string
    {
        return $this->translator->translatePlural($singular, $plural, $count);
    }

    /**
     * Returns the translator.
     *
     * @return TranslatorInterface
     */
    public function getTranslator(): TranslatorInterface
    {
        return $this->translator;
    }

    /**
     * Sets the translator
     *
     * @param TranslatorInterface $translator
     *
     * @return $this
     */
    public function setTranslator(TranslatorInterface $translator): self
    {
        $this->translator = $translator;

        return $this;
    }

    /**
     * Returns supported locales
     *
     * @return array
     */
    public function getSupportedLocales(): array
    {
        return $this->translator->supportedLocales();
    }

    /**
     * Indicates if given locale is supported
     *
     * @param $locale
     *
     * @return bool
     */
    public function isLocaleSupported($locale): bool
    {
        return $this->translator->isLocaleSupported($locale);
    }
}
