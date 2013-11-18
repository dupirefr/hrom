<?php

namespace HROM\ContactsBundle\Validator;

use HROM\ContactsBundle\Entity\Contact;

/**
 * Constraint to insure that a contact's role is valid.
 *
 * @author François Dupire
 * 
 * @Annotation
 */
class ExistingCommitteeRole extends ExistingRole
{    
    private static $authorizedRoles = array('ROLE_COMM_CHAIRMAN' => 'Président(e)', 'ROLE_COMM_TREASURER' => 'Trésorier/Trésorière', 'ROLE_COMM_SECRETARY' => 'Secrétaire', 'ROLE_COMM_MEMBER' => 'Membre');

    public static function getAuthorizedRoles() {
        return self::$authorizedRoles;
    }
    
    /**
     * Determines who from $a and $b precedes the other in the functions hierarchy.
     * 
     * @param Contact $a
     * @param Contact $b
     * @return int
     */
    public static function precedence(Contact $a, Contact $b) {
        $roleA = $a->getCommitteeRole();
        $roleB = $b->getCommitteeRole();
        
        if($roleA === $roleB) {
            return 0;
            
        } else if($roleA === 'ROLE_COMM_CHAIRMAN') {
            return -1;
            
        } else if($roleB === 'ROLE_COMM_CHAIRMAN') {
            return 1;
            
        } else if($roleA === 'ROLE_COMM_MEMBER') {
            return 1;
            
        } else if($roleB === 'ROLE_COMM_MEMBER') {
            return -1;
            
        } else {
            return 0;
        }
    }
}

?>
