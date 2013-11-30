/**
 * JS script for adding/removing email's input in form
 * 
 * @author François Dupire
 */

jQuery(document).ready(function($)
{
    var $container = $('div#hrom_contactsbundle_contacttype_emailAddresses');

    var $addButton = $('<div id="addEmail"><a href="#" class="btn plus-btn">+</a></div>');
    $container.prepend($addButton);

    $addButton.click(function(e)
    {
        addPhone($container);
        e.preventDefault();
        
        return false;
    });
    
    var index = $container.find(':input').length;
    
    if(index > 0) {
        $container.children('div.row').each(function()
        {
           addDeleteButton($(this)); 
        });
    }
    
    function addPhone($container)
    {
        var $prototype = $($container.attr('data-prototype')
                .replace(/__email_proto__/g, index)
        );
            
        addDeleteButton($prototype);
        
        $container.append($prototype);
        
        index++;
    }

    function addDeleteButton($prototype)
    {
        $deleteButton = $('<a href="#" class="btn minus-btn">-</a>');
        
        $deleteButton.appendTo($prototype);
        
        $deleteButton.click(function(e)
        {
           $prototype.remove();
           e.preventDefault();
           
           return false;
        });
    }
});