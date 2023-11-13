<?php


namespace MoOauthClient\Standard;

use MoOauthClient\MOUtils as CommonUtils;
class MOUtils extends CommonUtils
{
    private function manage_deactivate_cache()
    {
        global $lT;
        $iE = $lT->mo_oauth_client_get_option("\x6d\157\x5f\157\x61\x75\x74\x68\137\x6c\x6b");
        if (!(!$lT->mo_oauth_is_customer_registered() || false === $iE || empty($iE))) {
            goto rFe;
        }
        return;
        rFe:
        $Gr = $lT->mo_oauth_client_get_option("\150\157\x73\x74\137\x6e\x61\155\x65");
        $cX = $Gr . "\57\155\x6f\141\163\x2f\x61\160\x69\57\x62\141\143\153\x75\160\143\157\144\145\57\x75\x70\144\141\x74\x65\163\164\x61\164\165\163";
        $Vo = $lT->mo_oauth_client_get_option("\155\157\137\157\141\x75\164\150\137\x61\144\x6d\x69\x6e\137\x63\x75\x73\164\x6f\x6d\145\x72\x5f\x6b\x65\x79");
        $FS = $lT->mo_oauth_client_get_option("\x6d\x6f\137\x6f\141\165\x74\150\137\x61\144\x6d\151\156\137\x61\x70\151\x5f\x6b\145\x79");
        $NR = $lT->mooauthdecrypt($iE);
        $yg = round(microtime(true) * 1000);
        $yg = number_format($yg, 0, '', '');
        $V4 = $Vo . $yg . $FS;
        $rz = hash("\x73\x68\141\x35\61\x32", $V4);
        $F8 = "\103\x75\163\164\x6f\x6d\145\162\55\113\x65\171\x3a\40" . $Vo;
        $Xk = "\124\x69\155\145\163\164\141\155\160\x3a\x20" . $yg;
        $hh = "\101\165\164\150\157\x72\x69\x7a\x61\164\x69\157\x6e\72\40" . $rz;
        $RK = '';
        $RK = array("\x63\157\x64\145" => $NR, "\143\x75\163\164\157\x6d\145\162\113\145\171" => $Vo, "\141\x64\x64\151\x74\x69\157\156\141\x6c\106\x69\x65\x6c\144\x73" => array("\146\151\x65\x6c\x64\61" => site_url()));
        $Pv = wp_json_encode($RK);
        $Da = array("\103\x6f\x6e\x74\x65\x6e\164\55\x54\171\x70\x65" => "\x61\160\x70\x6c\x69\143\141\164\151\x6f\x6e\x2f\x6a\x73\157\156");
        $Da["\103\165\x73\x74\x6f\155\145\162\55\113\x65\x79"] = $Vo;
        $Da["\124\151\155\145\163\164\141\x6d\x70"] = $yg;
        $Da["\101\x75\164\150\x6f\162\x69\x7a\141\164\x69\x6f\156"] = $rz;
        $nt = array("\155\145\164\150\x6f\144" => "\x50\x4f\x53\124", "\142\x6f\x64\171" => $Pv, "\164\x69\155\x65\157\165\x74" => "\61\x35", "\162\145\x64\x69\162\x65\x63\x74\151\x6f\156" => "\x35", "\150\164\164\x70\x76\145\x72\163\x69\157\x6e" => "\x31\x2e\60", "\x62\154\x6f\x63\x6b\x69\x6e\147" => true, "\x68\x65\x61\x64\x65\162\x73" => $Da);
        $Qv = wp_remote_post($cX, $nt);
        if (!is_wp_error($Qv)) {
            goto zc6;
        }
        $gl = $Qv->get_error_message();
        echo "\x53\157\x6d\145\164\150\151\156\x67\40\x77\145\156\164\40\x77\162\x6f\x6e\x67\x3a\x20{$gl}";
        exit;
        zc6:
        return wp_remote_retrieve_body($Qv);
    }
    public function deactivate_plugin()
    {
        $this->manage_deactivate_cache();
        parent::deactivate_plugin();
        $this->mo_oauth_client_delete_option("\155\x6f\137\x6f\x61\x75\164\150\x5f\154\x6b");
        $this->mo_oauth_client_delete_option("\x6d\157\137\x6f\141\165\164\150\x5f\x6c\x76");
    }
    public function is_url($cX)
    {
        $Qv = [];
        if (empty($cX)) {
            goto xdN;
        }
        $Qv = @get_headers($cX) ? @get_headers($cX) : [];
        xdN:
        $jQ = preg_grep("\x2f\50\56\52\51\62\x30\x30\x20\117\113\57", $Qv);
        return (bool) (sizeof($jQ) > 0);
    }
}
