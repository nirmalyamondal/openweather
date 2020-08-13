<?php
defined('TYPO3_MODE') || die('Access denied.');

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'openweather',
	'Pi1',
	'Open Weather Show'
);


//$pluginSignature = 'weathershow_pi1';
$pluginSignature = 'openweather_pi1';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,recursive,select_key';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:openweather/Configuration/FlexForms/flexform_openweather_show.xml');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('openweather', 'Configuration/TypoScript', 'Open Weather Show');
