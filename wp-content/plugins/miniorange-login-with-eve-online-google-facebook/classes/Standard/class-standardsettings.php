<?php


namespace MoOauthClient\Standard;

use MoOauthClient\Free\FreeSettings;
use MoOauthClient\Free\CustomizationSettings;
use MoOauthClient\Standard\AppSettings;
use MoOauthClient\Standard\SignInSettingsSettings;
use MoOauthClient\Standard\Customer;
use MoOauthClient\App;
use MoOauthClient\Config;
use MoOauthClient\Widget\MOUtils;
class StandardSettings
{
    private $free_settings;
    public function __construct()
    {
        add_filter("\x63\x72\x6f\x6e\137\x73\143\x68\x65\144\165\154\x65\x73", array($this, "\155\157\137\157\x61\x75\x74\150\137\x73\x63\150\x65\144\165\154\145"));
        if (wp_next_scheduled("\155\x6f\x5f\x6f\141\165\x74\150\x5f\x73\x63\150\145\x64\165\154\x65")) {
            goto VUM;
        }
        wp_schedule_event(time(), "\145\x76\x65\x72\x79\137\156\x5f\x6d\151\x6e\165\x74\x65\163", "\155\x6f\137\157\141\165\164\150\x5f\x73\143\150\145\144\x75\x6c\145");
        VUM:
        add_action("\155\157\x5f\x6f\x61\165\x74\150\137\x73\x63\x68\145\x64\165\x6c\145", array($this, "\x65\x76\x65\162\x79\x5f\163\145\166\x65\156\x5f\144\141\171\163\137\145\166\x65\x6e\164\137\x66\x75\x6e\143"));
        $this->free_settings = new FreeSettings();
        add_action("\141\144\x6d\151\156\137\151\156\x69\x74", array($this, "\155\x6f\x5f\x6f\x61\x75\x74\150\137\143\154\151\x65\x6e\x74\137\x73\x74\141\x6e\x64\x61\162\144\x5f\x73\x65\164\x74\151\156\147\x73"));
        add_action("\144\157\137\x6d\141\x69\156\137\163\x65\164\164\151\x6e\x67\x73\137\x69\x6e\164\145\162\x6e\x61\x6c", array($this, "\144\x6f\x5f\x69\x6e\164\x65\162\156\x61\154\137\x73\145\x74\164\x69\156\x67\163"), 1, 10);
    }
    public function mo_oauth_schedule($Sf)
    {
        $Sf["\145\166\145\162\x79\137\x6e\x5f\x6d\151\x6e\x75\164\x65\x73"] = array("\x69\x6e\164\x65\x72\x76\141\154" => 60 * 60 * 24 * 7, "\x64\151\163\x70\154\x61\171" => __("\x45\x76\x65\x72\x79\40\156\x20\x4d\151\x6e\165\x74\145\x73", "\164\145\170\x74\x64\157\x6d\x61\x69\156"));
        return $Sf;
    }
    public function mo_oauth_update_license_expiry()
    {
        $this->every_seven_days_event_func();
    }
    public function every_seven_days_event_func()
    {
        global $lT;
        $HW = new Customer();
        $VI = $HW->check_customer_ln();
        $VI = json_decode($VI, true);
        $this->mo_oauth_initiate_expiration($VI);
        $this->mo_oauth_initiate_license_domain_check($HW);
    }
    public function mo_oauth_initiate_expiration($VI)
    {
        global $lT;
        $XT = "\144\x69\x73\x61\x62\x6c\x65\144";
        $ii = new SignInSettingsSettings();
        $zB = $ii->get_config_option();
        if (!isset($VI["\x6c\151\x63\x65\x6e\163\145\x45\170\160\x69\x72\171"])) {
            goto Gw4;
        }
        $of = $VI["\x6c\x69\143\145\156\163\145\x45\x78\160\x69\162\171"];
        $Co = false;
        $tU = date("\131\55\x6d\55\x64\x20\x48\72\151\72\163");
        $of <= $tU ? $Co = "\145\156\141\x62\154\x65\144" : ($Co = "\144\151\x73\x61\142\x6c\x65\144");
        $zB->add_config("\155\x6f\137\144\x74\x65\x5f\163\164\x61\x74\x65", $lT->mooauthencrypt($Co));
        $zB->add_config("\x6d\157\x5f\x64\x74\x65\137\x64\x61\164\x61", $lT->mooauthencrypt($of));
        $ii->save_config_option($zB);
        Gw4:
    }
    public function mo_oauth_initiate_license_domain_check($HW)
    {
        global $lT;
        $iE = $lT->mo_oauth_client_get_option("\x6d\157\137\157\141\x75\164\150\x5f\154\x6b");
        $NR = $lT->mooauthdecrypt($iE);
        $VI = json_decode($HW->XfskodsfhHJ($NR), true);
        if (isset($VI) && strcasecmp($VI["\x73\164\141\164\165\163"], "\106\101\x49\x4c\x45\x44") === 0) {
            goto vh6;
        }
        if (isset($VI) && strcasecmp($VI["\163\x74\141\x74\x75\163"], "\x53\125\x43\x43\105\123\x53") === 0) {
            goto KSb;
        }
        goto wO5;
        vh6:
        if (!(strcasecmp($VI["\x6d\x65\x73\163\141\147\x65"], "\103\157\x64\145\40\150\x61\163\x20\x45\x78\x70\x69\x72\145\144") === 0)) {
            goto k6w;
        }
        $lT->mo_oauth_client_update_option("\x6d\157\x5f\157\141\x75\x74\x68\137\x6c\144", $lT->mooauthencrypt("\x66\x61\154\163\x65"));
        k6w:
        goto wO5;
        KSb:
        $lT->mo_oauth_client_update_option("\x6d\x6f\x5f\157\x61\165\164\150\137\x6c\x64", $lT->mooauthencrypt("\x74\162\165\x65"));
        wO5:
    }
    public function mo_oauth_client_standard_settings()
    {
        $bI = new CustomizationSettings();
        $ii = new SignInSettingsSettings();
        $iX = new AppSettings();
        $bI->save_customization_settings();
        $iX->save_app_settings();
        $ii->mo_oauth_save_settings();
    }
    public function do_internal_settings($post)
    {
        global $lT;
        if (!(isset($_POST["\155\157\137\x6f\141\165\x74\x68\x5f\143\154\x69\x65\x6e\164\x5f\x76\x65\162\x69\146\x79\x5f\154\151\x63\x65\x6e\163\145\x5f\156\x6f\x6e\x63\145"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\x6d\157\137\157\141\x75\x74\150\x5f\x63\x6c\x69\145\156\164\x5f\x76\145\162\x69\x66\171\137\154\151\x63\x65\156\x73\x65\137\156\x6f\156\143\145"])), "\x6d\157\137\x6f\141\x75\x74\x68\137\x63\154\151\x65\x6e\x74\137\x76\145\162\151\x66\x79\137\x6c\151\x63\145\156\x73\145") && isset($post[\MoOAuthConstants::OPTION]) && "\x6d\157\137\157\x61\x75\x74\150\137\143\x6c\151\x65\x6e\x74\x5f\x76\145\x72\151\x66\x79\x5f\154\x69\143\x65\x6e\x73\145" === $post[\MoOAuthConstants::OPTION])) {
            goto JmJ;
        }
        if (!(!isset($post["\x6d\157\x5f\157\141\165\164\x68\137\143\x6c\x69\x65\x6e\x74\137\x6c\151\143\145\156\x73\145\137\153\x65\171"]) || empty($post["\x6d\157\137\157\141\x75\164\x68\137\143\x6c\151\x65\x6e\164\137\x6c\151\143\145\x6e\x73\x65\137\x6b\x65\x79"]))) {
            goto zVG;
        }
        $lT->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\120\154\145\141\x73\x65\40\145\x6e\x74\x65\162\40\x76\141\154\x69\144\40\154\151\143\x65\156\x73\x65\x20\x6b\145\171\x2e");
        $this->mo_oauth_show_error_message();
        return;
        zVG:
        $NR = trim($post["\155\x6f\x5f\157\141\165\164\x68\137\143\x6c\x69\145\x6e\164\137\x6c\x69\143\x65\x6e\163\145\x5f\x6b\145\171"]);
        $HW = new Customer();
        $VI = json_decode($HW->check_customer_ln(), true);
        $lb = false;
        if (!(isset($VI["\x69\163\115\165\154\x74\151\123\x69\x74\145\120\154\x75\x67\151\x6e\122\x65\161\x75\x65\x73\164\145\144"]) && boolval($VI["\x69\x73\115\165\154\x74\x69\123\x69\x74\x65\120\154\165\147\x69\156\x52\145\161\165\145\x73\x74\145\x64"]) && is_multisite())) {
            goto fMg;
        }
        $lb = boolval($VI["\x69\x73\x4d\x75\x6c\x74\x69\123\x69\x74\145\x50\154\x75\x67\151\x6e\122\145\x71\x75\x65\163\164\x65\x64"]);
        $lT->mo_oauth_client_update_option("\155\157\137\157\x61\165\x74\150\137\x69\163\115\x75\x6c\x74\151\x53\151\x74\145\x50\154\x75\147\151\x6e\x52\145\x71\165\x65\x73\x74\145\x64", $lb);
        $lT->mo_oauth_client_update_option("\x6e\157\117\146\x53\165\142\x53\151\x74\x65\163", intval($VI["\x6e\x6f\x4f\x66\x53\x75\x62\123\x69\164\x65\163"]));
        fMg:
        $DF = 0;
        if (!is_multisite()) {
            goto ol7;
        }
        if (!function_exists("\147\145\164\137\x73\151\164\x65\163")) {
            goto WUp;
        }
        $DF = count(get_sites(["\156\165\155\142\145\162" => 1000])) - 1;
        WUp:
        ol7:
        if (!(is_multisite() && $lb && ($lb && (!array_key_exists("\x6e\157\x4f\146\x53\165\x62\123\x69\x74\145\x73", $VI) && $lT->is_multisite_versi())))) {
            goto Xs3;
        }
        $Kd = $lT->mo_oauth_client_get_option("\x68\157\x73\x74\x5f\x6e\x61\x6d\145");
        $Kd .= "\x2f\x6d\157\x61\163\57\x6c\157\147\x69\x6e\77\162\145\144\151\x72\145\x63\x74\x55\162\x6c\75";
        $Kd .= $lT->mo_oauth_client_get_option("\x68\x6f\163\x74\x5f\156\x61\155\x65");
        $Kd .= "\57\x6d\157\141\163\57\x69\x6e\x69\x74\151\x61\x6c\151\x7a\145\160\x61\171\155\145\156\164\77\x72\145\x71\x75\145\163\164\117\x72\151\147\x69\156\x3d";
        $Kd .= "\x77\x70\x5f\157\141\165\164\150\137\143\x6c\151\x65\x6e\x74\137" . strtolower($lT->get_versi_str()) . "\x5f\x70\x6c\x61\156";
        $lT->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\131\157\165\x20\150\x61\166\x65\x20\156\x6f\164\x20\x75\x70\x67\162\141\144\x65\144\x20\x74\x6f\x20\164\x68\145\40\x63\x6f\162\x72\x65\143\164\x20\x6c\151\143\x65\156\x73\145\x20\x70\x6c\141\156\56\x20\105\151\x74\150\145\162\x20\x79\x6f\x75\40\150\141\x76\145\40\160\165\x72\143\x68\x61\163\145\144\x20\146\x6f\162\40\x69\156\143\157\162\162\x65\x63\x74\40\156\x6f\x2e\x20\157\146\x20\x73\151\164\x65\163\x20\x6f\x72\40\171\x6f\x75\40\150\141\x76\x65\40\156\x6f\164\40\x73\x65\x6c\x65\143\164\145\144\x20\x6d\165\x6c\x74\x69\163\x69\x74\x65\x20\157\160\164\151\x6f\x6e\x20\x77\x68\151\154\145\x20\160\165\162\143\x68\141\x73\151\156\147\x2e\x20\74\141\x20\x74\141\162\x67\145\x74\x3d\x22\137\142\154\141\x6e\x6b\x22\x20\150\162\145\146\x3d\x22" . $Kd . "\42\40\x3e\103\154\x69\143\153\40\150\145\x72\145\74\57\x61\x3e\40\x74\157\x20\165\x70\x67\162\x61\144\x65\x20\x74\157\x20\x70\162\x65\155\x69\165\155\x20\166\145\x72\x73\151\157\156\56");
        $lT->mo_oauth_show_error_message();
        return;
        Xs3:
        if (strcasecmp($VI["\163\164\141\164\165\163"], "\x53\x55\103\x43\x45\123\x53") === 0) {
            goto S9b;
        }
        $lT->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\131\x6f\x75\40\x68\x61\x76\145\156\47\x74\x20\x75\x70\x67\162\141\144\x65\x64\40\164\157\x20\164\150\x69\x73\x20\x70\154\x61\x6e\x20\x79\x65\164\x2e");
        $lT->mo_oauth_show_error_message();
        goto I4U;
        S9b:
        $fM = $VI;
        $VI = json_decode($HW->XfskodsfhHJ($NR), true);
        if (isset($VI)) {
            goto GSJ;
        }
        $lT->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\120\154\145\141\163\145\40\143\x68\145\143\153\x20\x69\x66\x20\171\x6f\x75\x20\x68\x61\x76\145\x20\145\x6e\x74\x65\x72\145\x64\x20\141\x20\166\x61\154\151\x64\40\x6c\151\x63\145\x6e\x73\145\x20\153\145\171");
        $lT->mo_oauth_show_error_message();
        goto bNZ;
        GSJ:
        if (strcasecmp($VI["\163\164\x61\164\x75\x73"], "\x53\x55\103\103\105\x53\x53") === 0) {
            goto ZPJ;
        }
        if (strcasecmp($VI["\x73\x74\x61\164\165\163"], "\x46\101\x49\114\105\x44") === 0) {
            goto m22;
        }
        $lT->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\101\156\x20\x65\162\x72\157\162\x20\x6f\143\143\x75\x72\x65\x64\x20\167\150\x69\x6c\x65\x20\x70\162\x6f\143\x65\163\x73\x69\156\147\x20\171\x6f\165\x72\x20\x72\x65\x71\x75\x65\x73\x74\x2e\x20\120\x6c\145\x61\163\x65\40\124\x72\x79\40\141\x67\141\151\x6e\x2e");
        $lT->mo_oauth_show_error_message();
        goto F6K;
        ZPJ:
        $lT->mo_oauth_client_update_option("\x6d\157\137\157\141\165\164\x68\x5f\x6c\x6b", $lT->mooauthencrypt($NR));
        $lT->mo_oauth_client_update_option("\155\157\x5f\157\x61\x75\164\150\x5f\154\x76", $lT->mooauthencrypt("\164\x72\x75\145"));
        $this->mo_oauth_initiate_expiration($fM);
        $Tx = $lT->get_app_list();
        if (!(!empty($Tx) && is_array($Tx))) {
            goto CRv;
        }
        foreach ($Tx as $Ig => $Lq) {
            if (is_array($Lq) && !empty($Lq)) {
                goto wc3;
            }
            if (boolval($Lq->get_app_config("\x63\154\x69\x65\156\164\x5f\x63\162\x65\x64\x73\137\145\x6e\x63\162\x70\x79\164\x65\144"))) {
                goto Wwx;
            }
            $M4 = $Lq->get_app_config("\143\x6c\151\145\156\164\137\151\144");
            !empty($M4) ? $Lq->update_app_config("\x63\154\151\145\156\x74\x5f\151\x64", $lT->mooauthencrypt($M4)) : '';
            $oM = $Lq->get_app_config("\x63\x6c\x69\x65\x6e\164\x5f\x73\x65\143\x72\145\x74");
            !empty($oM) ? $Lq->update_app_config("\143\x6c\x69\145\x6e\164\137\163\x65\x63\162\145\x74", $lT->mooauthencrypt($oM)) : '';
            $Lq->update_app_config("\x63\x6c\151\145\x6e\x74\137\x63\162\145\144\163\x5f\145\156\143\x72\x70\x79\x74\145\x64", true);
            Wwx:
            $Re[$Ig] = $Lq;
            goto MZc;
            wc3:
            if (!(!isset($Lq["\143\x6c\151\145\x6e\164\137\x69\144"]) || empty($Lq["\143\x6c\x69\x65\x6e\164\x5f\x69\144"]))) {
                goto L1X;
            }
            $Lq["\143\154\x69\145\156\x74\x5f\x69\144"] = isset($Lq["\143\154\x69\x65\x6e\164\x69\144"]) ? $Lq["\x63\154\151\145\156\164\151\x64"] : '';
            L1X:
            if (!(!isset($Lq["\143\x6c\x69\x65\x6e\x74\137\163\145\143\x72\x65\x74"]) || empty($Lq["\x63\x6c\151\145\156\164\x5f\x73\145\143\x72\145\164"]))) {
                goto Wxf;
            }
            $Lq["\143\x6c\151\145\156\x74\x5f\x73\x65\143\x72\145\x74"] = isset($Lq["\143\154\151\x65\156\164\163\x65\x63\162\145\x74"]) ? $Lq["\x63\x6c\151\x65\x6e\164\163\x65\143\162\145\164"] : '';
            Wxf:
            unset($Lq["\143\x6c\x69\145\156\164\151\x64"]);
            unset($Lq["\143\154\151\145\156\x74\163\x65\143\x72\x65\x74"]);
            if (!(!isset($Lq["\x63\x6c\x69\x65\156\x74\137\x63\x72\145\x64\x73\137\145\x6e\x63\x72\160\x79\164\x65\x64"]) || !boolval($Lq["\x63\154\151\145\x6e\164\137\143\162\x65\x64\x73\x5f\145\156\x63\x72\160\x79\x74\145\x64"]))) {
                goto gEt;
            }
            isset($Lq["\143\154\x69\145\156\164\x5f\x69\144"]) ? $Lq["\143\154\151\145\x6e\164\137\x69\x64"] = $lT->mooauthencrypt($Lq["\x63\154\x69\x65\156\164\x5f\x69\144"]) : '';
            isset($Lq["\x63\154\151\x65\x6e\164\137\x73\145\143\162\145\164"]) ? $Lq["\143\x6c\x69\145\156\x74\137\163\145\x63\x72\145\x74"] = $lT->mooauthencrypt($Lq["\x63\154\151\145\156\x74\137\163\145\143\162\x65\164"]) : '';
            $Lq["\x63\154\x69\145\156\x74\x5f\143\x72\x65\x64\x73\x5f\x65\x6e\143\x72\x70\x79\x74\145\x64"] = true;
            gEt:
            $kp = new App();
            $kp->migrate_app($Lq, $Ig);
            $Re[$Ig] = $kp;
            MZc:
            F8T:
        }
        ntc:
        CRv:
        !empty($Tx) ? $lT->mo_oauth_client_update_option("\x6d\157\137\157\141\165\x74\150\x5f\141\x70\x70\x73\x5f\x6c\151\x73\164", $Re) : '';
        $lT->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\131\x6f\x75\162\40\154\x69\143\x65\x6e\x73\145\x20\x69\163\40\x76\x65\x72\x69\146\x69\145\x64\x2e\40\x59\x6f\165\x20\x63\x61\156\x20\x6e\x6f\x77\40\163\145\164\x75\x70\40\x74\x68\x65\40\x70\154\165\147\x69\x6e\x2e");
        $lT->mo_oauth_show_success_message();
        goto F6K;
        m22:
        if (strcasecmp($VI["\x6d\145\x73\163\141\x67\145"], "\103\x6f\144\145\x20\150\x61\163\40\x45\x78\x70\151\162\145\144") === 0) {
            goto IkN;
        }
        $lT->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\131\157\x75\40\150\x61\166\x65\x20\145\156\164\x65\x72\145\x64\40\x61\156\40\151\156\x76\141\x6c\151\144\x20\x6c\151\143\x65\x6e\163\x65\40\x6b\145\171\56\x20\120\x6c\x65\141\x73\x65\x20\x65\156\x74\145\162\40\141\40\166\x61\x6c\x69\144\40\x6c\151\143\x65\156\x73\x65\x20\153\145\171\56");
        $lT->mo_oauth_show_error_message();
        goto doF;
        IkN:
        $lT->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\114\x69\x63\x65\x6e\x73\145\40\x6b\x65\171\x20\171\x6f\165\x20\150\x61\166\x65\40\x65\156\x74\145\x72\x65\x64\x20\150\x61\x73\x20\141\x6c\x72\145\141\144\171\40\x62\145\145\156\40\165\x73\145\144\56\x20\x50\x6c\145\x61\x73\145\40\x65\x6e\x74\145\162\x20\x61\x20\153\x65\171\x20\x77\x68\151\x63\x68\x20\x68\x61\x73\40\x6e\x6f\x74\x20\x62\145\145\x6e\40\165\x73\x65\144\40\142\145\146\157\162\145\40\157\156\x20\141\x6e\x79\40\x6f\164\x68\145\x72\40\151\x6e\163\x74\141\x6e\143\x65\40\x6f\x72\x20\151\x66\x20\171\x6f\x75\x20\150\141\x76\145\40\145\x78\x61\x75\x73\x74\145\144\40\x61\154\x6c\40\171\157\165\162\x20\x6b\x65\171\x73\40\164\x68\145\156\40\142\165\171\40\x6d\157\x72\x65\56");
        $lT->mo_oauth_show_error_message();
        doF:
        F6K:
        bNZ:
        I4U:
        JmJ:
        if (!(isset($_POST["\155\157\x5f\x6f\x61\x75\164\150\137\143\150\x61\x6e\x67\145\x5f\154\151\143\x65\x6e\163\x65\x5f\x6e\x6f\156\143\x65"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\155\157\137\x6f\141\x75\164\x68\x5f\x63\x68\x61\156\147\x65\137\x6c\x69\143\x65\x6e\163\145\137\156\x6f\156\143\145"])), "\155\157\x5f\157\x61\x75\164\150\137\x63\x68\141\x6e\x67\x65\137\154\151\x63\x65\156\163\145") && isset($_POST[\MoOAuthConstants::OPTION]) && "\143\x68\x61\156\147\x65\x5f\154\x69\143\x65\156\163\x65" === $_POST[\MoOAuthConstants::OPTION])) {
            goto xPL;
        }
        $this->mo_oauth_update_license_expiry();
        return;
        xPL:
    }
}
