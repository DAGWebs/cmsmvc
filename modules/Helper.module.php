<?php
class Helper {
    public static function isAssoc( $arr) {
        if(is_array($arr)) {
            return count(array_filter(array_keys($arr), 'is_string')) > 0;
        }
    }
}