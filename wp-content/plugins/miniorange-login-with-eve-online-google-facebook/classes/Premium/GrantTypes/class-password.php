<?php


namespace MoOauthClient\GrantTypes;

use MoOauthClient\GrantTypes\Implicit;
use MoOauthClient\OauthHandler;
use MoOauthClient\StorageManager;
use MoOauthClient\Base\InstanceHelper;
use MoOauthClient\LoginHandler;
use MoOauthClient\MO_Oauth_Debug;
class Password
{
    const CSS_URL = MOC_URL . "\x63\x6c\x61\163\163\145\163\57\120\162\x65\x6d\151\x75\155\x2f\x72\x65\163\157\x75\x72\143\145\x73\57\160\x77\x64\x73\164\x79\154\x65\56\x63\x73\x73";
    const JS_URL = MOC_URL . "\x63\154\141\x73\163\x65\163\57\x50\162\x65\155\151\165\155\x2f\162\145\x73\157\x75\162\x63\145\x73\x2f\160\x77\x64\56\152\163";
    public function __construct($cn = false)
    {
        if (!$cn) {
            goto y8;
        }
        return;
        y8:
        add_action("\x69\156\151\x74", array($this, "\142\x65\150\x61\166\145"));
    }
    public function inject_ui()
    {
        global $lT;
        wp_enqueue_style("\167\x70\x2d\x6d\157\55\x6f\143\55\x70\x77\144\x2d\x63\163\163", self::CSS_URL, array(), $jm = null, $XF = false);
        $om = $lT->parse_url($lT->get_current_url());
        $Vn = "\x62\x75\164\x74\157\156";
        if (!isset($om["\161\165\145\x72\171"]["\154\157\x67\x69\x6e"])) {
            goto HF;
        }
        return;
        HF:
        echo "\x9\x9\74\144\x69\x76\40\x69\x64\x3d\42\x70\141\163\163\x77\x6f\x72\144\x2d\x67\x72\x61\x6e\164\55\x6d\x6f\x64\141\x6c\x22\40\143\x6c\x61\x73\163\75\42\160\141\163\163\x77\x6f\162\x64\55\x6d\157\144\x61\154\40\155\157\x5f\x74\141\142\x6c\145\137\x6c\x61\171\157\165\x74\42\76\12\x9\x9\x9\x3c\x64\x69\166\40\x63\x6c\x61\x73\x73\75\42\x70\141\x73\163\167\157\162\144\x2d\155\x6f\144\141\154\x2d\x63\157\x6e\164\x65\156\164\42\76\12\11\11\x9\x9\74\144\151\x76\x20\x63\x6c\x61\x73\163\x3d\42\160\141\x73\163\x77\x6f\x72\x64\55\155\157\x64\x61\x6c\55\150\x65\x61\x64\x65\x72\42\x3e\xa\11\x9\11\x9\x9\74\144\151\x76\40\143\x6c\141\163\163\x3d\x22\x70\x61\163\x73\167\x6f\162\144\55\x6d\157\x64\x61\x6c\55\x68\145\141\x64\145\x72\x2d\x74\x69\x74\x6c\145\x22\x3e\12\x9\x9\x9\11\x9\11\x3c\163\x70\141\156\40\x63\x6c\141\163\163\x3d\x22\x70\141\163\x73\x77\x6f\162\144\55\155\x6f\x64\x61\154\55\143\x6c\157\x73\x65\x22\x3e\46\x74\151\155\145\163\x3b\x3c\x2f\x73\x70\x61\156\x3e\xa\11\11\11\x9\x9\11\74\163\x70\141\156\40\151\144\x3d\42\160\x61\x73\x73\167\x6f\162\144\x2d\155\157\x64\141\154\55\x68\x65\x61\x64\x65\162\55\x74\x69\164\x6c\x65\x2d\164\145\170\164\42\x3e\x3c\x2f\163\160\141\156\x3e\12\11\x9\11\x9\x9\x3c\57\x64\151\166\x3e\xa\11\x9\x9\11\74\x2f\144\x69\x76\76\12\x9\x9\11\11\74\x66\157\x72\155\40\151\144\75\42\160\167\x64\x67\162\156\164\146\162\x6d\42\x3e\12\x9\11\11\11\x9\x3c\x69\x6e\x70\165\164\40\164\x79\x70\145\x3d\x22\150\x69\x64\x64\x65\156\x22\40\156\141\155\145\75\42\x6c\x6f\x67\151\x6e\42\40\166\141\x6c\165\145\x3d\42\160\x77\x64\x67\162\156\164\146\x72\x6d\42\76\xa\x9\11\11\x9\x9\x3c\151\156\160\x75\x74\40\x74\x79\x70\x65\x3d\x22\164\x65\170\x74\42\40\143\154\x61\163\163\x3d\42\x6d\x6f\x5f\x74\141\x62\x6c\x65\x5f\x74\145\x78\164\x62\x6f\170\42\40\x69\144\x3d\42\160\x77\144\x67\x72\156\164\x66\x72\155\55\165\156\x6d\x66\154\x64\42\40\x6e\141\x6d\145\75\42\x63\x61\x6c\x6c\145\x72\42\x20\160\154\x61\143\x65\150\157\x6c\x64\x65\x72\75\x22\x55\x73\145\x72\x6e\141\x6d\145\42\x3e\12\x9\11\11\11\x9\74\x69\156\x70\165\164\40\x74\x79\x70\x65\75\x22\160\x61\163\163\x77\x6f\x72\144\42\x20\143\154\141\163\163\75\x22\155\157\x5f\x74\x61\142\154\x65\x5f\164\145\170\x74\x62\x6f\x78\42\x20\151\x64\x3d\x22\160\x77\x64\x67\x72\156\164\x66\x72\x6d\x2d\x70\146\154\144\42\40\x6e\141\155\145\75\x22\164\x6f\x6f\154\x22\x20\160\154\141\143\x65\x68\157\x6c\x64\145\x72\x3d\42\120\141\x73\x73\x77\157\x72\x64\42\x3e\xa\x9\x9\x9\x9\11\74\151\156\160\165\164\x20\x74\x79\160\145\75\42";
        echo $Vn;
        echo "\42\40\x63\154\x61\x73\x73\x3d\42\142\x75\164\164\157\x6e\40\142\165\164\164\x6f\156\x2d\160\162\x69\155\x61\162\x79\x20\142\x75\x74\164\x6f\x6e\55\x6c\x61\x72\x67\145\x22\40\151\x64\x3d\x22\160\x77\x64\x67\162\156\x74\146\x72\x6d\55\154\157\x67\x69\x6e\42\40\166\x61\x6c\x75\145\75\42\x4c\x6f\x67\x69\156\x22\x3e\xa\11\x9\11\11\74\57\146\x6f\162\x6d\x3e\12\11\x9\11\74\57\144\x69\166\76\12\x9\x9\x3c\x2f\x64\151\166\x3e\xa\x9\11";
    }
    public function inject_behaviour()
    {
        wp_enqueue_script("\167\x70\55\155\x6f\x2d\x6f\143\x2d\160\x77\144\55\152\x73", self::JS_URL, ["\152\x71\165\x65\162\171"], $jm = null, $XF = true);
    }
    public function behave($Od = '', $Av = '', $Or = '', $yU = '', $LI = false, $cn = false)
    {
        global $lT;
        $Od = !empty($Od) ? hex2bin($Od) : false;
        $Av = !empty($Av) ? hex2bin($Av) : false;
        $Or = !empty($Or) ? $Or : false;
        $yU = !empty($yU) ? $yU : site_url();
        if (!($Av && !$LI)) {
            goto HB;
        }
        $Av = wp_unslash($Av);
        HB:
        if (!(!$Od || !$Av || !$Or)) {
            goto JQ;
        }
        $lT->redirect_user(urldecode($yU));
        exit;
        JQ:
        $kp = $lT->get_app_by_name($Or);
        if ($kp) {
            goto Af;
        }
        $a7 = $lT->parse_url(urldecode(site_url()));
        $a7["\161\165\145\162\x79"]["\x65\162\162\x6f\162"] = "\124\x68\145\162\145\40\x69\163\40\x6e\157\x20\141\x70\160\x6c\151\143\x61\x74\151\157\x6e\x20\143\157\x6e\x66\x69\x67\165\162\145\144\x20\x66\x6f\162\40\x74\x68\151\x73\x20\x72\145\161\165\145\x73\x74";
        $lT->redirect_user($lT->generate_url($a7));
        Af:
        $FK = $kp->get_app_config();
        $nt = array("\147\x72\x61\156\x74\137\x74\171\160\145" => "\160\141\x73\163\x77\157\x72\144", "\143\154\x69\145\x6e\x74\137\151\144" => $FK["\143\x6c\151\x65\x6e\x74\x5f\x69\144"], "\143\154\151\x65\x6e\x74\x5f\163\x65\143\x72\x65\164" => $FK["\x63\154\151\145\156\x74\137\x73\x65\x63\162\145\164"], "\x75\x73\145\162\x6e\x61\x6d\x65" => $Od, "\x70\x61\x73\x73\167\x6f\x72\x64" => $Av, "\x69\163\137\x77\x70\137\x6c\157\x67\x69\156" => $cn);
        $W5 = new OauthHandler();
        $U0 = $FK["\141\143\143\145\163\163\x74\x6f\x6b\145\156\x75\162\154"];
        if (!(strpos($U0, "\x67\157\x6f\147\x6c\145") !== false)) {
            goto fs;
        }
        $U0 = "\150\x74\164\x70\x73\x3a\x2f\57\x77\x77\x77\56\x67\157\157\147\154\145\141\160\x69\x73\56\x63\157\x6d\x2f\157\x61\165\164\150\x32\x2f\x76\x34\57\x74\157\153\x65\156";
        fs:
        if (!(strpos($U0, "\163\145\x72\x76\x69\x63\145\x73\57\157\x61\165\x74\150\x32\57\164\x6f\x6b\145\x6e") === false && strpos($U0, "\163\x61\x6c\145\163\x66\x6f\x72\143\145") === false && strpos($FK["\141\143\x63\x65\x73\163\164\157\x6b\145\156\165\162\154"], "\57\x6f\141\x6d\x2f\x6f\141\165\164\150\x32\x2f\141\x63\143\145\163\163\x5f\164\x6f\153\x65\x6e") === false)) {
            goto ZC;
        }
        $nt["\x73\x63\x6f\x70\x65"] = $kp->get_app_config("\x73\143\157\160\x65");
        ZC:
        $o5 = isset($FK["\163\145\x6e\x64\x5f\x68\x65\x61\144\145\x72\163"]) ? $FK["\x73\145\x6e\144\137\x68\x65\141\144\x65\x72\163"] : 0;
        $u0 = isset($FK["\163\x65\156\x64\137\x62\157\x64\x79"]) ? $FK["\x73\x65\x6e\144\x5f\142\157\x64\x79"] : 0;
        do_action("\x6d\x6f\x5f\x67\145\163\143\x6f\154\x5f\x68\141\156\x64\x6c\x65\x72", $Od, $Av, $Or);
        $hf = $W5->get_access_token($U0, $nt, $o5, $u0);
        if (!is_wp_error($hf)) {
            goto ap;
        }
        return $hf;
        ap:
        MO_Oauth_Debug::mo_oauth_log("\124\x6f\x6b\x65\156\x20\x52\145\163\160\157\x6e\163\145\40\x52\x65\143\145\151\x76\145\x64\x20\x3d\76\40");
        MO_Oauth_Debug::mo_oauth_log($hf);
        if ($hf) {
            goto TR;
        }
        $TA = new \WP_Error();
        $TA->add("\x69\x6e\166\x61\x6c\151\x64\137\x70\x61\x73\163\x77\157\162\144", __("\74\163\164\162\157\156\x67\76\105\x52\122\117\122\74\x2f\x73\164\162\157\x6e\x67\76\72\40\111\156\143\x6f\x72\162\145\143\x74\x20\x45\x6d\x61\x69\154\40\x61\144\144\x72\145\163\163\x20\x6f\x72\40\x50\141\163\x73\x77\157\x72\144\56"));
        return $TA;
        TR:
        $T2 = isset($hf["\x61\x63\x63\x65\163\163\137\164\x6f\x6b\x65\x6e"]) ? $hf["\x61\143\143\x65\x73\163\137\x74\157\153\145\156"] : false;
        $M3 = isset($hf["\x69\144\x5f\x74\157\153\x65\x6e"]) ? $hf["\x69\x64\x5f\164\x6f\x6b\145\x6e"] : false;
        $tu = isset($hf["\x74\157\x6b\x65\156"]) ? $hf["\x74\157\153\145\x6e"] : false;
        $tJ = [];
        if (false !== $M3 || false !== $tu) {
            goto ea;
        }
        if ($T2) {
            goto Vd;
        }
        $lT->handle_error("\111\156\x76\141\x6c\151\144\40\164\x6f\x6b\145\x6e\40\162\x65\x63\145\x69\x76\x65\144\56");
        MO_Oauth_Debug::mo_oauth_log("\x45\x72\162\x6f\x72\40\146\162\157\x6d\x20\124\x6f\x6b\x65\x6e\40\105\156\x64\x70\157\151\x6e\x74\x20\x3d\76\x20\x49\156\166\141\x6c\151\x64\x20\x74\x6f\153\x65\x6e\x20\162\x65\x63\145\151\166\x65\x64");
        exit("\x49\x6e\x76\141\x6c\151\x64\40\164\157\x6b\145\156\40\x72\x65\143\x65\x69\x76\145\144\x2e");
        Vd:
        goto vM;
        ea:
        $ZO = '';
        if (!(false !== $tu)) {
            goto HY;
        }
        $ZO = "\164\x6f\x6b\145\x6e\x3d" . $tu;
        HY:
        if (!(false !== $M3)) {
            goto Ml;
        }
        $ZO = "\151\x64\137\x74\157\153\145\156\75" . $M3;
        Ml:
        $VP = new Implicit($ZO);
        if (!is_wp_error($VP)) {
            goto dP;
        }
        $lT->handle_error($VP->get_error_message());
        MO_Oauth_Debug::mo_oauth_log($VP->get_error_message());
        wp_die(wp_kses($VP->get_error_message(), \mo_oauth_get_valid_html()));
        exit("\x50\x6c\145\141\x73\x65\40\164\x72\171\40\114\x6f\x67\147\151\156\147\x20\151\x6e\x20\141\147\141\x69\x6e\56");
        dP:
        $dR = $VP->get_jwt_from_query_param();
        $tJ = $dR->get_decoded_payload();
        vM:
        $Ts = $FK["\162\x65\x73\157\x75\x72\x63\145\157\x77\x6e\145\x72\x64\x65\164\x61\x69\154\x73\165\x72\154"];
        if (!(substr($Ts, -1) === "\x3d")) {
            goto ol;
        }
        $Ts .= $T2;
        ol:
        if (!(strpos($Ts, "\x67\157\157\x67\154\145") !== false)) {
            goto uv;
        }
        $Ts = "\x68\x74\x74\x70\163\x3a\57\x2f\x77\167\167\x2e\147\x6f\157\147\154\x65\x61\160\151\163\56\143\157\x6d\x2f\157\141\x75\164\150\x32\x2f\x76\61\x2f\x75\x73\x65\162\x69\x6e\146\157";
        uv:
        if (empty($Ts)) {
            goto n8;
        }
        $tJ = $W5->get_resource_owner($Ts, $T2);
        n8:
        MO_Oauth_Debug::mo_oauth_log("\122\145\163\157\165\x72\x63\x65\x20\x4f\x77\156\145\162\x20\x3d\76\x20");
        MO_Oauth_Debug::mo_oauth_log($tJ);
        $io = new InstanceHelper();
        $vt = $io->get_login_handler_instance();
        $h0 = [];
        $f7 = new LoginHandler();
        $Vk = $f7->dropdownattrmapping('', $tJ, $h0);
        $lT->mo_oauth_client_update_option("\x6d\x6f\137\157\x61\165\x74\150\137\141\x74\164\x72\137\156\141\x6d\145\137\x6c\151\x73\164" . $Or, $Vk);
        if (!$LI) {
            goto g_;
        }
        $vt->handle_group_test_conf($tJ, $FK, $T2, false, $LI);
        exit;
        g_:
        $blog_id = get_current_blog_id();
        $Xc = new StorageManager();
        $Xc->add_replace_entry("\x72\x65\144\151\162\145\x63\x74\137\165\x72\x69", $yU);
        $Xc->add_replace_entry("\142\x6c\x6f\x67\x5f\151\144", $blog_id);
        $w6 = $Xc->get_state();
        $user = $vt->handle_sso($FK["\x61\160\x70\x49\x64"], $FK, $tJ, $w6, $hf, $cn);
        if (!$cn) {
            goto kM;
        }
        return $user;
        kM:
    }
    public function mo_oauth_wp_login($user, $vP, $W4)
    {
        global $lT;
        $TA = new \WP_Error();
        if (!(empty($vP) || empty($W4))) {
            goto su;
        }
        if (!empty($vP)) {
            goto Vy;
        }
        $TA->add("\x65\155\x70\x74\171\137\165\163\145\x72\156\141\155\x65", __("\74\163\x74\x72\157\156\x67\76\x45\x52\122\117\x52\x3c\x2f\x73\164\x72\157\x6e\147\76\x3a\x20\105\x6d\141\151\154\x20\x66\x69\x65\154\x64\x20\x69\x73\x20\145\x6d\x70\x74\x79\x2e"));
        Vy:
        if (!empty($W4)) {
            goto qh;
        }
        $TA->add("\x65\x6d\160\164\171\x5f\160\x61\163\x73\167\x6f\162\144", __("\74\163\x74\162\x6f\x6e\147\76\105\122\x52\117\122\74\57\x73\164\162\157\156\147\x3e\72\x20\120\x61\x73\x73\x77\x6f\162\x64\40\x66\151\x65\x6c\144\40\x69\163\40\145\x6d\160\164\171\56"));
        qh:
        return $TA;
        su:
        $Or = $lT->mo_oauth_client_get_option("\155\157\x5f\x6f\141\x75\x74\x68\x5f\x65\156\141\x62\x6c\145\x5f\x6f\141\165\164\150\x5f\x77\x70\137\154\x6f\x67\151\x6e");
        $user = false;
        if (\username_exists($vP)) {
            goto sH;
        }
        if (!email_exists($vP)) {
            goto j4;
        }
        $user = get_user_by("\145\x6d\141\151\154", $vP);
        j4:
        goto vj;
        sH:
        $user = \get_user_by("\x6c\x6f\147\x69\x6e", $vP);
        vj:
        if (!($user && wp_check_password($W4, $user->data->user_pass, $user->ID))) {
            goto A6;
        }
        return $user;
        A6:
        if (!(false !== $Or)) {
            goto ca;
        }
        $dy = '';
        $dy = do_action("\155\157\x5f\157\x61\165\164\x68\137\143\x75\163\x74\x6f\x6d\137\x73\163\157", \bin2hex($vP), \bin2hex($W4), $Or, site_url(), false, true);
        if (empty($dy)) {
            goto jc;
        }
        return $dy;
        jc:
        return $this->behave(\bin2hex($vP), \bin2hex($W4), $Or, site_url(), false, true);
        ca:
        $TA->add("\x69\156\166\x61\x6c\x69\x64\137\x70\x61\x73\163\x77\x6f\162\144", __("\x3c\163\x74\162\157\x6e\x67\x3e\x45\122\122\x4f\122\74\x2f\x73\x74\162\157\x6e\147\76\x3a\x20\125\x73\145\162\156\141\155\145\40\157\x72\40\x50\141\x73\x73\x77\157\x72\x64\40\x69\x73\40\151\x6e\x76\141\154\x69\x64\56"));
        MO_Oauth_Debug::mo_oauth_log($TA);
        return $TA;
    }
}
