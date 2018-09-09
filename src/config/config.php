<?php

return [

    /**
     * Translation handlers, options are:
     *
     * - symfony: (recommended) uses the Symfony translations component. Incompatible with php-gettext
     * you must uninstall the php-gettext module before use this handler.
     *
     * - gettext: requires the php-gettext module installed. This handler has well-known cache issues
     */
    'handler' => 'symfony',

    /**
     * Session identifier: Key under which the current locale will be stored.
     */
    'session-identifier' => 'laravel-gettext-locale',

    /**
     * Default locale: this will be the default locale for your application.
     * It is assumed that all strings will be written in this language.
     */
    'locale' => 'en_US',

    /**
     * Supported locales: An array containing all allowed languages
     */
    'supported-locales' => [
        'en_US',
    ],

    /**
     * Default charset encoding.
     */
    'encoding' => 'UTF-8',

    /**
     * -----------------------------------------------------------------------
     * All standard configuration ends here. The following values
     * are only for special cases.
     * -----------------------------------------------------------------------
     **/

    /**
     * Locale categories to set
     */
    'categories' => [
        'LC_ALL',
    ],

    /**
     * Base translation directory path (don't use trailing slash)
     */
    'translations-path' => '../resources/lang',

    /**
     * Relative path to the app folder: is used on .po file headers
     */
    'relative-path' => '../../../../../app',

    /**
     * Fallback locale: When default locale is not available, this locale will be used
     */
    'fallback-locale' => 'en_US',

    /**
     * Default domain used for translations: .po and .mo files will be created with this name
     */
    'domain' => 'messages',

    /**
     * Project name: is used on .po header files
     */
    'project' => 'MultilanguageLaravelApplication',

    /**
     * Translator contact data (used on .po headers too)
     */
    'translator' => 'James Translator <james@translations.colm>',

    /**
     * Paths where Poedit will conduct a recursive search for strings to translate.
     * All paths are relative to app/ (don't use trailing slash).
     *
     * Remember to call `php artisan gettext:update` after changing this.
     */
    'source-paths' => [
        'Http',
        '../resources/views',
        'Console',
    ],

    /**
     * Multi-domain directory paths. If you want the translations in
     * different files, just wrap your paths into a domain name.
     * for example:
     */
    /*
    'source-paths' => [

        // 'frontend' domain
        'frontend' => [
			'controllers',
			'views/frontend',
		],

        // 'backend' domain
		'backend' => [
			'views/backend',
		],

        // 'messages' domain (matches default domain)
		'storage/views',
	],
    */

    /**
     * Sync Laravel:  Setting this flag to true will change the Laravel locale each time a call to
     * LaravelGettext::setLocale() is called.
     *
     * Setting this to false disables this functionality.
     */
    'sync-laravel' => true,

    /**
     * The adapter used to sync the Laravel built-in locale
     */
    'adapter' => \Xinax\LaravelGettext\Adapters\LaravelAdapter::class,

    /**
     * Where to store the current locale/domain
     *
     * By default, in the session.
     * Can be changed for only memory or your own storage mechanism
     *
     * @see \Xinax\LaravelGettext\Storages\Storage
     */
    'storage' => \Xinax\LaravelGettext\Storages\SessionStorage::class,

    /**
     * Use a custom locale that is not supported by the system
     */
    'custom-locale' => false,

    /**
     * The keywords list used by poedit to search the strings to be translated
     *
     * The "_", "__" and "gettext" are singular translation functions
     * The "_n" and "ngettext" are plural translation functions
     * The "dgettext" function allows a translation domain to be explicitly specified
     *
     * "__" and "_n" and "_i" and "_s" are helpers functions @see \Xinax\LaravelGettext\Support\helpers.php
     */
    'keywords-list' => ['_', '__', '_i', '_s', 'gettext', '_n:1,2', 'ngettext:1,2', 'dgettext:2'],
];
