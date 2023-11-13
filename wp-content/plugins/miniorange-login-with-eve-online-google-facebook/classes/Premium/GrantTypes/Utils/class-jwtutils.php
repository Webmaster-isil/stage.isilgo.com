<?php


namespace MoOauthClient\GrantTypes;

use MoOauthClient\GrantTypes\JWSVerify;
use MoOauthClient\GrantTypes\Crypt_RSA;
use MoOauthClient\GrantTypes\Math_BigInteger;
class JWTUtils
{
    const HEADER = "\x48\105\101\104\105\x52";
    const PAYLOAD = "\x50\101\x59\x4c\117\101\104";
    const SIGN = "\x53\x49\107\116";
    private $jwt;
    private $decoded_jwt;
    public function __construct($dR)
    {
        $dR = \explode("\56", $dR);
        if (!(3 > count($dR))) {
            goto TZ;
        }
        return new \WP_Error("\x69\156\166\x61\x6c\x69\x64\137\x6a\x77\164", __("\112\127\x54\40\122\x65\143\145\x69\x76\x65\144\40\151\x73\x20\x6e\157\164\x20\x61\x20\x76\x61\154\151\144\40\x4a\127\124"));
        TZ:
        $this->jwt = $dR;
        $mE = $this->get_jwt_claim('', self::HEADER);
        $rd = $this->get_jwt_claim('', self::PAYLOAD);
        $this->decoded_jwt = array("\150\145\141\144\x65\x72" => $mE, "\x70\x61\171\x6c\157\141\x64" => $rd);
    }
    private function get_jwt_claim($LG = '', $XB = '')
    {
        global $lT;
        $Hp = '';
        switch ($XB) {
            case self::HEADER:
                $Hp = $this->jwt[0];
                goto L9;
            case self::PAYLOAD:
                $Hp = $this->jwt[1];
                goto L9;
            case self::SIGN:
                return $this->jwt[2];
            default:
                $lT->handle_error("\x43\x61\x6e\x6e\x6f\164\x20\x46\x69\x6e\144\40" . $XB . "\x20\151\156\40\x74\150\145\40\x4a\127\x54");
                $TA = "\103\141\156\x6e\x6f\164\x20\106\151\x6e\144\x20" . $XB . "\40\x69\156\40\164\150\145\40\112\127\x54";
                wp_die(wp_kses($TA, \mo_oauth_get_valid_html()));
        }
        sa:
        L9:
        $Hp = json_decode($lT->base64url_decode($Hp), true);
        if (!(!$Hp || empty($Hp))) {
            goto UU;
        }
        return null;
        UU:
        return empty($LG) ? $Hp : (isset($Hp[$LG]) ? $Hp[$LG] : null);
    }
    public function check_algo($Nk = '')
    {
        global $lT;
        $Rr = $this->get_jwt_claim("\141\x6c\x67", self::HEADER);
        $Rr = explode("\123", $Rr);
        if (isset($Rr[0])) {
            goto v3;
        }
        $TA = "\x49\156\x76\x61\x6c\x69\144\40\122\x65\163\x70\157\156\x73\145\40\x52\x65\x63\145\x69\166\x65\x64\x20\146\162\x6f\x6d\x20\117\x41\x75\x74\x68\57\117\160\145\x6e\x49\104\x20\x50\x72\157\x76\151\144\x65\x72\56";
        $lT->handle_error($TA);
        wp_die(wp_kses($TA, \mo_oauth_get_valid_html()));
        v3:
        switch ($Rr[0]) {
            case "\x48":
                return "\x48\123\101" === $Nk;
            case "\122":
                return "\122\x53\x41" === $Nk;
            default:
                return false;
        }
        DD:
        QV:
    }
    public function verify($Ld = '')
    {
        global $lT;
        if (!empty($Ld)) {
            goto Vl;
        }
        return false;
        Vl:
        $fv = $this->get_jwt_claim("\145\170\160", self::PAYLOAD);
        if (!(is_null($fv) || time() > $fv)) {
            goto He;
        }
        $cN = "\112\127\x54\40\150\141\x73\x20\142\145\x65\x6e\x20\x65\170\160\151\x72\145\x64\56\x20\120\154\x65\141\163\145\x20\x74\x72\171\x20\114\x6f\147\x67\x69\156\x67\40\x69\156\40\141\147\141\151\156\56";
        $lT->handle_error($cN);
        wp_die(wp_kses($cN, \mo_oauth_get_valid_html()));
        He:
        $ru = $this->get_jwt_claim("\x6e\142\x66", self::PAYLOAD);
        if (!(!is_null($ru) || time() < $ru)) {
            goto CT;
        }
        $Mt = "\x49\x74\40\151\x73\x20\164\157\x6f\x20\x65\x61\x72\x6c\x79\x20\x74\x6f\40\165\x73\145\40\164\x68\x69\x73\40\112\127\124\56\x20\x50\154\145\x61\163\145\40\x74\x72\171\x20\x4c\157\147\x67\151\156\x67\40\x69\156\40\x61\147\141\151\x6e\56";
        $lT->handle_error($Mt);
        wp_die(wp_kses($Mt, \mo_oauth_get_valid_html()));
        CT:
        $Cd = new JWSVerify($this->get_jwt_claim("\141\154\147", self::HEADER));
        $aL = $this->get_header() . "\x2e" . $this->get_payload();
        return $Cd->verify(\utf8_decode($aL), $Ld, base64_decode(strtr($this->get_jwt_claim(false, self::SIGN), "\x2d\137", "\53\x2f")));
    }
    public function verify_from_jwks($pr = '', $Rr = "\122\123\62\65\66")
    {
        global $lT;
        $t4 = wp_remote_get($pr);
        if (!is_wp_error($t4)) {
            goto Tq;
        }
        return false;
        Tq:
        $t4 = json_decode($t4["\142\x6f\x64\171"], true);
        $kx = false;
        if (!(json_last_error() !== JSON_ERROR_NONE)) {
            goto i6;
        }
        return $kx;
        i6:
        if (isset($t4["\x6b\x65\x79\163"])) {
            goto ch;
        }
        return $kx;
        ch:
        foreach ($t4["\x6b\145\x79\163"] as $HH => $W7) {
            if (!(!isset($W7["\153\x74\x79"]) || "\x52\123\x41" !== $W7["\x6b\x74\x79"] || !isset($W7["\145"]) || !isset($W7["\x6e"]))) {
                goto Zi;
            }
            goto VK;
            Zi:
            $kx = $kx || $this->verify($this->jwks_to_pem(["\x6e" => new Math_BigInteger($lT->base64url_decode($W7["\x6e"]), 256), "\x65" => new Math_BigInteger($lT->base64url_decode($W7["\145"]), 256)]));
            if (!(true === $kx)) {
                goto By;
            }
            goto gz;
            By:
            VK:
        }
        gz:
        return $kx;
    }
    private function jwks_to_pem($wb = array())
    {
        $c3 = new Crypt_RSA();
        $c3->loadKey($wb);
        return $c3->getPublicKey();
    }
    public function get_decoded_header()
    {
        return $this->decoded_jwt["\150\x65\x61\x64\x65\162"];
    }
    public function get_decoded_payload()
    {
        if (!isset($this->decoded_jwt["\160\x61\171\x6c\157\x61\x64"])) {
            goto sO;
        }
        return $this->decoded_jwt["\x70\141\x79\x6c\157\141\144"];
        sO:
    }
    public function get_header()
    {
        return $this->jwt[0];
    }
    public function get_payload()
    {
        return $this->jwt[1];
    }
}
