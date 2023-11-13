<?php


namespace MoOauthClient\Backup;

use MoOauthClient\App;
class EnvVarResolver
{
    public static function resolve_var($HH, $W7)
    {
        switch ($HH) {
            case "\155\x6f\137\x6f\141\x75\164\x68\137\141\x70\160\x73\x5f\154\x69\163\x74":
                $W7 = self::resolve_apps_list($W7);
                goto GW;
            default:
                goto GW;
        }
        BC:
        GW:
        return $W7;
    }
    private static function resolve_apps_list($W7)
    {
        if (!is_array($W7)) {
            goto nO;
        }
        return $W7;
        nO:
        $W7 = json_decode($W7, true);
        if (!(json_last_error() !== JSON_ERROR_NONE)) {
            goto h2;
        }
        return [];
        h2:
        $i9 = [];
        foreach ($W7 as $Or => $FK) {
            if (!$FK instanceof App) {
                goto Rc;
            }
            $i9[$Or] = $FK;
            goto BJ;
            Rc:
            if (!(!isset($FK["\x63\154\151\x65\x6e\x74\137\151\x64"]) || empty($FK["\x63\154\x69\x65\156\x74\137\151\144"]))) {
                goto Nn;
            }
            $FK["\143\154\x69\145\156\x74\137\151\x64"] = isset($FK["\143\x6c\151\x65\156\x74\x69\x64"]) ? $FK["\x63\154\151\145\156\164\x69\x64"] : '';
            Nn:
            if (!(!isset($FK["\x63\x6c\x69\x65\x6e\164\x5f\x73\145\x63\162\x65\x74"]) || empty($FK["\143\x6c\151\x65\x6e\164\137\x73\145\x63\x72\145\x74"]))) {
                goto TT;
            }
            $FK["\x63\x6c\x69\145\156\164\x5f\x73\x65\143\x72\145\x74"] = isset($FK["\143\x6c\x69\145\x6e\164\163\145\143\x72\145\x74"]) ? $FK["\143\154\151\145\156\164\x73\x65\x63\x72\145\164"] : '';
            TT:
            unset($FK["\x63\x6c\151\145\156\164\x69\x64"]);
            unset($FK["\143\x6c\x69\x65\x6e\164\x73\x65\143\162\145\x74"]);
            $kp = new App();
            $kp->migrate_app($FK, $Or);
            $i9[$Or] = $kp;
            BJ:
        }
        Qb:
        return $i9;
    }
}
