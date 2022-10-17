# Api Library Change Log #

## 0.2.1 ##

Allow URI parameters to be optional. Logical exceptions added on groups consistency.

## 0.2.0 ##

A support of groups has been added to reduce amount of files need for creation of doc.
 - An interface `CompositeInterface` has been extended with
`string getPath()`, `CompositeInterface[] getGroups()`. 
The method signature has changed for `CompositeInterface::addChild(CompositeInterface $leaf)`
 - An appropriate logic has been implemented in the inherited classes `Branch` and `Leaf`
 - A constructor for `Branch` has been added  `__construct(string $pathTemplate = null)`
 - New static methods `void turnOnShortVersionDoc()` and `turnOnFullVersionDoc()` have been added
 to `Branch` class to manage process of building documentation.
 - New class `Group` has been added to emulate variety of URI paths
 - The `ResponseType` class has been made non abstract to implement common logic for all responses.
 Also static factory method `build()` has been added.
 - The interface of `Response` class has been changed (`getBody()` -> `getBodies()`) 
 and extended (`getIdentifier()`, `getMainBody()`).
 Also static factory method `build()` has been added.
 
**All logic has been covered with Unit tests.**


## 0.1.8 ##

FIxed a bug when schema was overrided by next method, if amount of methods is more than 1.

## 0.1.7 ##

Fixed incorrect type for swagger's parameter when it is in POST PUT or DELETE

## 0.1.6 ##

Updated jar file for validation

## 0.1.5 ##

Fixed encoding issues

## 0.1.4 ##

Removed strict warnings

Fixed usse when required field of param was 'false'

## 0.1.3 ##

Changed __iconv__ IGNORE to TRANSLIT to prevent loss symbols

## 0.1.2 ##

Added installation script for git hooks on pre-commit that is working with phpcs

Added jar file for validation swagger file. This validation is used for Amazon.

## 0.1.1 ##

RAML file already has correct version number

## 0.1.0 ##

Basic implementation

