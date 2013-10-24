<?php

namespace HROM\CoreBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Constraint to insure that a date is in the future.
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
