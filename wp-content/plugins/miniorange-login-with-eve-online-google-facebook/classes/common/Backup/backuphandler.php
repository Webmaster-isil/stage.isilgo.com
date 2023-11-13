<?php


namespace MoOauthClient\Backup;

use MoOauthClient\App;
use MoOauthClient\Config;
class BackupHandler
{
    private $plugin_config;
    private $apps_list;
    public static function restore_settings($ss = '')
    {
        if (!(!is_array($ss) || empty($ss))) {
            goto Bz;
        }
        return false;
        Bz:
        $oR = false;
        $U_ = isset($ss["\x70\154\165\x67\151\156\137\143\157\156\146\x69\147"]) ? $ss["\160\x6c\x75\x67\x69\156\x5f\143\157\156\x66\151\x67"] : false;
        $Ai = isset($ss["\x61\160\160\137\143\x6f\x6e\x66\x69\x67\163"]) ? $ss["\141\160\x70\x5f\x63\157\x6e\146\151\x67\163"] : false;
        if (!$U_) {
            goto t0;
        }
        $oR = self::restore_plugin_config($U_);
        t0:
        if (!$Ai) {
            goto nS;
        }
        return $oR && self::restore_apps_config($Ai);
        nS:
        return false;
    }
    private static function restore_plugin_config($U_)
    {
        global $lT;
        if (!empty($U_)) {
            goto Aj;
        }
        return false;
        Aj:
        $zB = new Config($U_);
        if (empty($zB)) {
            goto A3;
        }
        $lT->mo_oauth_client_update_option("\155\157\137\x6f\x61\x75\164\150\x5f\143\154\x69\x65\x6e\x74\x5f\x63\157\156\146\151\x67", $zB);
        return true;
        A3:
        return false;
    }
    private static function restore_apps_config($Ai)
    {
        global $lT;
        if (!(!is_array($Ai) && empty($Ai))) {
            goto iA;
        }
        return false;
        iA:
        $JB = [];
        foreach ($Ai as $Or => $FK) {
            $kp = new App($FK);
            $kp->set_app_name($Or);
            $JB[$Or] = $kp;
            ge:
        }
        rd:
        $lT->mo_oauth_client_update_option("\155\157\x5f\157\141\x75\x74\150\137\x61\160\x70\x73\137\154\151\x73\x74", $JB);
        return true;
    }
    public static function get_backup_json()
    {
        global $lT;
        $yD = $lT->export_plugin_config();
        return json_encode($yD, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
}
