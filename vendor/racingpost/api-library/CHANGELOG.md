# Api Library Change Log #

## 0.5.15 ##

Added 'service' and 'version' tags to DataDog API request trace. Updated dependancies. Removed failing test stage from Gitlab Tag deployment.

## 0.5.3 ##

Fixed a bug, when some cases attributes was not applied to XML element

## 0.5.2 ##

Added possibility to mark field as element value. In that case all other elements as same level wil be ignored.

## 0.5.1 ##

Added possibility to mark field as xml attribute in mapper class.

## 0.5.0 ##

Refactored behaviour regarding Result. Now Result is abstract. Need to use concrete child of it such as Json, Xml etc.

## 0.4.12 ##
Increased deep of returning array at TemporaryTableManager::find to handle temporary tables with the same name

## 0.4.11 ##
Added TemporaryTableManager to handle TemporaryTables drop and destruction.
Any TemporaryTable will be added to the manager if it is in DI.
```
$di->setShared(
    \Api\Mvc\DataProvider\TemporaryTableManager::SERVICE_NAME,
    new \Api\Mvc\DataProvider\TemporaryTableManager()
);

... 

$manager = Di::getDefault()->getShared(TemporaryTableManager::SERVICE_NAME);
$arr = $manager->find("|.*someName.*|");
$manager->clear();


```


## 0.4.10 ##
Removed parameter $countryCode from method "prepareToPdf". 
Changed "RoundNullable" to "roundNullable"

## 0.4.9 ##
TemporaryTable::dropTemporaryTable is refactored. Added lazy loading on it. It can be called from register_shutdown and __destruct, but will execute just once.

## 0.4.8 ##
Changed behavior for TemporaryTable::dropTemporaryTable, now it's on register_shutdown instead of destruct

## 0.4.7 ##
Added BuilderBasedTemporaryTable::TEMPLATE_FOR_TABLE_NAME constant, that helps to use this class.

## 0.4.6 ##
Added unit tests for TemporaryTable. Due to this the class was slightly refactored: dropTemporaryTable now is public.
Added custom implementation of BuilderBasedTemporaryTable. It is Builder based realisation. It allows using prepared Builder query instead of implementing new realization.

## 0.4.5 ##
Added class that helps to create temporary tables.
Added new tools namespace and new tool Math.

## 0.4.4 ##

Removed countryCode logic in Mapper->prepareToPdf method 

## 0.4.3 ##

Added Controller class that has to be common for all API. It is needed for unit-tests-components package.

## 0.4.2 ##

Added function RoundNullable to class \Api\Output\Mapper

## 0.4.1 ##

Added collapseEmptySection() method for results

## 0.4.0 ##

Migration to PHP 7 .

## 0.3.2 ##

Added function for collapsing empty section in class \Api\Result

## 0.3.0 ##

Added support racingpost/phalcon-ext >=1.1.0
Added default adapter for Mapper's content attributes

## 0.2.3 ##

A new class **\Api\Result\BigJson** has been added to tackle issue regarding memory overload.

Few additional dependencies have been added to the composer.json - 
*teamone/util (0.1.\*), phpunit/phpunit (4.6.\*)*

The **version of PHP** has been changed from 5.4 to **5.5** in the composer.json

## 0.2.2 ##

An interface of class **\Api\Input\Request** has been changed accordingly with changes in our phalcon-ext library.

The restriction in the composer.json have been reinforced **phalcon-ext >= 1.0.2.**


## 0.2.1 ##

Refactored class **GetCourseImagePath**, it was moved from rp_utils to api-library.

Class **GetCourseTeaserSuffix** was moved into **GetCourseImagePath** as method

## 0.2.0 ##

Added **Cache Manager Client**, that allows to send CM request and clear cache using CM (**api-library\library\Cache\CacheManagerClient\Client.php**).

Added class **SharedConstants** that allows to store any constants between all our projects (**api-library\library\SharedConstants.php**).


