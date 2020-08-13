<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

call_user_func(
    function()
    {

    	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'AshokaTree.Openweather',
            'Pi1',
            [
                'Weathershow' => 'current, hourly, daily'
            ],
            // non-cacheable actions
            [
                
            ]
        );

		$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['AshokaTree\\Openweather\\Task\\OpenweatherCurrentTask'] = [
		    'extension' => 'OpenWeather',
		    'title' => 'LLL:EXT:openweather/Resources/Private/Language/locallang.xlf:current_title',
		    'description' => 'LLL:EXT:openweather/Resources/Private/Language/locallang.xlf:current_description',
		    'additionalFields' => 'AshokaTree\\Openweather\\Task\\OpenweatherAdditionalFieldProvider',
		];        
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['AshokaTree\\Openweather\\Task\\OpenweatherHourlyTask'] = [
            'extension' => 'OpenWeather',
            'title' => 'LLL:EXT:openweather/Resources/Private/Language/locallang.xlf:hourly_title',
            'description' => 'LLL:EXT:openweather/Resources/Private/Language/locallang.xlf:hourly_description',
            'additionalFields' => 'AshokaTree\\Openweather\\Task\\OpenweatherAdditionalFieldProvider',
        ];
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['AshokaTree\\Openweather\\Task\\OpenweatherDailyTask'] = [
            'extension' => 'OpenWeather',
            'title' => 'LLL:EXT:openweather/Resources/Private/Language/locallang.xlf:daily_title',
            'description' => 'LLL:EXT:openweather/Resources/Private/Language/locallang.xlf:daily_description',
            'additionalFields' => 'AshokaTree\\Openweather\\Task\\OpenweatherAdditionalFieldProvider',
        ];

	}
);
