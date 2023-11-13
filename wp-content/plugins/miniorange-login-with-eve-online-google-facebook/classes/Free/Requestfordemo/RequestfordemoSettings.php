<?php


namespace MoOauthClient\Free;

use MoOauthClient\Customer;
class RequestfordemoSettings
{
    public function save_requestdemo_settings()
    {
        global $lT;
        if (!(isset($_POST["\155\157\x5f\x6f\x61\165\x74\x68\x5f\x61\160\160\137\162\145\161\165\145\x73\164\144\145\x6d\157\137\x6e\x6f\156\143\145"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\155\157\137\x6f\x61\165\164\150\137\141\x70\x70\137\162\145\x71\165\145\163\164\144\145\155\x6f\x5f\156\157\x6e\143\x65"])), "\155\157\137\x6f\141\165\164\x68\137\141\x70\160\137\x72\145\161\165\145\x73\164\144\145\155\x6f") && isset($_POST[\MoOAuthConstants::OPTION]) && "\x6d\x6f\x5f\157\141\x75\x74\150\x5f\141\x70\160\x5f\x72\145\x71\x75\145\x73\x74\x64\145\x6d\157" === $_POST[\MoOAuthConstants::OPTION])) {
            goto OJ;
        }
        $q3 = $_POST["\155\157\x5f\x6f\141\x75\164\150\x5f\143\x6c\151\x65\x6e\x74\137\x64\145\155\157\x5f\145\x6d\141\151\x6c"];
        $R5 = $_POST["\x6d\157\x5f\157\x61\x75\164\150\x5f\x63\x6c\x69\x65\156\x74\x5f\144\x65\155\157\x5f\x70\x6c\141\x6e"];
        $Vz = $_POST["\x6d\x6f\137\x6f\141\165\164\x68\x5f\143\154\151\145\156\x74\x5f\144\x65\155\x6f\x5f\x64\x65\x73\x63\x72\x69\x70\164\x69\x6f\156"];
        $HW = new Customer();
        if ($lT->mo_oauth_check_empty_or_null($q3) || $lT->mo_oauth_check_empty_or_null($R5)) {
            goto Fg;
        }
        $gr = json_decode($HW->mo_oauth_send_demo_alert($q3, $R5, $Vz, "\127\x50\40\117\101\165\x74\x68\40\123\x69\x6e\x67\x6c\x65\40\123\x69\147\156\40\117\x6e\x20\104\145\x6d\x6f\x20\122\145\x71\x75\x65\x73\x74\40\55\x20" . $q3), true);
        $lT->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\x54\150\x61\x6e\153\x73\40\146\157\x72\x20\x67\x65\164\164\x69\x6e\147\x20\151\156\40\x74\157\x75\x63\x68\41\x20\x57\x65\40\x73\150\141\154\154\40\x67\x65\x74\40\142\x61\x63\153\40\x74\157\x20\171\x6f\165\40\163\x68\x6f\162\x74\x6c\171\x2e");
        $lT->mo_oauth_show_success_message();
        goto q4;
        Fg:
        $lT->mo_oauth_client_update_option(\MoOAuthConstants::PANEL_MESSAGE_OPTION, "\x50\x6c\x65\141\x73\x65\x20\146\151\154\154\x20\x75\x70\40\x45\x6d\141\151\x6c\x20\x66\151\145\154\144\40\164\x6f\40\x73\165\x62\155\x69\164\x20\x79\x6f\x75\x72\x20\161\165\x65\x72\x79\x2e");
        $lT->mo_oauth_show_success_message();
        q4:
        OJ:
    }
}
