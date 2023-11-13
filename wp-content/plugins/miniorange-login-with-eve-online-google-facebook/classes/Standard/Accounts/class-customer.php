<?php


namespace MoOauthClient\Standard;

use MoOauthClient\Customer as NormalCustomer;
class Customer extends NormalCustomer
{
    public $email;
    public $phone;
    private $default_customer_key = "\61\66\x35\65\x35";
    private $default_api_key = "\x66\x46\x64\x32\130\143\x76\124\x47\x44\145\x6d\132\166\142\167\x31\142\x63\125\145\x73\116\112\127\105\x71\113\x62\x62\x55\x71";
    public function check_customer_ln()
    {
        global $lT;
        $cX = $lT->mo_oauth_client_get_option("\150\x6f\163\x74\137\156\141\155\145") . "\57\155\x6f\141\163\x2f\162\x65\163\x74\x2f\x63\x75\x73\164\157\x6d\x65\162\x2f\x6c\x69\x63\145\156\163\x65";
        $Vo = $lT->mo_oauth_client_get_option("\155\x6f\137\157\x61\165\x74\x68\137\x61\144\x6d\151\x6e\137\x63\x75\163\x74\x6f\x6d\145\162\x5f\153\145\171");
        $FS = $lT->mo_oauth_client_get_option("\x6d\x6f\137\157\141\x75\164\150\137\x61\144\155\151\156\137\x61\x70\151\x5f\153\x65\171");
        $vP = $lT->mo_oauth_client_get_option("\x6d\x6f\137\x6f\141\165\164\x68\137\x61\144\155\x69\x6e\137\x65\155\141\151\154");
        $O8 = $lT->mo_oauth_client_get_option("\155\x6f\x5f\157\x61\165\x74\x68\x5f\x61\144\x6d\x69\156\137\x70\150\x6f\156\x65");
        $yg = self::get_timestamp();
        $V4 = $Vo . $yg . $FS;
        $rz = hash("\x73\x68\141\x35\61\x32", $V4);
        $F8 = "\103\165\163\x74\157\x6d\x65\x72\55\113\x65\x79\x3a\40" . $Vo;
        $Xk = "\124\x69\155\145\163\164\141\x6d\x70\x3a\40" . $yg;
        $hh = "\101\165\x74\x68\x6f\162\151\172\141\x74\x69\x6f\x6e\x3a\40" . $rz;
        $RK = '';
        $RK = array("\x63\x75\x73\164\157\155\145\162\111\x64" => $Vo, "\141\x70\x70\x6c\151\x63\x61\164\x69\x6f\156\116\141\155\145" => "\167\x70\137\157\x61\165\164\150\137\x63\x6c\x69\x65\156\164\137" . \strtolower($lT->get_versi_str()) . "\x5f\x70\x6c\141\x6e");
        $Pv = wp_json_encode($RK);
        $Da = array("\103\x6f\156\164\x65\x6e\x74\x2d\x54\x79\160\145" => "\141\x70\160\154\x69\143\x61\164\151\x6f\156\57\152\x73\157\x6e");
        $Da["\x43\165\x73\164\157\155\145\x72\55\113\145\171"] = $Vo;
        $Da["\124\x69\x6d\x65\163\x74\141\155\160"] = $yg;
        $Da["\x41\x75\164\150\157\162\x69\x7a\141\164\151\x6f\156"] = $rz;
        $nt = array("\155\x65\x74\150\157\144" => "\x50\117\123\124", "\x62\x6f\x64\171" => $Pv, "\x74\151\155\x65\157\x75\164" => "\x31\65", "\x72\145\144\151\x72\x65\x63\164\151\x6f\x6e" => "\65", "\x68\x74\x74\160\166\145\x72\163\151\x6f\156" => "\x31\x2e\x30", "\x62\154\x6f\143\153\x69\x6e\147" => true, "\150\145\x61\144\145\162\163" => $Da);
        $Qv = wp_remote_post($cX, $nt);
        if (!is_wp_error($Qv)) {
            goto EFe;
        }
        $gl = $Qv->get_error_message();
        echo "\123\157\155\x65\164\x68\x69\x6e\x67\x20\167\x65\156\x74\x20\x77\x72\157\156\x67\x3a\x20{$gl}";
        exit;
        EFe:
        return wp_remote_retrieve_body($Qv);
    }
    public function XfskodsfhHJ($NR)
    {
        global $lT;
        $cX = $lT->mo_oauth_client_get_option("\150\x6f\163\164\137\x6e\x61\155\145") . "\x2f\155\157\x61\x73\x2f\141\x70\151\57\142\x61\143\x6b\165\x70\x63\x6f\144\145\x2f\166\x65\x72\x69\146\x79";
        $Vo = $lT->mo_oauth_client_get_option("\155\157\137\x6f\x61\x75\164\150\137\141\x64\155\x69\x6e\137\143\165\x73\x74\157\155\145\x72\137\153\x65\171");
        $FS = $lT->mo_oauth_client_get_option("\x6d\x6f\x5f\x6f\141\x75\x74\150\137\141\x64\x6d\x69\156\x5f\141\160\x69\x5f\x6b\145\x79");
        $vP = $lT->mo_oauth_client_get_option("\x6d\x6f\137\x6f\141\x75\164\150\137\141\x64\x6d\151\156\137\x65\155\141\151\x6c");
        $O8 = $lT->mo_oauth_client_get_option("\x6d\157\x5f\157\141\165\x74\150\137\141\x64\x6d\151\x6e\137\x70\x68\157\x6e\x65");
        $yg = self::get_timestamp();
        $V4 = $Vo . $yg . $FS;
        $rz = hash("\163\x68\141\65\x31\x32", $V4);
        $F8 = "\x43\x75\163\164\157\155\145\162\x2d\x4b\x65\171\72\40" . $Vo;
        $Xk = "\124\151\x6d\145\x73\x74\x61\155\160\x3a\x20" . $yg;
        $hh = "\101\165\x74\150\157\x72\x69\x7a\141\164\151\157\156\x3a\40" . $rz;
        $RK = '';
        $RK = array("\143\x6f\144\145" => $NR, "\x63\x75\163\164\x6f\155\x65\162\x4b\145\171" => $Vo, "\141\144\144\x69\164\151\157\x6e\x61\x6c\106\151\145\154\x64\163" => array("\146\151\x65\154\x64\x31" => site_url()));
        $Pv = wp_json_encode($RK);
        $Da = array("\103\157\156\x74\145\156\164\55\124\171\x70\x65" => "\141\x70\x70\x6c\151\x63\141\x74\151\157\x6e\x2f\x6a\163\x6f\x6e");
        $Da["\103\x75\x73\164\157\x6d\145\162\x2d\113\x65\171"] = $Vo;
        $Da["\124\151\x6d\145\x73\x74\141\x6d\160"] = $yg;
        $Da["\101\165\x74\150\157\x72\151\172\141\x74\151\157\x6e"] = $rz;
        $nt = array("\x6d\145\164\x68\x6f\x64" => "\x50\x4f\123\124", "\x62\157\144\171" => $Pv, "\164\151\155\x65\157\x75\x74" => "\61\65", "\162\x65\144\151\162\145\143\164\151\157\156" => "\65", "\x68\164\164\160\166\145\162\x73\x69\157\x6e" => "\x31\56\60", "\142\x6c\157\143\x6b\151\156\x67" => true, "\x68\x65\141\x64\x65\162\x73" => $Da);
        $Qv = wp_remote_post($cX, $nt);
        if (!is_wp_error($Qv)) {
            goto x2o;
        }
        $gl = $Qv->get_error_message();
        echo "\123\157\x6d\145\164\150\151\x6e\147\x20\x77\x65\156\164\x20\x77\162\x6f\x6e\147\72\40{$gl}";
        exit;
        x2o:
        return wp_remote_retrieve_body($Qv);
    }
}
