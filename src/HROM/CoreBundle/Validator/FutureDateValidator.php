<?php

namespace HROM\CoreBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Validator for FutureDate constraint
 *
 * @author François Dupire
 * 
 * @Annotation
 */
class FutureDateValidator extends ConstraintValidator
{    
    public function validate($value, Constraint $constraint) {
        if($value < new \DateTime()) {
            $this->context->addViolation($constraint->message);
        }
    }
}

?>
