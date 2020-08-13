# TYPO3 Extension `openweather`

## 1 Features

* Display Current & Forecast weather data from OpenWeather.

## 2 Usage

### 2.1 Installation

#### Installation using Composer

The recommended way to install the extension is using [Composer][2].

Run the following command within your Composer based TYPO3 project:

```
composer require ashokatree/openweather
OR
composer require ashokatree/openweather 9.0
OR
composer require ashokatree/openweather dev-master
```

#### Installation as extension from TYPO3 Extension Repository (TER)

Download and install the [extension][3] with the extension manager module.

### 2.2 Minimal setup

1) Include the static TypoScript of the extension.
2) Create OpenWeather JSON file inside fileadmin by Creating & Executing a Scheduler task.
3) Create & configuring a plugin on a page.

## 3 Help supporting further development

**Why?** The Openweather extension is a tool to display Weather from OpenWeather. Support https://ashokatree.net by considering some projects.

**How?** There are multiple ways to support the further development. By outsourcing some additional tasks to https://ashokatree.net

## 4 Administration corner

### 4.1 Versions and support

| OpenWeather | TYPO3      | PHP       | Support / Development                   |
| ----------- | ---------- | ----------|---------------------------------------- |
| 9.x         | 9.5 - 10.x | 7.0 - 7.2 | features, bugfixes, security updates    |

### 4.2 Changelog

Please look into the [official extension documentation in changelog chapter].

### 4.3 Release Management

Openweather releases its first version!

### 4.4 Contribution

**Pull Requests** are gladly welcome! Nevertheless please don't forget to add an issue and connect it to your pull requests. This
is very helpful to understand what kind of issue the **PR** is going to solve.

Bugfixes: Please describe what kind of bug your fix solve and give us feedback how to reproduce the issue. We're going
to accept only bugfixes if we can reproduce the issue.


[1]: https://docs.typo3.org/typo3cms/extensions/openweather/
[2]: https://getcomposer.org/
[3]: https://extensions.typo3.org/extension/openweather
[4]: https://docs.typo3.org/p/georgringer/openweather/master/en-us/Misc/Changelog/Index.html
[5]: https://semver.org/
