<?php

namespace HROM\ContactsBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Constraint to insure that a date is in the future.
 *
 * @author François Dupire
 * 
 * @Annotation
 */
class ExistingRoleValidator extends ConstraintValidator
{    
    public function validate($value, Constraint $constraint) {
        foreach($value as $role) {
            if(!array_key_exists($role, ExistingRole::getAuthorizedRoles())) {
                $this->context->addViolation($constraint->message, array('%authorizedRoles%' => implode(',', ExistingRole::getAuthorizedRoles())));
                return;
            }
        }
    }
}

?>
