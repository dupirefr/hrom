jQuery(document).ready(function($)
{
    var $container = $('div#hrom_contactsbundle_contacttype_phoneNumbers');

    var $addButton = $('<a href="#" class="btn plus-btn">+</a>');
    
    $addButton.click(function(e)
    {
        addPhone($container);
        e.preventDefault();
        
        return false;
    });
    
    var rowsNumber = $container.find(':input').length;
    
    var index = rowsNumber;
    
    var $prototype = $($container.attr('data-prototype')
            .replace(/__phone_proto__/g, rowsNumber)
    );
    
    if(rowsNumber == 0) {
        initialize($container);

    } else {
        $container.children('div.row').each(function()
        {           
            addDeleteButton($(this));
        });
    }
    
    function initialize($container)
    {        
        $prototype.append($addButton);
        $container.append($prototype);
        
        rowsNumber++;
        index++;
    }
    
    function addPhone($container)
    {            
        if(rowsNumber == 1) {
            addDeleteButton($prototype);
        }
        
        $prototype = $($container.attr('data-prototype')
                .replace(/__phone_proto__/g, index)
        );
            
        addDeleteButton($prototype);
        $prototype.append($addButton);
        
        $container.append($prototype);
        
        rowsNumber++;
        index++;
    }

    function addDeleteButton($prototype)
    {
        var $deleteButton = $('<a href="#" class="btn minus-btn">-</a>');

        $deleteButton.appendTo($prototype);

        $deleteButton.click(function(e)
        {
            $prototype.remove();
            e.preventDefault();
            
            rowsNumber--;

            if(rowsNumber == 1) {
                $('div#hrom_contactsbundle_contacttype_phoneNumbers .minus-btn').remove();
                $('div#hrom_contactsbundle_contacttype_phoneNumbers').children('div.row').each(function()
                {
                    $(this).append($addButton);
                });
            }
            
            return false;
        });
    }
});