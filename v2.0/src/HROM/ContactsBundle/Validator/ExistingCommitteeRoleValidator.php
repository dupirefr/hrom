<?php

namespace HROM\ContactsBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Validator for ExistingCommitteeRole constraint
 *
 * @author François Dupire
 * 
 * @Annotation
 */
class ExistingCommitteeRoleValidator extends ConstraintValidator
{    
    public function validate($value, Constraint $constraint) {
        if(!array_key_exists($value, ExistingCommitteeRole::getAuthorizedRoles())) {
            $this->context->addViolation($constraint->message, array('%authorizedRoles%' => implode(', ', ExistingCommitteeRole::getAuthorizedRoles())));
        }
    }
}

?>
