# Phalcon-Ext Change Log #

## 2.3.1 ##
 - Fixed potential fatal error

## 2.3.0 ##
 - Refactored Result class to support ResultClearbleInterface. It helps doing additional transformation if is set.
   Result class has to implement that interface.

## 2.2.0 ##
 - Refactored Result class. All things related to certain response type moved to api-library. 

## 2.1.16 ##
 - Fixed issue when string param was not working in Mapper
 - Improved error messages for some Mapper's exception

## 2.1.15 ##
 - Fixed error for complex expressions, when expression was in where clause.
 - Refactored regexp

## 2.1.14 ##
 - Removed unused method getSqltemplate
 - Rearranged expressions processing: added an ability to pass a Builder instance into union
 - Small fixes

## 2.1.13 ##
 - Fixes for 2.1.12

## 2.1.12 ##
 - Extended failover messages when something is happened.

## 2.1.11 ##
 - Implemented Sybase cluster failover in database adapter. servername element in $descriptor now can be semicolon separated string to get array of servers.

## 2.1.10 ##
 - Removed setCustomParams method
 - Changed method's name setCustomParam to setParam and modified logic of this method to return Builder object (instead of void), so we can use method chaining to gather parameters.

## 2.1.9 ##
 - Fixed bug in name space

## 2.1.8 ##
 - Updated DataCollector comments

## 2.1.7 ##
 - Added DataCollector comments

## 2.1.6 ##
 - Emulation of query moved to strategy, so it can be used now separately

## 2.1.5 ##
 - Added posibility to set custom PDO instead of using \PDO. It allows to use fake PDO for testing. See Phalcon\Db\Adapter\Sybase::setCustomPdoObject method

## 2.1.4 ##
 - Minor fixes

## 2.1.3 ##
 - Changed visibility for fetchAll from private to public. It happens becuase DbLib drive can handle just one statement per connection

## 2.1.2 ##
 - Fix of executePrepared function in sybase adapter
 - Fix of fatal error with $bindTypes parameter
 - Fix of execute function in sybase adapter

## 2.1.1 ##
 - Defined default result set class fro base model
 
## 2.1.0 ##
 - Added Multiple resultset for queries or stored procedures that retuns more that one resultset

## 2.0.2 ##
 - Fix for Sybase Dialect regarding incorrect calculation that field can be null

## 2.0.1 ##
 - Added using of persistent connection for PDO

## 2.0.0 ##
 - Migration to PHP 7 and PHPUnit 6.4
 - Changed driver from sybase_ct to dblib with PDO 

## 1.2.9 ##
 - Update `Phalcon\Db\Sql\Builder` methods `columns`. solution of a problem with a superfluous comma

## 1.2.8 ##
 - Added \Phalcon\Input\Request\Parameter\Cast\Callback

## 1.2.7 ##
 - Amended response to support errors array with identical codes

## 1.2.6 ##
 - Fix issue with WHERE clause when next word is AS
 - Changed variable placeholder format to /:([a-z]+[_a-z0-9]+):?/im
 
## 1.2.5 ##
Move to the end replace `expression` in `\Phalcon\Db\Sql\Builder` 

## 1.2.4 ##
Create methods in `\Phalcon\Db\Sql\Builder` :
- setCustomParam($name, $value)
- setParamsColumnType($name, $value)

## 1.2.2 ##

Builder's template for where clause was renamed from 
**_TEMPLATE_CONDITIONS = '/\*{CONDITIONS}\*/'_** to **TEMPLATE_WHERE = '/\*{WHERE}\*/'**

## 1.2.1 ##

Small fix

## 1.2.0 ##

Improved Builder's methods where() and columns().
 
Now where() doesn't replace empty conditions to 1 = 1. 

columns() now can handle with string and array. 

**Note:** if you want to add column that contains comma(,) e.g CONVERT(CHAR(20), order_date, 7) need to use array instead of string.

**Example:** ['CONVERT(CHAR(20), order_date, 7)']

## 1.1.2 ##

Fixed a bug in Sybase adapter when there is no error when using query without bind parameters or preparedStatement is false

## 1.1.1 ##

Bug fixing

## 1.1.0 ##

Removed processField method from Mapper. For the same action must be used "(function)" call in left side of mapper.
Added support action in reight side of mapper. Syntax '(ca->methodName)fieldName'.  In that case will be called method methodName from object in field ca in current instance of Mapper. 

## 1.0.25 ##

The new validators for integer values have been added:
- `\Phalcon\Input\Request\Parameter\Validator\SybaseInt` boundary values [-2147483648 .. 2147483647]
- `\Phalcon\Input\Request\Parameter\Validator\SybaseSmallint` boundary values [-32768 .. 32767]

