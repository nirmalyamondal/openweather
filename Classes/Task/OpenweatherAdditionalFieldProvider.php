<?php
namespace AshokaTree\Openweather\Task;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Scheduler\AbstractAdditionalFieldProvider;
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Messaging\FlashMessageService;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Scheduler\Task\Enumeration\Action;

/**
 * Class OpenweatherAdditionalFieldProvider
 */
class OpenweatherAdditionalFieldProvider implements \TYPO3\CMS\Scheduler\AdditionalFieldProviderInterface
{
    /**
     * @var \TYPO3\CMS\Lang\LanguageService
     */
    protected $languageService;

    /**
     * Construct class.
     */
    public function __construct()
    {
        $this->languageService = $GLOBALS['LANG'];
    }

    /**
     * Gets additional fields to render in the form to add/edit a task.
     *
     * @param array $taskInfo Values of the fields from the add/edit task form
     * @param \TYPO3\Openweather\Task\OpenweatherTask $task The task object
     * @param \TYPO3\CMS\Scheduler\Controller\SchedulerModuleController $schedulerModule
	 * CURRENT: https://api.openweathermap.org/data/2.5/weather?id=6454307&appid=70cfc502d1281a300dfe6608914fc51e&units=metric
     * Hourly Forecast 4 days: https://api.openweathermap.org/data/2.5/forecast?id=6454307&appid=70cfc502d1281a300dfe6608914fc51e&units=metric
     * One Call API: https://api.openweathermap.org/data/2.5/onecall?lat=33.441792&lon=-94.037689&appid=70cfc502d1281a300dfe6608914fc51e&units=metric
     * @return array
     */
    public function getAdditionalFields(
        array &$taskInfo,
        $task,
        \TYPO3\CMS\Scheduler\Controller\SchedulerModuleController $schedulerModule
    ) {
        $currentSchedulerModuleAction = $schedulerModule->getCurrentAction();
        // process fields
        if (empty($taskInfo['weather_appid'])) {
            if ($currentSchedulerModuleAction->equals(Action::ADD)) {
                $taskInfo['weather_appid'] = '70cfc502d1281a300dfe6608914fc51e';
            } elseif ($currentSchedulerModuleAction->equals(Action::EDIT)) {
                $taskInfo['weather_appid'] = $task->weather_appid;
            } else {
                $taskInfo['weather_appid'] = '70cfc502d1281a300dfe6608914fc51e';
            }
        }

		if (empty($taskInfo['weather_folder'])) {
            if ($currentSchedulerModuleAction->equals(Action::ADD)) {
                $taskInfo['weather_folder'] = '/fileadmin/openweather/';
            } elseif ($currentSchedulerModuleAction->equals(Action::EDIT)) {
                $taskInfo['weather_folder'] = $task->weather_folder;
            } else {
                $taskInfo['weather_folder'] = '/fileadmin/openweather/';
            }
        }

		if (empty($taskInfo['weather_file'])) {
            if ($currentSchedulerModuleAction->equals(Action::ADD)) {
                $taskInfo['weather_file'] = 'hourly.json';
            } elseif ($currentSchedulerModuleAction->equals(Action::EDIT)) {
                $taskInfo['weather_file'] = $task->weather_file;
            } else {
                $taskInfo['weather_file'] = 'hourly.json';
            }
        }

        if (empty($taskInfo['weather_latitude'])) {
            if ($currentSchedulerModuleAction->equals(Action::ADD)) {
                $taskInfo['weather_latitude'] = '22.5016';
            } elseif ($currentSchedulerModuleAction->equals(Action::EDIT)) {
                $taskInfo['weather_latitude'] = $task->weather_latitude;
            } else {
                $taskInfo['weather_latitude'] = '22.5016';
            }
        }

        if (empty($taskInfo['weather_longitude'])) {
            if ($currentSchedulerModuleAction->equals(Action::ADD)) {
                $taskInfo['weather_longitude'] = '88.3612';
            } elseif ($currentSchedulerModuleAction->equals(Action::EDIT)) {
                $taskInfo['weather_longitude'] = $task->weather_longitude;
            } else {
                $taskInfo['weather_longitude'] = '88.3612';
            }
        }

        // render appid field
        $fieldId = 'task_weather_appid';
        $fieldCode = '<input type="text" name="tx_scheduler[weather_appid]" id="'.$fieldId.'" value="'.
            htmlspecialchars($taskInfo['weather_appid']).'" size="100" />';

        $additionalFields[$fieldId] = [
            'code' => $fieldCode,
            'label' => BackendUtility::wrapInHelp('weather', $fieldId, $this->translate('appid')),
            'cshKey' => '_MOD_tools_txschedulerM1',
            'cshLabel' => $fieldId,
        ];

		// render folder field
        $fieldId = 'task_weather_folder';
        $fieldCode = '<input type="text" name="tx_scheduler[weather_folder]" id="'.$fieldId.'" value="'.
            htmlspecialchars($taskInfo['weather_folder']).'" size="100" />';

        $additionalFields[$fieldId] = [
            'code' => $fieldCode,
            'label' => BackendUtility::wrapInHelp('weather', $fieldId, $this->translate('folder')),
            'cshKey' => '_MOD_tools_txschedulerM1',
            'cshLabel' => $fieldId,
        ];

		// render file field
        $fieldId = 'task_weather_file';
        $fieldCode = '<input type="text" name="tx_scheduler[weather_file]" id="'.$fieldId.'" value="'.
            htmlspecialchars($taskInfo['weather_file']).'" size="100" />';

        $additionalFields[$fieldId] = [
            'code' => $fieldCode,
            'label' => BackendUtility::wrapInHelp('weather', $fieldId, $this->translate('file')),
            'cshKey' => '_MOD_tools_txschedulerM1',
            'cshLabel' => $fieldId,
        ];

        // render latitude field
        $fieldId = 'task_weather_latitude';
        $fieldCode = '<input type="text" name="tx_scheduler[weather_latitude]" id="'.$fieldId.'" value="'.
            htmlspecialchars($taskInfo['weather_latitude']).'" size="100" />';

        $additionalFields[$fieldId] = [
            'code' => $fieldCode,
            'label' => BackendUtility::wrapInHelp('weather', $fieldId, $this->translate('latitude')),
            'cshKey' => '_MOD_tools_txschedulerM1',
            'cshLabel' => $fieldId,
        ];

        // render longitude field
        $fieldId = 'task_weather_longitude';
        $fieldCode = '<input type="text" name="tx_scheduler[weather_longitude]" id="'.$fieldId.'" value="'.
            htmlspecialchars($taskInfo['weather_longitude']).'" size="100" />';

        $additionalFields[$fieldId] = [
            'code' => $fieldCode,
            'label' => BackendUtility::wrapInHelp('weather', $fieldId, $this->translate('longitude')),
            'cshKey' => '_MOD_tools_txschedulerM1',
            'cshLabel' => $fieldId,
        ];

        return $additionalFields;
    }

