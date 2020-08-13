<?php
namespace AshokaTree\Openweather\Controller;

/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

/**
 * Controller of Weathershow records
 *
 */
class WeathershowController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

    /**
     * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
     */
    protected $configurationManager;

    /**
     * Initializes the current action
     *
     * @return void
     */
    public function initializeAction()
    {
		 parent::initializeAction();
    }

    /**
     * Display the Current weather data
     *
     * @param 
     * @param
     * @return void
     */
    public function currentAction() 
	{
		
		$file_content 	= file_get_contents(\TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($this->settings['filepath']));
		$file_content 	= (array) json_decode($file_content);
		$main 			= (string) $file_content['weather'][0]->main;
		$description	= (string) $file_content['weather'][0]->description;
		$icon 			= (string) $file_content['weather'][0]->icon;
		$temp 			= (string) $file_content['main']->temp;
		$feels_like 	= (string) $file_content['main']->feels_like;
		$temp_min 		= (string) $file_content['main']->temp_min;
		$temp_max		= (string) $file_content['main']->temp_max;
		$pressure 		= (string) $file_content['main']->pressure;
		$humidity	 	= (string) $file_content['main']->humidity;
		$visibility		= (string) $file_content['visibility'];
		$speed 			= (string) $file_content['wind']->speed;
		$deg 			= (string) $file_content['wind']->deg;
		$all 			= (string) $file_content['clouds']->all;		
		$dt				= (string) $file_content['dt'];
		$sunrise		= (string) $file_content['sys']->sunrise;
		$sunset			= (string) $file_content['sys']->sunset;
		$this->view->assign('main', $main);
		$this->view->assign('description', $description);
		$this->view->assign('icon', $icon);
		$this->view->assign('temp', $temp);
		$this->view->assign('feels_like', $feels_like);
		$this->view->assign('temp_min', $temp_min);
		$this->view->assign('temp_max', $temp_max);
		$this->view->assign('pressure', $pressure);
		$this->view->assign('humidity', $humidity);	
		$this->view->assign('visibility', $visibility);	
		$this->view->assign('speed', $speed);
		$this->view->assign('deg', $deg);
		$this->view->assign('all', $all);
		$this->view->assign('dt', $dt);	
		$this->view->assign('sunrise', $sunrise);
		$this->view->assign('sunset', $sunset);			
    }

    /**
     * Display the Hourly forecast data
     *
     * @param 
     * @param
     * @return void
     */
    public function hourlyAction() 
	{
		$file_content 	= file_get_contents(\TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($this->settings['filepath']));
		$file_content 	= (array) json_decode($file_content);
		$weatherDataAll = [];
		foreach($file_content['list'] as $key => $value) {
			$weatherDataAll[$key]['dt'] 		= (string) $value->dt;		
			$weatherDataAll[$key]['temp'] 		= (string) $value->main->temp;		
			$weatherDataAll[$key]['feels_like'] = (string) $value->main->feels_like;		
			$weatherDataAll[$key]['temp_min'] 	= (string) $value->main->temp_min;	
			$weatherDataAll[$key]['temp_max'] 	= (string) $value->main->temp_max;	
			$weatherDataAll[$key]['pressure'] 	= (string) $value->main->pressure;	
			$weatherDataAll[$key]['sea_level'] 	= (string) $value->main->sea_level;	
			$weatherDataAll[$key]['grnd_level']	= (string) $value->main->grnd_level;	
			$weatherDataAll[$key]['humidity'] 	= (string) $value->main->humidity;	
			$weatherDataAll[$key]['temp_kf'] 	= (string) $value->main->temp_kf;
			$weatherDataAll[$key]['main'] 		= (string) $value->weather[0]->main;		
			$weatherDataAll[$key]['description']= (string) $value->weather[0]->description;
			$weatherDataAll[$key]['icon'] 		= (string) $value->weather[0]->icon;	
			$weatherDataAll[$key]['all'] 		= (string) $value->clouds->all;
			$weatherDataAll[$key]['speed'] 		= (string) $value->wind->speed;	
			$weatherDataAll[$key]['deg'] 		= (string) $value->wind->deg;
			$weatherDataAll[$key]['visibility'] = (string) $value->visibility;
			$weatherDataAll[$key]['pop'] 		= (string) $value->pop;
			$weatherDataAll[$key]['dt_txt'] 	= (string) $value->dt_txt;
		}
		$this->view->assign('weatherDataAll', $weatherDataAll);
		$sunrise		= $file_content['city']->sunrise;
		$sunset			= $file_content['city']->sunset;
		$this->view->assign('sunrise', $sunrise);
		$this->view->assign('sunset', $sunset);			
	}

	/**
     * Display the Current and forecast weather data
     *
     * @param 
     * @param
     * @return void
     */
    public function dailyAction() 
	{
		$file_content 	= file_get_contents(\TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($this->settings['filepath']));
		$file_content 	= (array) json_decode($file_content);	//echo '<pre>'; print_r($file_content);
		$currentObj		= $file_content['current'];
		$hourlyObj		= $file_content['hourly'];
		$dailyObj		= $file_content['daily'];

		$weatherCurrentDataAll	= [];
		$weatherCurrentDataAll['dt']			= (string) $currentObj->dt;
		$weatherCurrentDataAll['sunrise']		= (string) $currentObj->sunrise;
		$weatherCurrentDataAll['sunset']		= (string) $currentObj->sunset;
		$weatherCurrentDataAll['temp']			= (string) $currentObj->temp;
		$weatherCurrentDataAll['feels_like']	= (string) $currentObj->feels_like;
		$weatherCurrentDataAll['pressure']		= (string) $currentObj->pressure;
		$weatherCurrentDataAll['humidity']		= (string) $currentObj->humidity;
		$weatherCurrentDataAll['dew_point']		= (string) $currentObj->dew_point;
		$weatherCurrentDataAll['uvi']			= (string) $currentObj->uvi;
		$weatherCurrentDataAll['clouds']		= (string) $currentObj->clouds;
		$weatherCurrentDataAll['visibility']	= (string) $currentObj->visibility;
		$weatherCurrentDataAll['wind_speed']	= (string) $currentObj->wind_speed;
		$weatherCurrentDataAll['wind_deg']		= (string) $currentObj->wind_deg;
		$weatherCurrentDataAll['main']			= (string) $currentObj->weather[0]->main;
		$weatherCurrentDataAll['description']	= (string) $currentObj->weather[0]->description;
		$weatherCurrentDataAll['icon']			= (string) $currentObj->weather[0]->icon;

		$weatherHourlyDataAll	= [];
		foreach($file_content['hourly'] as $key => $value) {
			$weatherHourlyDataAll[$key]['dt'] 			= (string) $value->dt;		
			$weatherHourlyDataAll[$key]['temp'] 		= (string) $value->temp;		
			$weatherHourlyDataAll[$key]['feels_like'] 	= (string) $value->feels_like;		
			$weatherHourlyDataAll[$key]['pressure'] 	= (string) $value->pressure;	
			$weatherHourlyDataAll[$key]['humidity'] 	= (string) $value->humidity;	
			$weatherHourlyDataAll[$key]['dew_point'] 	= (string) $value->dew_point;
			$weatherHourlyDataAll[$key]['clouds'] 		= (string) $value->clouds;		
			$weatherHourlyDataAll[$key]['visibility'] 	= (string) $value->visibility;
			$weatherHourlyDataAll[$key]['wind_speed']	= (string) $value->wind_speed;
			$weatherHourlyDataAll[$key]['wind_deg'] 	= (string) $value->wind_deg;
			$weatherHourlyDataAll[$key]['main'] 		= (string) $value->weather[0]->main;	
			$weatherHourlyDataAll[$key]['description'] 	= (string) $value->weather[0]->description;	
			$weatherHourlyDataAll[$key]['icon'] 		= (string) $value->weather[0]->icon;
			$weatherHourlyDataAll[$key]['pop'] 			= (string) $value->pop;			
		}

		$weatherDailyDataAll	= [];
		foreach($file_content['daily'] as $key => $value) {
			$weatherDailyDataAll[$key]['dt'] 			= (string) $value->dt;	
			$weatherDailyDataAll[$key]['sunrise']		= (string) $value->sunrise;
			$weatherDailyDataAll[$key]['sunset']		= (string) $value->sunset;	

			$weatherDailyDataAll[$key]['temp_day'] 		= (string) $value->temp->day;		
			$weatherDailyDataAll[$key]['temp_min'] 		= (string) $value->temp->min;
			$weatherDailyDataAll[$key]['temp_max'] 		= (string) $value->temp->max;		
			$weatherDailyDataAll[$key]['temp_night'] 	= (string) $value->temp->night;		
			$weatherDailyDataAll[$key]['temp_eve'] 		= (string) $value->temp->eve;		
			$weatherDailyDataAll[$key]['temp_morn'] 	= (string) $value->temp->morn;	

			$weatherDailyDataAll[$key]['feels_like_day'] 	= (string) $value->feels_like->day;	
			$weatherDailyDataAll[$key]['feels_like_night'] 	= (string) $value->feels_like->night;
			$weatherDailyDataAll[$key]['feels_like_eve'] 	= (string) $value->feels_like->eve;
			$weatherDailyDataAll[$key]['feels_like_morn'] 	= (string) $value->feels_like->morn;

			$weatherDailyDataAll[$key]['pressure'] 		= (string) $value->pressure;	
			$weatherDailyDataAll[$key]['humidity'] 		= (string) $value->humidity;	
			$weatherDailyDataAll[$key]['dew_point'] 	= (string) $value->dew_point;
			$weatherDailyDataAll[$key]['wind_speed']	= (string) $value->wind_speed;
			$weatherDailyDataAll[$key]['wind_deg'] 		= (string) $value->wind_deg;
			$weatherDailyDataAll[$key]['clouds'] 		= (string) $value->clouds;	
			$weatherDailyDataAll[$key]['pop'] 			= (string) $value->pop;	
			$weatherDailyDataAll[$key]['uvi'] 			= (string) $value->uvi;	
			
			$weatherDailyDataAll[$key]['main'] 			= (string) $value->weather[0]->main;	
			$weatherDailyDataAll[$key]['description'] 	= (string) $value->weather[0]->description;	
			$weatherDailyDataAll[$key]['icon'] 			= (string) $value->weather[0]->icon;			
		}

		$this->view->assign('weatherCurrentDataAll', $weatherCurrentDataAll);
		$this->view->assign('weatherHourlyDataAll', $weatherHourlyDataAll);
		$this->view->assign('weatherDailyDataAll', $weatherDailyDataAll);
	}
   
}