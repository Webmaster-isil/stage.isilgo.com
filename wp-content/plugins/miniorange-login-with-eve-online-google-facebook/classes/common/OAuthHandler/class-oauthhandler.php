<?php


namespace MoOauthClient;

use MoOauthClient\OauthHandlerInterface;
class MO_Oauth_Debug
{
    public static function mo_oauth_log($Rb)
    {
        global $lT;
        $sg = plugin_dir_path(__FILE__) . $lT->mo_oauth_client_get_option("\x6d\157\x5f\157\141\165\164\x68\137\144\145\142\x75\x67") . "\x2e\x6c\x6f\x67";
        $p0 = time();
        $e_ = "\133" . date("\x59\55\x6d\55\144\x20\110\x3a\151\72\163", $p0) . "\x20\x55\x54\x43\135\x20\x3a\40" . print_r($Rb, true) . PHP_EOL;
        if (!$lT->mo_oauth_client_get_option("\155\x6f\137\x64\x65\142\165\147\137\145\156\x61\x62\154\145")) {
            goto Xl;
        }
        if ($lT->mo_oauth_client_get_option("\155\x6f\x5f\144\145\x62\165\147\137\x63\x68\145\143\x6b")) {
            goto N9;
        }
        error_log($e_, 3, $sg);
        goto wG;
        N9:
        $Rb = "\124\150\151\163\x20\x69\163\40\x6d\x69\x6e\x69\117\x72\x61\x6e\x67\145\x20\x4f\x41\x75\x74\x68\x20\160\x6c\165\147\151\x6e\x20\104\145\x62\x75\147\40\x4c\157\x67\40\x66\151\154\x65" . PHP_EOL;
        error_log($Rb, 3, $sg);
        wG:
        Xl:
    }
}
class OauthHandler implements OauthHandlerInterface
{
    public function get_token($oA, $nt, $o5 = true, $u0 = false)
    {
        MO_Oauth_Debug::mo_oauth_log("\x54\157\x6b\145\156\x20\162\x65\161\x75\145\x73\164\40\x63\157\x6e\x74\x65\156\164\x20\x3d\x3e\40");
        global $lT;
        $TA = new \WP_Error();
        $cn = isset($nt["\151\x73\137\x77\x70\137\x6c\x6f\x67\151\156"]) ? $nt["\x69\163\137\167\160\x5f\x6c\x6f\x67\x69\x6e"] : false;
        unset($nt["\151\163\137\167\160\x5f\154\x6f\147\151\x6e"]);
        foreach ($nt as $HH => $W7) {
            $nt[$HH] = html_entity_decode($W7);
            Lq:
        }
        lg:
        $oM = '';
        if (!isset($nt["\x63\x6c\151\x65\156\164\x5f\x73\145\x63\162\145\x74"])) {
            goto OM;
        }
        $oM = $nt["\x63\x6c\x69\145\x6e\164\x5f\163\145\x63\162\145\x74"];
        OM:
        $Da = array("\x41\x63\143\145\x70\x74" => "\x61\x70\x70\154\151\x63\x61\x74\151\x6f\x6e\57\x6a\x73\157\156", "\143\x68\x61\162\163\145\164" => "\x55\x54\x46\x20\55\x20\70", "\103\157\x6e\164\145\x6e\164\x2d\x54\x79\160\x65" => "\x61\160\160\154\151\x63\141\164\x69\x6f\156\57\170\55\x77\x77\167\x2d\x66\157\x72\x6d\55\165\x72\x6c\145\x6e\x63\x6f\x64\x65\144", "\x41\x75\x74\x68\x6f\162\x69\x7a\141\x74\x69\x6f\x6e" => "\x42\141\163\151\143\40" . base64_encode($nt["\x63\154\x69\145\x6e\164\137\151\x64"] . "\x3a" . $oM));
        $Da = apply_filters("\x6d\x6f\137\x6f\x61\x75\164\150\x5f\x63\157\165\x73\164\157\x6d\137\145\x78\164\x65\156\x64\x5f\164\157\x6b\145\x6e\145\156\x64\160\157\151\156\x74\x5f\160\141\162\141\155\x73", $Da);
        if (!(isset($nt["\x63\x6f\x64\x65\x5f\x76\145\162\151\x66\151\145\162"]) && !isset($nt["\x63\154\x69\x65\x6e\x74\137\x73\145\143\x72\x65\x74"]))) {
            goto d3;
        }
        unset($Da["\x41\x75\164\x68\157\162\x69\172\x61\164\x69\x6f\156"]);
        d3:
        if (1 == $o5 && 0 == $u0) {
            goto BH;
        }
        if (0 == $o5 && 1 == $u0) {
            goto gM;
        }
        goto bq;
        BH:
        unset($nt["\x63\x6c\x69\145\x6e\164\137\151\144"]);
        if (!isset($nt["\143\154\151\x65\x6e\x74\137\163\145\143\x72\x65\x74"])) {
            goto nm;
        }
        unset($nt["\143\154\151\x65\x6e\x74\137\163\x65\x63\162\145\164"]);
        nm:
        goto bq;
        gM:
        if (!isset($Da["\101\165\x74\150\157\162\151\172\x61\164\151\157\x6e"])) {
            goto H6;
        }
        unset($Da["\101\165\x74\x68\157\x72\151\x7a\141\x74\x69\157\156"]);
        H6:
        bq:
        MO_Oauth_Debug::mo_oauth_log("\124\x6f\153\x65\156\x20\x65\x6e\144\160\157\151\156\x74\40\x55\122\114\x20\75\x3e\x20" . $oA);
        $nt = apply_filters("\x6d\157\137\157\141\165\x74\x68\137\x70\x6f\x6c\141\x72\137\x62\x6f\x64\x79\137\x61\162\x67\x75\x6d\145\156\164\x73", $nt);
        MO_Oauth_Debug::mo_oauth_log("\x62\157\x64\x79\x20\75\76");
        MO_Oauth_Debug::mo_oauth_log($nt);
        MO_Oauth_Debug::mo_oauth_log("\x68\145\x61\144\x65\162\163\x20\x3d\x3e");
        MO_Oauth_Debug::mo_oauth_log($Da);
        $Qv = wp_remote_post($oA, array("\155\x65\164\x68\x6f\x64" => "\x50\x4f\x53\124", "\x74\151\x6d\x65\x6f\165\164" => 45, "\x72\145\144\151\x72\145\143\x74\x69\x6f\x6e" => 5, "\150\x74\x74\x70\166\145\x72\x73\151\x6f\156" => "\x31\x2e\60", "\x62\154\x6f\143\153\x69\x6e\x67" => true, "\x68\x65\x61\x64\x65\x72\x73" => $Da, "\x62\157\x64\171" => $nt, "\143\x6f\157\x6b\151\145\x73" => array(), "\x73\x73\x6c\x76\145\x72\x69\x66\x79" => false));
        if (!is_wp_error($Qv)) {
            goto fS;
        }
        $lT->handle_error($Qv->get_error_message());
        MO_Oauth_Debug::mo_oauth_log("\105\162\x72\x6f\x72\x20\x66\162\x6f\155\40\124\157\x6b\x65\156\40\x45\156\144\x70\x6f\151\156\164\72\40" . $Qv->get_error_message());
        wp_die(wp_kses($Qv->get_error_message(), \mo_oauth_get_valid_html()));
        exit;
        fS:
        $Qv = $Qv["\x62\157\144\x79"];
        if (is_array(json_decode($Qv, true))) {
            goto yq;
        }
        $lT->handle_error("\x49\156\166\x61\x6c\151\x64\40\x72\x65\x73\x70\157\x6e\163\145\40\x72\x65\x63\145\x69\166\x65\144\40\72\x20" . $Qv);
        echo "\x3c\x73\x74\162\157\x6e\147\x3e\x52\x65\163\x70\157\156\163\x65\40\x3a\x20\x3c\x2f\163\164\162\x6f\x6e\147\76\74\x62\162\x3e";
        print_r($Qv);
        echo "\x3c\x62\x72\x3e\x3c\142\162\x3e";
        MO_Oauth_Debug::mo_oauth_log("\x45\162\x72\157\x72\40\x66\x72\x6f\x6d\x20\124\x6f\153\145\156\x20\105\x6e\144\160\x6f\151\156\164\75\76\40\x49\x6e\x76\x61\154\151\x64\40\122\145\163\160\x6f\156\163\145\40\x72\145\143\145\151\166\145\x64\x2e" . $Qv);
        exit("\x49\x6e\166\141\x6c\151\144\x20\x72\x65\x73\x70\157\156\x73\145\40\x72\145\x63\x65\x69\166\x65\144\x2e");
        yq:
        $VI = json_decode($Qv, true);
        if (isset($VI["\145\x72\x72\157\x72\x5f\x64\145\163\143\162\x69\160\x74\151\x6f\156"])) {
            goto WR;
        }
        if (isset($VI["\145\x72\162\x6f\x72"])) {
            goto U3;
        }
        goto Ua;
        WR:
        do_action("\155\157\137\x72\x65\144\x69\162\145\143\x74\x5f\x74\157\137\x63\165\x73\x74\157\x6d\x5f\145\x72\x72\x6f\x72\137\160\141\147\x65");
        if (!($nt["\x67\x72\x61\156\x74\137\x74\x79\160\x65"] == "\160\141\x73\163\x77\x6f\x72\x64" && $cn)) {
            goto k1;
        }
        $TA->add("\155\157\137\x6f\x61\165\164\150\x5f\x69\x64\x70\137\145\x72\x72\x6f\162", __("\x3c\x73\x74\162\x6f\x6e\x67\76\105\122\x52\117\122\74\x2f\x73\x74\162\157\x6e\147\76\72\40" . $VI["\145\x72\162\x6f\x72\137\x64\145\163\143\162\x69\160\164\x69\157\x6e"]));
        return $TA;
        k1:
        $lT->handle_error($VI["\145\x72\162\x6f\162\x5f\144\x65\x73\143\x72\x69\x70\164\x69\157\156"]);
        $this->handle_error(json_encode($VI["\x65\x72\162\157\x72\x5f\x64\x65\x73\x63\x72\x69\160\164\x69\x6f\x6e"]), $nt);
        return;
        goto Ua;
        U3:
        do_action("\155\157\137\x72\145\144\151\162\x65\143\164\x5f\x74\x6f\137\x63\x75\163\x74\x6f\155\x5f\145\x72\x72\x6f\x72\137\160\x61\147\145");
        if (!($nt["\147\x72\x61\x6e\x74\137\164\171\160\x65"] == "\x70\141\163\163\x77\157\162\x64" && $cn)) {
            goto Uv;
        }
        $TA->add("\x6d\157\137\157\141\165\x74\x68\137\151\144\160\137\145\x72\x72\x6f\162", __("\x3c\x73\164\162\157\x6e\x67\76\x45\122\x52\117\x52\x3c\57\x73\x74\x72\157\x6e\x67\x3e\72\40" . $VI["\145\162\x72\157\162"]));
        return $TA;
        Uv:
        $lT->handle_error($VI["\x65\x72\x72\x6f\x72"]);
        $this->handle_error(json_encode($VI["\x65\162\x72\x6f\x72"]), $nt);
        return;
        Ua:
        return $Qv;
    }
    public function get_atoken($oA, $nt, $NR, $o5 = true, $u0 = false)
    {
        global $lT;
        foreach ($nt as $HH => $W7) {
            $nt[$HH] = html_entity_decode($W7);
            qW:
        }
        wd:
        $oM = '';
        if (!isset($nt["\143\x6c\151\145\156\x74\137\x73\x65\143\x72\x65\164"])) {
            goto jB;
        }
        $oM = $nt["\x63\x6c\x69\145\156\164\137\163\145\143\x72\145\x74"];
        jB:
        $M4 = $nt["\143\x6c\151\x65\x6e\x74\x5f\x69\144"];
        $Da = array("\x41\x63\x63\145\160\164" => "\141\160\x70\x6c\x69\x63\x61\x74\151\157\x6e\x2f\152\163\x6f\156", "\x63\x68\141\x72\163\x65\x74" => "\x55\124\106\x20\55\x20\70", "\103\157\x6e\x74\x65\156\164\x2d\x54\x79\x70\x65" => "\x61\160\160\x6c\x69\143\x61\164\151\157\x6e\57\x78\x2d\167\x77\x77\x2d\146\157\162\155\x2d\165\x72\154\145\156\143\x6f\144\x65\x64", "\101\x75\164\150\157\x72\151\172\141\164\x69\x6f\156" => "\102\x61\163\x69\x63\40" . base64_encode($M4 . "\72" . $oM));
        $Da = apply_filters("\x6d\x6f\x5f\157\x61\165\x74\150\137\x63\157\x75\163\164\157\155\137\145\x78\164\145\x6e\144\x5f\x74\x6f\x6b\x65\x6e\x65\x6e\x64\x70\157\151\156\164\137\160\x61\x72\141\155\x73", $Da);
        if (!isset($nt["\x63\x6f\x64\x65\137\x76\145\162\151\x66\x69\x65\162"])) {
            goto Uo;
        }
        unset($Da["\x41\165\164\150\157\x72\151\x7a\141\164\x69\157\156"]);
        Uo:
        if (1 === $o5 && 0 === $u0) {
            goto Kl;
        }
        if (0 === $o5 && 1 === $u0) {
            goto Od;
        }
        goto dZ;
        Kl:
        unset($nt["\x63\x6c\x69\145\x6e\164\137\x69\144"]);
        if (!isset($nt["\143\x6c\151\x65\x6e\x74\137\x73\x65\x63\162\145\x74"])) {
            goto wg;
        }
        unset($nt["\x63\x6c\151\145\156\164\137\x73\x65\x63\x72\145\x74"]);
        wg:
        goto dZ;
        Od:
        if (!isset($Da["\101\165\164\150\157\x72\151\172\x61\164\151\157\156"])) {
            goto j_;
        }
        unset($Da["\x41\165\x74\x68\x6f\162\151\x7a\x61\x74\151\157\156"]);
        j_:
        dZ:
        $v3 = curl_init($oA);
        curl_setopt($v3, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($v3, CURLOPT_ENCODING, '');
        curl_setopt($v3, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($v3, CURLOPT_AUTOREFERER, true);
        curl_setopt($v3, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($v3, CURLOPT_MAXREDIRS, 10);
        curl_setopt($v3, CURLOPT_POST, true);
        curl_setopt($v3, CURLOPT_HTTPHEADER, array("\101\165\164\150\x6f\162\151\x7a\141\x74\x69\157\156\72\40\102\141\163\151\143\40" . base64_encode($M4 . "\x3a" . $oM), "\x41\143\x63\x65\160\164\x3a\x20\x61\160\x70\154\x69\143\x61\x74\151\157\156\x2f\152\163\157\x6e"));
        curl_setopt($v3, CURLOPT_POSTFIELDS, "\162\x65\x64\151\x72\x65\x63\164\x5f\x75\x72\151\75" . $nt["\162\x65\x64\x69\162\145\x63\x74\137\x75\x72\x69"] . "\46\x67\162\x61\156\164\137\x74\171\x70\145\75" . "\x61\x75\x74\150\x6f\162\x69\172\x61\x74\x69\x6f\156\x5f\x63\157\144\x65" . "\46\143\154\151\x65\x6e\164\137\151\x64\75" . $M4 . "\46\x63\x6c\151\x65\x6e\x74\137\163\145\143\x72\x65\164\75" . $oM . "\46\143\157\144\145\x3d" . $NR);
        $VI = curl_exec($v3);
        if (!curl_error($v3)) {
            goto aX;
        }
        echo "\x3c\142\76\x52\145\163\160\157\156\x73\145\40\72\x20\x3c\x2f\x62\76\x3c\x62\162\76";
        print_r($VI);
        echo "\x3c\x62\x72\76\x3c\142\x72\76";
        MO_Oauth_Debug::mo_oauth_log(curl_error($v3));
        exit(curl_error($v3));
        aX:
        if (isset($VI["\x65\162\162\157\x72\137\144\145\x73\x63\x72\151\x70\x74\151\157\156"])) {
            goto A5;
        }
        if (isset($VI["\x65\162\162\x6f\162"])) {
            goto IP;
        }
        if (!isset($VI["\141\143\x63\x65\163\163\x5f\x74\157\x6b\x65\x6e"])) {
            goto CP;
        }
        $T2 = $VI["\141\143\x63\x65\163\163\137\164\157\153\x65\156"];
        CP:
        goto ps;
        IP:
        $gl = "\x45\162\162\x6f\x72\40\x66\162\x6f\x6d\40\x54\157\153\x65\x6e\x20\x45\x6e\144\x70\x6f\x69\156\164\72\x20" . $VI["\x65\x72\162\x6f\162"];
        MO_Oauth_Debug::mo_oauth_log($gl);
        do_action("\x6d\x6f\x5f\162\145\144\151\x72\145\143\x74\137\x74\157\x5f\x63\x75\163\x74\x6f\x6d\x5f\145\x72\x72\x6f\x72\x5f\x70\141\147\x65");
        exit($VI["\x65\162\162\157\162\137\x64\x65\x73\143\x72\x69\x70\x74\151\x6f\156"]);
        ps:
        goto KU;
        A5:
        $gl = "\105\162\162\157\162\40\x66\x72\x6f\155\40\x54\x6f\x6b\145\156\40\x45\x6e\144\x70\157\151\x6e\164\72\x20" . $VI["\145\x72\162\157\x72\137\144\145\163\x63\162\151\x70\164\x69\x6f\156"];
        MO_Oauth_Debug::mo_oauth_log($gl);
        do_action("\155\157\x5f\x72\145\144\x69\x72\x65\143\x74\137\x74\x6f\x5f\143\x75\163\164\157\x6d\137\145\162\x72\157\162\137\x70\141\147\145");
        exit($VI["\145\162\x72\x6f\162\x5f\144\145\x73\143\x72\x69\160\x74\151\157\x6e"]);
        KU:
        return $VI;
    }
    public function get_access_token($oA, $nt, $o5, $u0)
    {
        global $lT;
        $Qv = $this->get_token($oA, $nt, $o5, $u0);
        if (!is_wp_error($Qv)) {
            goto n3;
        }
        return $Qv;
        n3:
        $VI = json_decode($Qv, true);
        if (!("\160\x61\163\x73\167\x6f\162\144" === $nt["\x67\x72\141\156\x74\137\164\171\x70\x65"])) {
            goto FA;
        }
        return $VI;
        FA:
        if (isset($VI["\x61\x63\143\145\163\163\x5f\x74\x6f\153\x65\x6e"])) {
            goto kq;
        }
        $TA = "\x49\156\166\141\x6c\x69\x64\40\x72\145\163\160\x6f\x6e\x73\145\x20\162\x65\143\145\151\x76\145\x64\40\146\162\157\155\x20\x4f\x41\165\x74\150\40\x50\162\157\166\151\144\145\162\56\40\x43\157\x6e\164\x61\x63\164\40\x79\x6f\165\x72\40\x61\x64\x6d\151\156\151\163\x74\162\141\x74\x6f\x72\x20\146\157\162\40\x6d\157\162\145\40\x64\145\x74\141\x69\154\163\x2e\74\x62\162\76\x3c\x62\162\76\x3c\x73\164\x72\x6f\156\x67\x3e\x52\145\x73\160\x6f\x6e\163\145\40\x3a\x20\x3c\x2f\x73\x74\x72\x6f\156\x67\x3e\x3c\x62\162\76" . $Qv;
        $lT->handle_error($TA);
        MO_Oauth_Debug::mo_oauth_log("\x45\x72\x72\x6f\162\x20\x77\x68\x69\154\145\40\146\x65\164\x63\150\151\x6e\x67\x20\164\x6f\153\x65\156\x3a\x20" . $TA);
        echo $TA;
        exit;
        goto PG;
        kq:
        return $VI["\141\143\x63\145\x73\163\137\164\157\x6b\x65\x6e"];
        PG:
    }
    public function get_id_token($oA, $nt, $o5, $u0)
    {
        global $lT;
        $Qv = $this->get_token($oA, $nt, $o5, $u0);
        $VI = json_decode($Qv, true);
        if (isset($VI["\151\x64\137\164\x6f\153\145\156"])) {
            goto rO;
        }
        $TA = "\111\156\166\x61\154\x69\144\x20\162\x65\163\x70\157\156\x73\x65\x20\162\145\143\x65\151\166\145\x64\40\x66\162\x6f\155\40\x4f\160\x65\x6e\111\x64\40\x50\x72\x6f\x76\x69\144\145\162\56\40\103\157\156\x74\141\x63\x74\40\171\157\x75\162\x20\141\144\155\x69\x6e\151\x73\164\x72\141\x74\x6f\162\x20\146\x6f\162\x20\155\157\162\x65\x20\x64\145\164\141\151\x6c\163\x2e\74\x62\x72\x3e\74\142\x72\x3e\74\x73\x74\162\157\x6e\147\x3e\x52\x65\x73\x70\157\x6e\x73\145\x20\x3a\x20\x3c\x2f\x73\164\x72\x6f\156\147\76\x3c\x62\162\76" . $Qv;
        $lT->handle_error($TA);
        MO_Oauth_Debug::mo_oauth_log("\105\162\x72\x6f\162\x20\x77\x68\x69\154\x65\x20\x66\145\164\x63\150\x69\156\147\x20\x69\x64\x5f\x74\157\153\x65\x6e\x3a\40" . $TA);
        echo $TA;
        exit;
        goto xB;
        rO:
        return $VI;
        xB:
    }
    public function get_resource_owner_from_id_token($M3)
    {
        global $lT;
        $Ne = explode("\56", $M3);
        if (!isset($Ne[1])) {
            goto XV;
        }
        $ka = $lT->base64url_decode($Ne[1]);
        if (!is_array(json_decode($ka, true))) {
            goto S0;
        }
        return json_decode($ka, true);
        S0:
        XV:
        $TA = "\x49\156\166\x61\x6c\151\144\40\162\145\x73\x70\x6f\x6e\x73\x65\40\162\145\x63\x65\151\x76\x65\144\56\74\142\x72\x3e\x3c\x73\x74\x72\157\x6e\147\x3e\151\144\137\164\x6f\153\x65\156\40\x3a\x20\74\57\x73\164\x72\x6f\156\147\x3e" . $M3;
        $lT->handle_error($TA);
        MO_Oauth_Debug::mo_oauth_log("\x45\x72\x72\x6f\x72\40\x77\x68\x69\154\145\x20\x66\x65\x74\x63\x68\151\x6e\x67\40\162\145\x73\157\x75\162\143\x65\40\157\167\156\x65\x72\x20\146\162\157\x6d\40\x69\x64\40\164\157\153\x65\156\72" . $TA);
        echo $TA;
        exit;
    }
    public function get_resource_owner($Ts, $T2)
    {
        global $lT;
        $Da = array();
        $Da["\x41\165\164\x68\157\x72\x69\172\x61\164\x69\157\x6e"] = "\x42\x65\141\162\145\x72\x20" . $T2;
        $Da = apply_filters("\155\x6f\x5f\145\x78\x74\x65\156\144\137\x75\163\145\162\x69\156\x66\x6f\x5f\x70\141\x72\x61\155\163", $Da, $Ts);
        MO_Oauth_Debug::mo_oauth_log("\x52\x65\x73\x6f\x75\x72\143\145\x20\x4f\167\156\x65\x72\x20\x45\x6e\x64\x70\x6f\151\156\164\40\75\76\x20" . $Ts);
        MO_Oauth_Debug::mo_oauth_log("\122\145\163\157\165\x72\143\x65\40\117\x77\156\x65\x72\x20\x72\x65\161\x75\145\x73\164\x20\x63\x6f\156\164\x65\156\x74\x20\x3d\76\40");
        MO_Oauth_Debug::mo_oauth_log("\150\145\x61\144\x65\x72\163\40\x3d\76");
        MO_Oauth_Debug::mo_oauth_log($Da);
        $Ts = apply_filters("\155\x6f\x5f\157\x61\x75\164\150\x5f\165\x73\x65\162\x69\156\146\157\x5f\151\156\164\145\162\156\141\x6c", $Ts);
        $Qv = wp_remote_post($Ts, array("\x6d\145\x74\x68\157\x64" => "\107\x45\124", "\x74\151\x6d\145\157\x75\x74" => 45, "\162\x65\144\151\162\145\143\x74\x69\x6f\x6e" => 5, "\x68\164\x74\160\166\145\x72\x73\151\x6f\x6e" => "\x31\56\x30", "\142\154\157\x63\x6b\x69\x6e\x67" => true, "\150\145\x61\144\145\x72\x73" => $Da, "\x63\157\x6f\153\x69\145\x73" => array(), "\163\x73\x6c\166\145\x72\x69\x66\x79" => false));
        if (!is_wp_error($Qv)) {
            goto Mt;
        }
        $lT->handle_error($Qv->get_error_message());
        MO_Oauth_Debug::mo_oauth_log("\105\162\x72\x6f\x72\40\146\x72\x6f\x6d\x20\x52\x65\x73\x6f\x75\162\x63\145\40\105\156\x64\x70\x6f\151\x6e\x74\x3a\x20" . $Qv->get_error_message());
        wp_die(wp_kses($Qv->get_error_message(), \mo_oauth_get_valid_html()));
        exit;
        Mt:
        $Qv = $Qv["\142\157\x64\171"];
        if (is_array(json_decode($Qv, true))) {
            goto Ud;
        }
        $lT->handle_error("\111\x6e\166\x61\154\151\144\40\x72\145\x73\160\x6f\156\x73\145\x20\162\145\x63\145\151\166\145\144\40\x3a\40" . $Qv);
        echo "\74\163\x74\162\157\x6e\x67\76\x52\145\x73\160\x6f\x6e\x73\145\x20\72\40\x3c\x2f\163\164\162\157\x6e\147\76\x3c\142\162\76";
        print_r($Qv);
        echo "\x3c\142\x72\x3e\74\142\x72\x3e";
        MO_Oauth_Debug::mo_oauth_log("\111\x6e\x76\x61\154\151\x64\x20\x72\145\x73\160\x6f\x6e\163\145\40\162\x65\143\151\145\x76\145\144\40\x77\x68\151\x6c\145\x20\146\x65\x74\x63\150\151\156\x67\x20\162\x65\x73\x6f\x75\x72\143\145\40\x6f\167\x6e\145\x72\40\144\145\x74\141\x69\x6c\x73");
        exit("\x49\156\166\141\x6c\151\x64\40\162\145\163\x70\x6f\156\x73\x65\40\162\x65\143\x65\x69\166\x65\x64\56");
        Ud:
        $VI = json_decode($Qv, true);
        if (!(strpos($Ts, "\x61\x70\151\x2e\143\x6c\145\x76\145\x72\x2e\x63\x6f\x6d") != false && isset($VI["\154\151\156\x6b\163"][1]["\165\x72\x69"]) && strpos($Ts, $VI["\154\151\x6e\153\x73"][1]["\x75\162\151"]) === false)) {
            goto FG;
        }
        $uy = $VI["\154\151\156\x6b\x73"][1]["\x75\162\151"];
        $p8 = "\x68\164\x74\160\x73\x3a\57\57\141\160\x69\56\143\154\145\166\x65\x72\56\x63\157\x6d" . $uy;
        $lT->mo_oauth_client_update_option("\x6d\x6f\x5f\x6f\x61\165\x74\x68\137\143\154\151\x65\x6e\164\137\x63\x6c\145\166\x65\x72\x5f\165\163\145\162\x5f\x61\x70\151", $p8);
        $VI = $this->get_resource_owner($p8, $T2);
        FG:
        if (isset($VI["\145\162\162\157\162\137\144\145\163\143\162\x69\160\x74\x69\x6f\x6e"])) {
            goto Tk;
        }
        if (isset($VI["\x65\162\x72\157\x72"])) {
            goto eU;
        }
        goto tq;
        Tk:
        $gl = "\105\162\x72\157\162\x20\146\x72\157\x6d\40\x52\x65\x73\x6f\x75\x72\143\145\x20\105\156\x64\160\157\x69\x6e\x74\72\40" . $VI["\x65\162\x72\157\162\137\144\x65\x73\143\162\x69\x70\164\151\157\x6e"];
        $lT->handle_error($VI["\145\162\162\x6f\x72\x5f\144\145\163\143\x72\x69\160\x74\x69\157\x6e"]);
        MO_Oauth_Debug::mo_oauth_log($gl);
        do_action("\x6d\157\x5f\x72\x65\x64\151\x72\x65\143\x74\x5f\x74\157\x5f\x63\x75\x73\164\157\x6d\137\145\162\x72\x6f\x72\x5f\160\141\x67\x65");
        exit(json_encode($VI["\145\x72\162\157\162\137\144\145\x73\x63\x72\x69\160\164\151\x6f\156"]));
        goto tq;
        eU:
        $gl = "\x45\162\162\x6f\x72\x20\x66\162\x6f\155\40\122\145\163\157\165\162\143\145\40\105\x6e\x64\x70\157\x69\156\164\72\x20" . $VI["\x65\x72\162\157\162"];
        $lT->handle_error($VI["\145\x72\162\157\162"]);
        MO_Oauth_Debug::mo_oauth_log($gl);
        do_action("\x6d\157\137\162\145\x64\x69\162\x65\x63\x74\x5f\x74\157\137\143\165\163\164\x6f\x6d\x5f\x65\x72\x72\x6f\x72\x5f\160\141\x67\x65");
        exit(json_encode($VI["\x65\162\162\x6f\162"]));
        tq:
        return $VI;
    }
    public function get_response($cX)
    {
        $Qv = wp_remote_get($cX, array("\x6d\x65\164\x68\x6f\144" => "\x47\x45\x54", "\164\x69\x6d\x65\157\x75\164" => 45, "\162\145\x64\151\162\145\x63\164\x69\x6f\x6e" => 5, "\150\164\164\x70\166\145\x72\x73\151\157\156" => 1.0, "\142\154\157\143\153\x69\x6e\x67" => true, "\150\x65\x61\x64\145\162\163" => array(), "\x63\157\157\153\x69\x65\163" => array(), "\x73\163\x6c\166\x65\x72\x69\x66\171" => false));
        if (!is_wp_error($Qv)) {
            goto d8;
        }
        MO_Oauth_Debug::mo_oauth_log($Qv->get_error_message());
        wp_die(wp_kses($Qv->get_error_message(), \mo_oauth_get_valid_html()));
        exit;
        d8:
        $Qv = $Qv["\x62\157\x64\171"];
        $VI = json_decode($Qv, true);
        if (isset($VI["\x65\162\x72\157\162\x5f\144\x65\x73\143\162\x69\160\164\x69\157\x6e"])) {
            goto Y6;
        }
        if (isset($VI["\145\x72\162\x6f\162"])) {
            goto Qa;
        }
        goto o5;
        Y6:
        $lT->handle_error($VI["\145\162\x72\x6f\x72\x5f\144\145\x73\x63\162\151\x70\164\x69\157\156"]);
        MO_Oauth_Debug::mo_oauth_log($gl);
        do_action("\x6d\157\x5f\162\145\x64\x69\x72\x65\143\164\137\x74\x6f\x5f\143\x75\x73\x74\x6f\155\137\145\x72\x72\x6f\x72\x5f\160\141\x67\x65");
        goto o5;
        Qa:
        $lT->handle_error($VI["\145\x72\x72\157\162"]);
        MO_Oauth_Debug::mo_oauth_log($gl);
        do_action("\x6d\157\x5f\162\145\144\151\162\145\x63\x74\137\164\157\x5f\x63\165\163\x74\x6f\x6d\x5f\145\162\x72\157\x72\x5f\x70\x61\147\x65");
        o5:
        return $VI;
    }
    private function handle_error($TA, $nt)
    {
        global $lT;
        if (!($nt["\147\x72\x61\156\164\x5f\164\x79\x70\145"] === "\160\x61\x73\163\x77\x6f\x72\x64")) {
            goto UQ;
        }
        $Dl = $lT->get_current_url();
        $Dl = apply_filters("\x6d\x6f\x5f\157\141\165\x74\x68\x5f\x77\x6f\x6f\143\157\155\155\145\162\143\145\x5f\143\x68\145\143\153\157\165\x74\x5f\x63\x6f\155\160\x61\x74\x69\x62\x69\x6c\151\x74\171", $Dl);
        if ($Dl != '') {
            goto ag;
        }
        return;
        goto tk;
        ag:
        $Dl = "\x3f\x6f\x70\x74\151\157\x6e\75\145\162\162\157\x72\155\x61\156\141\147\145\162\x26\x65\x72\x72\157\162\75" . \base64_encode($TA);
        MO_Oauth_Debug::mo_oauth_log("\105\162\162\157\162\x3a\x20" . $TA);
        wp_die($TA);
        exit;
        tk:
        UQ:
        MO_Oauth_Debug::mo_oauth_log("\x45\162\x72\157\162\72\40" . $TA);
        exit($TA);
    }
}