    /**
     * {@inheritdoc}
     *
     * @return bool
     */
    public function validateAdditionalFields(
        array &$submittedData,
        \TYPO3\CMS\Scheduler\Controller\SchedulerModuleController $schedulerModule
    ) {
        $validInput = true;

        // clean data
        $submittedData['weather_appid'] = trim($submittedData['weather_appid']);
		$submittedData['weather_folder'] = trim($submittedData['weather_folder']);
		$submittedData['weather_file'] = trim($submittedData['weather_file']);
        $submittedData['weather_latitude'] = trim($submittedData['weather_latitude']);
        $submittedData['weather_longitude'] = trim($submittedData['weather_longitude']);

        /** @var FlashMessageService $flashMessageService */
        $flashMessageService = GeneralUtility::makeInstance(FlashMessageService::class);

        if (!(strlen($submittedData['weather_appid']) > 0 )) {
           // Argument is required and argument value is empty0
            $flashMessageService->getMessageQueueByIdentifier()->addMessage(
                new FlashMessage(
                    sprintf($this->translate('appid_invalid'), $submittedData['weather_appid']),
                    $this->translate('appid_invalid'),
                    FlashMessage::ERROR
                )
            );

            $validInput = false;
        }
		
		$jsonfolder = $submittedData['weather_folder'];
        $path = Environment::getPublicPath().$jsonfolder;
		if (!(strlen($jsonfolder) > 0 && is_dir(Environment::getPublicPath().$jsonfolder) && GeneralUtility::isAllowedAbsPath(Environment::getPublicPath().$jsonfolder))) {
            $flashMessageService->getMessageQueueByIdentifier()->addMessage(
                new FlashMessage(
                    sprintf($this->translate('folder_invalid'), $jsonfolder),
                    $this->translate('folder_invalid'),
                    FlashMessage::ERROR
                )
            );
            $validInput = false;
        }

		if (!(strlen($submittedData['weather_file']) > 0 )) {
            $flashMessageService->getMessageQueueByIdentifier()->addMessage(
                new FlashMessage(
                    sprintf($this->translate('file_invalid'), $submittedData['weather_file']),
                    $this->translate('file_invalid'),
                    FlashMessage::ERROR
                )
            );
            $validInput = false;
        }

        if (!(strlen($submittedData['weather_latitude']) > 0 )) {
            $flashMessageService->getMessageQueueByIdentifier()->addMessage(
                new FlashMessage(
                    sprintf($this->translate('latitude_invalid'), $submittedData['weather_latitude']),
                    $this->translate('latitude_invalid'),
                    FlashMessage::ERROR
                )
            );
            $validInput = false;
        }

        if (!(strlen($submittedData['weather_longitude']) > 0 )) {
            $flashMessageService->getMessageQueueByIdentifier()->addMessage(
                new FlashMessage(
                    sprintf($this->translate('longitude_invalid'), $submittedData['weather_longitude']),
                    $this->translate('longitude_invalid'),
                    FlashMessage::ERROR
                )
            );
            $validInput = false;
        }
        return $validInput;
    }

    /**
     * {@inheritdoc}
     */
    public function saveAdditionalFields(array $submittedData, \TYPO3\CMS\Scheduler\Task\AbstractTask $task)
    {
        $task->weather_appid = $submittedData['weather_appid'];
		$task->weather_folder = $submittedData['weather_folder'];
		$task->weather_file = $submittedData['weather_file'];
        $task->weather_latitude = $submittedData['weather_latitude'];
        $task->weather_longitude = $submittedData['weather_longitude'];
    }
	
    /**
     * Translate by key.
     *
     * @param string $key
     * @param string $prefix
     *
     * @return string
     */
    protected function translate($key, $prefix = 'LLL:EXT:openweather/Resources/Private/Language/locallang.xlf:')
    {
        return $this->languageService->sL($prefix.$key);
    }
}