## 1.0.24 ##
**\Phalcon\Db\Sql\Builder** - has been added
**\Phalcon\Mvc\DataProvider** - has been extended by methods:
- `queryBuilder(Builder $builder)`
- `executeBuilder(Builder $builder)`

## 1.0.22 ##

Added NativeArrayCurrentPage paginator for the case when we want to have only one page and know all other parameters

## 1.0.18 ##

Added new `Phalcon\Mvc\Model\BaseModely` method beforeUpdate 
For skipping non updated parameters.

## 1.0.17 ##

Added new `\Phalcon\Input\Request\Parameter\Cast\StringToArray` class 
intended to keep consistency of passed string parameters.

## 1.0.16 ##

An error in the `\Phalcon\Output\Result::arrayToXml` method related 
with 'unterminated entity reference Services' warning has been fixed

## 1.0.15 ##

The `\Phalcon\Input\Request` class has been extended with additional interface :
 
 - **\Phalcon\Input\Request::isRegisterEmpty** - method returns boolean true if 
 internal variable `\Phalcon\Input\Request::$register` is empty.

## 1.0.14 ##

The `\Phalcon\Input\Request` class has been extended with additional interfaces : 

- **\Phalcon\Input\Request::isParameterProvided($parameterName)** - method checks 
if parameter is coming from user request
- **\Phalcon\Input\Request::retrieveDefaultValue($parameterName)** - method calls 
logic of retrieving default parameter directly

## 1.0.12 ##

The `\Phalcon\Input\Request` class has been extended with additional interfaces : 

- **\Phalcon\Input\Request::set($name, $object)**

- **\Phalcon\Input\Request::get($name)**

This interfaces are intended to share information for internal classes/objects of the Request (`\Phalcon\Input\Request\Parameter`, `\Phalcon\Input\Request\Parameter\Calculate\ByDefault` etc.)

New class **\Phalcon\Input\Request\Parameter\Calculate\ByDefault** has been added for ability
to calculate default values in lazy manner.


## 1.0.9 ##

A processing of a big responses has been removed from *\Phalcon\Output\Result::bindRowToMapper* 
due adding specific class *\Api\Result\BigJson* in **api-library** for handling of big JSON 

## 1.0.8 ##

Test coverage was improved.
Validators InArray and RegEx are validating only scalar (array type was removed)
**Required** racingpost/api-library v0.2.2 and higher

## 1.0.7 ##

Getter for status code in result was added

## 1.0.6 ##

A method `\Phalcon\Input\Request::castParameters()` has been removed.
So, now, for right work of \Phalcon\Input\Request class in the method **setupParameters()**

- you have to specify needed 'casters' (as example `\Phalcon\Input\Request\Parameter\Cast\DecimalInteger`) 
to cast value to the integer type before it will be validated with a particular validator.

## 1.0.5 ##

bug related with casting just ordered parameters has been fixed

## 1.0.4 ##

Bug related with wrong message building for \Phalcon\Input\Request\Parameter\Validator\Date class has been fixed

## 1.0.3 ##

Bug related with casting has been fixed

## 1.0.2 ##

The new approach for work with requests has been provided.

All validators have been refactored accordingly with new paradigm that assumes that values 
that have to be validated have right type (integer, boolean, float etc). 

The new classes have been added to cast parameters to right type. 
So, now, for right work of `\Phalcon\Input\Request` class in the method `**castParameters()**`
you have to specify needed 'casters' (as example \Phalcon\Input\Request\Parameter\Cast\DecimalInteger) 
to cast value to the integer type before it will be validated with a particular validator.

## 1.0.0 ##

Merged 0.3.* and 0.2.*

## 0.3.2 ##

Added new model entity called **DataProvider**. it a Model form MVC pattren but without table representation like \Phalcon\Mvc\Model

## 0.3.1 ##

Fixed Sybase Dialect issues. 

MetaData now is correct generated  for composite primary keys. 

Sybase adapter is compatible with Phalcon DevTools. 

## 0.3.0 ##

Migrated to **Phalcon 2.1. RC1**. Resolved compatibility with new interfaces. Fixed ORM issues.
 
## 0.2.19 ##

**Fix** Updated the Diffusion character logic to use &lt;R> for a ']' symbol instead of &lt;T>  

## 0.2.7 ##

Fixed \Phalcon\Input\Request\Parameter\Validator\ExistsInArray issues.

Test \Test\Input\Request\Parameter\Validator\ExistsInArrayTest improved

## 0.2.6 ##

Fixed \Phalcon\Input\Request\Parameter\Validator\ArrayParameter issues. 

A strict checking an array type.

A fatal error originated due creating of info message has been fixed.
