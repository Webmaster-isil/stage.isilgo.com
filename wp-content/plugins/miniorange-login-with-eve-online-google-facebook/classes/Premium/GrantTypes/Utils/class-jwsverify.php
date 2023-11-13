<?php


namespace MoOauthClient\GrantTypes;

class JWSVerify
{
    public $algo;
    public function __construct($j9 = '')
    {
        if (!empty($j9)) {
            goto Js;
        }
        return;
        Js:
        $j9 = explode("\123", $j9);
        if (!(!is_array($j9) || 2 !== count($j9))) {
            goto Sb;
        }
        return WP_Error("\x69\156\166\x61\154\151\x64\x5f\x73\x69\147\156\x61\164\165\162\145", __("\124\x68\145\40\123\x69\147\x6e\x61\164\165\162\145\40\163\x65\x65\155\163\x20\164\157\40\142\145\40\151\x6e\166\141\154\151\x64\40\157\x72\x20\x75\156\x73\x75\x70\160\x6f\162\164\x65\144\x2e"));
        Sb:
        if ("\x48" === $j9[0]) {
            goto Xm;
        }
        if ("\x52" === $j9[0]) {
            goto qN;
        }
        return WP_Error("\151\x6e\166\141\154\151\x64\x5f\x73\x69\147\156\x61\x74\x75\162\145", __("\124\x68\x65\40\163\151\x67\x6e\x61\x74\x75\x72\145\40\x61\154\x67\x6f\162\x69\164\150\x6d\x20\x73\145\x65\x6d\163\x20\x74\157\x20\x62\145\x20\165\x6e\x73\x75\160\160\157\x72\164\145\x64\40\157\x72\x20\151\x6e\x76\x61\154\151\144\56"));
        goto l0;
        Xm:
        $this->algo["\x61\x6c\147"] = "\x48\x53\x41";
        goto l0;
        qN:
        $this->algo["\141\154\147"] = "\x52\123\101";
        l0:
        $this->algo["\x73\x68\141"] = $j9[1];
    }
    private function validate_hmac($aL = '', $Ld = '', $Hg = '')
    {
        if (!(empty($aL) || empty($Hg))) {
            goto rG;
        }
        return false;
        rG:
        $kW = $this->algo["\x73\x68\141"];
        $kW = "\x73\150\x61" . $kW;
        $yh = \hash_hmac($kW, $aL, $Ld, true);
        return hash_equals($yh, $Hg);
    }
    private function validate_rsa($aL = '', $tn = '', $Hg = '')
    {
        if (!(empty($aL) || empty($Hg))) {
            goto Gz;
        }
        return false;
        Gz:
        $kW = $this->algo["\x73\x68\x61"];
        $Sd = '';
        $F9 = explode("\55\x2d\x2d\x2d\x2d", $tn);
        if (preg_match("\x2f\134\162\x5c\x6e\x7c\x5c\162\174\x5c\156\x2f", $F9[2])) {
            goto JI;
        }
        $P1 = "\55\55\x2d\x2d\55" . $F9[1] . "\55\55\x2d\55\x2d\xa";
        $hB = 0;
        VF:
        if (!($dD = substr($F9[2], $hB, 64))) {
            goto ON;
        }
        $P1 .= $dD . "\12";
        $hB += 64;
        goto VF;
        ON:
        $P1 .= "\55\x2d\55\55\x2d" . $F9[3] . "\55\55\x2d\55\x2d\xa";
        $Sd = $P1;
        goto La;
        JI:
        $Sd = $tn;
        La:
        $kx = false;
        switch ($kW) {
            case "\62\65\66":
                $kx = openssl_verify($aL, $Hg, $Sd, OPENSSL_ALGO_SHA256);
                goto z3;
            case "\x33\x38\64":
                $kx = openssl_verify($aL, $Hg, $Sd, OPENSSL_ALGO_SHA384);
                goto z3;
            case "\x35\x31\x32":
                $kx = openssl_verify($aL, $Hg, $Sd, OPENSSL_ALGO_SHA512);
                goto z3;
            default:
                $kx = false;
                goto z3;
        }
        kV:
        z3:
        return $kx;
    }
    public function verify($aL = '', $Ld = '', $Hg = '')
    {
        if (!(empty($aL) || empty($Hg))) {
            goto Lg;
        }
        return false;
        Lg:
        $j9 = $this->algo["\x61\154\147"];
        switch ($j9) {
            case "\110\x53\x41":
                return $this->validate_hmac($aL, $Ld, $Hg);
            case "\122\123\x41":
                return @$this->validate_rsa($aL, $Ld, $Hg);
            default:
                return false;
        }
        Fa:
        Kb:
    }
}
