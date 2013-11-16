<?php

namespace HROM\ContactsBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * Constraint to insure that a contact's role is valid.
 *
 * @author François Dupire
 * 
 * @Annotation
 */
class ExistingRole extends Constraint
{
    public $message = 'Le rôle défini n\'est pas valide. Veuillez choisir un des rôles suivants : %authorizedRoles%';
    
    private static $authorizedRoles = array('ROLE_COMMITTEE' => 'Comitard', 'ROLE_DIRECTOR' => 'Chef de Musique', 'ROLE_TEACHER' => 'Professeur', 'ROLE_MUSICIAN' => 'Musicien');

    public static function getAuthorizedRoles() {
        return self::$authorizedRoles;
    }
}

?>
