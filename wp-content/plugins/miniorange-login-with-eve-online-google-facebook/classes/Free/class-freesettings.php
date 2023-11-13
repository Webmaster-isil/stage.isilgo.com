<?php


namespace MoOauthClient\Free;

use MoOauthClient\Settings;
use MoOauthClient\Free\CustomizationSettings;
use MoOauthClient\Free\RequestfordemoSettings;
use MoOauthClient\Free\AppSettings;
use MoOauthClient\Customer;
class FreeSettings
{
    private $common_settings;
    public function __construct()
    {
        $this->common_settings = new Settings();
        add_action("\x61\144\x6d\151\x6e\x5f\x69\x6e\151\x74", array($this, "\155\x6f\x5f\157\x61\165\x74\150\137\x63\154\151\145\156\x74\x5f\146\x72\x65\x65\x5f\163\x65\164\x74\151\156\x67\163"));
        add_action("\x61\144\x6d\151\x6e\137\146\157\157\164\145\162", array($this, "\155\157\137\157\x61\165\164\x68\137\143\x6c\x69\x65\x6e\164\137\146\x65\145\x64\142\x61\x63\153\137\162\145\161\165\145\163\164"));
    }
    public function mo_oauth_client_free_settings()
    {
        global $lT;
        $bI = new CustomizationSettings();
        $WW = new RequestfordemoSettings();
        $bI->save_customization_settings();
        $WW->save_requestdemo_settings();
        $iX = new AppSettings();
        $iX->save_app_settings();
        if (!(isset($_POST["\x6d\x6f\137\x6f\141\x75\x74\150\x5f\x63\x6c\x69\x65\156\164\137\x66\x65\x65\144\142\141\x63\x6b\137\156\x6f\156\x63\x65"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\x6d\x6f\137\x6f\141\x75\x74\x68\137\x63\x6c\151\x65\x6e\164\137\x66\145\x65\144\142\141\143\153\x5f\x6e\157\156\x63\x65"])), "\155\157\137\157\141\165\x74\x68\137\x63\x6c\151\x65\x6e\x74\137\146\145\x65\x64\x62\141\143\153") && isset($_POST[\MoOAuthConstants::OPTION]) && "\155\x6f\137\x6f\x61\x75\164\150\137\x63\x6c\x69\x65\x6e\x74\137\146\145\x65\144\142\x61\x63\153" === $_POST[\MoOAuthConstants::OPTION])) {
            goto mY;
        }
        $user = wp_get_current_user();
        $kv = "\x50\x6c\165\147\151\x6e\x20\104\145\141\x63\164\151\166\x61\x74\145\x64\x3a";
        $xQ = isset($_POST["\x64\145\x61\x63\x74\151\x76\x61\164\x65\137\x72\145\141\x73\x6f\x6e\x5f\162\x61\144\x69\157"]) ? sanitize_text_field(wp_unslash($_POST["\x64\145\x61\x63\164\x69\166\141\x74\145\137\162\x65\x61\x73\157\156\137\162\141\x64\x69\x6f"])) : false;
        $pp = isset($_POST["\161\165\145\x72\171\137\x66\145\x65\x64\x62\x61\x63\153"]) ? sanitize_text_field(wp_unslash($_POST["\161\x75\x65\x72\x79\137\146\145\x65\x64\x62\141\x63\x6b"])) : false;
        if ($xQ) {
            goto xG;
        }
        $lT->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\120\x6c\145\x61\163\145\x20\123\145\x6c\145\143\x74\40\157\x6e\x65\x20\x6f\146\x20\x74\150\x65\40\162\145\x61\x73\157\156\x73\x20\x2c\151\146\x20\171\157\x75\162\x20\162\x65\141\163\x6f\156\40\x69\x73\40\156\157\164\x20\155\145\156\x74\151\157\156\x65\144\x20\x70\x6c\x65\x61\x73\145\x20\x73\145\x6c\145\143\x74\x20\x4f\164\x68\x65\x72\x20\122\x65\x61\x73\x6f\x6e\x73");
        $lT->mo_oauth_show_error_message();
        xG:
        $kv .= $xQ;
        if (!isset($pp)) {
            goto z2;
        }
        $kv .= "\72" . $pp;
        z2:
        $q3 = $lT->mo_oauth_client_get_option("\155\x6f\x5f\157\x61\165\164\150\x5f\141\144\x6d\151\156\x5f\145\155\141\151\x6c");
        if (!($q3 == '')) {
            goto Rj;
        }
        $q3 = $user->user_email;
        Rj:
        $O8 = $lT->mo_oauth_client_get_option("\155\x6f\x5f\x6f\x61\165\x74\150\137\x61\x64\155\151\x6e\x5f\x70\150\157\156\x65");
        $Wm = new Customer();
        $gr = json_decode($Wm->mo_oauth_send_email_alert($q3, $O8, $kv), true);
        deactivate_plugins(MOC_DIR . "\x6d\x6f\x5f\x6f\x61\165\x74\150\x5f\x73\145\x74\164\x69\156\x67\x73\56\x70\150\x70");
        $lT->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\x54\x68\x61\x6e\x6b\40\x79\x6f\165\x20\146\x6f\162\x20\164\x68\x65\40\x66\x65\x65\144\142\141\143\153\56");
        $lT->mo_oauth_show_success_message();
        mY:
        if (!(isset($_POST["\x6d\157\x5f\x6f\141\x75\164\x68\137\x63\x6c\151\x65\x6e\164\137\x73\153\x69\160\x5f\146\x65\145\x64\x62\141\143\153\137\156\x6f\x6e\143\145"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\x6d\157\x5f\x6f\x61\x75\x74\x68\137\x63\154\x69\x65\x6e\x74\x5f\163\153\151\160\137\x66\x65\x65\144\x62\x61\143\x6b\137\156\157\x6e\x63\145"])), "\x6d\157\137\157\x61\165\x74\x68\137\x63\154\151\x65\156\x74\x5f\163\153\x69\x70\137\x66\145\145\x64\x62\x61\143\x6b") && isset($_POST["\157\160\x74\x69\157\156"]) && "\155\157\x5f\x6f\x61\x75\164\x68\137\x63\x6c\x69\145\156\164\137\163\153\x69\x70\137\x66\145\x65\144\x62\141\x63\153" === $_POST["\x6f\160\164\151\x6f\156"])) {
            goto dV;
        }
        deactivate_plugins(MOC_DIR . "\155\x6f\x5f\157\x61\x75\x74\x68\137\163\145\164\x74\x69\156\x67\163\56\x70\x68\x70");
        $lT->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\120\x6c\165\x67\151\156\x20\104\x65\x61\143\164\151\x76\141\164\x65\144\56");
        $lT->mo_oauth_show_success_message();
        dV:
    }
    public function mo_oauth_client_feedback_request()
    {
        $gh = new \MoOauthClient\Free\Feedback();
        $gh->show_form();
    }
}
