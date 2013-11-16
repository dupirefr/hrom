<?php

namespace HROM\CoreBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * Constraint to insure that an item in a collection is unique
 *
 * @author François Dupire
 * 
 * @Annotation
 */
class UniqueCollectionItem extends Constraint
{
    public $message = 'Il ne peut y avoir plusieurs fois cet objet dans la collection.';
    
    public $propertyPath = null;
}

?>
