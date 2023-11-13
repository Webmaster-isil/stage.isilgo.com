<?php


namespace MoOauthClient;

use MoOauthClient\MO_Custom_OAuth1;
use MoOauthClient\MO_Oauth_Debug;
class MO_Custom_OAuth1
{
    public static function mo_oauth1_auth_request($Ig)
    {
        global $lT;
        $FK = $lT->get_app_by_name($Ig)->get_app_config();
        $M4 = $FK["\x63\x6c\151\x65\156\x74\137\151\144"];
        $oM = $FK["\143\x6c\151\145\x6e\164\137\x73\x65\143\162\145\164"];
        $b3 = $FK["\x61\165\164\x68\157\x72\151\x7a\x65\x75\x72\154"];
        $CE = $FK["\x72\145\161\165\145\163\x74\165\162\x6c"];
        $Gh = $FK["\x61\x63\x63\x65\x73\163\164\157\x6b\x65\156\x75\x72\154"];
        $JI = $FK["\162\x65\x73\157\x75\162\143\145\x6f\167\156\x65\x72\144\145\x74\x61\x69\x6c\163\165\162\154"];
        $Wi = new MO_Custom_OAuth1_Flow($M4, $oM, $CE, $Gh, $JI);
        $Jf = $Wi->mo_oauth1_get_request_token();
        if (!(strpos($b3, "\x3f") == false)) {
            goto Hf;
        }
        $b3 .= "\x3f";
        Hf:
        $BM = $b3 . "\x6f\141\x75\164\x68\137\x74\x6f\x6b\145\156\x3d" . $Jf;
        if (!($Jf == '' || $Jf == NULL)) {
            goto yW;
        }
        MO_Oauth_Debug::mo_oauth_log("\105\162\x72\157\x72\40\151\156\40\x52\145\x71\165\145\163\164\x20\124\157\153\x65\x6e\40\x45\156\144\160\157\151\x6e\x74");
        $lT->handle_error("\105\x72\162\157\x72\x20\151\156\x20\122\x65\x71\x75\145\163\x74\x20\x54\x6f\153\x65\156\x20\105\156\144\x70\157\x69\156\164\72\x20\111\156\166\x61\x6c\x69\144\40\x74\x6f\153\145\x6e\40\x72\145\143\x65\x69\x76\145\x64\56\x20\103\x6f\156\x74\x61\x63\x74\40\164\x6f\40\x79\157\x75\162\40\x61\144\x6d\151\x6d\x69\163\x74\162\x61\x74\x6f\x72\x20\x66\x6f\x72\40\x6d\x6f\x72\145\40\x69\156\x66\157\x72\155\141\164\x69\x6f\156\x2e");
        wp_die("\x45\x72\x72\x6f\x72\40\151\156\40\x52\x65\161\x75\x65\163\164\40\124\157\153\x65\156\x20\105\156\x64\160\157\x69\156\164\x3a\x20\x49\x6e\x76\x61\x6c\x69\x64\40\x74\x6f\x6b\145\156\40\162\145\143\145\151\166\x65\x64\56\x20\x43\x6f\156\164\141\x63\x74\x20\164\157\40\x79\x6f\x75\x72\x20\141\144\x6d\x69\x6d\x69\x73\164\162\x61\164\x6f\x72\40\x66\157\x72\x20\x6d\x6f\x72\145\40\151\x6e\146\x6f\162\x6d\141\164\x69\x6f\x6e\x2e");
        yW:
        MO_Oauth_Debug::mo_oauth_log("\122\145\161\x75\x65\x73\164\x20\124\x6f\153\145\x6e\x20\x72\x65\143\145\151\166\x65\144\56");
        MO_Oauth_Debug::mo_oauth_log("\122\x65\x71\x75\x65\163\164\x20\x54\157\153\x65\156\x20\x3d\x3e\x20");
        MO_Oauth_Debug::mo_oauth_log($Jf);
        header("\114\157\143\x61\164\151\x6f\156\x3a" . $BM);
        exit;
    }
    static function mo_oidc1_get_access_token($Ig)
    {
        $Bo = explode("\46", $_SERVER["\122\105\121\x55\105\x53\x54\x5f\125\x52\x49"]);
        $E1 = explode("\75", $Bo[1]);
        $Qi = explode("\x3d", $Bo[0]);
        $Tx = get_option("\x6d\x6f\137\157\141\165\x74\x68\x5f\141\160\x70\163\x5f\x6c\151\x73\164");
        $Wj = $Ig;
        $MD = null;
        foreach ($Tx as $HH => $kp) {
            if (!($Ig == $HH)) {
                goto P0;
            }
            $MD = $kp;
            goto VC;
            P0:
            Bg:
        }
        VC:
        global $lT;
        $FK = $lT->get_app_by_name($Ig)->get_app_config();
        $M4 = $FK["\143\x6c\x69\145\156\x74\137\x69\144"];
        $oM = $FK["\x63\x6c\x69\x65\156\x74\x5f\x73\145\143\162\x65\164"];
        $b3 = $FK["\141\165\x74\x68\157\162\151\x7a\x65\x75\162\154"];
        $CE = $FK["\x72\x65\x71\165\145\163\164\165\162\x6c"];
        $Gh = $FK["\x61\x63\143\145\x73\x73\164\x6f\x6b\x65\x6e\x75\162\x6c"];
        $JI = $FK["\x72\x65\163\x6f\x75\162\x63\x65\157\167\x6e\x65\x72\144\145\164\x61\151\x6c\163\x75\162\x6c"];
        $jM = new MO_Custom_OAuth1_Flow($M4, $oM, $CE, $Gh, $JI);
        $KQ = $jM->mo_oauth1_get_access_token($E1[1], $Qi[1]);
        $SV = explode("\46", $KQ);
        $Dv = '';
        $zn = '';
        foreach ($SV as $HH) {
            $Xj = explode("\x3d", $HH);
            if ($Xj[0] == "\157\141\x75\164\150\x5f\164\x6f\x6b\145\x6e") {
                goto NY;
            }
            if (!($Xj[0] == "\157\141\x75\x74\x68\x5f\164\157\153\145\156\x5f\x73\x65\143\162\145\164")) {
                goto Ej;
            }
            $zn = $Xj[1];
            Ej:
            goto Og;
            NY:
            $Dv = $Xj[1];
            Og:
            nE:
        }
        Be:
        MO_Oauth_Debug::mo_oauth_log("\x41\143\x63\145\x73\163\40\x54\157\x6b\x65\156\40\x72\145\x63\x65\151\x76\145\144\56");
        MO_Oauth_Debug::mo_oauth_log("\101\x63\143\x65\x73\x73\x20\x54\x6f\x6b\x65\156\x20\75\x3e\40");
        MO_Oauth_Debug::mo_oauth_log($Dv);
        $SC = new MO_Custom_OAuth1_Flow($M4, $oM, $CE, $Gh, $JI);
        $PS = isset($Gm[1]) ? $Gm[1] : '';
        $OS = isset($A0[1]) ? $A0[1] : '';
        $rJ = isset($xC[1]) ? $xC[1] : '';
        $O5 = $SC->mo_oauth1_get_profile_signature($Dv, $zn);
        if (isset($O5)) {
            goto PI;
        }
        $lT->handle_error("\x49\156\x76\141\154\151\144\40\x43\157\x6e\146\x69\147\x75\162\141\x74\151\157\156\163\x2e\40\120\154\145\x61\163\x65\x20\x63\x6f\x6e\x74\x61\x63\x74\40\164\x6f\40\x74\150\145\40\x61\144\x6d\x69\155\x69\163\164\162\x61\x74\157\x72\x20\x66\x6f\162\x20\155\157\x72\x65\x20\151\156\x66\x6f\162\x6d\x61\x74\151\x6f\x6e");
        wp_die("\x49\x6e\x76\141\154\x69\144\x20\103\157\x6e\x66\x69\x67\165\x72\x61\x74\151\x6f\156\x73\x2e\40\x50\154\145\x61\x73\145\x20\143\157\156\x74\141\143\x74\40\x74\x6f\x20\x74\x68\145\40\141\144\155\151\155\x69\x73\164\x72\x61\x74\x6f\162\x20\x66\157\x72\x20\x6d\157\162\145\x20\151\x6e\146\x6f\x72\155\141\x74\x69\x6f\156");
        PI:
        return $O5;
    }
}
class MO_Custom_OAuth1_Flow
{
    var $key = '';
    var $secret = '';
    var $request_token_url = '';
    var $access_token_url = '';
    var $userinfo_url = '';
    function __construct($dN, $oM, $CE, $Gh, $JI)
    {
        $this->key = $dN;
        $this->secret = $oM;
        $this->request_token_url = $CE;
        $this->access_token_url = $Gh;
        $this->userinfo_url = $JI;
    }
    function mo_oauth1_get_request_token()
    {
        $RT = array("\157\141\x75\x74\x68\x5f\x76\x65\x72\163\x69\x6f\x6e" => "\61\56\x30", "\157\x61\x75\x74\150\x5f\156\157\x6e\143\145" => time(), "\157\141\165\164\150\137\164\x69\155\145\x73\x74\x61\x6d\160" => time(), "\157\141\165\x74\x68\x5f\x63\x6f\156\x73\x75\x6d\x65\x72\137\x6b\145\171" => $this->key, "\x6f\141\165\x74\150\x5f\x73\151\x67\x6e\141\164\165\x72\x65\x5f\x6d\x65\x74\150\157\x64" => "\x48\x4d\x41\103\x2d\x53\x48\x41\x31");
        if (!(strpos($this->request_token_url, "\77") != false)) {
            goto Aa;
        }
        $h0 = explode("\77", $this->request_token_url);
        $this->request_token_url = $h0[0];
        $sf = explode("\x26", $h0[1]);
        foreach ($sf as $W6) {
            $e4 = explode("\75", $W6);
            $RT[$e4[0]] = $e4[1];
            pA:
        }
        tp:
        Aa:
        $aY = array_keys($RT);
        $oS = array_values($RT);
        $RT = $this->mo_oauth1_url_encode_rfc3986(array_combine($aY, $oS));
        uksort($RT, "\163\164\162\143\155\x70");
        foreach ($RT as $pt => $zq) {
            $g0[] = $this->mo_oauth1_url_encode_rfc3986($pt) . "\75" . $this->mo_oauth1_url_encode_rfc3986($zq);
            dA:
        }
        Wl:
        $iB = implode("\46", $g0);
        $bu = $iB;
        $bu = str_replace("\75", "\45\x33\x44", $bu);
        $bu = str_replace("\46", "\45\62\x36", $bu);
        $bu = "\x47\x45\124\x26" . $this->mo_oauth1_url_encode_rfc3986($this->request_token_url) . "\46" . $bu;
        $Ld = $this->mo_oauth1_url_encode_rfc3986($this->secret) . "\x26";
        $RT["\157\x61\x75\164\x68\x5f\x73\151\x67\156\x61\x74\x75\162\x65"] = $this->mo_oauth1_url_encode_rfc3986(base64_encode(hash_hmac("\163\150\x61\61", $bu, $Ld, TRUE)));
        uksort($RT, "\163\164\162\143\155\x70");
        foreach ($RT as $pt => $zq) {
            $yu[] = $pt . "\x3d" . $zq;
            tY:
        }
        ma:
        $NP = implode("\x26", $yu);
        $cX = $this->request_token_url . "\x3f" . $NP;
        MO_Oauth_Debug::mo_oauth_log("\122\x65\161\x75\x65\163\x74\40\x54\157\x6b\145\156\x20\x55\x52\x4c\x20\x3d\76\x20" . $cX);
        $Qv = $this->mo_oauth1_https($cX);
        MO_Oauth_Debug::mo_oauth_log("\122\x65\161\165\x65\x73\x74\x20\124\157\x6b\x65\156\x20\x45\x6e\144\x70\157\151\x6e\x74\x20\x52\x65\x73\x70\157\156\x73\145\x20\75\x3e\40");
        MO_Oauth_Debug::mo_oauth_log($Qv);
        $a2 = explode("\x26", $Qv);
        $l8 = '';
        foreach ($a2 as $HH) {
            $Xj = explode("\x3d", $HH);
            if ($Xj[0] == "\x6f\x61\165\x74\x68\137\164\157\x6b\145\156") {
                goto Xf;
            }
            if (!($Xj[0] == "\x6f\141\x75\x74\x68\x5f\x74\157\x6b\x65\156\137\163\x65\x63\162\145\x74")) {
                goto uB;
            }
            setcookie("\x6d\x6f\137\x74\163", $Xj[1], time() + 30);
            uB:
            goto za;
            Xf:
            $l8 = $Xj[1];
            za:
            Ul:
        }
        w4:
        return $l8;
    }
    function mo_oauth1_get_access_token($E1, $Qi)
    {
        $RT = array("\157\x61\x75\x74\x68\x5f\x76\145\x72\163\x69\x6f\156" => "\x31\56\x30", "\x6f\x61\x75\x74\x68\x5f\x6e\157\156\x63\x65" => time(), "\157\x61\165\x74\150\137\x74\151\x6d\x65\x73\x74\x61\155\160" => time(), "\x6f\x61\165\164\150\137\143\x6f\x6e\163\165\x6d\x65\x72\x5f\x6b\x65\171" => $this->key, "\x6f\141\x75\164\150\137\x74\157\x6b\145\156" => $Qi, "\157\x61\x75\x74\150\x5f\x73\x69\147\x6e\x61\164\165\x72\145\137\155\145\x74\150\157\144" => "\x48\x4d\101\x43\55\x53\110\x41\61", "\157\x61\x75\x74\x68\x5f\x76\145\x72\151\x66\x69\145\x72" => $E1);
        $aY = $this->mo_oauth1_url_encode_rfc3986(array_keys($RT));
        $oS = $this->mo_oauth1_url_encode_rfc3986(array_values($RT));
        $RT = array_combine($aY, $oS);
        uksort($RT, "\163\x74\x72\x63\155\160");
        foreach ($RT as $pt => $zq) {
            $g0[] = $this->mo_oauth1_url_encode_rfc3986($pt) . "\x3d" . $this->mo_oauth1_url_encode_rfc3986($zq);
            ND:
        }
        p7:
        $iB = implode("\x26", $g0);
        $bu = $iB;
        $bu = str_replace("\75", "\x25\x33\104", $bu);
        $bu = str_replace("\46", "\x25\62\66", $bu);
        $bu = "\x47\x45\124\x26" . $this->mo_oauth1_url_encode_rfc3986($this->access_token_url) . "\46" . $bu;
        $WZ = isset($_COOKIE["\155\x6f\137\164\x73"]) ? $_COOKIE["\x6d\x6f\x5f\x74\163"] : '';
        $Ld = $this->mo_oauth1_url_encode_rfc3986($this->secret) . "\46" . $WZ;
        $RT["\x6f\141\x75\x74\x68\x5f\x73\x69\147\x6e\141\164\x75\x72\x65"] = $this->mo_oauth1_url_encode_rfc3986(base64_encode(hash_hmac("\x73\x68\x61\x31", $bu, $Ld, TRUE)));
        uksort($RT, "\x73\164\x72\x63\x6d\x70");
        foreach ($RT as $pt => $zq) {
            $yu[] = $pt . "\75" . $zq;
            jv:
        }
        UK:
        $NP = implode("\46", $yu);
        $cX = $this->access_token_url . "\x3f" . $NP;
        MO_Oauth_Debug::mo_oauth_log("\x41\143\x63\145\x73\163\40\124\157\153\145\x6e\x20\x45\x6e\144\x70\157\x69\156\164\x20\x55\x52\114\x20\75\x3e\40" . $cX);
        $Qv = $this->mo_oauth1_https($cX);
        MO_Oauth_Debug::mo_oauth_log("\x41\143\x63\145\163\163\40\124\157\153\145\156\x20\x45\156\x64\160\157\151\x6e\164\40\122\145\x73\160\157\156\163\145\40\x3d\76\x20");
        MO_Oauth_Debug::mo_oauth_log($Qv);
        return $Qv;
    }
    function mo_oauth1_get_profile_signature($KQ, $A0, $xC = '')
    {
        $RT = array("\157\141\x75\x74\x68\x5f\x76\x65\162\x73\x69\157\156" => "\61\56\x30", "\x6f\141\165\164\150\137\x6e\157\156\143\x65" => time(), "\157\x61\165\x74\150\137\164\151\x6d\145\x73\164\141\155\x70" => time(), "\x6f\x61\x75\x74\x68\137\x63\157\x6e\x73\165\x6d\x65\x72\x5f\153\145\171" => $this->key, "\x6f\x61\165\164\x68\137\x74\157\153\x65\x6e" => $KQ, "\157\x61\x75\x74\x68\137\163\x69\x67\x6e\x61\x74\x75\162\x65\137\x6d\145\164\x68\157\144" => "\x48\x4d\x41\x43\x2d\x53\110\101\x31");
        if (!(strpos($this->userinfo_url, "\77") != false)) {
            goto cI;
        }
        $h0 = explode("\77", $this->userinfo_url);
        $this->userinfo_url = $h0[0];
        $sf = explode("\46", $h0[1]);
        foreach ($sf as $W6) {
            $e4 = explode("\75", $W6);
            $RT[$e4[0]] = $e4[1];
            We:
        }
        FT:
        cI:
        $aY = $this->mo_oauth1_url_encode_rfc3986(array_keys($RT));
        $oS = $this->mo_oauth1_url_encode_rfc3986(array_values($RT));
        $RT = array_combine($aY, $oS);
        uksort($RT, "\163\164\162\x63\155\x70");
        foreach ($RT as $pt => $zq) {
            $g0[] = $this->mo_oauth1_url_encode_rfc3986($pt) . "\x3d" . $this->mo_oauth1_url_encode_rfc3986($zq);
            E2:
        }
        EK:
        $iB = implode("\x26", $g0);
        $bu = "\107\105\x54\x26" . $this->mo_oauth1_url_encode_rfc3986($this->userinfo_url) . "\46" . $this->mo_oauth1_url_encode_rfc3986($iB);
        $Ld = $this->mo_oauth1_url_encode_rfc3986($this->secret) . "\x26" . $this->mo_oauth1_url_encode_rfc3986($A0);
        $RT["\157\141\x75\164\150\137\x73\x69\x67\156\141\x74\165\162\145"] = $this->mo_oauth1_url_encode_rfc3986(base64_encode(hash_hmac("\x73\x68\141\x31", $bu, $Ld, TRUE)));
        uksort($RT, "\x73\164\162\143\155\x70");
        foreach ($RT as $pt => $zq) {
            $yu[] = $pt . "\x3d" . $zq;
            x1:
        }
        iU:
        $NP = implode("\x26", $yu);
        $cX = $this->userinfo_url . "\77" . $NP;
        MO_Oauth_Debug::mo_oauth_log("\x52\x65\x73\x6f\x75\x72\x63\145\x20\105\156\x64\x70\157\151\x6e\x74\x20\x55\x52\x4c\40\75\76\40" . $cX);
        $nt = array();
        MO_Oauth_Debug::mo_oauth_log("\x52\x65\x73\x6f\165\162\x63\x65\x20\105\156\144\x70\x6f\x69\x6e\164\40\x69\156\x66\157\x20\x3d\76\40");
        MO_Oauth_Debug::mo_oauth_log($RT);
        $nw = wp_remote_get($cX, $nt);
        MO_Oauth_Debug::mo_oauth_log("\x52\145\x73\x6f\x75\162\143\x65\40\x45\156\144\160\x6f\151\x6e\x74\40\122\x65\163\160\157\156\x73\145\40\x3d\76\x20");
        MO_Oauth_Debug::mo_oauth_log($nw);
        $O5 = json_decode($nw["\142\157\x64\x79"], true);
        return $O5;
    }
    function mo_oauth1_https($cX, $UI = null)
    {
        if (!isset($UI)) {
            goto PP;
        }
        $nt = array("\155\145\164\x68\157\144" => "\120\x4f\x53\124", "\142\157\144\171" => $UI, "\x74\x69\x6d\145\157\x75\164" => "\61\65", "\x72\x65\144\x69\162\145\143\x74\151\x6f\x6e" => "\x35", "\x68\x74\x74\160\x76\145\x72\163\x69\157\156" => "\x31\56\60", "\142\x6c\157\143\x6b\151\x6e\x67" => true);
        MO_Oauth_Debug::mo_oauth_log("\x4f\141\165\x74\150\61\40\x50\x4f\123\x54\40\105\x6e\144\160\157\151\x6e\164\40\101\x72\x67\x75\x6d\145\156\164\163\x20\75\x3e\x20");
        MO_Oauth_Debug::mo_oauth_log($nw);
        $IR = wp_remote_post($cX, $nt);
        return $IR["\142\x6f\144\171"];
        PP:
        $nt = array();
        $nw = wp_remote_get($cX, $nt);
        if (!is_wp_error($nw)) {
            goto eq;
        }
        $lT->handle_error($nw);
        wp_die($nw);
        eq:
        $Qv = $nw["\x62\x6f\x64\x79"];
        return $Qv;
    }
    function mo_oauth1_url_encode_rfc3986($MA)
    {
        if (is_array($MA)) {
            goto sy;
        }
        if (is_scalar($MA)) {
            goto EG;
        }
        return '';
        goto D4;
        EG:
        return str_replace("\x2b", "\x20", str_replace("\x25\x37\105", "\x7e", rawurlencode($MA)));
        D4:
        goto Fs;
        sy:
        return array_map(array("\115\x6f\x4f\x61\165\x74\x68\103\154\151\x65\156\164\134\x4d\x4f\x5f\103\x75\x73\164\x6f\155\137\117\x41\165\x74\x68\61\x5f\106\x6c\157\x77", "\x6d\x6f\x5f\157\x61\x75\164\150\61\x5f\x75\x72\154\x5f\x65\x6e\143\157\x64\x65\x5f\162\146\143\63\x39\70\x36"), $MA);
        Fs:
    }
}
