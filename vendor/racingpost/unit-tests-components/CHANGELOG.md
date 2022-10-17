# Unit-Tests-Components Change Log #

## 0.3.0 ##
 - Renamed getExpectedJson to getExpected to support different types except json
 - Added method that compares xml outputs
 - ApiRouteTestPrototype now is abstract. The logic for tests was splitted depends of response type. 
   For example UnitTestsComponents\ApiRouteTest\Json for json output 
   and UnitTestsComponents\ApiRouteTest\Xml for XML. Tests have to be extended from these implementations instead of ApiRouteTestPrototype as earlier

## 0.2.0 ##
 - Amended assertControllerResultEqualsJson

## 0.1.1 ##
 - Bug fixing

## 0.1.0 ##
 - Removed previous workaround. Added support TemporaryTableManager to clear temporary tables instead of it.
 
## 0.0.14 ##
 - Added workaround to avoid Exception when destructor is called, but FakePdo already has been cleared.

## 0.0.13 ##
 - Added ApiRouteTestPrototype, that allows to test app from Route. Removed previous workaround.

## 0.0.12 ##
 - Workaround: removed fakePdo->clear() call to avoid Exceptions on multiple tests with temp tables. This may cause other issues. TODO: refactor it with full investigation.
 
## 0.0.11 ##
 - Fixed DataCollector's issues due to amendments in TemporaryTable::dropTemporaryTable

## 0.0.10 ##
 - Added to DataCollector new method that can collect pure array
 
## 0.0.9 ##
 - Supporting for TemporaryTable classes added to DataCollector.

## 0.0.8 ##
 - DataProviders' bug fixing

## 0.0.7 ##
 - Fixed prediction for call using DataProviders

## 0.0.6 ##
 - Added new tool to help generate stubs. Fixed issue when result was not reset, when multiple call the same query.

## 0.0.5 ##
 - Removed getControllerClassName from StubDataInterface
 
## 0.0.4 ##
 - Fixed lower case before md5

## 0.0.3 ##
 - Added strtolower for md5 hash, renamed method assertControllerResult to assertControllerResultEqualsJson

## 0.0.2 ##
 - Fixed some initial issues

## 0.0.1 ##
 - Initial setup, Base components