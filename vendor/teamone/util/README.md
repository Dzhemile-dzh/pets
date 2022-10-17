#Goal of this package#
This package contains interface which determines a common method signature for building unique identifier. This unique 
identifier can be used as uniquely determinator. It can be used for creating key - value pair where key will be a value 
of buildUniqueIdentifier() method and value will be the object.

##PHP example##
    /* @var Phalcon\Util\IUniqueIdentifier $object */
    $object = new MyObject();
    
    $array = [
        $object->buildUniqueIdentifier() => $object
    ];