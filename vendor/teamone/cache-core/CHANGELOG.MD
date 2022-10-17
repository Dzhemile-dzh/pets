# Change log

### [6.0.0] - 2017-11-16
- Migration to PHP 7 and PHPUnit 6.4

### [5.0.0] - 2017-03-21
- Broken backward compatibility with previous version.
- Added dependency from content-attributes
- KeyStratagy was moved to content-attributes
- For ICacheComponent method createKeyStrategy was renamed to getKey and now it returns string of key

### [4.0.1] - 2017-03-01
- Changed 'force' logic, so now it don't remove existing key but just skipped read method

### [4.0.0] - 2017-02-24
- Added Locker and Indexer entities
- Break backward compatibility

### [2.0.1] - 2016-10-26
- Removed `racingpost/phalcon-ext`

### [2.0.0] - 2016-08-17
- Check for private cache control
- Require `rp\cache-lifetime`

### [1.2.1] - 2016-07-04
- Page 404 lifetime const added

### [1.2.0] - 2016-06-27
- Do not create cache files for 404 page and etc

### [1.1.0] - 2016-04-25
- Changed interface of IResponseDTO

### [1.0.3] - 2016-03-30
- Fix: do not use view service in ResponseBuilder if not defined

### [1.0.2] - 2016-03-30
- Third argument in EventsManager constructor is not mandatory

### [1.0.1] - 2016-03-29
- Fix: Prevent call of adapter save method if ResponseDTO object is null

### [1.0.0] - 2016-03-28
- Changed namespace of component
- Different initialization way applied
- Output object replaced with IResponseDTO interface
- Cache service works with Phalcon/Http/Response object

### [0.3.2]
- Output setHeaders method can take null argument

### [0.3.1]
- Fixed cache disabling

### [0.3.0]
- Surrogate keys implementation

### [0.2.4]
- Minor refactoring
- Removed lifetime default values

### [0.2.0]
- Force update cache functionality
- Namespace for EventsManager changed from RP\Cache\Core\Service to RP\Cache\Core

### [0.1.0]
- Disable creating cache functionality