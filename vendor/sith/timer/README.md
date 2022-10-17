# Shared Timer Component

## Setup:

* Add repository to `composer.json`

```
"repositories": [
  {
    "type": "vcs",
    "url":  "ssh://git@stash.rp-dev.com:7999/st/timer.git"
  }
],
"require": {
  "sith/timer": "1.0.*"
}
```

* Set up Timer service with next config:

```
$di->setShared('timer', function () use ($config) {
    return new \RP\Utils\Timer\TimerService($config->services->requestUri, $config->services->pageStartTime);
});
```

Note:
`$config->services->requestUri` is value of server vaiable `$_SERVER['REQUEST_URI']` - page url for proper logging, you can pass here any string as you wish
`$config->services->pageStartTime` is value of server vaiable `$_SERVER['REQUEST_TIME_FLOAT']` - is needed to properly calculate page load time from the start of script
Service automatically creates root timer with name `'Page'` and description `$config->services->requestUri`.

## Usage:

* To start any timer just call method `start($name, $description = '')` with any name and description. Method will return timer reference instance which is used to stop timer:

```
$timerRef = $di->getTimer()->start('Api', 'endpoint url');
// ... some code
$timerRef->stop();
```

* Timer reference is stopping timer on destruct, thus you may not call `stop()` if you do not pass timer reference anywhere else:

```
function myCalculatedFunction() 
{
    $timerRef = $di->getTimer()->start('My component', 'myCalculatedFunction');
    // ... some code
}
```

When `myCalculatedFunction()` is finished, `$timerRef` destructor is called and timer is stopped, measuring total execution time of function

* Timer is working as tree, so if you start new timer before stoping previous, new timer will be child of last started timer:
 
```
$apiTimerRef = $di->getTimer()->start('Api');

$raceListTimerRef = $di->getTimer()->start('RaceList');
$callTimerRef = $di->getTimer()->start('http call');
// ... some api call
$callTimerRef->stop();
$processTimerRef = $di->getTimer()->start('processing response');
// ... some processing code
$processTimerRef->stop();
$raceListTimerRef->stop();

$cardTimerRef = $di->getTimer()->start('Card');
// ... some another api call
$cardTimerRef->stop();

$apiTimerRef->stop();
```

Resulting timers tree:
```
Page
  └-Api
      ├-RaceList
      |   ├-http call
      |   └-processing response
      └- Card
```

## Reporting:

* You can get total report by calling `$timerService->getReport()`:

```
$timerService = $di->getShared('timer');
$timerRef1 = $timerService->start('Parallel loading');
// ... API calls
$timerRef1->stop();
// ... some code
$timerRef2 = $timerService->start('Navigation', 'some description');
// ... navigation rendering
$timerRef2->stop();
// ... some code
$timerRef3 = $timerService->start('View');
// ... view rendering
$timerRef3->stop();
$report = $timerService->getReport();
```

```
Page /racecards/:
    Parallel loading: 0.42 s [13.68%]
    Navigation some description: 1.95 s [63.52%]
    View: 0.01 s [0.32%]
Total: 3.07 s [100.00%] (own time 0.69 s)
```

* You can get custom report by using your own reporter which implements `\RP\Utils\Timer\ReporterInterface`:

```
interface ReporterInterface
{
    /**
     * Generates report from timer with all subtimers tree
     * @param Timer $timer
     * @return mixed
     */
    public function getReport(Timer $timer);
}
```

`$timer` is instance of root page timer and has next interface:
 
* `float` `getTime()` Returns total time in seconds.
* `float` `getOwnTime()` Returns time in seconds without subtimers.
* `int` `getId()` Returns id of the timer
* `string` `getName()` Returns name of the timer
* `string` `getDescription()` Returns description of the timer
* `Timer[]` `getTimers()` Returns all subtimers
* `bool` `hasTimers()` Checks if timer has subtimers

For details please see default implementation `\RP\Utils\Timer\Reporter` and `\RP\Utils\Timer\Timer` 

To use your custom reporter, pass it as third parameter to service setup:
```
$di->setShared('timer', function () use ($config) {
    return new \RP\Utils\Timer\TimerService($config->services->requestUri, $config->services->pageStartTime, new MyCustomReporter());
});
```
