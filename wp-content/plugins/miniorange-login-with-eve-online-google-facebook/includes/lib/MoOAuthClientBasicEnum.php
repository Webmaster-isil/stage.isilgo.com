<?php


abstract class MoOAuthClientBasicEnum
{
    private static $constCacheArray = NULL;
    public static function getConstants()
    {
        if (!(self::$constCacheArray == NULL)) {
            goto iBH;
        }
        self::$constCacheArray = [];
        iBH:
        $d_ = get_called_class();
        if (array_key_exists($d_, self::$constCacheArray)) {
            goto XOg;
        }
        $gO = new ReflectionClass($d_);
        self::$constCacheArray[$d_] = $gO->getConstants();
        XOg:
        return self::$constCacheArray[$d_];
    }
    public static function isValidName($LE, $tT = false)
    {
        $b9 = self::getConstants();
        if (!$tT) {
            goto XUk;
        }
        return array_key_exists($LE, $b9);
        XUk:
        $aY = array_map("\x73\x74\162\164\157\x6c\157\x77\x65\x72", array_keys($b9));
        return in_array(strtolower($LE), $aY);
    }
    public static function isValidValue($W7, $tT = true)
    {
        $oS = array_values(self::getConstants());
        return in_array($W7, $oS, $tT);
    }
}
