<?php
class Helper
{
    /**
     * Checks if the given array is an associative array.
     * An associative array is defined as an array where at least one key is a string.
     * This method first verifies that the input is an array. Then, it checks if any of the array keys are strings.
     * If at least one key is a string, it returns true, indicating that the array is associative.
     *
     * @param mixed $arr The variable to check. While this method is intended for arrays, 
     *                   it can accept any type, returning false if the input is not an array.
     * @return bool Returns true if $arr is an associative array, false otherwise. If $arr is not an array, 
     *              the method's behavior is undefined, and it may not return a value.
     */
    public static function isAssoc($arr)
    {
        if (is_array($arr)) {
            return count(array_filter(array_keys($arr), 'is_string')) > 0;
        }
        // It would be good practice to ensure a boolean return in all cases.
        return false;
    }
}
