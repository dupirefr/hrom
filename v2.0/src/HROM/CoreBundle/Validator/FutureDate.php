<?php

namespace HROM\CoreBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * Constraint to insure that a date is in the future.
 *
 * @author François Dupire
 * 
 * @Annotation
 */
class FutureDate extends Constraint
{
    public $message;
}

?>
