/**
 * JS script for showing/unshowing committees roles regarding to users' roles
 * 
 * @author François Dupire
 */
jQuery(document).ready(function($)
{
    var $rolesSelection = $('select#hrom_contactsbundle_contacttype_roles');
    var rolesSelected = 'select#hrom_contactsbundle_contacttype_roles :selected';
    var $committeeRoleRow = $('select#hrom_contactsbundle_contacttype_committeeRole').parent();
    
    $committeeRoleRow.css('display', 'none');
    
    function isCommitteeRoleSelected(selected)
    {
        var found = false;
        
        selected.each(function()
        {
            if($(this).val() === 'ROLE_COMMITTEE')
            {
                found = true;
            }
        });
        
        return found;
    }
    
    function switchCommitteeRoleVisibility(event) {
        var selected = $(event.data.selected);
        var row = event.data.row;
        
        var found = isCommitteeRoleSelected(selected);
        
        if(found)
        {
            row.css('display', 'inline-block');
        }
        else        
        {
            row.css('display', 'none');
        }
    }
    
    if(isCommitteeRoleSelected($(rolesSelected)))
    {
        $committeeRoleRow.css('display', 'inline-block');
    }
    
    $rolesSelection.change({selected : rolesSelected, row: $committeeRoleRow}, switchCommitteeRoleVisibility);
});