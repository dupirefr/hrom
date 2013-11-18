jQuery(document).ready(function($)
{
    var $rolesSelection = $('select#hrom_contactsbundle_contacttype_roles');
    var $rolesSelected = $('select#hrom_contactsbundle_contacttype_roles :selected');
    var $committeeRoleRow = $('select#hrom_contactsbundle_contacttype_committeeRole').parent();
    
    $committeeRoleRow.css('display', 'none');
    
    $rolesSelected.each(function() {
        if($(this).val() === 'ROLE_COMMITTEE') {
            $committeeRoleRow.css('display', 'inline-block');
        }
    });
    
    $rolesSelection.change(function() {        
        $rolesSelected.each(function() {
            var found = false;
            if($(this).val() === 'ROLE_COMMITTEE') {
                $committeeRoleRow.css('display', 'inline-block');
                found = true;
            }
            
            if(!found) {
                $committeeRoleRow.css('display', 'none');
            }
        });
    });
});