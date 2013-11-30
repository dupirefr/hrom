<?php
namespace HROM\CoreBundle\Other;

/**
 * Classes with miscellaneous tools
 *
 * @author François Dupire
 */
class Utils
{
    /**
     * Copies an array
     * 
     * @param array $originalArray
     * @return array
     */
    public static function copyArray($originalArray)
    {
        $copiedArray = array();
        
        foreach($originalArray as $item) {
            $copiedArray[] = $item;
        }
        
        return $copiedArray;
    }
    
    /**
     * Substract an array from another.
     * REQUIRE : arrays element to have an accessible id attribute.
     * 
     * @param array $originalArray
     * @param array $toSubstractArray
     * @return array
     */
    public static function substractArray($originalArray, $toSubstractArray)
    {
        foreach($toSubstractArray as $toSubstractItem) {
            foreach($originalArray as $key => $item) {
                if($item->getId() === $toSubstractItem->getId()) {
                    unset($originalArray[$key]);
                }
            }
        }
        return $originalArray;
    }
}

?>
