<?php


namespace MoOauthClient;

use MoOauthClient\Base\InstanceHelper;
use MoOauthClient\OauthHandler;
use MoOauthClient\StorageManager;
use MoOauthClient\MO_Custom_OAuth1;
class LoginHandler
{
    public $oauth_handler;
    public function __construct()
    {
        $this->oauth_handler = new OauthHandler();
        add_action("\x69\x6e\151\x74", array($this, "\155\157\x5f\x6f\141\165\164\150\x5f\144\x65\x63\151\144\145\137\146\154\x6f\167"));
        add_action("\155\157\x5f\157\141\x75\164\x68\x5f\143\154\x69\x65\156\164\x5f\x74\151\147\150\164\x5f\154\x6f\x67\151\156\x5f\151\156\164\145\x72\156\141\x6c", array($this, "\150\141\156\x64\x6c\145\137\163\x73\x6f"), 10, 4);
    }
    public function mo_oauth_decide_flow()
    {
        global $lT;
        if (!(isset($_REQUEST[\MoOAuthConstants::OPTION]) && "\x74\x65\x73\x74\141\164\x74\162\155\x61\160\160\x69\156\x67\x63\x6f\x6e\146\x69\147" === $_REQUEST[\MoOAuthConstants::OPTION])) {
            goto uq;
        }
        $eb = $_REQUEST["\x61\x70\x70"];
        wp_safe_redirect(site_url() . "\77\x6f\160\x74\x69\157\156\x3d\157\141\x75\x74\150\x72\x65\144\x69\x72\x65\x63\x74\x26\x61\160\160\137\x6e\141\x6d\x65\75" . rawurlencode($eb) . "\46\x74\145\x73\164\x3d\x74\162\165\x65");
        exit;
        uq:
        $this->mo_oauth_login_validate();
    }
    public function mo_oauth_login_validate()
    {
        global $lT;
        $Xc = new StorageManager();
        if (!(isset($_REQUEST[\MoOAuthConstants::OPTION]) and strpos($_REQUEST[\MoOAuthConstants::OPTION], "\157\141\x75\164\x68\162\x65\x64\x69\x72\145\x63\x74") !== false)) {
            goto lU;
        }
        if (isset($_REQUEST["\155\x6f\137\x6c\x6f\147\151\156\x5f\x70\157\x70\165\x70"])) {
            goto Pq;
        }
        if (!(isset($_REQUEST["\162\x65\x73\157\165\x72\143\x65"]) && !empty($_REQUEST["\x72\x65\163\x6f\x75\x72\143\x65"]))) {
            goto d2;
        }
        if (!empty($_REQUEST["\162\x65\x73\157\165\x72\x63\145"])) {
            goto MR;
        }
        $lT->handle_error("\124\150\145\40\162\145\163\x70\x6f\x6e\x73\145\x20\x66\162\157\x6d\x20\165\x73\145\x72\x69\x6e\146\157\x20\167\141\163\40\x65\155\x70\x74\171\56");
        MO_Oauth_Debug::mo_oauth_log("\x54\150\x65\x20\x72\145\x73\160\x6f\x6e\x73\145\x20\146\x72\157\155\40\x75\x73\145\x72\151\156\x66\x6f\x20\167\141\x73\40\145\x6d\x70\x74\x79\56");
        wp_die(wp_kses("\124\150\145\40\x72\x65\x73\160\x6f\156\163\x65\40\x66\x72\157\x6d\40\x75\x73\x65\162\151\x6e\x66\x6f\x20\x77\x61\x73\x20\x65\x6d\160\x74\x79\x2e", \mo_oauth_get_valid_html()));
        MR:
        $Xc = new StorageManager(urldecode($_REQUEST["\162\x65\163\157\165\162\x63\145"]));
        $tJ = $Xc->get_value("\x72\x65\163\x6f\165\162\x63\x65");
        $Wj = $Xc->get_value("\x61\160\160\x6e\x61\x6d\x65");
        $gQ = $Xc->get_value("\x72\x65\144\x69\x72\x65\x63\x74\137\x75\162\151");
        $T2 = $Xc->get_value("\x61\143\x63\x65\x73\163\137\x74\157\x6b\145\x6e");
        $FK = $lT->get_app_by_name($Wj)->get_app_config();
        $wK = isset($_REQUEST["\164\x65\163\164"]) && !empty($_REQUEST["\x74\x65\x73\x74"]);
        if (!($wK && '' !== $wK)) {
            goto RL;
        }
        $this->handle_group_test_conf($tJ, $FK, $T2, false, $wK);
        exit;
        RL:
        $Xc->remove_key("\162\x65\163\157\165\x72\x63\x65");
        $Xc->add_replace_entry("\x70\x6f\x70\165\160", "\151\147\x6e\x6f\x72\x65");
        if (!has_filter("\x77\157\x6f\x63\157\x6d\x6d\145\162\143\145\x5f\x63\x68\x65\x63\153\157\165\x74\x5f\x67\145\x74\137\x76\141\154\x75\145")) {
            goto PV;
        }
        $tJ["\141\x70\160\x6e\x61\x6d\145"] = $Wj;
        PV:
        do_action("\155\x6f\137\x61\142\162\137\146\151\x6c\164\x65\x72\x5f\x6c\157\x67\151\x6e", $tJ);
        $this->handle_sso($Wj, $FK, $tJ, $Xc->get_state(), ["\141\143\143\x65\x73\163\137\x74\157\153\145\156" => $T2]);
        d2:
        if (isset($_REQUEST["\x61\160\160\x5f\x6e\x61\x6d\145"])) {
            goto JD;
        }
        $WG = "\120\x6c\x65\x61\x73\x65\40\x63\x68\145\x63\153\x20\x69\x66\x20\171\x6f\165\x20\141\x72\x65\x20\x73\145\x6e\x64\x69\156\x67\x20\164\x68\x65\x20\47\x61\160\160\x5f\156\x61\x6d\145\x27\40\160\141\162\x61\x6d\x65\x74\x65\162";
        $lT->handle_error($WG);
        wp_die(wp_kses($WG, \mo_oauth_get_valid_html()));
        exit;
        JD:
        $Ig = isset($_REQUEST["\x61\160\160\137\x6e\141\155\145"]) && !empty($_REQUEST["\x61\160\160\x5f\x6e\x61\x6d\x65"]) ? $_REQUEST["\141\x70\160\x5f\x6e\x61\155\x65"] : '';
        if (!($Ig == '')) {
            goto mG;
        }
        $WG = "\116\157\40\x73\165\x63\x68\40\x61\x70\160\x20\146\x6f\x75\156\x64\x20\x63\x6f\156\146\x69\147\x75\162\145\x64\56\40\x50\154\145\141\x73\145\x20\143\150\x65\143\153\x20\x69\146\x20\x79\x6f\x75\40\141\x72\x65\x20\x73\x65\x6e\144\151\156\147\x20\x74\150\x65\40\x63\x6f\x72\162\145\143\x74\40\x61\160\x70\137\x6e\141\x6d\x65";
        MO_Oauth_Debug::mo_oauth_log($WG);
        $lT->handle_error($WG);
        wp_die(wp_kses($WG, \mo_oauth_get_valid_html()));
        exit;
        mG:
        $Tx = $lT->mo_oauth_client_get_option("\155\157\137\x6f\141\165\x74\x68\137\x61\x70\x70\x73\x5f\154\151\163\164");
        if (is_array($Tx) && isset($Tx[$Ig])) {
            goto fy;
        }
        $WG = "\116\157\40\x73\165\143\150\40\x61\x70\160\40\146\157\x75\x6e\144\40\143\x6f\x6e\146\151\147\x75\x72\x65\144\x2e\x20\x50\x6c\x65\x61\163\x65\x20\x63\x68\x65\143\153\x20\151\x66\x20\171\x6f\165\40\141\x72\145\40\163\145\x6e\x64\151\x6e\147\x20\x74\150\x65\x20\143\157\162\x72\x65\x63\x74\x20\x61\x70\160\137\x6e\x61\x6d\145";
        MO_Oauth_Debug::mo_oauth_log($WG);
        $lT->handle_error($WG);
        wp_die(wp_kses($WG, \mo_oauth_get_valid_html()));
        exit;
        fy:
        $c5 = "\57\57" . $_SERVER["\110\124\124\x50\137\x48\117\x53\124"] . $_SERVER["\x52\105\x51\x55\105\x53\x54\137\x55\x52\x49"];
        $c5 = strtok($c5, "\77");
        $Dl = isset($_REQUEST["\x72\145\144\x69\x72\145\x63\x74\x5f\165\x72\154"]) ? urldecode($_REQUEST["\x72\x65\144\151\x72\x65\143\164\137\165\x72\154"]) : $c5;
        $wK = isset($_REQUEST["\x74\145\x73\x74"]) ? urldecode($_REQUEST["\164\x65\163\x74"]) : false;
        $l9 = isset($_REQUEST["\162\145\x73\164\x72\x69\143\164\x72\x65\x64\x69\162\x65\x63\x74"]) ? urldecode($_REQUEST["\162\145\163\x74\162\x69\x63\x74\162\x65\144\x69\162\145\143\164"]) : false;
        $kp = $lT->get_app_by_name($Ig);
        $xN = $kp->get_app_config("\x67\162\x61\156\x74\x5f\164\x79\x70\145");
        if (!is_multisite()) {
            goto Fv;
        }
        $blog_id = get_current_blog_id();
        $dK = $lT->mo_oauth_client_get_option("\x6d\157\x5f\x6f\x61\165\164\150\137\x63\63\126\x69\143\62\x6c\x30\132\x58\116\172\x5a\x57\170\x6c\x59\63\122\x6c\x5a\x41");
        $f5 = array();
        if (!isset($dK)) {
            goto a9;
        }
        $f5 = json_decode($lT->mooauthdecrypt($dK), true);
        a9:
        $hE = false;
        $lb = $lT->mo_oauth_client_get_option("\155\x6f\x5f\157\x61\165\x74\x68\137\x69\x73\115\165\x6c\x74\151\123\x69\x74\x65\120\x6c\x75\147\x69\x6e\122\145\x71\165\145\163\x74\x65\x64");
        if (!(is_array($f5) && in_array($blog_id, $f5))) {
            goto U5;
        }
        $hE = true;
        U5:
        if (!(is_multisite() && $lb && ($lb && !$hE) && !$wK && $lT->mo_oauth_client_get_option("\156\157\x4f\x66\x53\165\142\x53\151\x74\x65\x73") < 1000)) {
            goto cn;
        }
        $lT->handle_error("\x4c\157\147\x69\x6e\x20\151\163\40\x64\151\163\141\x62\154\145\144\x20\x66\157\162\x20\x74\x68\151\163\40\x73\x69\164\x65\56\40\x50\154\x65\141\x73\145\40\143\x6f\156\164\x61\x63\164\x20\171\x6f\x75\162\40\141\x64\155\151\x6e\151\x73\x74\x72\141\164\157\x72\56");
        MO_Oauth_Debug::mo_oauth_log("\114\157\x67\151\x6e\x20\151\x73\40\144\x69\163\141\x62\154\x65\144\x20\x66\x6f\162\x20\164\x68\x69\163\40\x73\x69\164\x65\56\x20\120\154\x65\141\x73\x65\40\x63\157\x6e\x74\141\143\164\x20\x79\157\165\x72\40\141\x64\x6d\x69\156\x69\163\164\x72\x61\x74\x6f\162\56");
        wp_die("\x4c\x6f\147\x69\x6e\x20\151\x73\x20\x64\151\x73\141\142\154\x65\x64\40\x66\x6f\162\40\x74\x68\151\x73\40\163\x69\164\x65\56\x20\x50\154\x65\141\x73\x65\40\x63\157\156\x74\141\143\x74\x20\171\x6f\165\x72\40\x61\144\155\x69\156\x69\x73\164\162\141\164\157\162\x2e");
        cn:
        $Xc->add_replace_entry("\x62\154\157\x67\x5f\x69\144", $blog_id);
        Fv:
        MO_Oauth_Debug::mo_oauth_log("\107\x72\x61\156\164\x3a\40" . $xN);
        if ($xN && "\x50\141\163\163\167\157\162\144\40\x47\x72\x61\x6e\164" === $xN) {
            goto eJ;
        }
        if (!($xN && "\103\x6c\151\145\x6e\x74\x20\103\x72\145\144\x65\156\164\x69\141\154\x73\40\107\x72\141\156\x74" === $xN)) {
            goto yB;
        }
        do_action("\x6d\x6f\137\157\x61\165\x74\150\x5f\x63\x6c\x69\145\x6e\164\137\143\162\x65\x64\145\x6e\164\x69\x61\x6c\163\137\x67\x72\x61\156\164\137\x69\x6e\x69\x74\151\x61\x74\145", $Ig, $wK);
        exit;
        yB:
        goto zP;
        eJ:
        do_action("\160\167\x64\x5f\145\163\163\x65\156\164\x69\141\x6c\x73\137\151\x6e\x74\x65\162\156\x61\154");
        do_action("\155\157\137\157\141\x75\164\x68\137\143\x6c\x69\145\156\x74\137\141\x64\144\x5f\x70\x77\144\137\152\x73");
        echo "\11\x9\x9\x9\74\x73\143\162\151\x70\164\76\xa\x9\11\11\11\x9\166\141\x72\40\155\x6f\x5f\x6f\141\165\x74\x68\x5f\141\160\160\137\x6e\x61\155\145\x20\x3d\40\42";
        echo wp_kses($Ig, \mo_oauth_get_valid_html());
        echo "\42\73\xa\11\11\x9\11\x9\x64\157\x63\x75\155\145\x6e\164\x2e\141\144\x64\x45\166\x65\x6e\164\x4c\151\163\x74\145\x6e\145\x72\50\47\x44\x4f\115\103\157\x6e\164\x65\156\164\114\157\x61\144\x65\x64\47\x2c\40\146\x75\156\143\x74\151\x6f\x6e\x28\x29\40\x7b\12\11\x9\11\x9\x9\11";
        if ($wK) {
            goto II;
        }
        echo "\x9\x9\x9\11\x9\x9\11\155\157\x4f\x41\165\164\x68\x4c\157\147\x69\x6e\120\167\144\50\x6d\157\x5f\157\x61\165\x74\x68\x5f\141\x70\160\x5f\x6e\x61\x6d\x65\x2c\40\146\141\154\x73\145\x2c\40\x27";
        echo $Dl;
        echo "\x27\x29\x3b\12\11\11\x9\11\11\x9";
        goto BK;
        II:
        echo "\x9\x9\11\11\x9\11\x9\x6d\157\117\x41\x75\164\150\x4c\157\x67\151\156\120\167\x64\50\155\157\x5f\x6f\141\165\164\150\x5f\141\x70\x70\x5f\156\141\x6d\145\x2c\40\164\162\165\145\x2c\40\47";
        echo $Dl;
        echo "\x27\51\73\12\11\11\11\11\x9\11";
        BK:
        echo "\11\11\x9\x9\x9\175\54\x20\146\x61\154\163\x65\x29\73\xa\11\11\x9\11\74\57\163\143\162\x69\160\164\76\xa\x9\x9\11\11";
        exit;
        zP:
        if (!($kp->get_app_config("\141\x70\x70\x49\144") === "\164\167\151\164\164\x65\162" || $kp->get_app_config("\x61\x70\x70\x49\x64") === "\x6f\141\165\164\150\61")) {
            goto DG;
        }
        MO_Oauth_Debug::mo_oauth_log("\117\x61\x75\x74\x68\x31\x20\146\x6c\157\167");
        $wK = isset($_REQUEST["\x74\x65\163\x74"]) && !empty($_REQUEST["\164\145\163\x74"]);
        if (!($wK && '' !== $wK)) {
            goto cm;
        }
        setcookie("\157\141\165\x74\x68\x31\137\x74\145\x73\164", "\x31", time() + 20);
        cm:
        setcookie("\x6f\x61\x75\164\x68\61\141\x70\160\x6e\141\155\145", $Ig, time() + 60);
        $_COOKIE["\157\x61\x75\x74\x68\61\x61\160\x70\x6e\x61\x6d\145"] = $Ig;
        MO_Custom_OAuth1::mo_oauth1_auth_request($Ig);
        exit;
        DG:
        $za = md5(rand(0, 15));
        $Xc->add_replace_entry("\141\160\160\x6e\x61\x6d\x65", $Ig);
        $Xc->add_replace_entry("\x72\145\144\151\x72\x65\143\x74\137\x75\162\151", $Dl);
        $Xc->add_replace_entry("\x74\x65\163\164\x5f\x63\157\x6e\146\x69\x67", $wK);
        $Xc->add_replace_entry("\x72\x65\163\x74\x72\x69\x63\x74\162\145\144\x69\x72\x65\143\x74", $l9);
        $Xc->add_replace_entry("\163\164\x61\x74\145\x5f\x6e\157\x6e\x63\145", $za);
        $Xc = apply_filters("\x6d\x6f\x5f\x6f\141\x75\x74\150\137\x73\145\x74\x5f\x63\x75\x73\x74\x6f\155\137\163\x74\157\x72\x61\147\145", $Xc);
        $w6 = $Xc->get_state();
        $w6 = apply_filters("\163\164\141\x74\145\137\151\x6e\x74\145\x72\x6e\x61\x6c", $w6);
        $A4 = $kp->get_app_config("\x61\165\x74\x68\x6f\162\x69\x7a\145\165\162\154");
        if (!($kp->get_app_config("\163\x65\156\144\137\x73\x74\x61\x74\x65") === false || $kp->get_app_config("\163\x65\156\x64\137\x73\164\141\x74\145") === '')) {
            goto O8;
        }
        $kp->update_app_config("\x73\145\156\144\137\x73\x74\141\164\x65", 1);
        $lT->set_app_by_name($Ig, $kp->get_app_config('', false));
        O8:
        if ($kp->get_app_config("\163\145\156\144\x5f\x73\x74\141\x74\x65")) {
            goto Hb;
        }
        setcookie("\163\x74\141\x74\145\x5f\x70\141\162\x61\155", $w6, time() + 60);
        Hb:
        $f6 = $kp->get_app_config("\x70\x6b\143\x65\x5f\146\x6c\157\x77");
        $gQ = $kp->get_app_config("\x72\145\144\x69\162\145\x63\x74\x5f\165\162\151");
        $M4 = urlencode($kp->get_app_config("\x63\x6c\x69\145\x6e\164\137\151\144"));
        $gQ = empty($gQ) ? \site_url() : $gQ;
        if ($f6 && 1 === $f6) {
            goto Zn;
        }
        $gi = $kp->get_app_config("\163\x65\156\144\x5f\163\164\141\x74\x65") ? "\46\x73\x74\141\164\x65\75" . $w6 : '';
        if ($kp->get_app_config("\163\x65\156\144\137\x73\x74\141\164\x65")) {
            goto dz;
        }
        setcookie("\x73\x74\x61\164\x65\137\x70\x61\x72\141\155", $w6, time() + 60);
        MO_Oauth_Debug::mo_oauth_log("\x73\164\x61\164\x65\40\x70\x61\x72\141\x6d\145\x74\x65\162\x20\x6e\157\x74\40\x73\145\x6e\164");
        goto Sd;
        dz:
        MO_Oauth_Debug::mo_oauth_log("\163\164\x61\164\145\x20\x70\x61\x72\x61\155\145\x74\145\162\x20\163\145\156\x74");
        Sd:
        if (strpos($A4, "\77") !== false) {
            goto pt;
        }
        $A4 = $A4 . "\77\143\154\151\x65\x6e\x74\x5f\151\x64\75" . $M4 . "\x26\x73\x63\x6f\160\x65\75" . $kp->get_app_config("\x73\x63\157\160\145") . "\46\x72\145\x64\151\162\145\x63\x74\137\x75\162\151\75" . urlencode($gQ) . "\x26\162\145\x73\160\x6f\x6e\x73\x65\x5f\164\x79\x70\x65\75\143\157\144\x65" . $gi;
        goto O6;
        pt:
        $A4 = $A4 . "\x26\x63\x6c\x69\x65\156\164\x5f\151\144\x3d" . $M4 . "\46\163\x63\x6f\160\x65\75" . $kp->get_app_config("\163\143\x6f\160\x65") . "\46\162\x65\144\151\x72\145\143\x74\137\x75\x72\x69\x3d" . urlencode($gQ) . "\46\162\145\163\x70\x6f\x6e\163\145\137\x74\x79\x70\145\75\143\157\144\x65" . $gi;
        O6:
        goto ft;
        Zn:
        MO_Oauth_Debug::mo_oauth_log("\x50\113\103\x45\40\146\154\157\167");
        $NR = bin2hex(openssl_random_pseudo_bytes(32));
        $In = $lT->base64url_encode(pack("\x48\52", $NR));
        $t8 = $lT->base64url_encode(pack("\x48\x2a", hash("\x73\150\141\x32\65\66", $In)));
        $Xc->add_replace_entry("\x63\x6f\x64\x65\137\166\x65\x72\x69\x66\x69\145\162", $In);
        $w6 = $Xc->get_state();
        $gi = $kp->get_app_config("\163\x65\x6e\144\137\x73\164\141\x74\145") ? "\46\x73\164\x61\x74\145\75" . $w6 : '';
        if ($kp->get_app_config("\163\145\156\144\x5f\x73\x74\x61\164\x65")) {
            goto Zp;
        }
        MO_Oauth_Debug::mo_oauth_log("\x73\164\141\x74\145\x20\160\x61\162\x61\x6d\145\164\145\162\40\x6e\157\164\x20\163\x65\156\164");
        goto Vv;
        Zp:
        MO_Oauth_Debug::mo_oauth_log("\x73\x74\x61\164\x65\x20\x70\x61\x72\x61\155\145\x74\x65\162\x20\x73\145\156\x74");
        Vv:
        if (strpos($A4, "\x3f") !== false) {
            goto tD;
        }
        $A4 = $A4 . "\x3f\143\x6c\x69\x65\156\x74\137\151\x64\x3d" . $M4 . "\46\163\x63\157\160\145\x3d" . $kp->get_app_config("\x73\x63\157\160\145") . "\x26\x72\x65\144\151\x72\145\x63\x74\x5f\x75\x72\x69\x3d" . urlencode($gQ) . "\x26\162\x65\x73\160\x6f\x6e\x73\x65\137\164\x79\160\145\75\143\157\x64\x65" . $gi . "\x26\143\157\144\x65\x5f\x63\150\x61\154\x6c\x65\x6e\x67\x65\75" . $t8 . "\46\143\157\x64\x65\137\x63\x68\141\154\154\x65\x6e\x67\145\137\155\145\x74\150\x6f\x64\x3d\x53\62\65\x36";
        goto i2;
        tD:
        $A4 = $A4 . "\46\143\154\151\145\x6e\x74\x5f\x69\x64\75" . $M4 . "\46\x73\x63\x6f\x70\145\x3d" . $kp->get_app_config("\x73\x63\157\x70\x65") . "\x26\162\x65\144\x69\x72\145\143\164\137\165\x72\x69\75" . urlencode($gQ) . "\46\162\x65\163\160\157\156\x73\x65\137\x74\x79\160\x65\x3d\x63\157\144\x65" . $gi . "\46\143\x6f\144\145\x5f\143\150\x61\154\x6c\x65\x6e\147\145\x3d" . $t8 . "\x26\143\x6f\x64\145\x5f\143\150\141\154\x6c\145\x6e\147\x65\x5f\155\145\164\x68\157\144\75\x53\62\x35\x36";
        i2:
        ft:
        if (!(null !== $kp->get_app_config("\x73\x65\x6e\144\x5f\156\x6f\156\x63\145") && $kp->get_app_config("\163\x65\x6e\x64\x5f\156\157\x6e\143\145"))) {
            goto kD;
        }
        $p5 = md5(rand());
        $lT->set_transient("\155\157\x5f\157\141\165\x74\x68\x5f\x6e\x6f\x6e\x63\x65\137" . $p5, $p5, time() + 120);
        $A4 = $A4 . "\46\156\157\x6e\143\145\75" . $p5;
        MO_Oauth_Debug::mo_oauth_log("\x6e\157\x6e\x63\145\x20\160\x61\162\141\155\x65\164\x65\x72\x20\163\x65\x6e\164");
        kD:
        if (!(strpos($A4, "\141\x70\x70\x6c\x65") !== false)) {
            goto vp;
        }
        $A4 = $A4 . "\x26\162\145\163\160\x6f\x6e\x73\145\x5f\x6d\157\144\145\75\x66\x6f\162\x6d\x5f\x70\x6f\163\x74";
        vp:
        $A4 = apply_filters("\x6d\157\137\141\165\164\x68\137\165\x72\154\x5f\x69\156\x74\145\162\x6e\x61\x6c", $A4, $Ig);
        MO_Oauth_Debug::mo_oauth_log("\101\165\164\x68\157\162\x69\x7a\141\151\x6f\156\40\105\156\144\x70\x6f\151\x6e\164\40\75\76\40" . $A4);
        header("\x4c\x6f\143\x61\x74\151\157\x6e\x3a\40" . $A4);
        exit;
        Pq:
        lU:
        if (isset($_GET["\145\162\x72\x6f\162\137\x64\145\163\x63\x72\151\x70\164\x69\157\156"])) {
            goto H5;
        }
        if (!isset($_GET["\x65\162\x72\157\x72"])) {
            goto Bu;
        }
        if (!empty($_GET["\x65\162\162\x6f\x72"])) {
            goto BT;
        }
        MO_Oauth_Debug::mo_oauth_log("\x52\145\143\x65\x69\x76\145\x64\54\x20\x45\155\x70\164\171\x20\x45\x72\x72\157\162\40\146\x72\x6f\x6d\40\101\x75\x74\x68\157\x72\151\x7a\145\40\105\156\x64\160\x6f\151\x6e\x74");
        return;
        BT:
        do_action("\155\x6f\137\162\145\144\151\162\x65\143\x74\x5f\x74\x6f\x5f\143\165\x73\x74\x6f\x6d\x5f\145\162\162\157\162\137\160\141\x67\x65");
        $TA = "\105\162\162\157\x72\x20\146\x72\x6f\x6d\40\x41\165\164\x68\157\x72\151\x7a\145\x20\x45\x6e\x64\x70\157\x69\156\x74\x3a\x20" . sanitize_text_field($_GET["\x65\x72\x72\x6f\x72"]);
        MO_Oauth_Debug::mo_oauth_log($TA);
        $lT->handle_error($TA);
        wp_die($TA);
        Bu:
        goto yU;
        H5:
        if (!(strpos($_GET["\163\164\x61\164\x65"], "\x64\x6f\x6b\x61\156\55\163\164\162\151\160\x65\55\x63\x6f\x6e\x6e\x65\x63\164") !== false)) {
            goto aY;
        }
        return;
        aY:
        do_action("\155\x6f\x5f\x72\x65\144\x69\x72\145\x63\x74\137\164\157\137\x63\x75\x73\x74\157\x6d\137\x65\162\162\157\x72\137\x70\x61\x67\x65");
        $u3 = "\x45\162\x72\157\162\x20\144\x65\163\143\x72\x69\160\x74\x69\157\x6e\40\x66\x72\157\155\40\x41\x75\x74\x68\x6f\x72\151\172\145\40\x45\x6e\x64\160\x6f\x69\x6e\x74\x3a\40" . sanitize_text_field($_GET["\x65\x72\162\x6f\x72\137\x64\x65\163\x63\x72\x69\160\x74\151\157\x6e"]);
        MO_Oauth_Debug::mo_oauth_log($u3);
        $lT->handle_error($u3);
        wp_die($u3);
        yU:
        if (!(strpos($_SERVER["\x52\105\121\125\105\123\124\137\125\x52\x49"], "\157\x70\x65\156\151\x64\x63\141\154\154\142\x61\143\153") !== false || strpos($_SERVER["\122\x45\121\x55\x45\123\x54\137\125\122\x49"], "\x6f\x61\165\164\150\137\164\157\x6b\145\156") !== false && strpos($_SERVER["\x52\105\121\125\105\123\x54\137\x55\122\x49"], "\157\141\x75\x74\x68\137\x76\x65\162\151\x66\151\x65\162"))) {
            goto z0;
        }
        MO_Oauth_Debug::mo_oauth_log("\x4f\141\165\164\x68\x31\40\143\141\x6c\x6c\142\x61\x63\153\40\146\x6c\x6f\167");
        if (!empty($_COOKIE["\x6f\x61\165\164\150\61\x61\x70\160\156\141\x6d\x65"])) {
            goto BI;
        }
        MO_Oauth_Debug::mo_oauth_log("\x52\145\x74\165\x72\x6e\x69\156\147\x20\146\162\x6f\x6d\x20\x4f\x41\x75\164\150\x31");
        return;
        BI:
        MO_Oauth_Debug::mo_oauth_log("\x4f\x41\x75\x74\x68\61\40\141\x70\160\40\x66\157\x75\x6e\144");
        $Ig = $_COOKIE["\x6f\x61\x75\164\x68\x31\x61\160\x70\156\x61\x6d\145"];
        $tJ = MO_Custom_OAuth1::mo_oidc1_get_access_token($_COOKIE["\157\x61\x75\x74\x68\x31\x61\x70\160\156\141\x6d\x65"]);
        $m7 = apply_filters("\155\x6f\137\164\x72\137\x61\x66\164\145\x72\137\160\x72\157\x66\x69\x6c\x65\137\151\156\x66\x6f\137\145\x78\x74\x72\141\x63\x74\151\157\x6e\x5f\146\162\x6f\155\x5f\x74\x6f\x6b\145\156", $tJ);
        $h0 = [];
        $Vk = $this->dropdownattrmapping('', $tJ, $h0);
        $lT->mo_oauth_client_update_option("\x6d\x6f\x5f\x6f\x61\165\164\150\x5f\141\x74\164\162\137\x6e\141\x6d\x65\137\154\151\163\x74" . $Ig, $Vk);
        if (!(isset($_COOKIE["\157\141\x75\x74\150\61\x5f\164\145\x73\164"]) && $_COOKIE["\157\x61\x75\x74\x68\x31\137\x74\x65\163\164"] == "\61")) {
            goto og;
        }
        $kp = $lT->get_app_by_name($Ig);
        $Lq = $kp->get_app_config();
        $this->render_test_config_output($tJ, false, $Lq, $Ig);
        exit;
        og:
        $kp = $lT->get_app_by_name($Ig);
        $bi = $kp->get_app_config("\165\163\x65\x72\x6e\x61\x6d\x65\x5f\x61\164\164\x72");
        $dw = isset($FK["\x65\x6d\141\151\154\137\141\x74\164\x72"]) ? $FK["\x65\155\141\x69\x6c\137\x61\x74\x74\162"] : '';
        $q3 = $lT->getnestedattribute($tJ, $dw);
        $LE = $lT->getnestedattribute($tJ, $bi);
        if (!empty($LE)) {
            goto gl;
        }
        MO_Oauth_Debug::mo_oauth_log("\x55\x73\145\162\156\x61\x6d\x65\x20\156\157\164\x20\x72\145\143\x65\151\166\145\x64\x2e\x50\154\x65\x61\x73\145\x20\143\x6f\x6e\146\151\147\165\162\x65\40\101\x74\x74\x72\151\142\165\x74\145\x20\x4d\x61\x70\x70\x69\x6e\147");
        $lT->handle_error("\125\x73\145\162\x6e\x61\155\x65\x20\x6e\x6f\x74\40\x72\x65\x63\145\151\166\145\x64\56\x50\x6c\145\141\x73\x65\x20\x63\157\x6e\x66\x69\147\165\x72\x65\40\101\164\164\x72\151\x62\x75\x74\145\40\x4d\141\160\x70\151\x6e\x67");
        wp_die("\x55\163\x65\x72\x6e\141\155\145\x20\x6e\x6f\x74\x20\162\x65\143\145\151\x76\x65\x64\56\120\154\x65\x61\163\145\x20\x63\157\156\x66\151\147\165\162\145\40\x41\x74\x74\x72\x69\142\x75\x74\x65\x20\115\141\160\x70\x69\156\147");
        gl:
        if (!empty($q3)) {
            goto iM;
        }
        $user = get_user_by("\x6c\157\147\x69\156", $LE);
        goto df;
        iM:
        $q3 = $lT->getnestedattribute($tJ, $dw);
        if (!(false === strpos($q3, "\x40"))) {
            goto Y1;
        }
        MO_Oauth_Debug::mo_oauth_log("\x4d\141\x70\160\x65\144\x20\x45\155\141\151\154\40\x61\164\x74\162\x69\142\165\x74\x65\x20\144\157\145\x73\x20\156\x6f\164\x20\143\157\156\164\141\x69\x6e\x20\166\x61\x6c\151\x64\x20\x65\155\141\x69\x6c\x2e");
        $lT->handle_error("\x4d\x61\x70\x70\145\144\40\105\155\x61\x69\154\x20\x61\164\164\162\x69\x62\x75\x74\145\x20\144\157\145\163\x20\156\x6f\164\x20\143\157\156\164\141\151\156\40\166\x61\154\151\x64\x20\145\155\x61\151\x6c\x2e");
        wp_die("\115\141\160\160\145\144\x20\105\155\141\151\154\40\141\164\164\162\151\x62\165\x74\145\x20\144\x6f\145\x73\x20\156\157\x74\40\x63\x6f\156\164\x61\x69\x6e\40\x76\x61\x6c\x69\x64\x20\x65\155\141\x69\x6c\x2e");
        Y1:
        df:
        if ($user) {
            goto oK;
        }
        $kM = 0;
        if ($lT->mo_oauth_hbca_xyake()) {
            goto ah;
        }
        $user = $lT->mo_oauth_hjsguh_kiishuyauh878gs($q3, $LE);
        goto IU;
        ah:
        if ($lT->mo_oauth_client_get_option("\x6d\x6f\137\157\x61\165\x74\150\137\x66\154\141\x67") !== true) {
            goto Wf;
        }
        $Rb = base64_decode("PGRpdiBzdHlsZT0ndGV4dC1hbGlnbjpjZW50ZXI7Jz48Yj5Vc2VyIEFjY291bnQgZG9lcyBub3QgZXhpc3QuPC9iPjwvZGl2Pjxicj48c21hbGw+VGhpcyB2ZXJzaW9uIHN1cHBvcnRzIEF1dG8gQ3JlYXRlIFVzZXIgZmVhdHVyZSB1cHRvIDEwIFVzZXJzLiBQbGVhc2UgdXBncmFkZSB0byB0aGUgaGlnaGVyIHZlcnNpb24gb2YgdGhlIHBsdWdpbiB0byBlbmFibGUgYXV0byBjcmVhdGUgdXNlciBmb3IgdW5saW1pdGVkIHVzZXJzIG9yIGFkZCB1c2VyIG1hbnVhbGx5Ljwvc21hbGw+");
        $lT->handle_error($Rb);
        MO_Oauth_Debug::mo_oauth_log($Rb);
        wp_die($Rb);
        goto hl;
        Wf:
        if (!empty($q3)) {
            goto h8;
        }
        $user = $lT->mo_oauth_jhuyn_jgsukaj($LE, $LE);
        goto Oz;
        h8:
        $user = $lT->mo_oauth_jhuyn_jgsukaj($q3, $LE);
        Oz:
        hl:
        IU:
        goto C6;
        oK:
        $kM = $user->ID;
        C6:
        if (!$user) {
            goto fv;
        }
        wp_set_current_user($user->ID);
        $CY = false;
        $CY = apply_filters("\x6d\157\x5f\x72\145\x6d\145\x6d\142\x65\162\x5f\155\x65", $CY);
        wp_set_auth_cookie($user->ID, $CY);
        $user = get_user_by("\x49\x44", $user->ID);
        do_action("\x77\160\137\154\157\x67\x69\156", $user->user_login, $user);
        wp_safe_redirect(home_url());
        exit;
        fv:
        z0:
        if (!isset($_SERVER["\110\124\x54\x50\x5f\130\137\122\x45\121\x55\x45\123\124\105\104\x5f\x57\x49\124\x48"]) && (strpos($_SERVER["\122\x45\x51\x55\x45\x53\x54\x5f\x55\122\x49"], "\57\157\141\x75\x74\x68\143\141\x6c\x6c\142\141\x63\153") !== false || isset($_REQUEST["\143\x6f\144\x65"]) && !empty($_REQUEST["\143\x6f\144\145"]) && !isset($_REQUEST["\x69\144\x5f\164\x6f\x6b\x65\156"]))) {
            goto Rm;
        }
        if (!empty($_POST["\x72\145\146\162\x65\163\x68\x5f\x74\157\x6b\145\x6e"])) {
            goto uh;
        }
        goto Dk;
        Rm:
        if (!(isset($_REQUEST["\x70\x6f\163\164\137\x49\x44"]) || isset($_REQUEST["\x65\144\144\x2d\141\143\x74\151\x6f\156"]) || isset($_REQUEST["\x6c\x6f\x63\x61\164\151\x6f\x6e"]) || isset($_REQUEST["\x61\x70\151"]))) {
            goto wt;
        }
        return;
        wt:
        if (!(strpos($_SERVER["\122\x45\121\125\105\123\x54\137\125\122\x49"], "\57\x77\160\x2d\x6a\x73\x6f\156\57\155\157\x73\x65\162\166\x65\x72\57\x74\x6f\153\x65\x6e") !== false)) {
            goto c4;
        }
        return;
        c4:
        try {
            if (isset($_COOKIE["\x73\164\x61\164\145\137\160\x61\162\141\x6d"])) {
                goto qG;
            }
            if (isset($_GET["\x73\x74\141\x74\145"]) && !empty($_GET["\163\x74\x61\x74\145"])) {
                goto gd;
            }
            $po = new StorageManager();
            if (!is_multisite()) {
                goto v1;
            }
            $po->add_replace_entry("\142\154\x6f\x67\137\x69\144", 1);
            v1:
            $CR = $lT->get_app_by_name();
            if (isset($_GET["\141\160\x70\137\156\x61\x6d\x65"])) {
                goto qq;
            }
            $po->add_replace_entry("\x61\x70\x70\x6e\x61\x6d\x65", $CR->get_app_name());
            goto uy;
            qq:
            $po->add_replace_entry("\141\160\x70\156\141\155\x65", $_GET["\x61\x70\160\x5f\156\141\x6d\x65"]);
            uy:
            $po->add_replace_entry("\164\145\x73\x74\137\x63\157\x6e\x66\151\147", false);
            $po->add_replace_entry("\x72\145\x64\x69\x72\145\143\164\137\165\x72\x69", site_url());
            $w6 = $po->get_state();
            goto mn;
            qG:
            $w6 = $_COOKIE["\x73\164\141\164\145\137\160\141\x72\141\155"];
            goto mn;
            gd:
            $w6 = wp_unslash($_GET["\x73\x74\x61\x74\x65"]);
            mn:
            $Xc = new StorageManager($w6);
            if (!empty($Xc->get_value("\141\x70\160\x6e\141\x6d\145"))) {
                goto mp;
            }
            return;
            mp:
            $Ig = $Xc->get_value("\141\160\160\156\141\x6d\x65");
            $wK = $Xc->get_value("\x74\x65\163\x74\x5f\143\x6f\156\x66\151\x67");
            if (!is_multisite()) {
                goto BE;
            }
            if (!(empty($Xc->get_value("\162\145\x64\151\162\x65\x63\164\x65\x64\137\x74\157\x5f\x73\x75\x62\163\x69\x74\145")) || $Xc->get_value("\x72\145\x64\x69\162\145\x63\x74\145\x64\x5f\x74\157\137\x73\x75\x62\163\151\164\x65") !== "\162\145\x64\x69\162\x65\x63\x74")) {
                goto xN;
            }
            MO_Oauth_Debug::mo_oauth_log("\x52\145\x64\x69\162\x65\143\x74\x69\x6e\147\x20\146\157\162\40\155\165\154\164\151\163\164\x65\x20\x73\165\x62\x73\x69\x74\145");
            $blog_id = $Xc->get_value("\142\x6c\157\147\137\x69\144");
            $HD = get_site_url($blog_id);
            $Xc->add_replace_entry("\x72\145\144\x69\x72\145\143\164\x65\x64\137\164\x6f\137\x73\x75\142\163\x69\x74\145", "\x72\145\144\x69\162\145\x63\x74");
            $EQ = $Xc->get_state();
            $HD = $HD . "\77\x63\x6f\144\145\x3d" . $_REQUEST["\143\157\144\x65"] . "\46\x73\x74\141\164\145\x3d" . $EQ;
            wp_redirect($HD);
            exit;
            xN:
            BE:
            $Wj = $Ig ? $Ig : '';
            $Tx = $lT->mo_oauth_client_get_option("\155\x6f\137\x6f\x61\165\164\x68\x5f\141\160\x70\x73\137\x6c\x69\x73\x74");
            $bi = '';
            $dw = '';
            $MD = $lT->get_app_by_name($Wj);
            if ($MD) {
                goto EV;
            }
            $lT->handle_error("\x41\160\160\x6c\151\143\x61\x74\151\157\x6e\40\x6e\x6f\x74\40\143\157\156\146\x69\x67\165\x72\x65\144\56");
            MO_Oauth_Debug::mo_oauth_log("\x41\160\x70\154\x69\143\x61\164\x69\157\156\x20\x6e\x6f\164\x20\x63\x6f\156\146\x69\x67\x75\x72\x65\144\56");
            exit("\101\160\160\154\151\x63\x61\x74\151\x6f\x6e\40\156\157\x74\x20\143\157\156\x66\x69\x67\x75\x72\145\x64\x2e");
            EV:
            $FK = $MD->get_app_config();
            if (!(isset($FK["\163\x65\x6e\144\x5f\156\157\x6e\x63\x65"]) && $FK["\x73\145\156\x64\x5f\x6e\157\156\x63\145"] === 1)) {
                goto LS;
            }
            if (!(isset($_REQUEST["\156\157\156\143\145"]) && !$lT->get_transient("\x6d\x6f\137\157\x61\165\x74\150\137\156\x6f\x6e\x63\145\x5f" . $_REQUEST["\x6e\x6f\156\143\145"]))) {
                goto pH;
            }
            $TA = "\x4e\157\156\143\x65\40\x76\145\x72\x69\x66\151\143\x61\164\151\x6f\x6e\x20\151\163\x20\x66\x61\151\154\x65\x64\x2e\40\120\154\x65\x61\163\145\40\x63\157\x6e\164\141\143\164\x20\x74\x6f\x20\171\x6f\165\x72\40\141\x64\155\151\156\x69\x73\x74\162\x61\164\x6f\162\56";
            $lT->handle_error($TA);
            MO_Oauth_Debug::mo_oauth_log($TA);
            wp_die($TA);
            pH:
            LS:
            $f6 = $MD->get_app_config("\x70\x6b\143\x65\x5f\146\154\x6f\167");
            $KW = $MD->get_app_config("\x70\153\x63\x65\x5f\143\x6c\151\145\156\x74\137\163\x65\x63\162\145\x74");
            $nt = array("\x67\162\x61\x6e\164\x5f\x74\x79\x70\145" => "\x61\165\x74\x68\157\162\151\172\141\164\151\157\156\137\x63\157\144\145", "\x63\x6c\x69\145\156\164\137\x69\x64" => $FK["\x63\x6c\x69\x65\x6e\164\137\151\x64"], "\162\145\144\151\162\x65\143\x74\x5f\165\162\151" => $FK["\162\145\x64\x69\x72\x65\x63\x74\137\x75\162\x69"], "\143\x6f\144\x65" => $_REQUEST["\x63\157\x64\145"]);
            if (!(strpos($FK["\141\x63\x63\x65\x73\x73\x74\x6f\x6b\x65\156\165\x72\x6c"], "\x73\x65\162\166\151\x63\145\163\x2f\157\141\165\164\150\62\57\164\157\153\145\156") === false && strpos($FK["\141\x63\x63\x65\163\163\x74\x6f\153\145\156\165\x72\154"], "\x73\x61\x6c\x65\x73\146\x6f\x72\143\x65") === false && strpos($FK["\x61\143\x63\x65\x73\x73\164\x6f\153\x65\156\165\162\154"], "\57\x6f\x61\x6d\x2f\x6f\x61\165\164\x68\x32\57\x61\143\143\x65\x73\163\x5f\x74\157\153\145\156") === false)) {
                goto aB;
            }
            $nt["\163\143\157\160\145"] = $MD->get_app_config("\x73\143\x6f\x70\x65");
            aB:
            if ($f6 && 1 === $f6) {
                goto Nc;
            }
            $nt["\143\154\151\x65\156\x74\137\x73\x65\x63\162\x65\164"] = $FK["\143\x6c\x69\x65\x6e\x74\x5f\163\x65\143\x72\x65\164"];
            goto ZO;
            Nc:
            if (!($KW && 1 === $KW)) {
                goto B7;
            }
            $nt["\143\x6c\151\145\156\x74\x5f\163\x65\143\162\145\x74"] = $FK["\x63\x6c\151\145\x6e\x74\137\163\x65\x63\x72\145\x74"];
            B7:
            $nt = apply_filters("\x6d\x6f\x5f\x6f\x61\165\x74\x68\x5f\141\x64\x64\x5f\x63\x6c\151\x65\156\164\x5f\163\x65\x63\162\145\x74\137\x70\x6b\x63\145\x5f\146\x6c\157\167", $nt, $FK);
            $nt["\143\x6f\x64\x65\137\166\145\162\151\146\151\145\x72"] = $Xc->get_value("\143\157\x64\145\x5f\x76\145\x72\x69\x66\x69\145\162");
            ZO:
            $o5 = isset($FK["\163\x65\x6e\x64\137\150\145\141\144\145\162\163"]) ? $FK["\x73\x65\156\x64\137\x68\145\x61\x64\x65\x72\x73"] : 0;
            $u0 = isset($FK["\163\x65\x6e\x64\137\x62\x6f\x64\171"]) ? $FK["\163\145\156\144\x5f\x62\x6f\144\x79"] : 0;
            if ("\x6f\160\145\x6e\151\x64\x63\x6f\156\x6e\145\143\x74" === $MD->get_app_config("\141\160\x70\137\164\171\160\x65")) {
                goto oX;
            }
            $U0 = $FK["\141\143\143\x65\x73\x73\x74\157\153\145\156\x75\162\x6c"];
            MO_Oauth_Debug::mo_oauth_log("\x4f\x41\x75\164\150\40\x66\154\157\167");
            if (strpos($FK["\x61\165\164\150\157\x72\151\x7a\145\165\x72\154"], "\x63\154\x65\166\x65\x72\x2e\x63\x6f\x6d\x2f\157\x61\165\164\x68") != false || strpos($FK["\x61\x63\143\145\x73\x73\x74\157\x6b\145\x6e\x75\x72\x6c"], "\x62\151\164\x72\x69\170") != false) {
                goto GT;
            }
            $hf = json_decode($this->oauth_handler->get_token($U0, $nt, $o5, $u0), true);
            goto Lc;
            GT:
            $hf = json_decode($this->oauth_handler->get_atoken($U0, $nt, $_GET["\x63\x6f\144\x65"], $o5, $u0), true);
            Lc:
            if (!(get_current_user_id() && $wK != 1)) {
                goto Pg;
            }
            if (has_filter("\x6d\157\137\x6f\x61\x75\x74\x68\137\142\162\145\141\153\137\163\163\x6f\137\x66\x6c\157\x77")) {
                goto yA;
            }
            wp_clear_auth_cookie();
            wp_set_current_user(0);
            yA:
            Pg:
            $_SESSION["\160\162\x6f\x63\x6f\x72\x65\x5f\141\143\x63\x65\163\163\137\x74\x6f\x6b\x65\156"] = isset($hf["\x61\x63\x63\145\x73\163\137\164\x6f\153\x65\x6e"]) ? $hf["\x61\143\x63\145\163\163\x5f\x74\157\153\145\x6e"] : false;
            if (isset($hf["\141\x63\143\x65\x73\163\x5f\164\x6f\x6b\x65\x6e"])) {
                goto Iv;
            }
            do_action("\155\x6f\x5f\x72\145\144\151\x72\145\143\x74\137\164\157\137\x63\x75\163\x74\157\x6d\137\x65\162\x72\157\x72\x5f\160\141\x67\145");
            $lT->handle_error("\111\156\166\141\x6c\x69\x64\40\164\x6f\153\x65\x6e\x20\162\x65\x63\x65\151\166\x65\144\x2e");
            MO_Oauth_Debug::mo_oauth_log("\x49\x6e\x76\x61\x6c\151\x64\x20\164\157\x6b\145\x6e\40\162\145\x63\145\151\166\145\x64\x2e");
            exit("\111\x6e\x76\x61\154\151\144\x20\164\x6f\153\145\x6e\x20\162\145\x63\x65\x69\x76\x65\x64\x2e");
            Iv:
            MO_Oauth_Debug::mo_oauth_log("\124\x6f\x6b\145\156\40\x52\x65\163\x70\157\x6e\x73\145\x20\x3d\x3e\40");
            MO_Oauth_Debug::mo_oauth_log($hf);
            $Ts = $FK["\162\145\x73\x6f\x75\x72\143\x65\x6f\167\156\145\x72\x64\145\x74\x61\x69\x6c\x73\165\x72\154"];
            if (!(substr($Ts, -1) === "\x3d")) {
                goto ct;
            }
            $Ts .= $hf["\x61\x63\x63\x65\x73\163\x5f\x74\157\x6b\x65\156"];
            ct:
            MO_Oauth_Debug::mo_oauth_log("\101\x63\143\x65\163\163\40\164\x6f\x6b\x65\156\40\x72\145\x63\x65\151\166\x65\144\x2e");
            MO_Oauth_Debug::mo_oauth_log("\x41\143\x63\x65\163\163\x20\124\157\153\x65\156\40\x3d\x3e\x20" . $hf["\141\x63\143\x65\x73\163\137\x74\x6f\153\145\x6e"]);
            $tJ = false;
            MO_Oauth_Debug::mo_oauth_log("\x52\145\163\x6f\x75\162\x63\x65\40\x4f\167\x6e\x65\x72\x20\x3d\76\40");
            if (!has_filter("\155\x6f\x5f\x75\x73\x65\162\151\x6e\146\157\137\146\x6c\x6f\x77\137\x66\x6f\x72\137\x77\x61\x6c\x6d\x61\162\164")) {
                goto g5;
            }
            $tJ = apply_filters("\155\157\137\x75\163\145\x72\x69\156\146\157\137\x66\x6c\157\167\x5f\x66\x6f\x72\137\167\x61\154\155\x61\162\x74", $Ts, $hf, $nt, $Wj, $FK);
            g5:
            if (!($tJ === false)) {
                goto bH;
            }
            $Ru = null;
            $Ru = apply_filters("\155\x6f\137\160\157\154\x61\162\x5f\162\x65\147\151\163\x74\145\x72\137\165\163\145\x72", $hf);
            if (!(!empty($Ru) && !empty($hf["\x78\137\x75\x73\x65\x72\137\151\144"]))) {
                goto Aw;
            }
            $Ts .= "\57" . $hf["\170\137\x75\163\145\x72\137\151\144"];
            Aw:
            $tJ = $this->oauth_handler->get_resource_owner($Ts, $hf["\x61\x63\x63\x65\x73\163\x5f\x74\x6f\153\x65\x6e"]);
            $YO = array();
            if (!(strpos($MD->get_app_config("\141\165\x74\150\x6f\x72\151\x7a\145\165\162\154"), "\x6c\x69\156\153\145\144\x69\x6e") !== false && strpos($FK["\x73\x63\x6f\160\145"], "\x72\137\x65\155\141\x69\154\141\144\x64\162\145\x73\x73") != false)) {
                goto B2;
            }
            $Ee = "\150\164\x74\160\163\72\x2f\57\141\x70\x69\x2e\154\151\156\x6b\145\x64\x69\x6e\56\143\157\155\x2f\166\62\x2f\x65\155\141\151\154\x41\x64\x64\162\145\x73\x73\x3f\x71\x3d\155\145\x6d\142\145\x72\x73\x26\x70\x72\x6f\152\145\143\164\x69\x6f\x6e\x3d\x28\145\154\x65\x6d\x65\156\x74\x73\52\50\x68\141\x6e\x64\x6c\145\x7e\x29\x29";
            $YO = $this->oauth_handler->get_resource_owner($Ee, $hf["\141\143\143\x65\163\163\x5f\x74\x6f\x6b\145\156"]);
            B2:
            $tJ = array_merge($tJ, $YO);
            bH:
            if (!has_filter("\155\157\x5f\x63\150\145\x63\153\137\164\x6f\x5f\x65\170\145\x63\x75\x74\145\x5f\x70\x6f\163\164\137\x75\x73\145\162\151\x6e\x66\x6f\x5f\x66\x6c\157\167\x5f\x66\x6f\162\x5f\167\141\154\x6d\141\162\x74")) {
                goto Kk;
            }
            $tJ = apply_filters("\x6d\x6f\x5f\143\150\145\143\153\x5f\164\x6f\137\x65\x78\145\143\x75\x74\145\137\x70\157\x73\164\x5f\165\x73\145\x72\x69\156\146\x6f\137\146\154\x6f\x77\137\x66\157\162\x5f\167\x61\154\x6d\x61\162\x74", $tJ, $Wj, $FK);
            Kk:
            MO_Oauth_Debug::mo_oauth_log($tJ);
            if (has_filter("\155\x6f\137\x67\x65\164\137\x74\157\153\x65\156\137\146\x6f\162\x5f\156\x65\x6f\156\137\155\x65\155\x62\145\x72\163\150\151\160")) {
                goto OX;
            }
            $m7 = apply_filters("\x6d\157\137\x74\162\137\141\146\164\x65\x72\x5f\x70\162\x6f\x66\x69\154\145\137\151\156\x66\157\137\x65\x78\x74\162\141\143\164\x69\157\x6e\x5f\146\x72\157\x6d\137\x74\157\153\x65\156", $tJ);
            goto kd;
            OX:
            $m7 = apply_filters("\x6d\x6f\x5f\x67\145\164\x5f\x74\157\x6b\x65\x6e\137\146\x6f\x72\137\x6e\145\157\156\137\155\145\155\142\x65\162\163\x68\x69\x70", $tJ, $hf["\141\x63\x63\x65\163\x73\137\x74\x6f\153\145\x6e"]);
            kd:
            if (!($m7 != '' && is_array($m7))) {
                goto f2;
            }
            $tJ = array_merge($tJ, $m7);
            f2:
            $ev = apply_filters("\141\x63\x63\x72\x65\x64\x69\x74\151\x6f\x6e\163\x5f\145\x6e\x64\x70\157\x69\x6e\164", $hf["\141\143\143\x65\163\x73\x5f\x74\157\153\x65\156"]);
            if (!($ev !== '' && is_array($ev))) {
                goto EQ;
            }
            $tJ = array_merge($tJ, $ev);
            EQ:
            if (!has_filter("\155\157\x5f\160\x6f\x6c\141\162\x5f\162\x65\x67\151\163\164\x65\162\x5f\165\x73\x65\162")) {
                goto lC;
            }
            $Ta = array();
            $Ta["\164\157\153\x65\x6e"] = $hf["\141\x63\143\145\163\163\x5f\164\157\x6b\145\156"];
            $tJ = array_merge($tJ, $Ta);
            lC:
            if (!(strpos($MD->get_app_config("\141\x75\164\150\x6f\162\151\x7a\x65\165\x72\x6c"), "\144\151\x73\143\x6f\162\x64") !== false)) {
                goto sB;
            }
            apply_filters("\x6d\x6f\x5f\x64\x69\x73\137\165\x73\145\x72\137\x61\x74\164\x65\156\x64\x61\x6e\x63\x65", $tJ["\151\144"]);
            $h3 = apply_filters("\x6d\157\137\x64\162\x6d\x5f\x67\145\164\137\165\163\145\x72\x5f\x72\x6f\154\145\x73", array_key_exists("\x69\144", $tJ) ? $tJ["\x69\x64"] : '');
            if (!(false !== $h3)) {
                goto J4;
            }
            MO_Oauth_Debug::mo_oauth_log("\x44\151\163\x63\157\162\144\40\122\157\154\145\x73\40\x3d\x3e\40");
            MO_Oauth_Debug::mo_oauth_log($h3);
            $tJ["\x72\x6f\x6c\x65\163"] = $h3;
            J4:
            if (!(!$wK && '' == $wK)) {
                goto Ue;
            }
            do_action("\x6d\157\x5f\x6f\141\165\164\x68\x5f\141\x64\x64\x5f\x64\151\163\137\165\163\145\x72\x5f\163\x65\162\166\145\162", get_current_user_id(), $hf, $tJ);
            Ue:
            sB:
            if (!(isset($FK["\x73\145\x6e\144\x5f\156\157\156\x63\x65"]) && $FK["\163\145\156\144\x5f\x6e\x6f\156\143\145"] === 1)) {
                goto ht;
            }
            if (!(isset($tJ["\156\157\x6e\143\145"]) && $tJ["\156\157\x6e\x63\145"] != NULL)) {
                goto TV;
            }
            if ($lT->get_transient("\x6d\157\x5f\x6f\141\x75\164\150\x5f\x6e\157\156\x63\145\x5f" . $tJ["\x6e\157\156\x63\145"])) {
                goto gN;
            }
            $TA = "\x4e\x6f\156\x63\145\x20\166\145\162\151\x66\151\143\x61\164\151\x6f\156\40\x69\163\40\146\141\x69\x6c\x65\x64\x2e\x20\120\154\x65\x61\x73\145\40\143\x6f\156\x74\141\x63\164\40\164\157\40\x79\157\x75\x72\x20\x61\144\155\x69\156\151\163\x74\x72\141\164\x6f\162\56";
            $lT->handle_error($TA);
            MO_Oauth_Debug::mo_oauth_log($TA);
            wp_die($TA);
            goto QL;
            gN:
            $lT->delete_transient("\155\157\x5f\157\141\x75\x74\150\x5f\x6e\x6f\156\x63\145\x5f" . $tJ["\156\x6f\x6e\143\x65"]);
            QL:
            TV:
            ht:
            $h0 = [];
            $Vk = $this->dropdownattrmapping('', $tJ, $h0);
            $lT->mo_oauth_client_update_option("\155\x6f\137\x6f\x61\165\x74\150\x5f\141\x74\164\x72\x5f\x6e\x61\155\x65\x5f\x6c\151\163\164" . $Wj, $Vk);
            if (!($wK && '' !== $wK)) {
                goto gJ;
            }
            $this->handle_group_test_conf($tJ, $FK, $hf["\141\x63\x63\145\x73\163\137\164\157\x6b\x65\156"], false, $wK);
            exit;
            gJ:
            goto N4;
            oX:
            MO_Oauth_Debug::mo_oauth_log("\117\x70\x65\x6e\111\x44\40\103\157\x6e\156\145\x63\x74\40\146\x6c\157\x77");
            $hf = json_decode($this->oauth_handler->get_token($FK["\x61\143\x63\145\163\163\164\x6f\x6b\145\x6e\x75\162\x6c"], $nt, $o5, $u0), true);
            MO_Oauth_Debug::mo_oauth_log("\124\157\x6b\145\156\x20\x52\x65\x73\x70\x6f\156\163\145\40\x3d\76\x20");
            MO_Oauth_Debug::mo_oauth_log($hf);
            $tu = [];
            try {
                $tu = $this->resolve_and_get_oidc_response($hf);
            } catch (\Exception $JW) {
                $lT->handle_error($JW->getMessage());
                MO_Oauth_Debug::mo_oauth_log("\x49\x6e\x76\x61\x6c\x69\x64\40\x52\x65\x73\x70\157\x6e\163\x65\x20\x72\145\143\145\151\166\x65\x64\x2e");
                do_action("\x6d\x6f\x5f\162\145\x64\x69\162\x65\x63\x74\137\x74\157\137\x63\165\x73\x74\157\155\137\x65\162\x72\x6f\x72\x5f\x70\141\x67\145");
                wp_die("\x49\x6e\166\x61\154\x69\144\40\122\145\x73\160\157\x6e\163\x65\40\x72\145\143\x65\151\166\145\x64\56");
                exit;
            }
            MO_Oauth_Debug::mo_oauth_log("\x49\x44\40\x54\157\x6b\x65\x6e\40\x72\145\143\x65\x69\x76\145\x64\40\123\x75\143\143\145\x73\163\x66\165\154\154\x79");
            MO_Oauth_Debug::mo_oauth_log("\x49\x44\40\124\x6f\x6b\145\156\x20\x3d\76\40");
            MO_Oauth_Debug::mo_oauth_log($tu);
            $tJ = $this->get_resource_owner_from_app($tu, $Wj);
            MO_Oauth_Debug::mo_oauth_log("\x52\145\163\157\x75\162\x63\145\x20\x4f\167\x6e\145\x72\40\75\76\x20");
            MO_Oauth_Debug::mo_oauth_log($tJ);
            if (!(strpos($MD->get_app_config("\141\x75\x74\x68\157\162\x69\172\x65\165\x72\x6c"), "\x74\167\x69\164\143\150") !== false)) {
                goto Ci;
            }
            $vV = apply_filters("\x6d\x6f\137\164\163\x6d\x5f\147\x65\x74\x5f\x75\x73\145\162\x5f\x73\x75\142\163\x63\162\x69\160\164\151\x6f\x6e", $tJ["\163\x75\x62"], $FK["\x63\154\x69\145\x6e\164\x5f\151\x64"], $hf["\x61\x63\143\x65\163\x73\137\x74\x6f\153\145\x6e"]);
            if (!(false !== $vV)) {
                goto uE;
            }
            MO_Oauth_Debug::mo_oauth_log("\124\167\x69\x74\x63\x68\x20\123\x75\142\x73\143\162\151\160\x74\151\x6f\156\x20\75\x3e\x20");
            MO_Oauth_Debug::mo_oauth_log($vV);
            $tJ["\163\165\x62\x73\143\x72\x69\160\x74\x69\157\x6e"] = $vV;
            uE:
            Ci:
            if (!($MD->get_app_config("\141\160\160\111\144") === "\153\x65\x79\143\x6c\x6f\141\153")) {
                goto Pf;
            }
            $NL = apply_filters("\x6d\x6f\x5f\x6b\162\x6d\137\x67\145\x74\137\165\163\x65\162\137\162\x6f\154\145\x73", $tJ, $hf);
            if (!(false !== $NL)) {
                goto jj;
            }
            $tJ["\162\157\x6c\x65\163"] = $NL;
            jj:
            Pf:
            $tJ = apply_filters("\155\x6f\137\x61\172\x75\x72\x65\x62\x32\x63\137\147\x65\x74\x5f\x75\x73\x65\x72\x5f\147\162\x6f\165\160\137\x69\144\x73", $tJ, $FK);
            $m7 = apply_filters("\x6d\157\137\x74\x72\137\141\x66\x74\145\x72\x5f\x70\x72\157\146\x69\x6c\145\137\151\x6e\x66\157\137\145\x78\164\162\x61\143\x74\x69\157\x6e\x5f\x66\162\157\155\x5f\x74\x6f\x6b\x65\x6e", $tJ);
            if (!($m7 != '' && is_array($m7))) {
                goto u9;
            }
            $tJ = array_merge($tJ, $m7);
            u9:
            if (!(isset($FK["\163\x65\x6e\144\137\156\x6f\x6e\143\x65"]) && $FK["\163\145\156\x64\x5f\x6e\157\x6e\x63\145"] === 1)) {
                goto sW;
            }
            if (!(isset($tJ["\x6e\x6f\x6e\143\x65"]) && $tJ["\156\157\156\143\x65"] != NULL)) {
                goto gh;
            }
            if ($lT->get_transient("\x6d\x6f\x5f\157\141\165\x74\x68\x5f\x6e\x6f\x6e\x63\145\137" . $tJ["\x6e\x6f\156\143\145"])) {
                goto O3;
            }
            $TA = "\x4e\x6f\156\143\x65\x20\166\145\x72\151\146\151\143\141\164\151\157\156\40\x69\x73\x20\x66\x61\x69\154\145\144\56\x20\120\154\145\141\163\145\x20\x63\x6f\x6e\164\x61\x63\x74\40\x74\157\40\171\x6f\165\x72\x20\x61\x64\x6d\151\156\151\x73\x74\162\x61\x74\x6f\162\56";
            $lT->handle_error($TA);
            MO_Oauth_Debug::mo_oauth_log($TA);
            wp_die($TA);
            goto Bh;
            O3:
            $lT->delete_transient("\155\157\x5f\x6f\141\x75\164\150\x5f\x6e\x6f\156\143\x65\137" . $tJ["\156\157\x6e\143\x65"]);
            Bh:
            gh:
            sW:
            $h0 = [];
            $Vk = $this->dropdownattrmapping('', $tJ, $h0);
            $lT->mo_oauth_client_update_option("\155\x6f\137\157\x61\165\164\x68\137\141\x74\x74\x72\137\156\x61\x6d\x65\137\x6c\x69\163\x74" . $Wj, $Vk);
            if (!($wK && '' !== $wK)) {
                goto CB;
            }
            $hf["\162\x65\146\x72\x65\163\x68\137\164\157\x6b\x65\x6e"] = isset($hf["\162\145\x66\162\145\x73\150\137\164\x6f\153\145\156"]) ? $hf["\x72\145\146\x72\145\163\150\x5f\x74\157\153\145\x6e"] : '';
            $_SESSION["\160\162\x6f\143\157\162\145\x5f\x72\x65\146\162\145\x73\x68\x5f\164\157\x6b\x65\x6e"] = $hf["\x72\x65\146\x72\145\163\150\x5f\164\x6f\x6b\x65\156"];
            $SQ = isset($hf["\x61\143\143\145\163\x73\137\x74\x6f\x6b\145\156"]) ? $hf["\x61\x63\143\145\x73\x73\137\164\157\x6b\x65\x6e"] : '';
            $this->handle_group_test_conf($tJ, $FK, $SQ, false, $wK);
            MO_Oauth_Debug::mo_oauth_log("\x41\x74\x74\x72\x69\x62\x75\164\145\x20\122\145\x63\145\151\166\x65\x64\40\x53\x75\x63\x63\145\163\x73\x66\x75\154\154\171");
            exit;
            CB:
            N4:
            if (!(isset($FK["\147\x72\157\x75\160\x64\145\x74\141\151\x6c\x73\x75\x72\x6c"]) && !empty($FK["\147\162\157\165\x70\x64\145\x74\x61\151\154\x73\x75\x72\154"]))) {
                goto EX;
            }
            $tJ = $this->handle_group_user_info($tJ, $FK, $hf["\x61\143\x63\145\163\x73\137\164\157\153\145\156"]);
            MO_Oauth_Debug::mo_oauth_log("\x47\x72\157\x75\160\x20\104\x65\x74\141\151\x6c\163\40\117\x62\164\141\x69\156\145\x64\40\x3d\x3e\40");
            MO_Oauth_Debug::mo_oauth_log($tJ);
            EX:
            MO_Oauth_Debug::mo_oauth_log("\106\145\x74\x63\150\x65\x64\x20\x72\x65\x73\157\x75\162\x63\145\x20\157\167\156\145\162\x20\72\40" . json_encode($tJ));
            if (!has_filter("\167\x6f\x6f\143\x6f\155\x6d\145\x72\143\145\137\x63\x68\145\x63\x6b\157\x75\164\x5f\x67\x65\164\x5f\166\x61\154\x75\x65")) {
                goto id;
            }
            $tJ["\141\160\160\x6e\x61\x6d\x65"] = $Wj;
            id:
            do_action("\x6d\157\137\x61\x62\x72\137\x66\x69\154\164\x65\162\137\x6c\157\x67\151\156", $tJ);
            $this->handle_sso($Wj, $FK, $tJ, $w6, $hf);
        } catch (Exception $JW) {
            $lT->handle_error($JW->getMessage());
            MO_Oauth_Debug::mo_oauth_log($JW->getMessage());
            do_action("\x6d\x6f\137\x72\145\x64\x69\162\x65\143\164\x5f\164\x6f\x5f\143\x75\x73\x74\x6f\x6d\x5f\x65\162\x72\x6f\162\137\160\x61\x67\x65");
            exit(esc_html($JW->getMessage()));
        }
        goto Dk;
        uh:
        try {
            if (isset($_COOKIE["\x73\164\141\x74\145\137\x70\141\162\141\155"])) {
                goto m9;
            }
            if (isset($_GET["\x73\x74\141\164\145"])) {
                goto a6;
            }
            $po = new StorageManager();
            if (!is_multisite()) {
                goto tv;
            }
            $po->add_replace_entry("\x62\x6c\x6f\x67\137\x69\144", 1);
            tv:
            $CR = $lT->get_app_by_name();
            if (isset($_GET["\141\160\160\x5f\156\141\155\x65"])) {
                goto Jb;
            }
            $po->add_replace_entry("\141\x70\x70\156\x61\155\145", $CR->get_app_name());
            goto rl;
            Jb:
            $po->add_replace_entry("\141\160\160\x6e\x61\x6d\145", sanitize_text_field(wp_unslash($_GET["\141\160\160\137\156\x61\155\x65"])));
            rl:
            $po->add_replace_entry("\x74\x65\x73\164\137\143\x6f\156\x66\151\x67", false);
            $po->add_replace_entry("\162\145\144\151\162\145\143\x74\x5f\165\162\x69", site_url());
            $w6 = $po->get_state();
            goto S8;
            a6:
            $w6 = sanitize_text_field(wp_unslash($_GET["\163\x74\x61\x74\145"]));
            S8:
            goto hW;
            m9:
            $w6 = sanitize_text_field(wp_unslash($_COOKIE["\163\x74\x61\x74\x65\x5f\160\141\162\x61\x6d"]));
            hW:
            $Xc = new StorageManager($w6);
            if (!empty($Xc->get_value("\141\x70\x70\156\x61\155\x65"))) {
                goto iG;
            }
            return;
            iG:
            $Ig = $Xc->get_value("\141\160\x70\x6e\141\155\x65");
            $wK = $Xc->get_value("\164\145\x73\x74\137\143\x6f\156\x66\x69\x67");
            $Wj = $Ig ? $Ig : '';
            $Tx = $lT->mo_oauth_client_get_option("\155\x6f\x5f\x6f\x61\x75\x74\x68\x5f\141\x70\x70\163\137\x6c\151\x73\164");
            $bi = '';
            $dw = '';
            $MD = $lT->get_app_by_name($Wj);
            if ($MD) {
                goto eY;
            }
            $lT->handle_error("\x41\160\160\154\x69\x63\x61\164\x69\x6f\156\40\156\157\164\40\x63\x6f\x6e\146\151\x67\x75\x72\145\144\56");
            MO_Oauth_Debug::mo_oauth_log("\101\160\x70\154\151\143\141\164\x69\157\x6e\x20\156\157\x74\x20\x63\x6f\156\146\151\147\165\162\x65\144\56");
            exit("\x41\x70\x70\x6c\151\143\141\164\x69\x6f\x6e\x20\x6e\x6f\x74\x20\x63\x6f\x6e\x66\x69\x67\165\162\x65\x64\x2e");
            eY:
            $FK = $MD->get_app_config();
            if (!(isset($FK["\163\145\x6e\144\x5f\156\x6f\156\x63\x65"]) && $FK["\163\145\x6e\144\x5f\x6e\x6f\156\143\145"] === 1)) {
                goto V1;
            }
            if (!(isset($_REQUEST["\156\x6f\156\143\x65"]) && !$lT->get_transient("\x6d\x6f\x5f\157\x61\x75\x74\150\137\156\157\x6e\143\145\x5f" . sanitize_text_field(wp_unslash($_REQUEST["\156\157\156\x63\x65"]))))) {
                goto re;
            }
            $TA = "\x4e\157\156\x63\145\x20\166\145\x72\x69\x66\x69\x63\141\x74\151\157\156\x20\151\x73\x20\x66\141\151\x6c\145\x64\56\40\120\154\x65\x61\163\x65\x20\x63\157\x6e\164\141\143\164\40\164\157\x20\171\x6f\x75\x72\40\x61\144\155\151\x6e\x69\163\x74\x72\x61\164\x6f\162\x2e";
            $lT->handle_error($TA);
            MO_Oauth_Debug::mo_oauth_log($TA);
            wp_die(esc_html($TA));
            re:
            V1:
            $nt = array("\147\x72\141\x6e\164\x5f\x74\x79\x70\x65" => "\162\145\x66\162\x65\163\x68\x5f\x74\157\x6b\x65\x6e", "\x63\x6c\151\145\156\164\137\x69\144" => $FK["\143\154\x69\x65\156\164\137\x69\x64"], "\x72\145\x64\151\x72\x65\x63\x74\x5f\165\x72\151" => $FK["\162\x65\x64\x69\x72\x65\x63\164\137\x75\x72\151"], "\162\x65\x66\162\145\163\x68\x5f\x74\x6f\x6b\x65\156" => $_POST["\x72\x65\146\162\x65\163\150\137\x74\x6f\153\x65\x6e"], "\x73\143\x6f\x70\x65" => $MD->get_app_config("\x73\x63\157\160\x65"), "\143\x6c\x69\145\x6e\164\137\163\145\143\162\x65\x74" => $FK["\x63\x6c\151\x65\156\x74\137\x73\145\x63\162\x65\x74"]);
            $o5 = isset($FK["\163\x65\x6e\x64\137\150\145\141\144\145\162\163"]) ? $FK["\163\145\x6e\144\137\150\145\x61\144\145\x72\163"] : 0;
            $u0 = isset($FK["\163\x65\x6e\144\137\142\x6f\144\x79"]) ? $FK["\163\x65\156\x64\x5f\x62\157\144\x79"] : 0;
            $U0 = $FK["\141\x63\x63\145\x73\x73\164\157\153\x65\156\165\x72\x6c"];
            MO_Oauth_Debug::mo_oauth_log("\x4f\x41\165\x74\x68\40\x66\154\157\167");
            $hf = json_decode($this->oauth_handler->get_token($U0, $nt, $o5, $u0), true);
            $pJ = isset($hf["\141\143\x63\x65\x73\163\x5f\164\x6f\153\x65\x6e"]) ? $hf["\141\143\143\145\x73\x73\x5f\x74\x6f\x6b\145\x6e"] : false;
            if (isset($pJ)) {
                goto r8;
            }
            do_action("\155\157\137\162\x65\144\x69\162\145\x63\164\137\x74\x6f\x5f\143\165\x73\x74\x6f\x6d\137\x65\x72\162\x6f\162\137\x70\x61\147\x65");
            $lT->handle_error("\x49\156\x76\x61\154\x69\x64\40\164\157\153\x65\156\x20\162\145\143\x65\x69\166\x65\144\x2e");
            MO_Oauth_Debug::mo_oauth_log("\x49\156\x76\x61\154\x69\144\x20\x74\157\x6b\145\x6e\40\x72\x65\x63\x65\151\166\145\x64\x2e");
            exit("\111\156\x76\x61\154\x69\144\x20\x74\x6f\x6b\145\x6e\x20\x72\145\x63\145\x69\166\x65\x64\x2e");
            r8:
            MO_Oauth_Debug::mo_oauth_log("\x54\157\153\x65\x6e\x20\x52\145\163\160\x6f\x6e\163\145\40\75\76\40");
            MO_Oauth_Debug::mo_oauth_log($hf);
            $Ts = $FK["\x72\145\x73\157\165\162\x63\145\x6f\x77\156\x65\x72\x64\145\x74\x61\151\154\163\x75\x72\x6c"];
            if (!(substr($Ts, -1) == "\75" && !empty($hf["\x75\x73\x65\162\116\x61\155\x65"]))) {
                goto kh;
            }
            $Ts .= strtolower($hf["\x75\163\x65\162\116\141\155\x65"]);
            kh:
            MO_Oauth_Debug::mo_oauth_log("\x41\143\143\145\163\163\x20\x74\157\153\x65\x6e\40\x72\x65\x63\145\x69\166\x65\144\56");
            MO_Oauth_Debug::mo_oauth_log("\101\143\143\145\x73\163\40\124\x6f\153\x65\x6e\40\75\76\x20");
            MO_Oauth_Debug::mo_oauth_log($pJ);
            $tJ = false;
            if (!($tJ === false)) {
                goto js;
            }
            $tJ = $this->oauth_handler->get_resource_owner($Ts, $pJ);
            js:
            MO_Oauth_Debug::mo_oauth_log($tJ);
            $h0 = [];
            $Vk = $this->dropdownattrmapping('', $tJ, $h0);
            $lT->mo_oauth_client_update_option("\x6d\157\x5f\157\141\165\x74\150\137\141\164\x74\162\x5f\156\x61\155\145\x5f\x6c\x69\163\164" . $Wj, $Vk);
            if (!($wK && '' !== $wK)) {
                goto BV;
            }
            $this->handle_group_test_conf($tJ, $FK, $pJ, false, $wK);
            exit;
            BV:
            if (!(isset($FK["\x67\162\x6f\x75\x70\x64\145\164\x61\151\x6c\163\x75\x72\154"]) && !empty($FK["\147\162\x6f\165\x70\144\145\x74\141\151\154\163\x75\x72\x6c"]))) {
                goto dk;
            }
            $tJ = $this->handle_group_user_info($tJ, $FK, $pJ);
            MO_Oauth_Debug::mo_oauth_log("\107\162\157\165\x70\x20\104\x65\x74\x61\151\154\163\40\117\x62\164\x61\x69\x6e\145\x64\x20\75\76\40" . $tJ);
            dk:
            MO_Oauth_Debug::mo_oauth_log("\x46\x65\x74\x63\x68\145\x64\40\162\145\163\157\165\162\x63\x65\x20\x6f\x77\156\145\162\40\x3a\x20" . json_encode($tJ));
            if (!has_filter("\x77\x6f\157\x63\157\155\155\145\162\143\x65\x5f\143\x68\145\143\153\157\x75\164\x5f\147\145\x74\x5f\166\141\x6c\x75\x65")) {
                goto dW;
            }
            $tJ["\141\x70\160\x6e\x61\x6d\x65"] = $Wj;
            dW:
            do_action("\155\157\137\141\x62\162\137\146\x69\x6c\164\x65\162\x5f\154\x6f\147\151\156", $tJ);
            $this->handle_sso($Wj, $FK, $tJ, $w6, $hf);
        } catch (Exception $JW) {
            $lT->handle_error($JW->getMessage());
            MO_Oauth_Debug::mo_oauth_log($JW->getMessage());
            do_action("\x6d\x6f\137\162\x65\144\x69\x72\145\x63\x74\137\164\157\137\x63\165\163\x74\157\x6d\x5f\x65\x72\162\157\x72\x5f\x70\x61\147\x65");
            exit(esc_html($JW->getMessage()));
        }
        Dk:
    }
    public function dropdownattrmapping($lV, $mf, $h0)
    {
        global $lT;
        foreach ($mf as $HH => $eM) {
            if (is_array($eM)) {
                goto rB;
            }
            if (!empty($lV)) {
                goto th;
            }
            array_push($h0, $HH);
            goto a_;
            th:
            array_push($h0, $lV . "\56" . $HH);
            a_:
            goto MN;
            rB:
            if (empty($lV)) {
                goto Ts;
            }
            $lV .= "\56";
            Ts:
            $h0 = $this->dropdownattrmapping($lV . $HH, $eM, $h0);
            $lV = rtrim($lV, "\x2e");
            MN:
            Jp:
        }
        vD:
        return $h0;
    }
    public function resolve_and_get_oidc_response($hf = array())
    {
        if (!empty($hf)) {
            goto jF;
        }
        throw new \Exception("\x54\x6f\x6b\145\156\x20\162\x65\163\160\157\x6e\x73\145\40\x69\163\40\x65\155\x70\164\171", "\151\x6e\166\x61\154\151\x64\x5f\x72\x65\163\160\157\x6e\163\x65");
        jF:
        global $lT;
        $M3 = isset($hf["\x69\144\x5f\x74\157\x6b\x65\x6e"]) ? $hf["\x69\x64\x5f\164\x6f\153\x65\156"] : false;
        $T2 = isset($hf["\141\x63\143\x65\163\x73\137\x74\157\153\145\156"]) ? $hf["\x61\x63\x63\x65\x73\163\x5f\164\x6f\153\145\x6e"] : false;
        $_SESSION["\160\162\157\x63\x6f\162\145\x5f\x61\143\x63\x65\x73\163\x5f\x74\x6f\153\145\156"] = isset($T2) ? $T2 : $M3;
        if (!$lT->is_valid_jwt($M3)) {
            goto Sz;
        }
        return $M3;
        Sz:
        if (!$lT->is_valid_jwt($T2)) {
            goto Jq;
        }
        return $T2;
        Jq:
        MO_Oauth_Debug::mo_oauth_log("\124\157\153\145\156\x20\151\x73\x20\156\x6f\164\40\141\40\166\x61\154\151\144\x20\x4a\x57\124\x2e");
        throw new \Exception("\124\157\x6b\x65\156\x20\151\163\40\x6e\x6f\164\x20\141\x20\166\x61\x6c\x69\x64\40\112\127\124\x2e");
    }
    public function handle_group_test_conf($tJ = array(), $FK = array(), $T2 = '', $We = false, $wK = false)
    {
        $this->render_test_config_output($tJ, false);
    }
    public function testattrmappingconfig($lV, $mf)
    {
        foreach ($mf as $HH => $eM) {
            if (is_array($eM) || is_object($eM)) {
                goto Z0;
            }
            echo "\x3c\x74\162\76\74\x74\144\x3e";
            if (empty($lV)) {
                goto dX;
            }
            echo $lV . "\56";
            dX:
            echo $HH . "\74\57\164\x64\76\x3c\x74\x64\76" . $eM . "\x3c\57\164\144\76\74\57\164\162\x3e";
            goto m6;
            Z0:
            if (empty($lV)) {
                goto Dv;
            }
            $lV .= "\56";
            Dv:
            $this->testattrmappingconfig($lV . $HH, $eM);
            $lV = rtrim($lV, "\56");
            m6:
            g1:
        }
        xp:
    }
    public function render_test_config_output($tJ, $We = false)
    {
        MO_Oauth_Debug::mo_oauth_log("\x54\x68\151\163\x20\151\x73\x20\x74\x65\x73\x74\x20\143\x6f\156\x66\151\x67\x75\x72\x61\x74\x69\x6f\156\40\146\154\x6f\167\40\x3d\x3e\40");
        echo "\74\144\151\166\x20\163\164\x79\154\x65\x3d\x22\x66\157\156\164\55\x66\x61\x6d\151\x6c\x79\72\103\x61\154\x69\142\x72\x69\x3b\x70\141\144\x64\x69\156\147\x3a\x30\40\63\x25\73\x22\x3e";
        echo "\x3c\x73\164\x79\x6c\145\x3e\164\x61\x62\154\x65\x7b\x62\x6f\162\x64\x65\x72\55\143\x6f\x6c\x6c\x61\160\x73\145\x3a\x63\157\154\154\141\160\163\x65\x3b\x7d\x74\150\x20\173\x62\x61\x63\x6b\x67\162\x6f\165\156\x64\55\143\157\x6c\157\x72\x3a\40\43\145\145\145\73\x20\x74\145\x78\164\x2d\141\x6c\x69\147\156\x3a\40\x63\145\x6e\x74\x65\x72\73\x20\x70\x61\x64\144\x69\156\x67\x3a\40\x38\x70\x78\73\40\142\157\162\x64\x65\162\x2d\167\x69\144\x74\x68\72\61\160\170\73\x20\142\x6f\x72\144\x65\x72\x2d\x73\164\171\x6c\x65\x3a\163\x6f\154\151\x64\73\x20\142\x6f\x72\x64\x65\x72\x2d\143\x6f\154\x6f\x72\x3a\x23\62\x31\62\x31\62\61\73\x7d\164\x72\72\x6e\x74\150\x2d\143\x68\151\x6c\x64\50\157\144\x64\51\x20\x7b\142\141\x63\x6b\x67\x72\x6f\165\156\x64\x2d\143\157\x6c\157\x72\x3a\x20\x23\x66\x32\x66\62\146\62\73\175\x20\164\144\x7b\160\x61\x64\x64\x69\156\x67\72\x38\x70\170\73\x62\157\x72\144\145\162\x2d\167\x69\144\164\x68\x3a\x31\160\x78\x3b\x20\x62\x6f\162\144\x65\162\55\x73\x74\171\154\145\72\x73\157\x6c\x69\x64\73\x20\142\x6f\x72\x64\x65\x72\55\143\x6f\x6c\157\162\x3a\x23\62\61\x32\x31\x32\61\73\175\x3c\x2f\163\x74\x79\154\x65\x3e";
        echo "\x3c\x68\x32\76";
        echo $We ? "\107\x72\x6f\x75\x70\40\111\x6e\146\157" : "\x54\x65\163\164\x20\x43\157\x6e\x66\x69\147\x75\x72\x61\164\151\157\x6e";
        echo "\74\57\150\62\76\x3c\x74\141\x62\x6c\x65\76\74\164\162\x3e\x3c\164\x68\76\x41\164\164\x72\151\142\165\x74\145\x20\116\141\x6d\145\x3c\x2f\164\150\x3e\74\x74\x68\x3e\101\x74\164\162\151\142\x75\164\x65\x20\x56\x61\154\165\x65\x3c\x2f\x74\150\76\x3c\x2f\164\x72\76";
        $this->testattrmappingconfig('', $tJ);
        echo "\74\x2f\164\141\142\x6c\145\x3e";
        if ($We) {
            goto aF;
        }
        echo "\74\x64\151\x76\x20\163\164\x79\154\x65\x3d\42\x70\141\x64\x64\x69\x6e\x67\x3a\40\x31\x30\160\x78\x3b\42\x3e\74\x2f\x64\x69\x76\x3e\x3c\151\156\x70\x75\164\40\x73\164\x79\x6c\145\x3d\x22\x70\141\x64\144\x69\x6e\147\72\61\x25\73\167\x69\144\x74\150\72\x31\x30\60\x70\x78\73\142\x61\143\153\x67\162\x6f\165\156\144\72\40\x23\60\60\x39\x31\x43\x44\40\x6e\x6f\x6e\x65\x20\162\x65\x70\x65\x61\164\40\163\x63\x72\157\x6c\154\40\60\45\x20\60\x25\73\143\165\x72\163\x6f\x72\72\x20\x70\157\151\x6e\x74\x65\x72\x3b\146\157\x6e\x74\x2d\163\151\172\x65\x3a\x31\65\x70\x78\x3b\x62\x6f\x72\x64\x65\x72\x2d\x77\151\144\x74\x68\72\40\x31\160\x78\x3b\x62\157\162\x64\145\162\x2d\x73\164\171\154\145\x3a\40\x73\157\x6c\151\x64\73\142\157\x72\x64\x65\162\x2d\x72\x61\144\151\x75\163\72\x20\x33\160\x78\73\x77\x68\151\164\x65\x2d\x73\x70\x61\143\145\72\x20\x6e\157\167\162\141\160\x3b\142\157\170\55\163\151\172\x69\156\147\72\40\x62\x6f\x72\144\145\162\x2d\x62\157\170\73\142\x6f\162\x64\145\x72\x2d\143\157\x6c\157\x72\72\x20\x23\60\x30\67\x33\101\101\x3b\142\x6f\x78\x2d\163\150\x61\144\x6f\167\x3a\40\x30\x70\170\40\61\x70\170\40\x30\x70\170\40\162\x67\x62\141\x28\61\62\x30\54\x20\62\60\60\x2c\40\62\x33\60\x2c\40\x30\x2e\66\51\x20\x69\156\x73\145\x74\x3b\x63\157\x6c\x6f\x72\72\40\43\106\x46\x46\73\42\x74\171\160\145\75\42\x62\x75\164\164\x6f\156\x22\40\x76\x61\x6c\x75\145\x3d\42\x44\157\156\x65\x22\40\157\156\103\x6c\151\143\153\75\x22\x73\x65\x6c\146\x2e\143\x6c\157\x73\145\x28\x29\73\42\x3e\x3c\x2f\144\x69\x76\76";
        aF:
    }
    public function handle_sso($Wj, $FK, $tJ, $w6, $hf, $cn = false)
    {
        MO_Oauth_Debug::mo_oauth_log("\123\x53\117\40\x68\x61\156\x64\154\151\x6e\x67\x20\x66\154\x6f\167");
        global $lT;
        if (!(get_class($this) === "\115\x6f\x4f\141\x75\x74\x68\103\x6c\151\x65\x6e\164\134\114\x6f\147\x69\x6e\x48\141\156\x64\x6c\145\162" && $lT->check_versi(1))) {
            goto Mp;
        }
        $io = new \MoOauthClient\Base\InstanceHelper();
        $vt = $io->get_login_handler_instance();
        $vt->handle_sso($Wj, $FK, $tJ, $w6, $hf, $cn);
        Mp:
        $bi = isset($FK["\156\141\155\x65\137\141\164\x74\x72"]) ? $FK["\x6e\x61\155\145\137\x61\x74\x74\x72"] : '';
        $dw = isset($FK["\x65\x6d\141\151\x6c\137\x61\x74\164\x72"]) ? $FK["\x65\x6d\x61\151\x6c\137\x61\x74\164\x72"] : '';
        $q3 = $lT->getnestedattribute($tJ, $dw);
        $LE = $lT->getnestedattribute($tJ, $bi);
        if (!empty($q3)) {
            goto Fy;
        }
        MO_Oauth_Debug::mo_oauth_log("\105\x6d\x61\x69\x6c\x20\x61\x64\144\x72\x65\163\x73\40\156\157\x74\40\x72\145\143\x65\x69\166\145\144\56\x20\103\x68\x65\143\x6b\40\171\157\165\162\40\x41\x74\164\x72\151\142\165\x74\145\40\x4d\141\160\160\x69\156\147\40\143\157\156\x66\151\147\x75\162\141\x74\x69\157\156\56");
        $lT->handle_error("\105\x6d\x61\151\x6c\40\141\x64\x64\162\x65\x73\x73\40\x6e\x6f\164\40\162\x65\143\145\x69\x76\145\144\56\40\x43\x68\x65\x63\153\x20\x79\157\x75\x72\40\x3c\x73\x74\x72\157\156\147\76\x41\164\164\162\x69\142\x75\x74\145\40\x4d\x61\160\x70\151\156\147\74\x2f\x73\x74\x72\x6f\156\147\76\40\143\x6f\x6e\146\151\x67\x75\x72\141\x74\x69\157\x6e\56");
        wp_die("\x45\x6d\141\x69\154\x20\x61\x64\144\162\145\x73\163\40\156\x6f\x74\40\x72\145\143\145\151\166\145\144\x2e\40\103\x68\145\x63\153\40\171\x6f\x75\x72\x20\74\163\x74\162\x6f\156\147\76\101\164\x74\x72\x69\142\165\164\145\40\115\141\x70\160\x69\156\x67\74\x2f\x73\164\162\x6f\156\147\x3e\40\x63\x6f\x6e\x66\x69\x67\x75\x72\x61\x74\151\x6f\156\x2e");
        Fy:
        if (!(false === strpos($q3, "\x40"))) {
            goto vF;
        }
        MO_Oauth_Debug::mo_oauth_log("\x4d\141\x70\x70\145\144\x20\105\155\141\x69\x6c\40\x61\164\x74\162\151\142\x75\x74\145\40\144\x6f\145\x73\x20\x6e\x6f\x74\40\143\x6f\x6e\164\141\x69\156\x20\x76\141\154\x69\144\x20\145\155\x61\151\154\x2e");
        $lT->handle_error("\115\x61\x70\x70\x65\x64\40\x45\x6d\141\x69\154\x20\x61\x74\164\162\151\142\x75\x74\145\x20\x64\157\x65\163\x20\x6e\157\x74\x20\143\157\156\x74\141\x69\156\40\x76\141\x6c\x69\x64\40\x65\x6d\141\151\154\x2e");
        wp_die("\x4d\141\x70\x70\145\144\x20\x45\155\x61\x69\154\40\141\x74\x74\x72\x69\x62\x75\x74\145\x20\144\x6f\145\x73\x20\x6e\157\164\x20\x63\157\156\164\x61\151\x6e\x20\x76\141\154\151\x64\40\145\x6d\x61\151\154\x2e");
        vF:
        $user = get_user_by("\x6c\x6f\147\151\156", $q3);
        if ($user) {
            goto p6;
        }
        $user = get_user_by("\145\x6d\141\151\154", $q3);
        p6:
        if ($user) {
            goto f4;
        }
        $kM = 0;
        if ($lT->mo_oauth_hbca_xyake()) {
            goto DS;
        }
        $user = $lT->mo_oauth_hjsguh_kiishuyauh878gs($q3, $LE);
        goto HS;
        DS:
        if ($lT->mo_oauth_client_get_option("\x6d\157\x5f\157\141\165\x74\150\137\146\154\x61\147") !== true) {
            goto Xi;
        }
        $Rb = base64_decode("PGRpdiBzdHlsZT0ndGV4dC1hbGlnbjpjZW50ZXI7Jz48Yj5Vc2VyIEFjY291bnQgZG9lcyBub3QgZXhpc3QuPC9iPjwvZGl2Pjxicj48c21hbGw+VGhpcyB2ZXJzaW9uIHN1cHBvcnRzIEF1dG8gQ3JlYXRlIFVzZXIgZmVhdHVyZSB1cHRvIDEwIFVzZXJzLiBQbGVhc2UgdXBncmFkZSB0byB0aGUgaGlnaGVyIHZlcnNpb24gb2YgdGhlIHBsdWdpbiB0byBlbmFibGUgYXV0byBjcmVhdGUgdXNlciBmb3IgdW5saW1pdGVkIHVzZXJzIG9yIGFkZCB1c2VyIG1hbnVhbGx5Ljwvc21hbGw+");
        $lT->handle_error($Rb);
        MO_Oauth_Debug::mo_oauth_log($Rb);
        wp_die($Rb);
        goto pU;
        Xi:
        $user = $lT->mo_oauth_jhuyn_jgsukaj($q3, $LE);
        pU:
        HS:
        goto YV;
        f4:
        $kM = $user->ID;
        YV:
        if (!$user) {
            goto JH;
        }
        wp_set_current_user($user->ID);
        MO_Oauth_Debug::mo_oauth_log("\125\x73\145\x72\40\x46\157\165\x6e\144");
        $CY = false;
        $CY = apply_filters("\155\x6f\137\162\145\155\x65\x6d\x62\x65\162\x5f\155\x65", $CY);
        if (!$CY) {
            goto Wd;
        }
        MO_Oauth_Debug::mo_oauth_log("\122\x65\155\145\x6d\142\145\x72\40\101\144\144\x6f\156\x20\141\143\x74\151\x76\141\164\x65\x64");
        Wd:
        wp_set_auth_cookie($user->ID, $CY);
        MO_Oauth_Debug::mo_oauth_log("\125\x73\x65\162\40\x63\x6f\x6f\153\151\x65\x20\x73\x65\x74");
        $user = get_user_by("\111\x44", $user->ID);
        do_action("\167\160\137\154\x6f\x67\x69\x6e", $user->user_login, $user);
        wp_safe_redirect(home_url());
        MO_Oauth_Debug::mo_oauth_log("\x55\x73\145\162\x20\122\x65\x64\151\x72\x65\143\x74\145\x64\x20\x74\157\40\x68\157\x6d\145\40\165\162\154");
        exit;
        JH:
    }
    public function get_resource_owner_from_app($M3, $Or)
    {
        return $this->oauth_handler->get_resource_owner_from_id_token($M3);
    }
}
