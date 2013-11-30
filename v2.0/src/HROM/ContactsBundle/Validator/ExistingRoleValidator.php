<?php

namespace HROM\ContactsBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Validator for ExistingRole constraint
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
                $this->context->addViolation($constraint->message, array('%authorizedRoles%' => implode(', ', ExistingRole::getAuthorizedRoles())));
                return;
            }
        }
    }
}

?>
