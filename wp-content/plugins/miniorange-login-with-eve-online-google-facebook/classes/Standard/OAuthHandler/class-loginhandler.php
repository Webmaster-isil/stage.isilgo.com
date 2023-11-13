<?php


namespace MoOauthClient\Standard;

use MoOauthClient\LoginHandler as FreeLoginHandler;
use MoOauthClient\Config;
use MoOauthClient\StorageManager;
use MoOauthClient\MO_Oauth_Debug;
class LoginHandler extends FreeLoginHandler
{
    public $config;
    public function handle_group_test_conf($tJ = array(), $FK = array(), $T2 = '', $We = false, $wK = false)
    {
        global $lT;
        $this->render_test_config_output($tJ, false);
        if (!(!isset($FK["\147\x72\157\165\160\x64\x65\164\141\x69\x6c\163\x75\162\154"]) || '' === $FK["\147\162\157\165\160\144\145\x74\141\151\154\163\165\162\x6c"])) {
            goto uyq;
        }
        return;
        uyq:
        $tj = [];
        $K5 = $FK["\147\162\157\165\x70\144\x65\x74\141\151\154\x73\165\162\x6c"];
        if (!(strpos($K5, "\141\x70\151\x2e\x63\x6c\145\166\x65\x72\56\143\x6f\x6d") != false && isset($tJ["\x64\141\x74\x61"]["\x69\144"]))) {
            goto VwH;
        }
        $K5 = str_replace("\165\x73\145\x72\151\144", $tJ["\x64\141\164\x61"]["\151\144"], $K5);
        VwH:
        MO_Oauth_Debug::mo_oauth_log("\x47\x72\x6f\x75\x70\40\x44\x65\164\141\151\x6c\163\40\125\x52\114\x3a\40" . $K5);
        if (!('' === $T2)) {
            goto C4C;
        }
        if (has_filter("\x6d\x6f\x5f\x6f\x61\x75\164\150\x5f\143\146\x61\137\x67\x72\x6f\165\x70\x5f\144\x65\164\141\151\x6c\x73")) {
            goto ekI;
        }
        MO_Oauth_Debug::mo_oauth_log("\x41\x63\x63\x65\x73\x73\x20\x54\x6f\153\145\156\x20\x45\x6d\160\164\171");
        return;
        ekI:
        C4C:
        if (!('' !== $K5)) {
            goto wOB;
        }
        if (has_filter("\155\157\x5f\157\x61\x75\164\x68\x5f\x63\x66\x61\137\x67\x72\157\x75\x70\x5f\144\x65\x74\141\x69\x6c\163")) {
            goto f9a;
        }
        if (has_filter("\x6d\157\137\157\141\x75\164\x68\137\147\162\x6f\165\x70\137\x64\x65\164\x61\x69\x6c\x73")) {
            goto fM8;
        }
        if (has_filter("\x6d\x6f\x5f\157\x61\x75\164\x68\x5f\162\141\x76\x65\x6e\137\x67\x72\x6f\165\160\137\x64\145\164\141\151\x6c\x73")) {
            goto aAZ;
        }
        $tj = $this->oauth_handler->get_resource_owner($K5, $T2);
        goto Ldv;
        aAZ:
        $tj = apply_filters("\155\x6f\137\x6f\141\x75\x74\150\x5f\x72\x61\x76\145\x6e\x5f\x67\162\x6f\165\x70\x5f\x64\145\x74\x61\151\154\163", $tJ["\145\155\x61\x69\x6c"], $K5, $T2, $FK, $We);
        Ldv:
        goto NsT;
        fM8:
        $tj = apply_filters("\155\157\137\157\x61\x75\x74\150\137\147\x72\157\165\160\137\x64\145\164\141\151\x6c\163", $K5, $T2, $FK, $We);
        NsT:
        goto pvj;
        f9a:
        MO_Oauth_Debug::mo_oauth_log("\x46\x65\164\x63\x68\x69\x6e\147\40\x43\106\101\x20\107\162\157\x75\x70\x2e\x2e");
        $tj = apply_filters("\155\x6f\x5f\x6f\141\x75\164\x68\137\143\146\x61\x5f\x67\x72\157\x75\x70\x5f\144\x65\x74\x61\151\154\x73", $tJ, $K5, $T2, $FK, $We);
        pvj:
        $h0 = $lT->mo_oauth_client_get_option("\155\x6f\x5f\x6f\141\x75\x74\150\x5f\x61\164\164\162\137\x6e\141\155\x65\137\154\151\163\164" . $FK["\141\160\x70\111\144"]);
        $af = [];
        $Vk = $this->dropdownattrmapping('', $tj, $af);
        $h0 = (array) $h0 + $Vk;
        $lT->mo_oauth_client_update_option("\x6d\x6f\x5f\x6f\141\x75\x74\150\137\x61\x74\x74\162\x5f\x6e\x61\155\145\137\154\x69\x73\x74" . $FK["\141\x70\x70\x49\144"], $h0);
        if (!($wK && '' !== $wK)) {
            goto iVz;
        }
        if (!(is_array($tj) && !empty($tj))) {
            goto IE2;
        }
        $this->render_test_config_output($tj, true);
        IE2:
        return;
        iVz:
        wOB:
    }
    public function handle_group_user_info($tJ, $FK, $T2)
    {
        if (!(!isset($FK["\x67\162\x6f\165\160\144\145\164\141\151\154\163\x75\x72\x6c"]) || '' === $FK["\x67\x72\x6f\x75\160\x64\145\x74\141\151\154\163\x75\x72\x6c"])) {
            goto x0R;
        }
        return $tJ;
        x0R:
        $K5 = $FK["\x67\162\157\x75\160\144\145\x74\141\x69\154\163\x75\162\x6c"];
        if (!(strpos($K5, "\x61\x70\151\56\x63\x6c\x65\166\x65\162\x2e\143\x6f\x6d") != false && isset($tJ["\x64\141\164\141"]["\x69\144"]))) {
            goto GVj;
        }
        $K5 = str_replace("\x75\x73\x65\x72\x69\144", $tJ["\144\x61\164\141"]["\151\144"], $K5);
        GVj:
        if (!('' === $T2)) {
            goto ZHR;
        }
        return $tJ;
        ZHR:
        $tj = array();
        if (!('' !== $K5)) {
            goto Loh;
        }
        if (has_filter("\x6d\157\137\157\141\x75\164\150\x5f\143\x66\x61\x5f\x67\162\x6f\165\x70\137\144\x65\164\x61\151\x6c\x73")) {
            goto whi;
        }
        if (has_filter("\x6d\x6f\137\x6f\141\165\x74\150\x5f\x67\162\157\165\160\137\144\x65\164\x61\151\x6c\x73")) {
            goto e2R;
        }
        if (has_filter("\x6d\x6f\137\157\x61\x75\164\150\137\162\x61\x76\145\x6e\137\x67\x72\157\165\x70\137\144\145\164\x61\x69\x6c\x73")) {
            goto nPE;
        }
        $tj = $this->oauth_handler->get_resource_owner($K5, $T2);
        goto MCW;
        nPE:
        $tj = apply_filters("\155\157\137\x6f\x61\165\x74\x68\x5f\x72\x61\x76\145\x6e\x5f\x67\x72\x6f\165\x70\x5f\x64\145\x74\x61\x69\154\x73", $tJ["\145\x6d\x61\x69\154"], $K5, $T2, $FK, $We);
        MCW:
        goto oBF;
        e2R:
        $tj = apply_filters("\155\x6f\137\157\141\165\x74\150\x5f\147\x72\157\165\160\137\144\145\x74\x61\151\154\163", $K5, $T2, $FK);
        oBF:
        goto top;
        whi:
        MO_Oauth_Debug::mo_oauth_log("\106\145\164\x63\x68\151\156\147\40\x43\106\101\x20\x47\162\157\x75\160\56\56");
        $tj = apply_filters("\x6d\157\x5f\157\x61\x75\x74\x68\137\143\x66\141\137\147\162\157\165\160\137\x64\x65\x74\141\151\154\x73", $tJ, $K5, $T2, $FK, $We);
        top:
        Loh:
        MO_Oauth_Debug::mo_oauth_log("\x47\x72\x6f\165\x70\40\104\x65\x74\x61\151\154\x73\40\75\76\40");
        MO_Oauth_Debug::mo_oauth_log($tj);
        if (!(is_array($tj) && count($tj) > 0)) {
            goto SYA;
        }
        $tJ = array_merge($tJ, $tj);
        SYA:
        MO_Oauth_Debug::mo_oauth_log("\122\x65\163\157\165\x72\x63\x65\40\x4f\167\x6e\145\x72\40\101\x66\x74\x65\x72\x20\x6d\x65\x72\x67\151\156\147\x20\167\151\x74\150\40\107\162\x6f\165\160\x20\x64\145\x74\x69\141\x6c\163\x20\x3d\x3e\40");
        MO_Oauth_Debug::mo_oauth_log($tJ);
        return $tJ;
    }
    public function mo_oauth_client_map_default_role($kM, $FK)
    {
        $m6 = new \WP_User($kM);
        if (!(isset($FK["\x65\156\x61\x62\154\x65\137\x72\x6f\x6c\145\x5f\x6d\141\160\x70\x69\x6e\147"]) && !boolval($FK["\x65\156\x61\x62\154\x65\137\162\157\x6c\x65\137\155\x61\x70\160\151\156\147"]))) {
            goto jo4;
        }
        $m6->set_role('');
        return;
        jo4:
        if (!(isset($FK["\x5f\155\141\160\160\x69\156\x67\137\x76\x61\x6c\x75\145\x5f\x64\145\x66\x61\x75\x6c\x74"]) && '' !== $FK["\x5f\x6d\141\x70\x70\x69\x6e\x67\x5f\x76\141\x6c\165\x65\137\x64\x65\x66\x61\x75\154\164"])) {
            goto Yj_;
        }
        $cJ = explode("\54", $FK["\x5f\155\x61\x70\160\x69\156\x67\x5f\x76\x61\x6c\x75\x65\137\144\x65\146\141\x75\x6c\x74"]);
        $gR = 0;
        foreach ($cJ as $VS) {
            if (!(0 === $gR)) {
                goto O38;
            }
            $m6->set_role('');
            O38:
            $VS = trim($VS);
            $m6->add_role($VS);
            $gR++;
            xL_:
        }
        e9o:
        Yj_:
    }
    public function handle_sso($Wj, $FK, $tJ, $w6, $hf, $cn = false)
    {
        global $lT;
        $Xc = new StorageManager($w6);
        do_action("\x6d\x6f\x5f\x6f\x61\165\x74\x68\x5f\x6c\x69\x6e\153\137\144\151\163\143\x6f\x72\144\137\141\x63\143\x6f\165\x6e\x74", $Xc, $tJ);
        $jd = isset($FK["\x75\x73\x65\162\x6e\x61\155\145\137\x61\x74\x74\162"]) ? $FK["\165\163\x65\x72\x6e\x61\155\x65\x5f\141\x74\x74\162"] : '';
        $dw = isset($FK["\x65\x6d\141\151\154\137\x61\164\164\x72"]) ? $FK["\x65\x6d\x61\151\x6c\137\x61\164\164\x72"] : '';
        $VR = isset($FK["\146\x69\162\x73\x74\x6e\x61\x6d\145\x5f\141\164\x74\162"]) ? $FK["\146\151\x72\163\164\x6e\141\155\x65\x5f\141\x74\x74\162"] : '';
        $Om = isset($FK["\x6c\141\x73\x74\x6e\x61\x6d\145\137\141\164\164\x72"]) ? $FK["\x6c\x61\163\x74\x6e\x61\x6d\145\137\141\x74\164\x72"] : '';
        $WN = isset($FK["\144\151\x73\160\x6c\x61\x79\137\141\x74\164\162"]) ? $FK["\144\x69\x73\160\154\x61\171\137\141\164\164\x72"] : '';
        $vP = $lT->getnestedattribute($tJ, $jd);
        $q3 = $lT->getnestedattribute($tJ, $dw);
        $Ex = $lT->getnestedattribute($tJ, $VR);
        $ga = $lT->getnestedattribute($tJ, $Om);
        $Ku = $vP;
        $this->config = $lT->mo_oauth_client_get_option("\155\x6f\x5f\157\141\x75\x74\x68\137\x63\154\x69\145\156\x74\137\143\157\x6e\146\x69\x67");
        $this->config = !$this->config || empty($this->config) ? array() : $this->config->get_current_config();
        $z1 = isset($this->config["\141\x63\164\x69\x76\x61\x74\145\137\x75\163\145\162\x5f\141\156\x61\x6c\171\x74\x69\x63\163"]) ? $this->config["\x61\143\164\x69\166\x61\164\145\137\165\163\145\x72\x5f\141\156\141\x6c\x79\164\x69\x63\163"] : 0;
        $current_user = wp_get_current_user();
        if (!($current_user->ID !== 0)) {
            goto qmH;
        }
        do_action("\x6d\157\137\157\x61\x75\164\150\x5f\x64\x69\x73\143\x6f\162\144\x5f\x66\154\157\167\x5f\x68\141\x6e\144\154\145", $current_user, $hf, $tJ);
        do_action("\155\157\137\x6f\x61\165\164\150\x5f\x6c\157\x67\x67\145\144\x5f\x69\x6e\137\165\x73\x65\162\x5f\x74\x61\x67\137\x75\x70\x64\141\x74\145", $current_user, $hf, $tJ);
        $nV = get_option("\x6d\x6f\x5f\x64\x72\x6d\x5f\163\171\x6e\x63\x5f\162\145\x64\151\162\x65\x63\164");
        if (!(isset($nV) && $nV)) {
            goto lNA;
        }
        wp_redirect($nV);
        exit;
        lNA:
        qmH:
        if (empty($WN)) {
            goto eld;
        }
        switch ($WN) {
            case "\106\116\x41\115\x45":
                $Ku = $Ex;
                goto opW;
            case "\114\x4e\x41\115\105":
                $Ku = $ga;
                goto opW;
            case "\125\x53\x45\122\x4e\x41\115\x45":
                $Ku = $vP;
                goto opW;
            case "\106\116\x41\115\x45\x5f\114\x4e\x41\x4d\x45":
                $Ku = $Ex . "\x20" . $ga;
                goto opW;
            case "\x4c\x4e\101\x4d\x45\x5f\106\116\101\x4d\105":
                $Ku = $ga . "\x20" . $Ex;
            default:
                goto opW;
        }
        k5Y:
        opW:
        eld:
        if (!empty($vP)) {
            goto mCr;
        }
        MO_Oauth_Debug::mo_oauth_log("\125\163\x65\x72\x6e\141\x6d\145\40\72\40" . $vP);
        $this->check_status(array("\155\163\147" => "\125\x73\x65\162\x6e\141\x6d\x65\x20\156\x6f\x74\40\162\x65\143\145\x69\x76\x65\144\x2e\x20\103\x68\x65\x63\153\x20\x79\x6f\x75\x72\40\x3c\163\x74\x72\x6f\x6e\x67\76\101\164\164\x72\151\x62\x75\164\x65\40\115\141\x70\160\x69\156\x67\74\57\163\164\x72\x6f\x6e\x67\x3e\x20\x63\157\x6e\x66\151\147\x75\x72\141\x74\151\x6f\156\56", "\143\157\144\x65" => "\x55\x4e\101\x4d\105", "\163\164\141\x74\165\163" => false, "\x61\160\x70\154\x69\143\141\x74\151\157\156" => $Wj, "\145\x6d\x61\x69\x6c" => '', "\x75\x73\145\x72\156\x61\x6d\x65" => ''), $z1);
        mCr:
        if (!(!empty($q3) && false === strpos($q3, "\x40"))) {
            goto D5v;
        }
        $this->check_status(array("\x6d\163\147" => "\115\141\160\x70\145\x64\40\x45\x6d\x61\151\154\40\x61\x74\164\162\151\142\165\x74\x65\x20\144\157\x65\x73\x20\x6e\157\164\x20\x63\x6f\156\164\141\x69\x6e\x20\166\x61\154\151\144\x20\x65\155\x61\151\x6c\x2e", "\143\157\x64\x65" => "\105\x4d\101\111\114", "\163\164\141\x74\x75\163" => false, "\141\160\x70\154\151\143\x61\x74\x69\157\156" => $Wj, "\143\x6c\151\145\x6e\164\x5f\151\160" => $lT->get_client_ip(), "\145\x6d\141\151\x6c" => $q3, "\165\x73\x65\x72\x6e\x61\x6d\x65" => $vP), $z1);
        D5v:
        if (!is_multisite()) {
            goto wzJ;
        }
        $blog_id = $Xc->get_value("\x62\x6c\157\147\137\151\x64");
        switch_to_blog($blog_id);
        do_action("\155\157\137\157\141\165\164\150\137\x63\154\151\x65\156\164\137\x63\x6f\156\x63\x6f\162\144\x5f\162\x65\163\164\162\151\143\x74\137\154\x6f\x67\x69\x6e", $FK, $tJ, $blog_id);
        wzJ:
        if (!has_action("\155\x6f\x5f\x6f\x61\x75\x74\x68\x5f\x63\x6c\x69\145\x6e\x74\x5f\x73\x61\x76\x65\x5f\165\163\145\x72\x5f\151\156\x5f\163\145\x73\x73\x69\157\156")) {
            goto yqD;
        }
        do_action("\155\x6f\137\x6f\141\165\164\x68\137\x63\x6c\x69\x65\156\x74\137\x73\141\x76\x65\x5f\165\163\x65\162\137\151\x6e\137\163\x65\x73\x73\151\157\x6e", array("\141\160\x70\137\143\x6f\x6e\x66\x69\x67" => $FK, "\x73\164\157\x72\141\147\145\x5f\155\141\156\x61\147\x65\162" => $Xc, "\162\145\163\157\x75\162\143\x65\137\x6f\167\156\145\162" => $tJ, "\165\x73\x65\x72\x6e\141\x6d\145" => $vP));
        yqD:
        do_action("\x6d\x6f\137\x6f\x61\165\x74\x68\x5f\162\145\163\164\162\x69\x63\164\137\x65\x6d\141\151\x6c\x73", $q3, $this->config);
        if (!has_filter("\x6d\157\x5f\157\x61\x75\x74\150\x5f\x6d\157\x64\151\146\x79\137\x75\x73\145\x72\x6e\141\x6d\x65\137\141\x74\164\x72")) {
            goto MKy;
        }
        $vP = apply_filters("\155\x6f\137\x6f\x61\x75\x74\150\x5f\155\x6f\144\151\x66\171\137\165\163\145\x72\x6e\x61\x6d\145\137\141\x74\164\162", $tJ);
        MKy:
        if (!has_filter("\x6d\157\x5f\x6f\141\165\x74\150\137\x63\x68\145\143\x6b\x5f\x75\163\x65\162\x5f\x61\x75\164\150\157\x72\x69\x73\x65\144")) {
            goto KUv;
        }
        $vP = apply_filters("\x6d\157\137\157\x61\165\164\x68\137\143\150\x65\x63\153\137\x75\163\x65\x72\137\x61\165\x74\x68\x6f\162\151\163\x65\x64", $tJ, $vP);
        KUv:
        $user = get_user_by("\x6c\157\147\x69\x6e", $vP);
        $CJ = isset($FK["\141\x6c\154\x6f\167\x5f\x64\x75\x70\154\151\143\x61\164\145\x5f\145\x6d\141\151\154\163"]) ? true : false;
        if ($user) {
            goto Jm2;
        }
        if (!(!$CJ || $CJ && !$FK["\x61\x6c\154\157\167\137\144\x75\160\x6c\151\x63\141\x74\x65\137\145\x6d\141\151\x6c\163"])) {
            goto DSA;
        }
        $user = get_user_by("\x65\155\x61\151\154", $q3);
        DSA:
        Jm2:
        $kM = $user ? $user->ID : 0;
        $Kv = 0 === $kM;
        if (!has_filter("\155\157\x5f\x6f\141\x75\x74\150\x5f\x67\x65\x74\x5f\x75\163\x65\162\x5f\x62\171\x5f\x65\x6d\x61\151\154")) {
            goto a9k;
        }
        $user = apply_filters("\155\157\x5f\x6f\x61\165\164\150\137\x67\145\164\137\x75\x73\145\162\x5f\142\171\137\x65\155\141\x69\x6c", $vP, $q3);
        a9k:
        if (!has_filter("\155\157\137\157\x61\x75\164\x68\x5f\x63\x68\x65\143\153\137\x75\163\x65\x72\x5f\142\171\137\x65\x6d\x61\x69\154")) {
            goto OGa;
        }
        $Kv = apply_filters("\x6d\x6f\137\x6f\141\165\x74\150\x5f\x63\150\145\143\x6b\x5f\165\163\x65\x72\x5f\142\171\x5f\x65\x6d\x61\x69\x6c", $vP, $q3);
        OGa:
        $kM = $user ? $user->ID : 0;
        if (!(isset($FK["\x61\165\x74\x6f\143\x72\145\141\164\145\165\163\x65\x72\163"]) && 1 !== intval($FK["\141\165\x74\157\143\162\145\x61\164\145\x75\163\x65\x72\x73"]))) {
            goto VNk;
        }
        $blog_id = 1;
        $WV = apply_filters("\x6d\x6f\x5f\157\141\165\x74\150\x5f\x63\x6c\151\x65\156\x74\137\x64\151\163\x61\x62\x6c\x65\137\141\x75\x74\157\x5f\x63\162\x65\x61\164\145\137\x75\163\145\x72\x73\x5f\146\x6f\162\x5f\163\160\145\143\x69\146\x69\x63\137\x69\x64\160", $kM, $blog_id, $this->config, $FK);
        $this->config = $WV[0];
        $FK = $WV[1];
        VNk:
        if (!(!(isset($this->config["\x61\x75\x74\x6f\x5f\x72\145\147\151\163\164\145\x72"]) && 1 === intval($this->config["\x61\x75\164\x6f\137\x72\145\x67\151\163\164\145\x72"])) && $Kv)) {
            goto de4;
        }
        $this->check_status(array("\x6d\x73\x67" => "\x52\145\x67\x69\x73\x74\x72\x61\x74\x69\157\x6e\40\x69\163\40\x64\x69\x73\141\x62\154\x65\144\40\x66\x6f\x72\40\164\x68\151\163\x20\163\151\164\x65\56\40\120\154\145\141\x73\145\x20\x63\x6f\x6e\164\141\x63\x74\x20\x79\x6f\165\162\x20\x61\144\x6d\151\156\151\163\164\x72\141\x74\157\162", "\x63\x6f\144\145" => "\x52\105\x47\111\123\124\x52\101\124\x49\117\x4e\137\104\111\123\x41\x42\114\105\104", "\163\164\x61\x74\165\163" => false, "\141\160\160\154\x69\x63\x61\164\x69\x6f\x6e" => $Wj, "\143\154\151\x65\x6e\164\x5f\151\x70" => $lT->get_client_ip(), "\x65\x6d\x61\151\154" => $q3, "\x75\163\145\162\x6e\141\x6d\x65" => $vP), $z1);
        de4:
        if (!$Kv) {
            goto xsa;
        }
        $k7 = 10;
        $Y0 = false;
        $N_ = false;
        $zB = apply_filters("\x6d\157\137\157\141\x75\164\150\x5f\160\x61\163\x73\167\157\162\144\137\160\157\154\151\143\171\x5f\x6d\x61\x6e\141\x67\x65\162", $k7);
        if (!is_array($zB)) {
            goto tIy;
        }
        $k7 = intval($zB["\160\x61\163\163\x77\157\162\144\137\x6c\x65\x6e\147\164\150"]);
        $Y0 = $zB["\x73\160\145\143\151\x61\154\x5f\143\x68\x61\x72\x61\x63\164\145\162\163"];
        $N_ = $zB["\145\x78\164\x72\x61\137\163\160\145\143\x69\141\154\137\143\150\x61\x72\141\143\x74\145\x72\163"];
        tIy:
        $mk = wp_generate_password($k7, $Y0, $N_);
        $Gk = get_user_by("\x65\155\141\151\154", $q3);
        if (!$Gk) {
            goto mRa;
        }
        add_filter("\160\x72\x65\137\x75\163\x65\x72\137\145\x6d\141\151\x6c", array($this, "\x73\x6b\x69\160\137\x65\x6d\x61\x69\154\137\145\x78\x69\x73\x74"), 30);
        mRa:
        $vP = apply_filters("\x6d\157\x5f\157\141\x75\164\x68\137\x67\x65\x74\137\x75\163\x65\x72\x6e\141\x6d\145\137\167\x69\164\150\x5f\160\157\163\164\146\x69\x78\137\x61\x64\x64\145\x64", $vP, $q3);
        $kM = wp_create_user($vP, $mk, $q3);
        if (!is_wp_error($kM)) {
            goto VZF;
        }
        MO_Oauth_Debug::mo_oauth_log("\x45\162\x72\x6f\x72\x20\143\x72\145\x61\x74\151\156\147\x20\x57\120\40\165\163\145\162");
        goto dsr;
        VZF:
        MO_Oauth_Debug::mo_oauth_log("\116\x65\x77\x20\x75\x73\145\162\40\143\x72\145\x61\164\145\144\40\75\76");
        MO_Oauth_Debug::mo_oauth_log("\x55\163\145\162\40\x49\104\x20\75\76\40" . $kM);
        dsr:
        $YK = array("\111\104" => $kM, "\x75\163\x65\x72\137\145\155\141\x69\154" => $q3, "\165\163\x65\162\x5f\154\x6f\147\x69\x6e" => $vP, "\165\163\x65\162\137\156\151\x63\145\156\x61\155\x65" => $vP);
        do_action("\165\163\x65\x72\137\x72\x65\x67\151\x73\164\145\x72", $kM, $YK);
        xsa:
        if (!($Kv || (!isset($this->config["\x6b\145\x65\x70\x5f\145\x78\151\x73\164\x69\x6e\x67\x5f\x75\163\145\x72\x73"]) || 1 !== intval($this->config["\x6b\x65\145\160\x5f\x65\x78\151\x73\x74\151\156\x67\137\165\x73\145\162\163"])))) {
            goto c4X;
        }
        if (!is_wp_error($kM)) {
            goto Rx8;
        }
        if (!get_user_by("\x6c\157\147\151\x6e", $vP)) {
            goto fBr;
        }
        $kM = get_user_by("\x6c\x6f\x67\151\156", $vP)->ID;
        fBr:
        Rx8:
        $SB = array("\x49\x44" => $kM, "\x66\x69\162\x73\164\x5f\156\x61\x6d\145" => $Ex, "\154\x61\x73\164\137\156\141\x6d\145" => $ga, "\144\x69\163\x70\x6c\x61\x79\137\156\x61\x6d\145" => $Ku, "\165\x73\x65\x72\137\154\157\147\x69\156" => $vP, "\x75\x73\x65\x72\137\156\151\x63\x65\156\x61\x6d\x65" => $vP);
        if (isset($this->config["\x6b\x65\x65\x70\x5f\145\170\x69\x73\164\x69\x6e\147\x5f\145\155\x61\151\154\x5f\141\164\164\162"]) && 1 === intval($this->config["\153\x65\145\x70\x5f\145\x78\x69\163\164\x69\x6e\x67\x5f\x65\x6d\141\x69\x6c\x5f\x61\x74\x74\x72"])) {
            goto InV;
        }
        $SB["\x75\163\145\162\x5f\145\x6d\x61\x69\x6c"] = $q3;
        wp_update_user($SB);
        MO_Oauth_Debug::mo_oauth_log("\101\164\164\x72\x69\x62\165\x74\x65\x20\115\141\160\160\x69\156\x67\40\x44\157\156\x65");
        goto PtF;
        InV:
        wp_update_user($SB);
        MO_Oauth_Debug::mo_oauth_log("\101\x74\x74\162\x69\142\x75\x74\145\x20\115\x61\160\160\151\x6e\147\40\104\157\x6e\x65");
        PtF:
        if (!isset($tJ["\x73\165\x62"])) {
            goto w3s;
        }
        update_user_meta($kM, "\x6d\x6f\x5f\x62\141\x63\153\143\x68\141\156\x6e\x65\x6c\137\x61\164\x74\162\x5f\163\x75\142", $tJ["\163\x75\142"]);
        w3s:
        if (!isset($tJ["\x73\x69\144"])) {
            goto FSh;
        }
        update_user_meta($kM, "\x6d\157\x5f\142\x61\143\x6b\x63\150\141\156\x6e\x65\154\137\x61\164\x74\162\x5f\x73\151\x64", $tJ["\163\x69\x64"]);
        FSh:
        update_user_meta($kM, "\x6d\x6f\x5f\x6f\141\x75\x74\x68\137\142\x75\144\x64\171\x70\x72\x65\x73\163\137\x61\164\x74\162\x69\x62\165\x74\145\163", $tJ);
        MO_Oauth_Debug::mo_oauth_log("\102\x75\x64\x64\x79\x50\x72\x65\x73\x73\x20\x61\164\x74\x72\x69\x62\x75\164\x65\x73\x20\x75\160\x64\x61\164\145\x64\40\x73\165\x63\x63\145\163\163\x66\165\154\154\171");
        c4X:
        $user = get_user_by("\111\104", $kM);
        MO_Oauth_Debug::mo_oauth_log("\x55\x73\145\162\40\x46\157\x75\156\x64");
        MO_Oauth_Debug::mo_oauth_log("\125\x73\145\162\40\111\x44\40\x3d\x3e\40" . $kM);
        $lb = $lT->is_multisite_plan();
        if (!is_multisite()) {
            goto GUf;
        }
        MO_Oauth_Debug::mo_oauth_log("\x4d\x75\154\x74\151\x73\151\x74\145\40\x50\x6c\x61\156");
        $dK = $lT->mo_oauth_client_get_option("\x6d\x6f\137\x6f\x61\165\x74\x68\x5f\143\63\x56\x69\143\x32\x6c\60\132\130\116\172\132\x57\x78\x6c\x59\x33\122\154\132\101");
        $f5 = array();
        if (!isset($dK)) {
            goto nuV;
        }
        $f5 = json_decode($lT->mooauthdecrypt($dK), true);
        nuV:
        $hE = false;
        if (!(is_array($f5) && in_array($blog_id, $f5))) {
            goto Tg4;
        }
        $hE = true;
        Tg4:
        $oq = intval($lT->mo_oauth_client_get_option("\156\157\117\146\123\165\x62\x53\151\x74\145\x73"));
        $DC = get_sites(["\156\165\x6d\142\145\162" => 1000]);
        if (!(is_multisite() && $lb && ($lb && !$hE && $oq < 1000))) {
            goto PEs;
        }
        $TA = "\x59\157\x75\x20\150\141\x76\145\40\156\157\164\x20\165\160\147\x72\141\x64\x65\144\x20\164\157\40\x74\150\x65\40\x63\157\x72\162\x65\x63\164\x20\154\x69\x63\x65\x6e\163\145\x20\x70\154\141\x6e\x2e\40\x45\x69\x74\x68\x65\x72\x20\171\157\x75\x20\x68\x61\x76\145\40\x70\x75\162\x63\150\x61\163\145\x64\x20\x66\x6f\162\x20\x69\x6e\x63\157\162\162\145\143\x74\40\156\x6f\56\40\157\x66\40\163\151\x74\x65\x73\40\x6f\162\x20\171\x6f\x75\40\x68\141\166\145\40\143\162\145\141\164\145\x64\40\141\40\x6e\145\167\40\x73\x75\x62\163\x69\x74\145\x2e\x20\103\157\156\164\x61\x63\164\40\164\x6f\40\171\x6f\x75\162\40\141\144\x6d\x69\156\x69\163\164\x72\x61\164\157\x72\40\164\157\40\165\160\x67\x72\141\x64\x65\x20\x79\x6f\x75\x72\40\163\165\x62\163\151\164\145\x2e";
        MO_Oauth_Debug::mo_oauth_log($TA);
        $lT->handle_error($TA);
        wp_die($TA);
        PEs:
        GUf:
        if ($user) {
            goto jXr;
        }
        return;
        jXr:
        $jK = '';
        if (isset($this->config["\x61\x66\x74\145\162\137\x6c\x6f\x67\151\x6e\x5f\x75\162\154"]) && '' !== $this->config["\x61\146\164\x65\x72\137\x6c\x6f\147\151\x6e\x5f\x75\162\x6c"]) {
            goto CXl;
        }
        $HD = $Xc->get_value("\x72\x65\x64\x69\x72\145\143\x74\137\165\162\151");
        $uc = parse_url($HD);
        if (!(isset($uc["\x70\x61\x74\x68"]) && strpos($uc["\x70\x61\164\150"], "\167\160\x2d\154\x6f\x67\151\156\x2e\x70\150\160") !== false)) {
            goto IOe;
        }
        $HD = site_url();
        IOe:
        if (!isset($uc["\161\x75\145\x72\171"])) {
            goto fay;
        }
        parse_str($uc["\x71\165\145\x72\171"], $ZO);
        if (!isset($ZO["\x72\x65\x64\x69\x72\x65\x63\x74\x5f\x74\x6f"])) {
            goto f7W;
        }
        $HD = $ZO["\162\145\144\151\162\145\143\x74\x5f\164\x6f"];
        f7W:
        fay:
        $jK = rawurldecode($HD && '' !== $HD ? $HD : site_url());
        if (!(strpos($jK, "\155\x6f\x5f\x63\x68\x61\x6e\147\145\x5f\x74\x6f\137\150\x61\x73\150") !== false)) {
            goto rN1;
        }
        $jK = str_replace("\x6d\x6f\137\x63\x68\x61\x6e\x67\145\x5f\164\157\137\x68\141\x73\150", "\x23", $jK);
        rN1:
        if (!has_filter("\x6d\x6f\137\x6f\x61\x75\164\150\137\144\x69\163\137\165\160\x64\141\164\x65\137\x61\x63\164\165\141\x6c\x5f\154\x69\156\x6b")) {
            goto HvK;
        }
        $jK = apply_filters("\x6d\x6f\x5f\x6f\141\165\164\x68\x5f\144\x69\x73\x5f\x75\160\144\141\164\x65\137\x61\143\164\165\x61\x6c\137\154\x69\156\153", $jK, $vP);
        HvK:
        goto ewn;
        CXl:
        $jK = $this->config["\141\146\x74\145\x72\x5f\x6c\x6f\147\151\156\137\x75\162\154"];
        ewn:
        if (!($lT->get_versi() === 1)) {
            goto O7A;
        }
        if (isset($FK["\145\156\x61\x62\x6c\x65\137\162\x6f\x6c\x65\x5f\155\x61\x70\x70\x69\156\x67"])) {
            goto XJX;
        }
        $FK["\145\156\x61\142\x6c\x65\x5f\162\x6f\x6c\x65\x5f\x6d\x61\160\160\x69\x6e\147"] = true;
        if (!(isset($FK["\143\154\151\145\x6e\x74\x5f\x63\162\145\x64\x73\x5f\x65\x6e\143\162\160\171\x74\x65\x64"]) && boolval($FK["\x63\154\x69\x65\x6e\x74\137\x63\162\x65\x64\x73\x5f\145\156\x63\162\x70\171\164\145\144"]))) {
            goto B0N;
        }
        $FK["\x63\154\x69\145\156\x74\x5f\151\x64"] = $lT->mooauthencrypt($FK["\x63\154\x69\x65\x6e\x74\x5f\x69\x64"]);
        $FK["\x63\154\151\x65\x6e\164\137\163\145\143\x72\145\164"] = $lT->mooauthencrypt($FK["\143\x6c\x69\x65\x6e\x74\137\163\x65\x63\162\145\x74"]);
        B0N:
        $lT->set_app_by_name($nt["\x61\160\x70\137\x6e\x61\155\x65"], $FK);
        XJX:
        if (!(!user_can($kM, "\141\x64\155\151\156\x69\163\164\x72\141\164\157\x72") && $Kv || !isset($FK["\153\145\145\160\137\145\x78\x69\x73\x74\151\156\147\x5f\165\x73\x65\162\x5f\x72\x6f\154\x65\163"]) || 1 !== intval($FK["\x6b\x65\x65\160\x5f\145\170\x69\x73\164\151\x6e\147\137\x75\163\145\x72\x5f\x72\157\x6c\145\x73"]))) {
            goto X6m;
        }
        $this->mo_oauth_client_map_default_role($kM, $FK);
        MO_Oauth_Debug::mo_oauth_log("\x52\x6f\x6c\x65\40\115\141\160\160\x69\x6e\147\x20\104\x6f\156\x65");
        X6m:
        O7A:
        do_action("\x6d\157\x5f\157\x61\165\x74\x68\137\x63\154\151\145\156\164\137\155\x61\160\x5f\x72\157\154\x65\x73", array("\x75\163\x65\x72\x5f\151\144" => $kM, "\141\160\x70\137\x63\x6f\156\x66\151\x67" => $FK, "\156\145\167\137\x75\x73\x65\x72" => $Kv, "\162\x65\163\157\165\x72\x63\145\137\x6f\x77\x6e\x65\x72" => $tJ, "\141\160\x70\137\x6e\141\155\145" => $Wj, "\143\157\156\x66\x69\147" => $this->config));
        MO_Oauth_Debug::mo_oauth_log("\122\157\x6c\x65\x20\115\141\160\160\151\156\147\x20\104\x6f\x6e\x65");
        do_action("\x6d\x6f\x5f\x6f\141\x75\164\x68\x5f\154\157\x67\x67\x65\144\137\151\x6e\x5f\165\x73\x65\162\137\x74\x6f\x6b\x65\x6e", $user, $hf);
        do_action("\155\157\x5f\x6f\141\x75\164\x68\137\141\x64\144\x5f\144\151\163\x5f\165\x73\145\162\x5f\x73\145\162\166\x65\x72", $kM, $hf, $tJ);
        $this->check_status(array("\155\163\x67" => "\x4c\157\x67\x69\x6e\40\x53\x75\143\143\145\163\163\146\x75\154\41", "\x63\x6f\144\x65" => "\114\117\x47\x49\116\x5f\123\x55\103\103\105\123\123", "\163\164\x61\164\165\x73" => true, "\141\x70\160\154\151\143\x61\164\x69\157\x6e" => $Wj, "\143\x6c\151\145\x6e\164\137\x69\x70" => $lT->get_client_ip(), "\x6e\x61\166\x69\147\141\164\x69\157\156\165\162\154" => $jK, "\145\155\x61\x69\154" => $q3, "\x75\163\145\162\156\141\155\145" => $vP), $z1);
        if (!$cn) {
            goto ZB9;
        }
        return $user;
        ZB9:
        do_action("\155\x6f\x5f\157\x61\x75\x74\150\137\163\x65\x74\x5f\154\x6f\147\x69\x6e\137\143\157\157\153\151\145");
        do_action("\155\x6f\137\157\x61\x75\x74\150\x5f\x67\145\164\x5f\165\x73\x65\162\x5f\x61\164\x74\162\x73", $user, $tJ);
        update_user_meta($user->ID, "\155\157\137\x6f\x61\165\164\150\137\x63\154\x69\x65\x6e\164\x5f\x6c\141\x73\x74\x5f\x69\x64\x5f\x74\x6f\x6b\x65\156", isset($hf["\x69\144\x5f\x74\157\x6b\x65\156"]) ? $hf["\151\x64\x5f\x74\x6f\153\145\156"] : $hf["\x61\x63\143\x65\x73\163\x5f\x74\157\x6b\145\x6e"]);
        wp_set_current_user($user->ID);
        $CY = false;
        $CY = apply_filters("\155\157\137\x72\x65\x6d\x65\155\142\145\x72\137\x6d\x65", $CY);
        wp_set_auth_cookie($user->ID, $CY);
        if (!isset($tJ["\162\x6f\x6c\145\163"])) {
            goto q8n;
        }
        apply_filters("\155\x6f\x5f\157\141\165\164\x68\137\x75\x70\144\141\x74\x65\x5f\x62\x62\160\137\162\x6f\x6c\x65", $user->ID, $tJ["\162\157\154\145\163"]);
        q8n:
        if (!has_action("\155\x6f\x5f\x68\x61\x63\153\x5f\154\157\x67\151\x6e\137\163\x65\163\163\151\157\x6e\137\x72\145\x64\x69\162\x65\143\x74")) {
            goto QUx;
        }
        $tu = $lT->gen_rand_str();
        $W4 = $lT->gen_rand_str();
        $zB = array("\x75\163\145\x72\x5f\151\x64" => $user->ID, "\165\x73\145\162\x5f\x70\141\163\163\x77\157\162\x64" => $W4);
        set_transient($tu, $zB);
        do_action("\x6d\x6f\x5f\x68\x61\143\153\137\154\157\147\x69\156\x5f\163\x65\163\163\151\157\x6e\x5f\x72\145\x64\151\162\145\x63\x74", $user, $W4, $tu, $jK);
        QUx:
        do_action("\167\160\137\x6c\x6f\147\151\156", $user->user_login, $user);
        setcookie("\155\157\137\x6f\141\x75\164\x68\137\x6c\x6f\x67\x69\x6e\x5f\141\160\160\x5f\163\x65\x73\163\x69\x6f\x6e", $Wj, null, "\57", null, true, true);
        do_action("\155\x6f\137\157\x61\x75\164\150\x5f\x67\x65\164\137\x74\157\153\145\156\137\x66\x6f\162\x5f\150\x65\x61\144\x6c\145\x73\163", $user, $hf, $jK);
        do_action("\x6d\157\x5f\157\141\x75\164\150\137\147\x65\x74\137\143\x75\x72\x72\145\156\164\x5f\141\x70\160\x6e\x61\x6d\145", $Wj);
        $Ic = $Xc->get_value("\162\x65\x73\x74\162\151\143\164\x72\x65\144\x69\x72\145\x63\164") !== false;
        $Xs = $Xc->get_value("\x70\x6f\x70\165\x70") === "\x69\147\x6e\x6f\162\x65";
        if (isset($this->config["\x70\x6f\160\165\160\137\x6c\157\147\x69\156"]) && 1 === intval($this->config["\160\157\x70\x75\x70\137\154\157\x67\x69\156"]) && !$Xs && !boolval($Ic)) {
            goto Ayz;
        }
        do_action("\x6d\x6f\x5f\157\141\x75\164\x68\x5f\162\x65\x64\x69\162\145\x63\164\137\x6f\x61\165\x74\x68\x5f\x75\x73\x65\x72\x73", $user, $jK);
        header("\x4c\157\143\x61\164\x69\x6f\x6e\72\x20" . $jK);
        goto iU9;
        Ayz:
        echo "\x3c\163\x63\x72\x69\x70\x74\76\x77\x69\x6e\x64\x6f\x77\56\x6f\x70\x65\x6e\x65\162\x2e\x48\141\x6e\x64\154\x65\120\157\x70\165\160\x52\x65\x73\x75\x6c\164\50\x22" . $jK . "\x22\x29\x3b\x77\x69\156\144\157\x77\56\143\154\x6f\163\x65\50\x29\73\x3c\x2f\x73\143\x72\x69\160\164\x3e";
        iU9:
        exit;
    }
    public function check_status($nt, $z1)
    {
        global $lT;
        if (isset($nt["\163\164\x61\164\165\163"])) {
            goto KuA;
        }
        MO_Oauth_Debug::mo_oauth_log("\123\x6f\x6d\145\164\x68\151\156\147\x20\167\x65\156\164\40\x77\x72\157\x6e\147\x2e\x20\120\x6c\145\x61\x73\145\40\x74\162\171\x20\114\157\x67\147\x69\156\147\40\x69\156\x20\x61\147\x61\x69\x6e\x2e");
        $lT->handle_error("\123\x6f\155\x65\164\150\x69\x6e\x67\x20\x77\145\156\x74\40\x77\162\x6f\x6e\x67\x2e\40\x50\x6c\x65\141\163\x65\x20\164\162\171\40\x4c\157\147\x67\x69\x6e\147\x20\x69\156\40\141\x67\x61\x69\156\56");
        wp_die(wp_kses("\123\157\x6d\145\164\150\x69\x6e\x67\x20\167\x65\156\x74\x20\167\162\x6f\x6e\x67\x2e\40\x50\154\x65\141\x73\x65\x20\x74\x72\x79\40\114\x6f\147\147\151\x6e\x67\40\x69\x6e\x20\141\147\141\151\156\56", \mo_oauth_get_valid_html()));
        KuA:
        if (!(isset($nt["\x73\164\x61\x74\165\163"]) && true === $nt["\163\164\x61\164\165\x73"] && (isset($nt["\x63\x6f\x64\145"]) && "\x4c\117\x47\x49\116\x5f\x53\125\x43\103\x45\123\x53" === $nt["\x63\x6f\144\x65"]))) {
            goto SAQ;
        }
        return true;
        SAQ:
        if (!(true !== $nt["\163\x74\x61\x74\x75\163"])) {
            goto O1a;
        }
        $WG = isset($nt["\x6d\x73\x67"]) && !empty($nt["\155\163\x67"]) ? $nt["\155\163\147"] : "\123\x6f\155\x65\x74\150\151\x6e\147\x20\x77\145\156\164\x20\167\x72\157\x6e\x67\56\40\x50\154\x65\x61\x73\x65\x20\164\162\x79\40\x4c\x6f\147\147\151\x6e\x67\x20\151\x6e\x20\x61\x67\141\x69\x6e\56";
        MO_Oauth_Debug::mo_oauth_log($WG);
        $lT->handle_error($WG);
        wp_die(wp_kses($WG, \mo_oauth_get_valid_html()));
        exit;
        O1a:
    }
    public function skip_email_exist($lp)
    {
        define("\x57\120\137\x49\115\x50\117\122\x54\111\x4e\107", "\123\x4b\111\120\x5f\x45\x4d\101\111\114\x5f\105\x58\111\123\124");
        return $lp;
    }
}
