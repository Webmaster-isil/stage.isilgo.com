<?php


namespace MoOauthClient;

class Backup
{
    function backup()
    {
        global $lT;
        $zB = $lT->get_plugin_config()->get_current_config();
        $M9 = "\x64\151\163\x61\142\x6c\x65\144";
        if (empty($zB["\155\x6f\137\144\x74\145\137\163\x74\x61\x74\145"])) {
            goto W6;
        }
        $M9 = $lT->mooauthdecrypt($zB["\155\157\137\144\x74\145\137\163\x74\141\x74\x65"]);
        W6:
        $W7 = $lT->mo_oauth_client_get_option("\x6d\x6f\137\x6f\x61\x75\164\x68\137\141\160\160\x73\x5f\x6c\x69\x73\x74");
        echo "\74\x70\x72\145\x3e";
        echo "\74\57\x70\162\145\x3e";
        echo "\11\x9\x3c\144\x69\x76\x20\x69\144\x3d\42\x6d\x6f\137\157\x61\x75\164\x68\x5f\142\x61\143\x6b\165\160\x5f\154\141\x79\157\165\164\x22\40\143\x6c\141\x73\x73\x3d\x22\155\x6f\x5f\x73\x75\x70\x70\x6f\162\164\137\x6c\141\x79\x6f\165\x74\x22\76\xa\x9\11\11\x3c\x68\63\x3e\120\x6c\x75\147\x69\156\40\x42\x61\x63\153\x75\160\74\57\x68\x33\76\xa\x9\x9\11\x3c\x64\x69\166\x20\143\x6c\141\x73\x73\x3d\42\155\x6f\55\157\x61\x75\164\x68\55\x63\x6c\x69\x65\156\x74\55\x62\141\x63\153\165\x70\42\x3e\12\x20\40\x20\x20\x20\x20\40\x20\40\x20\40\x20\40\40\40\40\74\x68\64\76\x43\x75\162\x72\145\156\164\40\x53\x65\164\164\x69\156\x67\x73\74\57\150\64\76\12\11\11\x9\x9\x3c\x66\157\162\x6d\40\x69\144\x3d\42\155\x6f\137\157\x61\x75\164\x68\137\142\x61\x63\153\165\x70\x5f\146\157\x72\x6d\x22\40\x6d\x65\164\150\157\144\x3d\42\160\x6f\163\164\42\x3e\xa\11\11\x9\11\11\x3c\151\x6e\160\165\x74\x20\164\171\x70\x65\x3d\x22\x68\x69\x64\144\145\156\x22\40\x6e\x61\155\145\75\42\x6f\160\x74\151\157\x6e\x22\x20\166\141\154\x75\x65\75\x22\155\157\137\x6f\x61\x75\x74\150\137\x64\157\x77\156\x6c\157\x61\x64\x5f\142\141\x63\153\165\160\42\76\xa\x9\11\x9\11\11";
        wp_nonce_field("\155\157\137\157\x61\165\164\150\x5f\144\x6f\x77\156\154\157\141\144\x5f\x62\x61\x63\x6b\165\x70", "\155\157\137\157\x61\x75\164\150\137\x64\x6f\x77\x6e\x6c\157\x61\x64\x5f\142\141\143\x6b\165\x70\x5f\x6e\x6f\x6e\143\145");
        echo "\x9\11\x9\x9\x9\74\151\x6e\x70\165\x74\x20\x74\171\160\x65\x3d\42\x73\165\142\155\x69\x74\42\40\156\141\x6d\x65\75\42\x73\x75\142\x6d\151\x74\42\40\166\x61\x6c\165\145\75\42\x42\x61\x63\x6b\165\160\40\103\165\162\162\145\156\164\x20\123\x65\x74\x74\x69\x6e\x67\x73\42\40\x63\x6c\x61\x73\163\x3d\42\142\165\x74\164\x6f\156\40\x62\165\164\x74\157\156\x2d\x70\x72\x69\x6d\x61\x72\171\40\x62\x75\x74\164\157\156\x2d\x6c\141\x72\x67\x65\42\x20";
        if (!($M9 == "\x65\x6e\x61\142\154\145\144")) {
            goto m2;
        }
        echo "\x20\x64\x69\x73\x61\142\x6c\145\x64\40";
        m2:
        echo "\x3e\12\x9\x9\x9\11\x3c\x2f\146\157\162\155\76\12\x9\11\x9\74\57\x64\x69\166\76\12\11\11\x9\x3c\x64\x69\x76\40\143\154\141\x73\x73\75\42\155\x6f\55\157\x61\x75\x74\x68\x2d\x63\x6c\151\x65\156\164\x2d\x62\x61\x63\x6b\x75\160\x22";
        if (!($M9 == "\x65\156\141\x62\x6c\145\144")) {
            goto nK;
        }
        echo "\x20\x73\x74\x79\154\x65\75\x27\160\157\151\156\164\x65\x72\x2d\x65\166\145\156\x74\x73\x3a\156\157\156\x65\73\40\157\x70\141\x63\151\164\x79\x3a\x20\x30\56\65\73\x20\151\x6e\160\165\x74\x5b\164\x79\160\145\x3d\164\x65\170\164\x5d\x20\173\x62\x61\143\x6b\147\162\157\165\x6e\144\x3a\40\x23\x43\103\103\x3b\175\x27\40";
        nK:
        echo "\x3e\12\x20\40\40\40\x20\x20\40\40\40\40\x20\40\x20\40\40\40\x3c\x68\64\76\122\145\163\x74\157\162\x65\40\x50\x6c\x75\x67\x69\156\40\x53\x65\164\x74\151\156\147\x73\x3c\x2f\150\x34\76\xa\x9\x9\11\x9\x3c\146\157\162\155\x20\151\144\75\42\x6d\x6f\x5f\157\141\x75\164\x68\137\x62\141\143\x6b\165\x70\x5f\144\x6f\x77\156\154\x6f\141\x64\137\146\x6f\162\x6d\x22\40\155\145\x74\x68\157\144\75\x22\160\x6f\163\x74\42\x20\x65\156\143\164\171\160\145\x3d\42\155\165\154\x74\x69\160\141\162\x74\x2f\146\157\x72\155\x2d\x64\141\164\141\x22\x3e\12\11\x9\11\x9\11\x3c\x69\x6e\160\x75\164\40\x74\171\160\145\x3d\42\x68\151\x64\144\145\156\42\x20\156\x61\x6d\145\x3d\x22\x6f\x70\164\151\x6f\x6e\x22\x20\166\141\x6c\x75\x65\75\x22\x6d\157\x5f\x6f\x61\x75\x74\150\x5f\x72\x65\x73\164\x6f\162\x65\137\x62\x61\x63\x6b\x75\160\x22\76\xa\x9\11\x9\11\11";
        wp_nonce_field("\155\x6f\x5f\x6f\141\165\x74\x68\137\x72\x65\163\164\157\162\145\137\x62\141\x63\153\x75\x70", "\x6d\x6f\x5f\157\141\x75\x74\x68\137\162\x65\x73\164\157\162\x65\x5f\142\141\143\x6b\165\x70\x5f\x6e\157\x6e\x63\145");
        echo "\40\40\x20\x20\40\40\40\40\40\40\40\x20\x20\x20\x20\40\40\x20\x20\x20\120\154\x65\141\x73\x65\x20\x63\x68\157\x6f\163\145\40\141\x20\x66\x69\x6c\x65\72\40\74\151\x6e\x70\165\164\40\x6e\x61\155\145\x3d\x22\x6d\157\137\x6f\x61\165\x74\x68\137\x63\154\151\145\x6e\x74\x5f\142\141\x63\153\x75\x70\x22\40\164\171\160\145\x3d\42\146\151\x6c\145\42\40\x69\144\75\x22\155\x6f\x5f\x6f\x61\165\x74\x68\x5f\143\x6c\x69\x65\x6e\164\x5f\142\141\x63\153\165\160\42\76\x3c\x62\162\76\x3c\x62\162\76\xa\x9\x9\x9\x9\x9\74\x69\x6e\160\x75\164\40\x74\x79\x70\145\75\42\163\x75\x62\x6d\x69\x74\42\x20\156\x61\x6d\145\75\42\x73\165\142\155\x69\164\42\x20\x76\x61\x6c\x75\145\75\42\x52\x65\163\x74\157\162\145\40\105\x78\x69\163\x74\x69\x6e\x67\x20\x42\x61\143\x6b\x75\160\x22\x20\x63\154\141\163\163\x3d\42\x62\x75\x74\x74\157\x6e\40\x62\165\x74\x74\x6f\x6e\x2d\x70\162\x69\155\141\162\x79\x20\x62\x75\x74\164\157\156\x2d\x6c\141\162\x67\x65\x22";
        if (!($M9 == "\x65\156\x61\142\154\145\144")) {
            goto wN;
        }
        echo "\40\144\151\163\x61\x62\154\145\x64\x20";
        wN:
        echo "\76\12\x9\x9\11\11\x3c\x2f\x66\x6f\162\155\x3e\12\x9\x9\x9\74\x2f\144\151\166\x3e\xa\x9\11\74\x2f\144\151\166\76\12\x9";
    }
}