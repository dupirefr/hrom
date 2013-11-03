jQuery(document).ready(function($)
{
    var $container = $('div#hrom_contactsbundle_contacttype_emailAddresses');

    var $addButton = $('<div id="addEmail"><a href="#" class="btn">Ajouter</a></div>');
    $container.append($addButton);

    $addButton.click(function(e)
    {
        addPhone($container);
        e.preventDefault();
        
        return false;
    });
    
    var index = $container.find(':input').length;
    
    if(index == 0) {
        addPhone($container);
        
    } else {
        $container.children('div').each(function()
        {
           addDeleteButton($(this)); 
        });
    }
    
    function addPhone($container)
    {
        var $prototype = $($container.attr('data-prototype')
                .replace(/__name__/g, index)
        );
            
        addDeleteButton($prototype);
        
        $container.append($prototype);
        
        index++;
    }

    function addDeleteButton($prototype)
    {
        $deleteButton = $('<a href="#" class="btn">Supprimer</a><br /><br />');
        
        $deleteButton.appendTo($prototype);
        
        $deleteButton.click(function(e)
        {
           $prototype.remove();
           e.preventDefault();
           
           return false;
        });
    }
});