<?php

namespace HROM\CoreBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\PropertyAccess\PropertyAccessor;

/**
 * Validator for UniqueCollectionItem constraint
 *
 * @author François Dupire
 * 
 * @Annotation
 */
class UniqueCollectionItemValidator extends ConstraintValidator
{    
    private $collectionValues = array();
    
    public function validate($value, Constraint $constraint) {
        if($constraint->propertyPath) {
            $propertyAccessor = new PropertyAccessor();
            $propertyValue = $propertyAccessor->getValue($value, $constraint->propertyPath);
        }
        
        if(in_array($propertyValue, $this->collectionValues)) {
            $this->context->addViolation($constraint->message);
        }
        
        $this->collectionValues[] = $propertyValue;
    }
}

?>
