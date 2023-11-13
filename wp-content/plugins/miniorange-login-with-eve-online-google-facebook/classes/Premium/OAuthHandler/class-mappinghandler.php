<?php


namespace MoOauthClient\Premium;

use MoOauthClient\Mo_Oauth_Debug;
class MappingHandler
{
    private $user_id = 0;
    private $app_config = array();
    private $group_name = '';
    private $is_new_user = false;
    public function __construct($kM = 0, $FK = array(), $lm = '', $Kv = false)
    {
        if (!(!array($FK) || empty($FK))) {
            goto jCk;
        }
        return;
        jCk:
        $Yv = is_array($lm) ? $lm : $this->get_group_array($lm);
        $this->group_name = $Yv;
        $this->user_id = $kM;
        $this->app_config = $FK;
        $this->is_new_user = $Kv;
    }
    private function get_group_array($We)
    {
        $nT = json_decode($We, true);
        return is_array($nT) && json_last_error() === JSON_ERROR_NONE ? $nT : explode("\73", $We);
    }
    public function apply_custom_attribute_mapping($tJ)
    {
        if (!(!isset($this->app_config["\x63\x75\163\x74\x6f\x6d\137\x61\164\164\x72\x73\x5f\x6d\x61\x70\160\151\x6e\147"]) || empty($this->app_config["\143\x75\x73\164\157\x6d\x5f\141\x74\x74\162\163\137\x6d\x61\x70\160\151\x6e\147"]))) {
            goto UKR;
        }
        return;
        UKR:
        global $lT;
        $Ga = -1;
        $bv = $this->app_config["\143\165\163\x74\157\x6d\x5f\x61\x74\x74\x72\x73\137\155\x61\160\160\x69\x6e\x67"];
        $VE = [];
        $Qn = "\163\164\x61\x74\x69\143\137\x76\x61\154\165\x65";
        $AK = [];
        foreach ($bv as $HH => $W7) {
            $le = [];
            $vr = '';
            if (strpos($W7, "\x3b") !== false) {
                goto pDC;
            }
            $vr = $lT->getnestedattribute($tJ, $W7);
            goto Fxi;
            pDC:
            $le = array_map("\164\x72\x69\x6d", explode("\x3b", $W7));
            foreach ($le as $pt => $Vi) {
                $EI = $lT->getnestedattribute($tJ, $Vi);
                $vr .= "\x20" . $EI;
                zS1:
            }
            AZB:
            Fxi:
            $VE[$HH] = $vr;
            update_user_meta($this->user_id, $HH, $vr);
            if (!(strpos($W7, $Qn) !== false)) {
                goto pes;
            }
            $AK = explode("\x2e", $W7);
            $VE[$HH] = $AK["\x31"];
            pes:
            SWC:
        }
        Bkw:
        update_user_meta($this->user_id, "\155\157\137\157\141\x75\x74\x68\x5f\143\165\163\164\x6f\155\137\x61\x74\x74\x72\x69\x62\x75\164\x65\163", $VE);
    }
    public function apply_role_mapping($tJ)
    {
        if (!has_filter("\155\x6f\x5f\163\165\x62\x73\x69\164\145\137\x63\x68\x65\143\153\x5f\141\154\154\157\167\137\154\x6f\x67\x69\156")) {
            goto CY9;
        }
        $D9 = apply_filters("\x6d\x6f\137\x73\x75\x62\x73\151\x74\145\137\x63\150\145\x63\x6b\137\x65\170\x69\163\164\151\x6e\147\x5f\x72\x6f\x6c\145\163", $this->app_config, $this->is_new_user);
        if (!($D9 === true)) {
            goto Xda;
        }
        return;
        Xda:
        goto Abe;
        CY9:
        if (!(!$this->is_new_user && isset($this->app_config["\x6b\x65\x65\x70\x5f\x65\170\151\163\x74\151\156\x67\x5f\165\163\145\162\137\x72\x6f\154\x65\x73"]) && 1 === intval($this->app_config["\x6b\145\145\160\x5f\145\x78\x69\163\x74\x69\x6e\x67\x5f\165\163\145\162\137\162\x6f\x6c\145\163"]))) {
            goto ztk;
        }
        return;
        ztk:
        Abe:
        $m6 = new \WP_User($this->user_id);
        if (!($this->is_new_user && isset($this->app_config["\145\x6e\x61\142\x6c\145\137\x72\x6f\154\145\x5f\155\x61\160\x70\x69\156\147"]) && !boolval($this->app_config["\145\156\141\142\154\x65\137\x72\x6f\x6c\x65\x5f\155\141\160\160\151\156\147"]))) {
            goto WWU;
        }
        $m6->set_role('');
        return;
        WWU:
        if (!has_filter("\155\x6f\x5f\157\141\x75\164\150\137\162\141\166\x65\x6e\x5f\142\x79\x5f\160\141\163\163\x5f\x72\157\x6c\x65\x5f\x6d\141\x70\160\x69\x6e\147")) {
            goto chC;
        }
        $E6 = apply_filters("\x6d\x6f\x5f\x6f\141\165\164\x68\x5f\x72\x61\166\145\156\137\x62\171\x5f\160\x61\x73\x73\x5f\162\157\x6c\145\137\155\x61\x70\160\151\x6e\x67", $m6);
        if (!($E6 === true)) {
            goto syT;
        }
        return;
        syT:
        chC:
        $gR = 0;
        $To = false;
        if (!has_filter("\x6d\x6f\137\163\145\x74\x5f\143\x75\x72\162\x65\156\x74\x5f\163\151\164\x65\x5f\x72\157\x6c\x65\x73")) {
            goto cHL;
        }
        $iT = apply_filters("\x6d\157\137\163\x65\164\137\x63\165\x72\162\x65\156\164\x5f\163\151\x74\x65\137\162\x6f\154\145\163", $this->app_config, $this->group_name, $gR, $m6);
        goto HGa;
        cHL:
        $GV = isset($this->app_config["\162\157\x6c\145\137\x6d\x61\x70\160\151\x6e\147\137\143\x6f\165\x6e\164"]) ? intval($this->app_config["\x72\x6f\x6c\145\x5f\155\x61\160\x70\x69\156\x67\x5f\x63\x6f\165\x6e\164"]) : 0;
        $eL = array();
        $Ga = 1;
        FyC:
        if (!($Ga <= $GV)) {
            goto cHO;
        }
        $nf = isset($this->app_config["\137\155\x61\160\160\x69\156\147\137\153\x65\x79\137" . $Ga]) ? $this->app_config["\137\155\x61\160\160\151\156\x67\137\x6b\145\171\x5f" . $Ga] : '';
        array_push($eL, $nf);
        foreach ($this->group_name as $lW) {
            $Z1 = array_map("\164\x72\151\x6d", explode("\x2c", $nf));
            $Mx = isset($this->app_config["\137\x6d\141\160\160\x69\156\x67\137\166\x61\154\x75\145\137" . $Ga]) ? $this->app_config["\137\155\141\x70\160\x69\x6e\x67\x5f\166\141\154\x75\x65\137" . $Ga] : '';
            $To = apply_filters("\155\157\x5f\x6f\141\165\164\x68\137\x63\154\x69\145\x6e\x74\x5f\x64\x79\156\141\x6d\151\x63\x5f\166\x61\x6c\x75\x65\x5f\162\x6f\154\x65\137\155\x61\160\x70\151\x6e\x67", $Z1, $lW, $Mx);
            $z7 = array_map("\x74\162\x69\x6d", explode("\54", $lW));
            if (!(array_intersect($Z1, $z7) == $Z1 || true === $To)) {
                goto iH7;
            }
            if (!$Mx) {
                goto C4Y;
            }
            if (!(0 === $gR)) {
                goto COU;
            }
            $m6->set_role('');
            COU:
            $m6->add_role($Mx);
            $gR++;
            C4Y:
            iH7:
            LAp:
        }
        v00:
        uGy:
        $Ga++;
        goto FyC;
        cHO:
        HGa:
        if (empty($this->group_name[0])) {
            goto hwD;
        }
        $Ig = '';
        $Ai = get_site_option("\x6d\x6f\x5f\157\141\165\164\x68\x5f\141\x70\160\x73\x5f\154\x69\163\164");
        $ri = isset($this->app_config["\165\156\151\x71\165\x65\137\x61\160\x70\x69\144"]) ? $this->app_config["\165\x6e\x69\161\165\x65\x5f\x61\x70\160\151\144"] : '';
        if (!is_array($Ai)) {
            goto RDg;
        }
        foreach ($Ai as $Or => $zB) {
            $he = $zB->get_app_config();
            if (!($this->app_config["\x61\x70\x70\x49\x64"] == $he["\x61\x70\x70\111\x64"] && $ri === $Or)) {
                goto Ybi;
            }
            MO_Oauth_Debug::mo_oauth_log("\x63\157\155\160\x61\x72\x65\x64\40\x61\x6e\x64\40\146\x6f\165\x6e\144\40\143\x75\x72\162\145\156\x74\40\141\x70\x70\40\55\40" . $Or);
            $Ig = $Or;
            Ybi:
            C6P:
        }
        hmF:
        RDg:
        global $lT;
        $jd = isset($this->app_config["\165\x73\x65\162\x6e\x61\155\145\137\x61\x74\164\162"]) ? $this->app_config["\165\163\x65\162\x6e\x61\155\145\x5f\x61\164\164\162"] : '';
        $dw = isset($this->app_config["\x65\x6d\141\151\x6c\x5f\x61\x74\x74\162"]) ? $this->app_config["\145\x6d\141\x69\154\137\x61\164\x74\x72"] : '';
        $VR = isset($this->app_config["\146\151\x72\163\164\x6e\141\x6d\x65\137\x61\164\x74\162"]) ? $this->app_config["\x66\151\x72\x73\x74\x6e\x61\x6d\x65\x5f\x61\x74\x74\162"] : '';
        $Om = isset($this->app_config["\x6c\x61\163\x74\156\x61\x6d\145\137\x61\164\164\162"]) ? $this->app_config["\154\x61\x73\164\156\141\155\x65\137\141\164\x74\x72"] : '';
        $vP = $lT->getnestedattribute($tJ, $jd);
        $q3 = $lT->getnestedattribute($tJ, $dw);
        $Ex = $lT->getnestedattribute($tJ, $VR);
        $ga = $lT->getnestedattribute($tJ, $Om);
        Mo_Oauth_Debug::mo_oauth_log("\x53\145\156\164\40\x64\145\x74\141\x69\154\163\x20\x74\x6f\x20\154\145\x61\x72\x6e\x64\x61\x73\150\72\40");
        Mo_Oauth_Debug::mo_oauth_log($vP);
        Mo_Oauth_Debug::mo_oauth_log(json_encode($this->group_name));
        Mo_Oauth_Debug::mo_oauth_log($Ig);
        do_action("\x6d\157\x5f\157\141\165\164\x68\137\x61\x74\x74\162\x69\x62\165\164\145\163", $vP, $q3, $Ex, $ga, $this->group_name, $Ig);
        hwD:
        if (!has_filter("\155\x6f\x5f\163\145\x74\x5f\x63\165\x72\x72\x65\x6e\164\x5f\x73\x69\x74\x65\137\162\157\154\x65\x73")) {
            goto Z7W;
        }
        $blog_id = get_current_blog_id();
        if (0 === $iT["\x72\x6f\154\145\163"] && isset($this->app_config["\x6d\157\x5f\x73\x75\x62\163\151\164\x65\x5f\x72\157\x6c\x65\x5f\x6d\141\x70\x70\x69\156\x67"][$blog_id]["\x5f\155\141\x70\x70\151\x6e\147\137\x76\x61\154\165\145\x5f\x64\x65\146\141\165\154\164"]) && '' !== $this->app_config["\155\157\x5f\x73\x75\x62\163\x69\x74\145\x5f\x72\157\x6c\145\137\155\141\160\x70\x69\x6e\x67"][$blog_id]["\137\155\141\160\x70\151\x6e\x67\137\166\141\154\x75\x65\137\144\145\x66\x61\x75\x6c\x74"]) {
            goto stt;
        }
        if (!(0 === $iT["\162\x6f\x6c\145\163"] && empty($this->app_config["\x6d\157\x5f\163\165\142\163\x69\x74\x65\137\x72\x6f\154\x65\137\x6d\x61\160\x70\151\x6e\147"][$blog_id]["\x5f\x6d\x61\x70\160\x69\156\147\137\x76\x61\154\165\145\x5f\x64\x65\x66\x61\165\154\x74"]))) {
            goto nHq;
        }
        $m6->set_role("\x73\x75\142\x73\x63\x72\x69\x62\x65\x72");
        nHq:
        goto jNE;
        stt:
        $m6->set_role($this->app_config["\155\157\x5f\163\x75\x62\x73\x69\164\145\x5f\162\157\154\x65\137\155\141\x70\160\x69\x6e\147"][$blog_id]["\137\x6d\141\160\160\151\x6e\x67\137\x76\x61\154\165\x65\x5f\144\x65\146\141\165\154\164"]);
        jNE:
        goto he4;
        Z7W:
        if (!(0 === $gR && isset($this->app_config["\x5f\x6d\x61\160\160\151\156\147\x5f\166\141\x6c\x75\x65\137\144\x65\x66\141\x75\154\164"]) && '' !== $this->app_config["\x5f\x6d\x61\x70\x70\151\156\147\x5f\x76\141\x6c\165\145\x5f\144\x65\146\141\x75\154\x74"])) {
            goto mXz;
        }
        $cJ = explode("\54", $this->app_config["\137\155\141\160\160\x69\156\147\x5f\x76\141\154\x75\145\137\144\x65\x66\141\x75\154\x74"]);
        $gR = 0;
        foreach ($cJ as $VS) {
            if (!(0 === $gR)) {
                goto LaY;
            }
            $m6->set_role('');
            LaY:
            $VS = trim($VS);
            $m6->add_role($VS);
            $gR++;
            Nhl:
        }
        NCR:
        mXz:
        he4:
        if (!has_filter("\x6d\157\137\163\165\x62\163\151\x74\x65\x5f\x63\150\145\x63\x6b\x5f\x61\154\154\157\167\x5f\154\x6f\147\151\x6e")) {
            goto TBk;
        }
        $Ey = apply_filters("\155\x6f\137\x73\x75\142\163\x69\164\x65\137\x63\150\145\x63\x6b\137\x61\x6c\x6c\x6f\x77\x5f\154\x6f\x67\151\x6e", $this->app_config, $this->group_name, $iT["\155\141\160\160\x65\144\137\x72\157\x6c\145\163"]);
        goto UhE;
        TBk:
        $hE = 0;
        if (!(isset($this->app_config["\x72\x65\163\164\x72\x69\x63\x74\137\154\x6f\147\151\x6e\x5f\x66\x6f\x72\x5f\155\x61\x70\x70\x65\x64\137\x72\x6f\154\145\163"]) && boolval($this->app_config["\162\x65\x73\164\x72\x69\143\164\137\x6c\157\x67\151\156\137\x66\x6f\x72\137\x6d\x61\160\160\x65\144\137\x72\157\154\145\x73"]))) {
            goto WCq;
        }
        foreach ($this->group_name as $Nh) {
            if (!(in_array($Nh, $eL, true) || true === $To)) {
                goto Ygx;
            }
            $hE = 1;
            Ygx:
            E4Q:
        }
        qf6:
        if (!($hE !== 1)) {
            goto I_s;
        }
        require_once ABSPATH . "\167\160\55\x61\144\x6d\151\x6e\57\151\x6e\x63\154\x75\144\x65\x73\57\x75\x73\145\162\56\160\150\x70";
        if (has_filter("\155\157\x5f\162\145\163\164\162\151\143\164\x5f\x77\160\137\x75\163\145\162\x5f\x64\145\154\x65\x74\x65")) {
            goto OkJ;
        }
        \wp_delete_user($this->user_id);
        OkJ:
        global $lT;
        $TA = "\x59\x6f\165\40\x64\x6f\40\x6e\157\164\x20\x68\x61\x76\x65\x20\x70\x65\x72\155\x69\163\x73\x69\157\156\x73\x20\164\157\40\x6c\157\147\x69\x6e\40\x77\x69\x74\150\x20\171\157\x75\162\40\x63\165\162\x72\x65\x6e\x74\40\162\x6f\154\145\x73\x2e\40\x50\154\145\x61\x73\145\40\x63\x6f\156\164\x61\x63\164\40\x74\150\145\x20\x41\x64\x6d\x69\156\x69\x73\x74\162\x61\164\157\x72\56";
        $lT->handle_error($TA);
        wp_die($TA);
        I_s:
        WCq:
        UhE:
    }
}
