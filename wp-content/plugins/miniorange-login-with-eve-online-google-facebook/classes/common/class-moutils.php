<?php


namespace MoOauthClient;

use MoOauthClient\App;
use MoOauthClient\Backup\EnvVarResolver;
class MOUtils
{
    const FREE = 0;
    const STANDARD = 1;
    const PREMIUM = 2;
    const MULTISITE_PREMIUM = 3;
    const ENTERPRISE = 4;
    const ALL_INCLUSIVE_SINGLE_SITE = 5;
    const MULTISITE_ENTERPRISE = 6;
    const ALL_INCLUSIVE_MULTISITE = 7;
    private $is_multisite = false;
    public function __construct()
    {
        remove_action("\x61\x64\x6d\151\x6e\137\x6e\157\164\x69\143\145\163", array($this, "\x6d\x6f\137\157\x61\x75\x74\x68\137\163\x75\x63\x63\145\163\x73\x5f\155\x65\163\163\x61\147\145"));
        remove_action("\141\144\155\151\x6e\x5f\156\x6f\164\151\x63\145\163", array($this, "\155\157\137\x6f\x61\x75\x74\x68\137\145\x72\162\x6f\162\x5f\155\145\x73\163\141\x67\145"));
        $this->is_multisite = boolval(get_site_option("\x6d\x6f\137\x6f\x61\x75\164\150\137\151\x73\115\165\x6c\x74\151\x53\x69\x74\x65\120\154\x75\x67\x69\x6e\x52\x65\x71\x75\x65\163\x74\145\x64")) ? true : ($this->is_multisite_versi() ? true : false);
    }
    public function mo_oauth_success_message()
    {
        $kE = "\x65\x72\x72\157\x72";
        $kv = $this->mo_oauth_client_get_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION);
        echo "\74\144\151\166\40\x63\x6c\x61\163\x73\x3d\x27" . $kE . "\47\x3e\x20\74\x70\x3e" . $kv . "\x3c\x2f\160\76\x3c\x2f\x64\x69\166\76";
    }
    public function mo_oauth_error_message()
    {
        $kE = "\x75\x70\x64\141\164\x65\144";
        $kv = $this->mo_oauth_client_get_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION);
        echo "\x3c\x64\x69\x76\x20\143\154\x61\x73\x73\75\x27" . $kE . "\x27\x3e\74\160\x3e" . $kv . "\74\x2f\160\x3e\74\57\144\x69\x76\x3e";
    }
    public function mo_oauth_show_success_message()
    {
        $VU = is_multisite() && $this->is_multisite_versi() ? "\x6e\145\164\167\x6f\x72\x6b\x5f" : '';
        remove_action("{$VU}\x61\144\x6d\x69\x6e\137\156\x6f\164\151\143\145\x73", array($this, "\155\x6f\x5f\x6f\x61\x75\164\150\x5f\163\x75\x63\x63\x65\x73\x73\137\155\x65\x73\163\141\x67\145"));
        add_action("{$VU}\x61\144\155\151\156\137\x6e\x6f\x74\x69\143\x65\163", array($this, "\x6d\x6f\x5f\157\141\165\164\150\137\x65\x72\x72\x6f\162\x5f\x6d\x65\163\x73\141\147\x65"));
    }
    public function mo_oauth_show_error_message()
    {
        $VU = is_multisite() && $this->is_multisite_versi() ? "\156\145\x74\167\157\x72\x6b\137" : '';
        remove_action("{$VU}\141\144\155\151\x6e\137\156\157\x74\x69\143\x65\163", array($this, "\155\157\x5f\157\x61\x75\x74\150\x5f\145\162\162\157\162\137\x6d\145\163\x73\141\x67\145"));
        add_action("{$VU}\141\x64\x6d\151\x6e\137\x6e\157\164\x69\143\145\163", array($this, "\155\157\x5f\x6f\141\x75\x74\150\x5f\x73\x75\143\x63\145\x73\x73\x5f\x6d\145\163\x73\141\147\145"));
    }
    public function mo_oauth_client_filter_error($TA)
    {
        $TA = apply_filters("\155\157\137\x6f\141\165\x74\x68\137\155\157\144\x69\146\x79\x5f\x65\x72\162\157\162", $TA);
        return $TA;
    }
    public function mo_oauth_is_customer_registered()
    {
        $q3 = $this->mo_oauth_client_get_option("\155\x6f\x5f\157\x61\165\164\x68\x5f\x61\x64\x6d\151\156\x5f\145\x6d\x61\151\x6c");
        $Vo = $this->mo_oauth_client_get_option("\155\x6f\137\x6f\x61\165\164\150\x5f\141\144\x6d\151\x6e\x5f\143\x75\163\164\x6f\155\145\x72\x5f\153\x65\171");
        if (!$q3 || !$Vo || !is_numeric(trim($Vo))) {
            goto Nh;
        }
        return 1;
        goto gC;
        Nh:
        return 0;
        gC:
    }
    public function mooauthencrypt($mH)
    {
        $lw = $this->mo_oauth_client_get_option("\x63\x75\x73\164\x6f\155\145\162\x5f\x74\157\x6b\x65\x6e");
        if ($lw) {
            goto tQ;
        }
        return "\146\x61\x6c\163\145";
        tQ:
        $lw = str_split(str_pad('', strlen($mH), $lw, STR_PAD_RIGHT));
        $ML = str_split($mH);
        foreach ($ML as $pt => $zq) {
            $NC = ord($zq) + ord($lw[$pt]);
            $ML[$pt] = chr($NC > 255 ? $NC - 256 : $NC);
            Al:
        }
        fq:
        return base64_encode(join('', $ML));
    }
    public function mooauthdecrypt($mH)
    {
        $mH = base64_decode($mH);
        $lw = $this->mo_oauth_client_get_option("\143\165\x73\164\157\155\145\x72\x5f\164\157\x6b\145\156");
        if ($lw) {
            goto VN;
        }
        return "\146\141\x6c\163\x65";
        VN:
        $lw = str_split(str_pad('', strlen($mH), $lw, STR_PAD_RIGHT));
        $ML = str_split($mH);
        foreach ($ML as $pt => $zq) {
            $NC = ord($zq) - ord($lw[$pt]);
            $ML[$pt] = chr($NC < 0 ? $NC + 256 : $NC);
            PA:
        }
        wp:
        return join('', $ML);
    }
    public function mo_oauth_check_empty_or_null($W7)
    {
        if (!(!isset($W7) || empty($W7))) {
            goto H7;
        }
        return true;
        H7:
        return false;
    }
    public function is_multisite_plan()
    {
        return $this->is_multisite;
    }
    public function mo_oauth_is_curl_installed()
    {
        if (in_array("\143\165\x72\154", get_loaded_extensions())) {
            goto Fm;
        }
        return 0;
        goto bu;
        Fm:
        return 1;
        bu:
    }
    public function mo_oauth_show_curl_error()
    {
        if (!($this->mo_oauth_is_curl_installed() === 0)) {
            goto Xr;
        }
        $this->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\x3c\141\40\150\x72\x65\146\x3d\42\150\164\x74\x70\72\57\x2f\160\150\160\x2e\x6e\145\x74\x2f\x6d\x61\156\x75\x61\x6c\57\145\x6e\x2f\x63\x75\162\154\x2e\x69\x6e\x73\164\141\x6c\x6c\x61\164\x69\157\156\56\160\150\160\x22\40\x74\141\162\x67\x65\164\x3d\42\137\x62\x6c\x61\156\153\42\x3e\120\x48\120\x20\x43\125\122\x4c\40\x65\x78\x74\145\156\163\151\x6f\x6e\74\57\x61\x3e\40\x69\x73\x20\156\x6f\x74\x20\x69\156\163\x74\141\x6c\154\145\144\40\157\162\40\x64\151\x73\x61\142\x6c\145\x64\56\40\120\x6c\x65\141\163\x65\40\x65\x6e\x61\x62\x6c\x65\x20\151\164\x20\x74\157\40\x63\157\156\x74\x69\156\x75\145\x2e");
        $this->mo_oauth_show_error_message();
        return;
        Xr:
    }
    public function mo_oauth_is_clv()
    {
        $pk = $this->mo_oauth_client_get_option("\155\x6f\137\x6f\x61\x75\x74\x68\137\154\x76");
        $pk = boolval($pk) ? $this->mooauthdecrypt($pk) : "\x66\141\154\x73\x65";
        $pk = !empty($this->mo_oauth_client_get_option("\x6d\x6f\x5f\x6f\x61\165\164\x68\137\154\153")) && "\164\162\x75\145" === $pk ? 1 : 0;
        if (!($pk === 0)) {
            goto rq;
        }
        return $this->verify_lk();
        rq:
        return $pk;
    }
    public function mo_oauth_is_cld()
    {
        if (!(empty($this->mo_oauth_client_get_option("\155\x6f\x5f\x6f\x61\165\x74\x68\137\x6c\x64")) || empty($this->mo_oauth_client_get_option("\143\165\163\164\157\155\145\162\x5f\164\157\x6b\x65\156")))) {
            goto lj;
        }
        return 1;
        lj:
        $pk = $this->mo_oauth_client_get_option("\x6d\157\x5f\157\x61\165\x74\150\x5f\154\144");
        $pk = "\x74\x72\x75\x65" === $this->mooauthdecrypt($pk) ? 1 : 0;
        return $pk;
    }
    public function mo_oauth_hbca_xyake()
    {
        if ($this->mo_oauth_is_customer_registered()) {
            goto Ib;
        }
        return false;
        Ib:
        if ($this->mo_oauth_client_get_option("\155\157\137\157\141\x75\x74\150\137\141\144\x6d\x69\x6e\x5f\143\165\x73\x74\x6f\x6d\x65\162\x5f\153\145\171") > 138200) {
            goto E5;
        }
        return false;
        goto e1;
        E5:
        return true;
        e1:
    }
    public function get_default_app($Rt, $fZ = false)
    {
        if ($Rt) {
            goto VE;
        }
        return false;
        VE:
        $Zh = false;
        $u8 = file_get_contents(MOC_DIR . "resources/app_components/defaultapps.json", true);
        $az = json_decode($u8, $fZ);
        foreach ($az as $E7 => $hT) {
            if (!($E7 === $Rt)) {
                goto XK;
            }
            if ($fZ) {
                goto P5;
            }
            $hT->appId = $E7;
            goto Nm;
            P5:
            $hT["\x61\160\x70\x49\144"] = $E7;
            Nm:
            return $hT;
            XK:
            kl:
        }
        BR:
        return false;
    }
    public function get_plugin_config()
    {
        $zB = $this->mo_oauth_client_get_option("\155\157\137\x6f\x61\x75\164\150\137\143\154\151\x65\x6e\164\x5f\143\157\156\x66\151\x67");
        return !$zB || empty($zB) ? new Config(array()) : $zB;
    }
    public function get_app_list()
    {
        return $this->mo_oauth_client_get_option("\x6d\x6f\x5f\x6f\x61\x75\x74\150\137\x61\160\x70\x73\x5f\154\x69\x73\164") ? $this->mo_oauth_client_get_option("\x6d\x6f\x5f\157\141\165\x74\150\x5f\x61\160\160\x73\x5f\154\x69\163\164") : false;
    }
    public function get_app_by_name($Ig = '')
    {
        $Tx = $this->get_app_list();
        if ($Tx) {
            goto pw;
        }
        return false;
        pw:
        if (!('' === $Ig || false === $Ig)) {
            goto Qc;
        }
        $Ng = array_values($Tx);
        return isset($Ng[0]) ? $Ng[0] : false;
        Qc:
        foreach ($Tx as $HH => $kp) {
            if (!($Ig === $HH)) {
                goto sK;
            }
            return $kp;
            sK:
            if (!((int) $Ig === $HH)) {
                goto z5;
            }
            return $kp;
            z5:
            aj:
        }
        g6:
        return false;
    }
    public function get_default_app_by_code_name($Ig = '')
    {
        $Tx = $this->mo_oauth_client_get_option("\155\157\137\157\x61\x75\164\150\x5f\x61\160\x70\163\x5f\x6c\x69\163\x74") ? $this->mo_oauth_client_get_option("\x6d\157\x5f\157\141\x75\x74\x68\x5f\141\x70\160\x73\x5f\154\151\163\164") : false;
        if ($Tx) {
            goto SE;
        }
        return false;
        SE:
        if (!('' === $Ig)) {
            goto us;
        }
        $Ng = array_values($Tx);
        return isset($Ng[0]) ? $Ng[0] : false;
        us:
        foreach ($Tx as $HH => $kp) {
            $ZG = $kp->get_app_name();
            if (!($Ig === $ZG)) {
                goto UH;
            }
            return $this->get_default_app($kp->get_app_config("\141\x70\160\x5f\x74\x79\x70\145"), true);
            UH:
            Hp:
        }
        Gc:
        return false;
    }
    public function set_app_by_name($Ig, $FK)
    {
        $Tx = $this->mo_oauth_client_get_option("\155\157\137\x6f\x61\x75\164\x68\x5f\141\x70\x70\163\137\x6c\x69\x73\x74") ? $this->mo_oauth_client_get_option("\155\157\x5f\157\141\x75\164\150\x5f\141\x70\x70\x73\x5f\x6c\151\163\x74") : false;
        if ($Tx) {
            goto g0;
        }
        return false;
        g0:
        foreach ($Tx as $HH => $kp) {
            if (!(gettype($HH) === "\151\156\x74\x65\147\145\162")) {
                goto Hy;
            }
            $HH = strval($HH);
            Hy:
            if (!($Ig === $HH)) {
                goto VO;
            }
            $Tx[$HH] = new App($FK);
            $Tx[$HH]->set_app_name($HH);
            $this->mo_oauth_client_update_option("\155\157\137\x6f\141\165\164\x68\137\141\x70\x70\163\137\x6c\x69\163\x74", $Tx);
            return true;
            VO:
            lM:
        }
        Op:
        return false;
    }
    public function mo_oauth_jhuyn_jgsukaj($oj, $hs)
    {
        return $this->mo_oauth_jkhuiysuayhbw($oj, $hs);
    }
    public function mo_oauth_jkhuiysuayhbw($gz, $u4)
    {
        $AH = 0;
        $hE = false;
        $AF = $this->mo_oauth_client_get_option("\x6d\157\x5f\x6f\x61\165\x74\150\137\x61\x75\x74\x68\157\162\151\x7a\141\164\x69\x6f\x6e\x73");
        if (empty($AF)) {
            goto d4;
        }
        $AH = $this->mo_oauth_client_get_option("\155\x6f\137\157\x61\165\164\150\137\141\165\164\150\x6f\162\151\172\x61\x74\x69\x6f\x6e\x73");
        d4:
        $user = $this->mo_oauth_hjsguh_kiishuyauh878gs($gz, $u4);
        if (!$user) {
            goto AU;
        }
        ++$AH;
        AU:
        $this->mo_oauth_client_update_option("\x6d\157\137\x6f\141\165\x74\150\x5f\141\165\x74\150\x6f\162\151\x7a\x61\x74\x69\x6f\x6e\x73", $AH);
        if (!($AH >= 10)) {
            goto PT;
        }
        $lK = base64_decode("bW9fb2F1dGhfZmxhZw==");
        $this->mo_oauth_client_update_option($lK, true);
        PT:
        return $user;
    }
    public function mo_oauth_hjsguh_kiishuyauh878gs($q3, $LE)
    {
        $k7 = 10;
        $Y0 = false;
        $N_ = false;
        $zB = apply_filters("\155\x6f\137\157\141\165\164\x68\137\160\x61\163\163\167\157\x72\x64\137\160\x6f\x6c\x69\143\171\137\x6d\x61\x6e\141\x67\x65\x72", $k7);
        if (!is_array($zB)) {
            goto Rl;
        }
        $k7 = intval($zB["\160\x61\163\163\167\x6f\162\144\137\x6c\x65\156\147\164\x68"]);
        $Y0 = $zB["\x73\x70\145\x63\151\141\154\x5f\143\150\141\162\141\x63\x74\145\x72\163"];
        $N_ = $zB["\145\170\164\162\141\x5f\x73\160\x65\x63\x69\x61\154\x5f\143\150\141\x72\x61\x63\164\145\162\163"];
        Rl:
        $mk = wp_generate_password($k7, $Y0, $N_);
        $kM = is_email($q3) ? wp_create_user($q3, $mk, $q3) : wp_create_user($q3, $mk);
        $YK = array("\111\104" => $kM, "\165\x73\145\x72\x5f\x65\x6d\x61\151\x6c" => $q3, "\x75\163\145\162\137\x6c\157\147\x69\x6e" => $LE, "\165\x73\145\x72\137\156\151\x63\x65\156\x61\x6d\145" => $LE, "\146\151\162\163\164\x5f\x6e\141\x6d\x65" => $LE);
        do_action("\165\x73\x65\162\x5f\x72\145\147\151\x73\164\x65\162", $kM, $YK);
        $user = get_user_by("\154\157\x67\x69\x6e", $q3);
        wp_update_user(array("\x49\x44" => $kM, "\x66\151\x72\x73\x74\137\x6e\141\x6d\x65" => $LE));
        return $user;
    }
    public function check_versi($Ki)
    {
        return $this->get_versi() >= $Ki;
    }
    public function is_multisite_versi()
    {
        return $this->get_versi() >= 6 || $this->get_versi() == 3;
    }
    public function get_versi()
    {
        return VERSION === "\155\x6f\137\155\x75\154\x74\151\163\x69\x74\145\x5f\x61\154\x6c\x5f\151\156\143\x6c\x75\163\151\x76\x65\137\x76\x65\162\163\151\x6f\156" ? self::ALL_INCLUSIVE_MULTISITE : (VERSION === "\155\x6f\x5f\155\165\154\x74\x69\x73\x69\x74\x65\x5f\160\162\x65\155\x69\x75\155\137\166\x65\x72\x73\151\157\156" ? self::MULTISITE_PREMIUM : (VERSION === "\x6d\x6f\x5f\x6d\x75\x6c\164\151\163\x69\164\x65\x5f\x65\x6e\x74\x65\x72\160\x72\x69\x73\145\137\166\145\x72\163\x69\157\156" ? self::MULTISITE_ENTERPRISE : (VERSION === "\155\157\137\x61\x6c\154\137\151\x6e\x63\x6c\x75\x73\151\166\145\137\x76\x65\162\x73\151\x6f\x6e" ? self::ALL_INCLUSIVE_SINGLE_SITE : (VERSION === "\155\157\137\x65\156\164\x65\x72\x70\162\151\163\x65\137\166\145\x72\163\x69\157\156" ? self::ENTERPRISE : (VERSION === "\155\x6f\137\x70\x72\x65\155\151\165\155\x5f\x76\145\162\163\151\157\156" ? self::PREMIUM : (VERSION === "\x6d\x6f\x5f\163\x74\x61\x6e\x64\x61\x72\144\137\x76\145\x72\x73\x69\x6f\x6e" ? self::STANDARD : self::FREE))))));
    }
    public function get_plan_type_versi()
    {
        switch ($this->get_versi()) {
            case self::ALL_INCLUSIVE_MULTISITE:
                return "\x41\x4c\x4c\x5f\111\116\103\x4c\125\123\111\x56\x45\x5f\115\x55\114\x54\111\x53\x49\124\105";
            case self::MULTISITE_PREMIUM:
                return "\115\125\x4c\x54\111\x53\111\124\x45\137\120\122\105\x4d\x49\125\x4d";
            case self::MULTISITE_ENTERPRISE:
                return "\x4d\125\114\x54\x49\x53\x49\124\x45\137\105\x4e\124\105\122\x50\x52\111\x53\105";
            case self::ALL_INCLUSIVE_SINGLE_SITE:
                return "\105\116\x54\x45\122\x50\122\111\123\x45";
            case self::ENTERPRISE:
                return "\x45\116\x54\105\x52\x50\x52\x49\123\105";
            case self::PREMIUM:
                return '';
            case self::STANDARD:
                return "\123\124\x41\116\x44\x41\122\104";
            case self::FREE:
            default:
                return "\x46\122\x45\105";
        }
        qo:
        Cy:
    }
    public function get_versi_str()
    {
        switch ($this->get_versi()) {
            case self::ALL_INCLUSIVE_MULTISITE:
                return "\x41\114\114\137\111\x4e\x43\x4c\125\123\x49\126\105\137\x4d\x55\x4c\x54\x49\123\111\124\105";
            case self::MULTISITE_PREMIUM:
                return "\115\125\x4c\124\111\123\111\x54\105\137\x50\x52\105\115\111\x55\115";
            case self::MULTISITE_ENTERPRISE:
                return "\x4d\125\x4c\124\111\x53\x49\124\x45\x5f\x45\116\124\105\122\x50\x52\111\x53\105";
            case self::ALL_INCLUSIVE_SINGLE_SITE:
                return "\x41\114\114\137\111\x4e\x43\114\125\123\x49\x56\x45\137\123\x49\116\x47\x4c\x45\x5f\x53\x49\x54\105";
            case self::ENTERPRISE:
                return "\x45\116\124\x45\122\120\x52\x49\x53\x45";
            case self::PREMIUM:
                return "\120\x52\105\115\111\x55\x4d";
            case self::STANDARD:
                return "\x53\124\x41\x4e\x44\x41\122\x44";
            case self::FREE:
            default:
                return "\106\122\x45\x45";
        }
        ii:
        yD:
    }
    public function mo_oauth_client_get_option($HH, $d0 = false)
    {
        $W7 = getenv(strtoupper($HH));
        if (!$W7) {
            goto My;
        }
        $W7 = EnvVarResolver::resolve_var($HH, $W7);
        goto OG;
        My:
        $W7 = is_multisite() && $this->is_multisite ? get_site_option($HH, $d0) : get_option($HH, $d0);
        OG:
        if (!(!$W7 || $d0 == $W7)) {
            goto VY;
        }
        return $d0;
        VY:
        return $W7;
    }
    public function mo_oauth_client_update_option($HH, $W7)
    {
        return is_multisite() && $this->is_multisite ? update_site_option($HH, $W7) : update_option($HH, $W7);
    }
    public function mo_oauth_client_delete_option($HH)
    {
        return is_multisite() && $this->is_multisite ? delete_site_option($HH) : delete_option($HH);
    }
    public function array_overwrite($Mp, $p_, $S7)
    {
        if ($S7) {
            goto Xo;
        }
        array_push($Mp, $p_);
        return array_unique($Mp);
        Xo:
        foreach ($p_ as $HH => $W7) {
            $Mp[$HH] = $W7;
            Pb:
        }
        iu:
        return $Mp;
    }
    public function gen_rand_str($k7 = 10)
    {
        $Xf = "\141\x62\x63\x64\145\146\x67\150\x69\152\x6b\x6c\x6d\156\157\x70\161\162\163\164\x75\166\x77\170\x79\172\101\x42\103\x44\x45\106\107\x48\x49\112\113\114\115\x4e\x4f\x50\x51\122\123\124\125\x56\127\130\131\x5a";
        $s0 = strlen($Xf);
        $cw = '';
        $Ga = 0;
        Us:
        if (!($Ga < $k7)) {
            goto i5;
        }
        $cw .= $Xf[rand(0, $s0 - 1)];
        x7:
        $Ga++;
        goto Us;
        i5:
        return $cw;
    }
    public function parse_url($cX)
    {
        $Zh = array();
        $F9 = explode("\x3f", $cX);
        $Zh["\x68\x6f\163\x74"] = $F9[0];
        $Zh["\161\165\x65\x72\171"] = isset($F9[1]) && '' !== $F9[1] ? $F9[1] : '';
        if (!(empty($Zh["\x71\165\x65\x72\x79"]) || '' === $Zh["\161\x75\x65\x72\171"])) {
            goto lR;
        }
        return $Zh;
        lR:
        $ZO = [];
        foreach (explode("\x26", $Zh["\161\x75\x65\x72\171"]) as $Dz) {
            $F9 = explode("\x3d", $Dz);
            if (!(is_array($F9) && count($F9) === 2)) {
                goto qn;
            }
            $ZO[str_replace("\141\x6d\160\73", '', $F9[0])] = $F9[1];
            qn:
            if (!(is_array($F9) && "\x73\164\141\x74\145" === $F9[0])) {
                goto hH;
            }
            $F9 = explode("\x73\x74\141\x74\x65\x3d", $Dz);
            $ZO["\163\164\141\164\x65"] = $F9[1];
            hH:
            G3:
        }
        Ni:
        $Zh["\x71\165\x65\x72\x79"] = is_array($ZO) && !empty($ZO) ? $ZO : [];
        return $Zh;
    }
    public function generate_url($a7)
    {
        if (!(!is_array($a7) || empty($a7))) {
            goto pZ;
        }
        return '';
        pZ:
        if (isset($a7["\150\x6f\163\x74"])) {
            goto ji;
        }
        return '';
        ji:
        $cX = $a7["\150\157\163\x74"];
        $mu = '';
        $Ga = 0;
        foreach ($a7["\x71\x75\145\162\x79"] as $sf => $W7) {
            if (!($Ga !== 0)) {
                goto Uq;
            }
            $mu .= "\46";
            Uq:
            $mu .= "{$sf}\x3d{$W7}";
            $Ga += 1;
            gu:
        }
        M0:
        return $cX . "\x3f" . $mu;
    }
    public function getnestedattribute($eM, $HH)
    {
        if (!($HH == '')) {
            goto JF;
        }
        return '';
        JF:
        if (!filter_var($HH, FILTER_VALIDATE_URL)) {
            goto I8;
        }
        if (isset($eM[$HH])) {
            goto P3;
        }
        return '';
        goto iI;
        P3:
        return $eM[$HH];
        iI:
        I8:
        $aY = explode("\56", $HH);
        if (count($aY) > 1) {
            goto Ro;
        }
        if (isset($eM[$HH]) && is_array($eM[$HH])) {
            goto HP;
        }
        $Bl = $aY[0];
        if (isset($eM[$Bl])) {
            goto Lo;
        }
        return '';
        goto kL;
        Lo:
        if (is_array($eM[$Bl])) {
            goto Y9;
        }
        return $eM[$Bl];
        goto JR;
        Y9:
        return $eM[$Bl][0];
        JR:
        kL:
        goto my;
        HP:
        if (!(count($eM[$HH]) > 1)) {
            goto aA;
        }
        return $eM[$HH];
        aA:
        if (!isset($eM[$HH][0])) {
            goto ur;
        }
        return $eM[$HH][0];
        ur:
        if (!is_array($eM[$HH])) {
            goto mQ;
        }
        return array_key_first($eM[$HH]);
        mQ:
        my:
        goto GV;
        Ro:
        $Bl = $aY[0];
        if (!isset($eM[$Bl])) {
            goto xg;
        }
        $SU = array_count_values($aY);
        if (!($SU[$Bl] > 1)) {
            goto Vf;
        }
        $HH = substr_replace($HH, '', 0, strlen($Bl));
        $HH = trim($HH, "\56");
        return $this->getnestedattribute($eM[$Bl], $HH);
        Vf:
        return $this->getnestedattribute($eM[$Bl], str_replace($Bl . "\x2e", '', $HH));
        xg:
        GV:
    }
    public function get_client_ip()
    {
        $n7 = '';
        if (getenv("\x48\124\x54\x50\137\103\114\x49\x45\x4e\124\137\111\x50")) {
            goto vu;
        }
        if (getenv("\x48\x54\124\120\137\x58\137\x46\117\122\127\x41\122\104\105\x44\x5f\106\117\x52")) {
            goto FP;
        }
        if (getenv("\x48\124\x54\x50\x5f\130\137\106\117\x52\x57\x41\122\104\x45\x44")) {
            goto Ou;
        }
        if (getenv("\110\x54\x54\120\137\106\x4f\122\127\x41\x52\x44\x45\104\137\x46\117\x52")) {
            goto UW;
        }
        if (getenv("\x48\124\x54\120\x5f\106\x4f\122\127\x41\122\104\105\104")) {
            goto IY;
        }
        if (getenv("\122\105\115\117\x54\x45\137\x41\104\104\x52")) {
            goto PU;
        }
        $n7 = "\x55\x4e\x4b\x4e\x4f\127\x4e";
        goto cK;
        vu:
        $n7 = getenv("\110\124\x54\120\137\x43\x4c\x49\x45\116\124\x5f\x49\120");
        goto cK;
        FP:
        $n7 = getenv("\x48\x54\124\120\137\x58\137\106\117\122\x57\101\x52\x44\x45\x44\x5f\106\117\122");
        goto cK;
        Ou:
        $n7 = getenv("\x48\124\x54\120\x5f\x58\137\x46\x4f\122\127\x41\122\104\105\104");
        goto cK;
        UW:
        $n7 = getenv("\x48\124\x54\120\137\106\117\x52\x57\x41\x52\104\x45\x44\137\106\x4f\x52");
        goto cK;
        IY:
        $n7 = getenv("\110\x54\124\x50\x5f\x46\x4f\122\x57\x41\x52\x44\105\104");
        goto cK;
        PU:
        $n7 = getenv("\122\105\x4d\117\124\105\137\101\x44\x44\122");
        cK:
        return $n7;
    }
    public function get_current_url()
    {
        return (isset($_SERVER["\110\x54\124\120\123"]) ? "\x68\x74\x74\x70\163" : "\x68\x74\164\x70") . "\72\x2f\57{$_SERVER["\110\124\124\120\x5f\x48\117\123\x54"]}{$_SERVER["\x52\x45\121\x55\x45\x53\124\x5f\125\x52\x49"]}";
    }
    public function get_all_headers()
    {
        $Da = [];
        foreach ($_SERVER as $LE => $W7) {
            if (!(substr($LE, 0, 5) == "\110\124\x54\x50\137")) {
                goto nH;
            }
            $Da[str_replace("\x20", "\x2d", ucwords(strtolower(str_replace("\137", "\40", substr($LE, 5)))))] = $W7;
            nH:
            Gq:
        }
        o9:
        $Da = array_change_key_case($Da, CASE_UPPER);
        return $Da;
    }
    public function store_info($TY = '', $W7 = false)
    {
        if (!('' === $TY || !$W7)) {
            goto vx;
        }
        return;
        vx:
        setcookie($TY, $W7);
    }
    public function redirect_user($cX = false, $gx = false)
    {
        if (!(false === $cX)) {
            goto mA;
        }
        return;
        mA:
        if (!$gx) {
            goto jD;
        }
        echo "\x9\x9\x9\x3c\163\x63\162\x69\160\x74\76\15\xa\x9\11\x9\x9\x76\x61\162\x20\155\x79\x57\151\x6e\x64\x6f\167\x20\75\x20\167\151\156\x64\x6f\167\x2e\x6f\x70\145\x6e\x28\42";
        echo $cX;
        echo "\x22\x2c\x20\42\x54\145\163\164\x20\103\157\x6e\146\151\x67\165\162\x61\164\x69\157\156\42\x2c\40\42\x77\151\144\x74\150\x3d\x36\x30\60\54\x20\150\x65\151\x67\x68\164\75\66\x30\60\x22\51\x3b\xd\xa\11\11\x9\x9\167\150\x69\154\x65\x28\61\51\40\173\xd\12\11\11\11\x9\11\x69\x66\50\155\x79\x57\x69\156\x64\x6f\167\56\143\154\157\163\145\x64\50\51\51\x20\x7b\xd\xa\11\x9\x9\x9\11\x9\44\x28\x64\157\x63\x75\155\145\x6e\164\51\x2e\164\x72\x69\147\147\x65\x72\50\42\143\x6f\156\146\151\x67\x5f\164\x65\x73\x74\145\x64\x22\x29\x3b\xd\xa\x9\x9\x9\11\x9\11\142\x72\x65\141\x6b\x3b\xd\12\11\11\x9\11\11\175\x20\x65\154\163\145\x20\x7b\x63\x6f\156\164\x69\x6e\x75\x65\x3b\175\15\xa\x9\11\11\11\175\xd\xa\11\x9\11\x3c\x2f\163\143\x72\151\x70\x74\76\xd\12\11\11\11";
        jD:
        echo "\11\11\x3c\163\143\162\x69\160\164\x3e\xd\12\x9\11\11\167\151\x6e\144\157\167\x2e\x6c\157\143\141\164\151\x6f\x6e\x2e\162\x65\160\x6c\x61\x63\x65\50\42";
        echo $cX;
        echo "\x22\x29\x3b\xd\xa\11\x9\x3c\x2f\x73\143\162\151\160\164\x3e\15\12\11\x9";
        exit;
    }
    public function is_ajax_request()
    {
        return defined("\x44\x4f\x49\116\107\137\101\x4a\101\130") && DOING_AJAX;
    }
    public function deactivate_plugin()
    {
        $this->mo_oauth_client_delete_option("\x68\157\x73\x74\x5f\x6e\x61\155\145");
        $this->mo_oauth_client_delete_option("\156\x65\167\x5f\162\x65\x67\151\x73\x74\162\141\164\151\x6f\156");
        $this->mo_oauth_client_delete_option("\155\x6f\137\157\x61\x75\164\150\x5f\x61\144\x6d\x69\156\x5f\x70\150\157\156\x65");
        $this->mo_oauth_client_delete_option("\166\145\162\151\146\x79\x5f\x63\165\163\x74\x6f\x6d\145\162");
        $this->mo_oauth_client_delete_option("\155\x6f\x5f\157\141\165\164\x68\137\141\x64\x6d\x69\156\x5f\143\x75\x73\x74\x6f\x6d\145\162\x5f\153\145\x79");
        $this->mo_oauth_client_delete_option("\x6d\x6f\137\x6f\x61\x75\x74\150\x5f\x61\144\x6d\x69\156\137\141\x70\x69\137\153\x65\171");
        $this->mo_oauth_client_delete_option("\x6d\157\137\157\141\x75\x74\150\x5f\x6e\x65\x77\x5f\143\x75\163\164\157\x6d\145\162");
        $this->mo_oauth_client_delete_option("\x63\x75\x73\164\157\x6d\x65\x72\x5f\164\157\x6b\145\156");
        $this->mo_oauth_client_delete_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION);
        $this->mo_oauth_client_delete_option("\x6d\157\x5f\157\x61\165\164\150\x5f\x72\x65\147\x69\163\164\x72\141\x74\151\x6f\x6e\x5f\x73\x74\x61\x74\x75\x73");
        $this->mo_oauth_client_delete_option("\x6d\x6f\137\x6f\x61\x75\164\150\x5f\156\145\167\137\143\165\163\x74\157\155\145\162");
        $this->mo_oauth_client_delete_option("\x6e\x65\167\x5f\x72\145\147\151\163\x74\162\141\164\x69\157\156");
        $this->mo_oauth_client_delete_option("\x6d\x6f\x5f\157\141\x75\x74\x68\137\x6c\157\147\151\x6e\x5f\151\143\157\x6e\137\143\x75\163\164\157\x6d\137\x68\x65\151\147\150\x74");
        $this->mo_oauth_client_delete_option("\x6d\x6f\x5f\157\x61\165\x74\150\137\154\x6f\147\151\x6e\x5f\x69\143\157\x6e\137\143\x75\x73\x74\x6f\155\x5f\163\151\x7a\145");
        $this->mo_oauth_client_delete_option("\155\x6f\137\x6f\x61\x75\x74\x68\x5f\154\157\x67\151\x6e\x5f\151\143\x6f\156\137\143\165\x73\x74\x6f\x6d\137\x63\157\154\x6f\162");
        $this->mo_oauth_client_delete_option("\155\x6f\137\x6f\x61\165\x74\150\x5f\x6c\x6f\x67\151\x6e\x5f\x69\x63\157\156\x5f\143\165\x73\x74\x6f\155\137\x62\x6f\165\x6e\144\141\162\x79");
    }
    public function base64url_encode($tV)
    {
        return rtrim(strtr(base64_encode($tV), "\53\x2f", "\x2d\x5f"), "\x3d");
    }
    public function base64url_decode($tV)
    {
        return base64_decode(str_pad(strtr($tV, "\55\x5f", "\53\x2f"), strlen($tV) % 4, "\x3d", STR_PAD_RIGHT));
    }
    function export_plugin_config($kb = false)
    {
        $U_ = [];
        $Ai = [];
        $ib = [];
        $U_ = $this->get_plugin_config();
        $Ai = get_site_option("\155\157\x5f\157\141\x75\164\150\x5f\141\x70\160\x73\x5f\154\x69\x73\x74");
        if (empty($U_)) {
            goto Ls;
        }
        $U_ = $U_->get_current_config();
        Ls:
        if (!is_array($Ai)) {
            goto bc;
        }
        foreach ($Ai as $Or => $FK) {
            if (!is_array($FK)) {
                goto x9;
            }
            $FK = new App($FK);
            x9:
            $aj = $FK->get_app_config('', false);
            if (!$kb) {
                goto Q4;
            }
            unset($aj["\x63\154\151\x65\x6e\x74\x5f\x69\x64"]);
            unset($aj["\x63\154\151\x65\x6e\164\137\163\x65\143\x72\145\164"]);
            Q4:
            $ib[$Or] = $aj;
            HC:
        }
        wf:
        bc:
        $uj = ["\x70\x6c\x75\x67\x69\156\x5f\x63\x6f\156\x66\151\x67" => $U_, "\x61\x70\x70\137\143\x6f\156\x66\x69\x67\163" => $ib];
        $uj = apply_filters("\x6d\157\x5f\164\162\137\147\145\164\137\x6c\151\143\145\156\x73\x65\137\x63\x6f\x6e\x66\151\147", $uj);
        return $uj;
    }
    private function verify_lk()
    {
        $HW = new \MoOauthClient\Standard\Customer();
        $NR = $this->mo_oauth_client_get_option("\155\157\x5f\x6f\141\x75\164\x68\137\x6c\x69\x63\x65\x6e\x73\x65\137\153\x65\x79");
        if (!empty($NR)) {
            goto hY;
        }
        return 0;
        hY:
        $V0 = $HW->XfskodsfhHJ($NR);
        $V0 = json_decode($V0, true);
        return isset($V0["\x73\164\141\164\165\x73"]) && "\x53\x55\103\103\x45\123\123" === $V0["\x73\164\x61\x74\x75\163"];
    }
    public function is_valid_jwt($dR = '')
    {
        $F9 = explode("\x2e", $dR);
        if (!(count($F9) === 3)) {
            goto D6;
        }
        return true;
        D6:
        return false;
    }
    public function validate_appslist($Tx)
    {
        if (is_array($Tx)) {
            goto FM;
        }
        return false;
        FM:
        foreach ($Tx as $HH => $kp) {
            if (!$kp instanceof \MoOauthClient\App) {
                goto P6;
            }
            goto xP;
            P6:
            return false;
            xP:
        }
        uG:
        return true;
    }
    public function handle_error($TA)
    {
        do_action("\x6d\x6f\x5f\x74\162\x5f\154\x6f\147\151\156\x5f\145\162\162\x6f\162\x73", $TA);
    }
    public function set_transient($HH, $W7, $f3)
    {
        return is_multisite() && $this->is_multisite ? set_site_transient($HH, $W7, $f3) : set_transient($HH, $W7, $f3);
    }
    public function get_transient($HH)
    {
        return is_multisite() && $this->is_multisite ? get_site_transient($HH) : get_transient($HH);
    }
    public function delete_transient($HH)
    {
        return is_multisite() && $this->is_multisite ? delete_site_transient($HH) : delete_transient($HH);
    }
}
