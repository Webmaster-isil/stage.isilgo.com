<?php


namespace MoOauthClient;

class Customer
{
    public $email;
    public $phone;
    private $default_customer_key = "\x31\x36\65\x35\65";
    private $default_api_key = "\146\x46\144\62\x58\143\166\x54\107\x44\x65\x6d\x5a\166\x62\x77\61\x62\143\x55\x65\163\x4e\x4a\x57\105\x71\x4b\x62\x62\x55\161";
    private $host_name = '';
    private $host_key = '';
    public function __construct()
    {
        global $lT;
        $this->host_name = $lT->mo_oauth_client_get_option("\150\157\x73\x74\137\156\141\155\x65");
        $this->email = $lT->mo_oauth_client_get_option("\x6d\157\x5f\157\141\165\x74\x68\137\141\144\155\x69\156\x5f\x65\155\141\x69\154");
        $this->phone = $lT->mo_oauth_client_get_option("\x6d\x6f\x5f\157\x61\x75\x74\150\137\x61\144\155\x69\x6e\137\160\150\157\156\145");
        $this->host_key = $lT->mo_oauth_client_get_option("\x70\x61\163\163\x77\x6f\162\x64");
    }
    public function create_customer()
    {
        global $lT;
        $cX = $this->host_name . "\x2f\x6d\x6f\141\x73\57\x72\145\163\x74\57\143\165\163\x74\157\x6d\x65\x72\57\141\144\x64";
        $W4 = $this->host_key;
        $Ex = $lT->mo_oauth_client_get_option("\x6d\x6f\137\x6f\x61\165\164\x68\137\141\x64\x6d\x69\x6e\x5f\x66\156\x61\x6d\145");
        $ga = $lT->mo_oauth_client_get_option("\x6d\157\137\157\x61\165\164\150\x5f\141\144\x6d\151\x6e\x5f\x6c\x6e\x61\x6d\x65");
        $GU = $lT->mo_oauth_client_get_option("\155\x6f\x5f\x6f\x61\x75\164\x68\x5f\141\144\155\x69\x6e\137\143\x6f\x6d\x70\141\156\x79");
        $RK = array("\x63\157\x6d\160\141\x6e\171\116\x61\155\145" => $GU, "\x61\x72\145\141\x4f\146\x49\156\164\145\162\x65\x73\164" => "\x57\120\x20\x4f\101\165\164\150\40\103\154\151\145\156\x74", "\146\151\x72\x73\164\156\141\155\145" => $Ex, "\154\141\163\x74\x6e\x61\155\145" => $ga, \MoOAuthConstants::EMAIL => $this->email, "\x70\x68\157\156\145" => $this->phone, "\160\141\x73\163\x77\x6f\x72\x64" => $W4);
        $Pv = wp_json_encode($RK);
        return $this->send_request([], false, $Pv, [], false, $cX);
    }
    public function get_customer_key()
    {
        global $lT;
        $cX = $this->host_name . "\57\155\157\141\163\x2f\162\x65\163\x74\x2f\143\x75\163\164\x6f\155\x65\162\x2f\x6b\x65\x79";
        $q3 = $this->email;
        $W4 = $this->host_key;
        $RK = array(\MoOAuthConstants::EMAIL => $q3, "\x70\x61\x73\163\x77\x6f\x72\x64" => $W4);
        $Pv = wp_json_encode($RK);
        return $this->send_request([], false, $Pv, [], false, $cX);
    }
    public function add_oauth_application($LE, $Or)
    {
        global $lT;
        $cX = $this->host_name . "\57\155\x6f\x61\x73\57\162\x65\x73\164\57\x61\160\x70\154\151\143\141\x74\x69\x6f\156\x2f\141\144\x64\157\141\165\164\150";
        $Vo = $lT->mo_oauth_client_get_option("\155\157\x5f\x6f\141\165\164\150\x5f\x61\x64\155\151\x6e\137\143\x75\163\164\157\155\x65\x72\x5f\153\x65\x79");
        $us = $lT->mo_oauth_client_get_option("\x6d\x6f\137\x6f\x61\165\x74\150\x5f" . $LE . "\137\x73\x63\157\x70\x65");
        $M4 = $lT->mo_oauth_client_get_option("\x6d\157\x5f\x6f\x61\x75\x74\150\x5f" . $LE . "\x5f\143\154\x69\x65\156\164\x5f\151\x64");
        $oM = $lT->mo_oauth_client_get_option("\x6d\157\137\x6f\141\x75\x74\150\137" . $LE . "\x5f\143\x6c\151\145\156\x74\137\x73\145\x63\x72\x65\x74");
        if (false !== $us) {
            goto vq;
        }
        $RK = array("\141\x70\x70\154\x69\x63\x61\x74\x69\157\156\116\141\155\145" => $Or, "\143\x75\163\x74\x6f\x6d\145\x72\111\x64" => $Vo, "\x63\x6c\x69\x65\x6e\x74\111\x64" => $M4, "\x63\154\x69\x65\x6e\x74\123\x65\x63\162\145\164" => $oM);
        goto Bp;
        vq:
        $RK = array("\x61\160\160\154\151\x63\141\164\151\x6f\156\x4e\x61\x6d\x65" => $Or, "\x73\143\x6f\160\x65" => $us, "\143\x75\163\164\157\155\145\x72\x49\x64" => $Vo, "\143\x6c\151\145\156\164\x49\x64" => $M4, "\143\154\x69\145\x6e\x74\x53\145\x63\x72\x65\x74" => $oM);
        Bp:
        $Pv = wp_json_encode($RK);
        return $this->send_request([], false, $Pv, [], false, $cX);
    }
    public function submit_contact_us($q3, $O8, $Vz, $ay = true)
    {
        global $current_user;
        global $lT;
        wp_get_current_user();
        $U_ = $lT->export_plugin_config(true);
        $uj = json_encode($U_, JSON_UNESCAPED_SLASHES);
        $Vo = $this->default_customer_key;
        $FS = $this->default_api_key;
        $yg = time();
        $cX = $this->host_name . "\57\x6d\x6f\x61\163\57\x61\x70\x69\x2f\156\x6f\164\151\x66\171\x2f\163\x65\x6e\x64";
        $V4 = $Vo . $yg . $FS;
        $rz = hash("\163\x68\x61\x35\x31\x32", $V4);
        $sU = $q3;
        $He = \ucwords(\strtolower($lT->get_versi_str())) . "\40\55\x20" . \mo_oauth_get_version_number();
        $lC = "\121\165\145\x72\171\72\40\127\x6f\x72\144\x50\162\x65\163\x73\40\x4f\x41\x75\x74\x68\x20" . $He . "\40\120\x6c\x75\x67\151\x6e";
        $Vz = "\x5b\x57\x50\x20\117\x41\x75\164\150\x20\x43\154\x69\x65\156\x74\x20" . $He . "\135\x20" . $Vz;
        if (!$ay) {
            goto c0;
        }
        $Vz .= "\x3c\x62\162\x3e\74\x62\x72\76\103\157\x6e\146\x69\147\40\x53\x74\x72\x69\x6e\147\x3a\74\142\162\76\x3c\160\x72\145\40\163\164\x79\154\x65\x3d\x22\x62\x6f\x72\x64\x65\162\72\x31\x70\170\40\163\x6f\154\151\144\40\x23\x34\64\x34\73\160\x61\x64\144\x69\156\147\72\x31\x30\x70\x78\73\x22\76\74\x63\x6f\144\x65\76" . $uj . "\x3c\x2f\x63\157\144\145\76\74\x2f\160\162\x65\76";
        c0:
        $Kn = isset($_SERVER["\123\x45\x52\x56\x45\122\137\116\x41\115\x45"]) ? sanitize_text_field(wp_unslash($_SERVER["\x53\x45\x52\x56\x45\x52\137\116\101\x4d\x45"])) : '';
        $VI = "\x3c\144\151\x76\40\x3e\x48\x65\x6c\154\x6f\x2c\x20\74\142\162\x3e\74\142\162\x3e\106\x69\162\163\164\40\x4e\x61\155\x65\x20\72" . $current_user->user_firstname . "\x3c\142\x72\x3e\74\142\162\x3e\x4c\141\x73\164\40\40\116\x61\155\145\x20\x3a" . $current_user->user_lastname . "\x20\x20\x20\74\x62\162\76\74\x62\x72\76\x43\x6f\x6d\160\141\156\x79\x20\72\x3c\141\40\150\x72\x65\146\x3d\42" . $Kn . "\x22\x20\164\x61\x72\x67\145\164\75\x22\x5f\x62\x6c\141\156\x6b\42\40\x3e" . $Kn . "\74\x2f\x61\x3e\74\x62\x72\76\x3c\142\162\x3e\x50\x68\157\156\145\40\116\165\x6d\142\x65\162\x20\x3a" . $O8 . "\x3c\x62\162\76\x3c\142\162\x3e\x45\x6d\141\x69\154\40\72\x3c\141\40\150\x72\x65\146\x3d\x22\x6d\x61\151\x6c\164\x6f\72" . $sU . "\x22\40\164\141\162\147\145\164\75\x22\137\142\x6c\141\156\x6b\x22\76" . $sU . "\x3c\57\141\76\x3c\x62\162\x3e\74\142\162\x3e\x51\165\145\162\171\40\72" . $Vz . "\74\57\x64\x69\x76\76";
        $RK = array("\143\x75\163\164\x6f\155\145\x72\x4b\145\171" => $Vo, "\x73\145\156\144\105\x6d\x61\151\154" => true, \MoOAuthConstants::EMAIL => array("\143\165\163\x74\x6f\x6d\x65\x72\113\145\x79" => $Vo, "\146\x72\157\155\x45\155\x61\x69\x6c" => $sU, "\142\x63\143\x45\155\141\x69\x6c" => "\151\x6e\x66\x6f\x40\170\145\143\165\x72\x69\x66\x79\56\x63\157\x6d", "\x66\162\x6f\155\116\x61\155\x65" => "\x6d\x69\156\x69\x4f\162\141\x6e\147\145", "\164\x6f\105\155\141\151\x6c" => "\157\141\165\164\150\163\x75\x70\x70\157\162\x74\100\170\145\x63\x75\162\x69\x66\x79\x2e\x63\x6f\x6d", "\x74\157\x4e\141\155\x65" => "\x6f\x61\x75\x74\150\x73\165\x70\x70\157\162\164\100\170\x65\x63\165\162\x69\x66\x79\x2e\x63\157\x6d", "\163\x75\x62\152\x65\x63\164" => $lC, "\143\x6f\156\164\x65\x6e\164" => $VI));
        $Pv = json_encode($RK, JSON_UNESCAPED_SLASHES);
        $Da = array("\103\x6f\156\164\145\x6e\x74\55\x54\x79\160\145" => "\141\x70\x70\154\x69\143\141\164\151\157\x6e\x2f\x6a\x73\157\156");
        $Da["\103\165\163\x74\157\155\145\x72\x2d\113\145\x79"] = $Vo;
        $Da["\124\x69\155\145\163\x74\x61\155\x70"] = $yg;
        $Da["\x41\x75\x74\150\x6f\162\151\x7a\141\x74\151\x6f\156"] = $rz;
        return $this->send_request($Da, true, $Pv, [], false, $cX);
    }
    public function submit_contact_us_upgrade($q3, $nZ, $wU, $iN)
    {
        global $lT;
        $Vo = $this->default_customer_key;
        $FS = $this->default_api_key;
        $yg = time();
        $cX = $this->host_name . "\x2f\x6d\x6f\x61\x73\x2f\x61\160\x69\57\156\157\164\x69\146\171\57\x73\145\x6e\x64";
        $V4 = $Vo . $yg . $FS;
        $rz = hash("\163\x68\141\65\61\x32", $V4);
        $sU = $q3;
        $He = \ucwords(\strtolower($lT->get_versi_str())) . "\x20\x2d\x20" . \mo_oauth_get_version_number();
        $lC = "\x51\x75\x65\162\171\x3a\x20\x57\157\x72\144\x50\x72\x65\x73\163\x20\x4f\x41\x75\164\150\x20\x55\x70\147\162\x61\x64\x65\40\x50\x6c\165\x67\x69\156";
        $Kn = isset($_SERVER["\123\105\x52\x56\105\x52\137\x4e\x41\115\105"]) ? sanitize_text_field(wp_unslash($_SERVER["\x53\x45\122\126\105\122\137\x4e\x41\115\105"])) : '';
        $VI = "\74\144\151\x76\40\76\110\145\x6c\x6c\157\54\x20\x20\40\x3c\142\162\x3e\74\142\162\76\103\157\155\160\x61\156\171\40\72\x3c\141\40\x68\162\145\146\x3d\x22" . $Kn . "\42\x20\164\x61\162\147\x65\164\75\42\137\x62\x6c\141\x6e\x6b\42\40\x3e" . $Kn . "\74\57\141\76\x3c\142\162\76\74\x62\162\x3e\x43\x75\162\x72\x65\x6e\164\40\126\x65\162\163\151\157\156\40\72" . $nZ . "\x3c\142\162\76\x3c\142\162\76\105\x6d\141\151\x6c\40\72\74\141\40\150\162\x65\x66\x3d\x22\155\141\151\154\164\157\72" . $sU . "\x22\x20\x74\141\x72\x67\145\x74\x3d\x22\x5f\142\154\x61\156\x6b\42\76" . $sU . "\74\57\x61\x3e\x3c\x62\x72\x3e\x3c\142\x72\x3e\126\x65\x72\163\151\x6f\156\40\164\x6f\40\x55\160\147\162\141\144\145\x20\x3a" . $wU . "\x3c\x62\x72\x3e\x3c\142\162\x3e\106\x65\141\164\165\162\x65\163\40\x52\145\161\x75\x69\162\145\x64\40\x3a" . $iN . "\74\57\x64\151\166\x3e";
        $RK = array("\x63\165\x73\x74\x6f\155\145\x72\113\145\171" => $Vo, "\x73\145\156\144\x45\155\141\x69\x6c" => true, \MoOAuthConstants::EMAIL => array("\143\165\163\x74\x6f\155\145\162\x4b\145\171" => $Vo, "\146\162\157\x6d\105\155\141\x69\x6c" => $sU, "\142\143\x63\105\x6d\141\x69\154" => "\151\x6e\146\157\100\x78\x65\143\165\162\x69\x66\171\56\143\157\x6d", "\x66\x72\x6f\x6d\x4e\x61\155\x65" => "\x6d\151\x6e\x69\117\162\x61\156\x67\145", "\164\157\105\x6d\141\151\154" => "\x6f\141\165\x74\150\x73\x75\160\160\x6f\x72\x74\100\x78\145\143\x75\162\151\x66\x79\x2e\143\157\155", "\x74\157\x4e\x61\x6d\x65" => "\x6f\141\x75\x74\150\163\165\160\160\x6f\162\x74\100\x78\145\x63\x75\x72\151\146\171\56\x63\157\x6d", "\x73\x75\x62\x6a\x65\143\x74" => $lC, "\x63\157\x6e\x74\x65\x6e\x74" => $VI));
        $Pv = json_encode($RK, JSON_UNESCAPED_SLASHES);
        $Da = array("\x43\157\x6e\x74\x65\x6e\164\x2d\x54\x79\x70\145" => "\x61\x70\x70\x6c\151\143\x61\164\x69\x6f\156\57\x6a\163\157\156");
        $Da["\x43\165\163\164\x6f\155\x65\x72\55\x4b\145\x79"] = $Vo;
        $Da["\124\151\155\145\x73\x74\141\155\x70"] = $yg;
        $Da["\101\165\164\150\157\162\151\172\x61\x74\151\x6f\x6e"] = $rz;
        return $this->send_request($Da, true, $Pv, [], false, $cX);
    }
    public function send_otp_token($q3 = '', $O8 = '', $gu = true, $hR = false)
    {
        global $lT;
        $cX = $this->host_name . "\x2f\x6d\157\141\x73\x2f\x61\x70\x69\x2f\141\165\x74\x68\x2f\143\150\x61\154\x6c\x65\x6e\147\145";
        $Vo = $this->default_customer_key;
        $FS = $this->default_api_key;
        $vP = $this->email;
        $O8 = $lT->mo_oauth_client_get_option("\x6d\157\x5f\157\x61\165\x74\x68\x5f\x61\x64\155\x69\156\137\160\x68\x6f\156\145");
        $yg = self::get_timestamp();
        $V4 = $Vo . $yg . $FS;
        $rz = hash("\x73\150\141\65\x31\x32", $V4);
        $F8 = "\x43\165\x73\x74\x6f\x6d\x65\162\55\x4b\145\x79\72\x20" . $Vo;
        $Xk = "\124\151\x6d\x65\x73\x74\x61\155\x70\72\40" . $yg;
        $hh = "\x41\x75\164\150\x6f\162\x69\x7a\141\x74\x69\x6f\x6e\x3a\x20" . $rz;
        if ($gu) {
            goto zp;
        }
        $RK = array("\143\x75\163\164\157\x6d\145\x72\113\x65\171" => $Vo, "\x70\150\157\x6e\x65" => $O8, "\141\165\x74\x68\124\171\x70\145" => "\123\x4d\x53");
        goto Mn;
        zp:
        $RK = array("\143\x75\x73\164\157\x6d\x65\x72\x4b\x65\x79" => $Vo, \MoOAuthConstants::EMAIL => $vP, "\141\x75\164\x68\124\x79\160\x65" => "\105\x4d\101\x49\114");
        Mn:
        $Pv = wp_json_encode($RK);
        $Da = array("\x43\157\x6e\x74\145\156\x74\55\x54\171\x70\x65" => "\141\160\160\x6c\151\x63\141\164\x69\x6f\x6e\57\152\x73\x6f\156");
        $Da["\103\165\x73\164\157\155\145\162\55\113\145\171"] = $Vo;
        $Da["\124\151\x6d\145\x73\x74\x61\155\160"] = $yg;
        $Da["\101\x75\164\150\157\x72\x69\x7a\x61\x74\x69\x6f\x6e"] = $rz;
        return $this->send_request($Da, true, $Pv, [], false, $cX);
    }
    public function get_timestamp()
    {
        global $lT;
        $cX = $this->host_name . "\57\x6d\157\141\x73\57\x72\x65\x73\164\x2f\155\x6f\142\151\x6c\x65\57\x67\145\164\x2d\x74\x69\x6d\145\163\x74\141\x6d\x70";
        return $this->send_request([], false, '', [], false, $cX);
    }
    public function validate_otp_token($j1, $Qo)
    {
        global $lT;
        $cX = $this->host_name . "\57\x6d\157\141\x73\x2f\x61\x70\x69\57\141\165\x74\150\57\x76\141\x6c\x69\144\141\164\145";
        $Vo = $this->default_customer_key;
        $FS = $this->default_api_key;
        $vP = $this->email;
        $yg = self::get_timestamp();
        $V4 = $Vo . $yg . $FS;
        $rz = hash("\x73\x68\x61\65\x31\x32", $V4);
        $F8 = "\x43\x75\x73\x74\x6f\155\145\162\x2d\113\145\171\x3a\40" . $Vo;
        $Xk = "\x54\x69\x6d\x65\163\164\141\155\x70\72\40" . $yg;
        $hh = "\101\165\164\x68\x6f\162\x69\172\141\164\151\157\156\x3a\x20" . $rz;
        $Pv = '';
        $RK = array("\164\x78\x49\144" => $j1, "\x74\157\153\145\x6e" => $Qo);
        $Pv = wp_json_encode($RK);
        $Da = array("\103\x6f\x6e\x74\145\x6e\x74\x2d\124\171\x70\x65" => "\141\160\160\154\x69\x63\x61\164\x69\x6f\156\x2f\x6a\x73\157\x6e");
        $Da["\103\x75\x73\164\157\x6d\145\162\x2d\113\145\x79"] = $Vo;
        $Da["\124\x69\155\145\163\x74\141\x6d\x70"] = $yg;
        $Da["\x41\165\164\x68\157\162\151\x7a\141\164\x69\x6f\x6e"] = $rz;
        return $this->send_request($Da, true, $Pv, [], false, $cX);
    }
    public function check_customer()
    {
        global $lT;
        $cX = $this->host_name . "\x2f\x6d\157\141\163\x2f\162\x65\x73\164\57\x63\x75\163\164\157\155\145\x72\57\x63\150\x65\143\153\55\x69\146\x2d\145\170\x69\x73\x74\x73";
        $q3 = $this->email;
        $RK = array(\MoOAuthConstants::EMAIL => $q3);
        $Pv = wp_json_encode($RK);
        return $this->send_request([], false, $Pv, [], false, $cX);
    }
    public function mo_oauth_send_email_alert($q3, $O8, $kv)
    {
        global $lT;
        if ($this->check_internet_connection()) {
            goto Z8;
        }
        return;
        Z8:
        $cX = $this->host_name . "\x2f\155\157\141\x73\57\141\160\x69\x2f\156\157\164\x69\146\171\x2f\x73\x65\156\144";
        global $user;
        $Vo = $this->default_customer_key;
        $FS = $this->default_api_key;
        $yg = self::get_timestamp();
        $V4 = $Vo . $yg . $FS;
        $rz = hash("\163\150\141\65\x31\x32", $V4);
        $sU = $q3;
        $lC = "\106\145\x65\x64\x62\x61\x63\153\x3a\40\127\157\x72\x64\x50\162\x65\163\163\x20\x4f\101\165\x74\150\40\x43\154\151\x65\x6e\164\40\120\x6c\x75\147\151\156";
        $lx = site_url();
        $user = wp_get_current_user();
        $He = \ucwords(\strtolower($lT->get_versi_str())) . "\40\x2d\40" . \mo_oauth_get_version_number();
        $Vz = "\133\127\120\x20\117\x41\x75\x74\150\x20\62\x2e\x30\x20\x43\x6c\151\145\156\164\x20" . $He . "\x5d\x20\72\40" . $kv;
        $Kn = isset($_SERVER["\x53\105\122\x56\x45\122\x5f\x4e\101\x4d\105"]) ? sanitize_text_field(wp_unslash($_SERVER["\123\x45\122\126\105\122\137\x4e\x41\115\x45"])) : '';
        $VI = "\74\x64\151\166\x20\x3e\x48\145\154\154\x6f\x2c\40\74\x62\162\76\74\x62\x72\x3e\x46\151\162\163\x74\x20\116\141\155\145\x20\x3a" . $user->user_firstname . "\74\142\162\x3e\x3c\142\162\76\114\x61\x73\164\40\40\x4e\141\155\145\40\x3a" . $user->user_lastname . "\x20\x20\x20\74\x62\162\x3e\74\142\x72\76\103\x6f\155\160\141\x6e\171\x20\x3a\x3c\141\x20\150\x72\x65\x66\75\42" . $Kn . "\x22\40\164\141\162\147\x65\x74\75\42\x5f\x62\x6c\141\x6e\153\42\x20\76" . $Kn . "\x3c\57\141\x3e\74\142\162\76\74\x62\x72\76\x50\x68\157\x6e\145\x20\116\165\155\x62\145\x72\40\72" . $O8 . "\74\x62\x72\76\74\142\x72\76\105\x6d\x61\151\154\x20\x3a\74\141\x20\x68\162\145\x66\75\42\155\141\x69\x6c\x74\157\x3a" . $sU . "\42\40\x74\141\162\x67\145\164\x3d\42\137\x62\x6c\141\x6e\x6b\42\x3e" . $sU . "\x3c\x2f\141\76\x3c\x62\162\x3e\x3c\x62\162\76\x51\x75\145\162\x79\x20\72" . $Vz . "\74\57\x64\x69\166\76";
        $RK = array("\x63\x75\163\x74\157\x6d\145\x72\113\145\x79" => $Vo, "\163\x65\x6e\144\105\x6d\x61\x69\154" => true, \MoOAuthConstants::EMAIL => array("\143\x75\163\164\x6f\155\145\x72\x4b\145\171" => $Vo, "\146\162\x6f\x6d\105\155\x61\151\154" => $sU, "\142\143\143\105\155\x61\x69\x6c" => "\x6f\x61\x75\164\x68\x73\165\x70\x70\x6f\162\x74\100\155\151\x6e\x69\157\162\141\156\147\x65\x2e\143\x6f\155", "\x66\x72\157\x6d\x4e\x61\155\x65" => "\155\x69\156\x69\x4f\162\x61\x6e\147\x65", "\x74\157\105\x6d\x61\x69\x6c" => "\x6f\141\x75\x74\150\163\165\160\160\x6f\x72\164\100\155\x69\x6e\x69\157\x72\141\156\147\x65\56\x63\x6f\x6d", "\164\x6f\116\x61\x6d\x65" => "\x6f\141\x75\x74\x68\x73\x75\x70\160\x6f\162\x74\x40\155\x69\156\x69\x6f\162\141\x6e\147\145\x2e\143\x6f\x6d", "\x73\165\142\152\145\143\x74" => $lC, "\x63\x6f\x6e\x74\x65\156\164" => $VI));
        $Pv = wp_json_encode($RK);
        $Da = array("\x43\157\156\164\145\x6e\x74\55\x54\171\x70\x65" => "\141\x70\160\154\x69\x63\141\164\151\157\x6e\57\152\x73\157\x6e");
        $Da["\x43\165\163\x74\x6f\x6d\x65\162\x2d\113\145\x79"] = $Vo;
        $Da["\124\x69\x6d\x65\163\x74\x61\x6d\160"] = $yg;
        $Da["\x41\x75\164\x68\157\162\x69\x7a\x61\x74\151\157\x6e"] = $rz;
        return $this->send_request($Da, true, $Pv, [], false, $cX);
    }
    public function mo_oauth_send_demo_alert($q3, $R5, $kv, $lC)
    {
        if ($this->check_internet_connection()) {
            goto Y8;
        }
        return;
        Y8:
        $cX = $this->host_name . "\x2f\155\x6f\x61\x73\x2f\141\160\x69\x2f\x6e\157\x74\x69\146\171\x2f\163\145\x6e\x64";
        $Vo = $this->default_customer_key;
        $FS = $this->default_api_key;
        $yg = self::get_timestamp();
        $V4 = $Vo . $yg . $FS;
        $rz = hash("\x73\150\x61\65\61\x32", $V4);
        $sU = $q3;
        global $user;
        $user = wp_get_current_user();
        $VI = "\x3c\x64\151\166\x20\76\x48\x65\154\x6c\x6f\54\40\x3c\57\141\76\74\142\x72\76\x3c\x62\162\x3e\x45\155\x61\x69\154\40\x3a\74\141\x20\x68\162\145\146\x3d\42\155\141\x69\154\164\157\72" . $sU . "\42\40\164\x61\x72\x67\x65\x74\x3d\42\137\x62\154\x61\x6e\x6b\42\x3e" . $sU . "\x3c\57\141\76\74\x62\162\x3e\x3c\142\162\x3e\x52\x65\161\x75\x65\163\x74\x65\x64\40\104\145\155\157\40\x66\157\x72\x20\40\x20\40\x20\x3a\40" . $R5 . "\x3c\142\x72\76\74\142\162\76\122\145\161\165\x69\x72\x65\x6d\145\x6e\164\x73\40\x20\x20\40\x20\40\40\40\x20\40\x20\72\40" . $kv . "\x3c\x2f\144\x69\x76\76";
        $RK = array("\x63\165\163\164\157\155\x65\162\113\145\x79" => $Vo, "\163\x65\x6e\144\x45\155\x61\x69\x6c" => true, \MoOAuthConstants::EMAIL => array("\x63\x75\x73\164\x6f\155\145\162\113\145\171" => $Vo, "\146\162\x6f\x6d\x45\155\141\x69\x6c" => $sU, "\142\143\x63\105\x6d\x61\x69\x6c" => "\157\x61\165\164\x68\x73\x75\160\160\x6f\x72\x74\100\x6d\151\x6e\151\157\162\x61\x6e\147\x65\x2e\x63\157\x6d", "\x66\162\157\x6d\116\x61\155\x65" => "\x6d\x69\156\151\x4f\x72\x61\x6e\x67\x65", "\164\x6f\105\x6d\x61\x69\x6c" => "\x6f\141\165\x74\x68\x73\x75\x70\x70\157\162\x74\x40\x6d\151\156\151\157\162\x61\x6e\x67\x65\56\x63\x6f\155", "\x74\157\116\x61\155\145" => "\157\141\165\x74\x68\163\x75\160\x70\x6f\162\164\100\155\151\156\x69\x6f\162\141\x6e\147\145\56\x63\x6f\x6d", "\163\x75\x62\152\145\143\x74" => $lC, "\x63\157\x6e\x74\145\156\164" => $VI));
        $Pv = json_encode($RK);
        $Da = array("\x43\x6f\156\164\x65\156\x74\x2d\124\x79\x70\x65" => "\x61\160\x70\154\151\143\x61\164\151\x6f\156\x2f\152\x73\x6f\156");
        $Da["\x43\165\163\164\157\x6d\x65\162\55\113\145\171"] = $Vo;
        $Da["\124\151\x6d\145\163\x74\x61\155\160"] = $yg;
        $Da["\x41\165\164\x68\x6f\162\151\172\141\164\151\157\156"] = $rz;
        $Qv = $this->send_request($Da, true, $Pv, [], false, $cX);
    }
    public function mo_oauth_forgot_password($q3)
    {
        global $lT;
        $cX = $this->host_name . "\x2f\x6d\x6f\141\x73\57\162\145\163\x74\57\x63\165\163\x74\x6f\x6d\x65\x72\x2f\160\x61\x73\163\167\157\162\144\x2d\162\x65\163\x65\164";
        $Vo = $lT->mo_oauth_client_get_option("\x6d\157\x5f\x6f\141\x75\x74\x68\x5f\141\x64\x6d\151\156\x5f\x63\x75\x73\164\x6f\155\x65\162\137\x6b\145\171");
        $FS = $lT->mo_oauth_client_get_option("\155\x6f\137\157\141\165\164\150\137\x61\x64\x6d\x69\x6e\137\x61\160\x69\x5f\x6b\x65\171");
        $yg = self::get_timestamp();
        $V4 = $Vo . $yg . $FS;
        $rz = hash("\163\150\x61\65\x31\x32", $V4);
        $F8 = "\103\x75\163\164\x6f\x6d\145\162\x2d\x4b\145\171\72\40" . $Vo;
        $Xk = "\124\x69\x6d\x65\x73\164\141\155\160\x3a\40" . number_format($yg, 0, '', '');
        $hh = "\101\165\x74\x68\x6f\x72\151\172\141\164\x69\157\156\x3a\40" . $rz;
        $Pv = '';
        $RK = array(\MoOAuthConstants::EMAIL => $q3);
        $Pv = wp_json_encode($RK);
        $Da = array("\103\x6f\x6e\164\145\x6e\164\x2d\x54\171\x70\x65" => "\141\x70\x70\x6c\x69\143\141\164\151\157\x6e\57\x6a\x73\157\x6e");
        $Da["\x43\x75\163\x74\x6f\155\145\x72\55\113\145\x79"] = $Vo;
        $Da["\x54\x69\x6d\x65\163\164\x61\155\160"] = $yg;
        $Da["\101\x75\x74\x68\x6f\x72\x69\172\141\164\x69\157\x6e"] = $rz;
        return $this->send_request($Da, true, $Pv, [], false, $cX);
    }
    public function check_internet_connection()
    {
        return (bool) @fsockopen("\x6c\157\x67\151\156\x2e\x78\145\143\x75\x72\151\146\x79\x2e\143\157\155", 443, $fe, $aV, 5);
    }
    private function send_request($nP = false, $kn = false, $Pv = '', $Fh = false, $AA = false, $cX = '')
    {
        $Da = array("\103\x6f\156\x74\145\156\x74\55\124\x79\x70\x65" => "\x61\x70\160\154\x69\x63\x61\x74\151\x6f\x6e\57\x6a\x73\x6f\156", "\143\x68\141\162\163\145\164" => "\125\124\106\40\x2d\x20\x38", "\x41\x75\164\x68\x6f\162\x69\172\141\164\x69\x6f\x6e" => "\x42\x61\x73\x69\143");
        $Da = $kn && $nP ? $nP : array_unique(array_merge($Da, $nP));
        $nt = array("\155\x65\x74\150\x6f\x64" => "\120\117\123\x54", "\x62\157\x64\x79" => $Pv, "\164\x69\155\145\x6f\165\x74" => "\61\65", "\162\145\x64\151\162\x65\143\x74\x69\157\156" => "\65", "\x68\164\164\x70\166\145\x72\x73\x69\157\x6e" => "\x31\x2e\x30", "\x62\x6c\157\143\x6b\151\156\147" => true, "\x68\145\141\x64\145\162\163" => $Da, "\163\163\x6c\166\x65\x72\151\146\171" => true);
        $nt = $AA ? $Fh : array_unique(array_merge($nt, $Fh), SORT_REGULAR);
        $Qv = wp_remote_post($cX, $nt);
        if (!is_wp_error($Qv)) {
            goto Ey;
        }
        $gl = $Qv->get_error_message();
        echo wp_kses("\x53\x6f\155\x65\x74\x68\151\x6e\147\40\x77\x65\156\x74\40\167\x72\x6f\156\x67\x3a\x20{$gl}", \mo_oauth_get_valid_html());
        exit;
        Ey:
        return wp_remote_retrieve_body($Qv);
    }
}
