<?php


use MoOauthClient\MO_Oauth_Debug;
function mo_oauth_client_auto_redirect_external_after_wp_logout($kM)
{
    MO_Oauth_Debug::mo_oauth_log("\111\156\x73\151\144\x65\40\x77\x70\40\x6c\157\147\x6f\165\x74");
    global $lT;
    $zB = $lT->get_plugin_config();
    if (!(!empty($zB->get_config("\141\146\164\x65\x72\x5f\154\157\x67\157\165\x74\137\165\x72\x6c")) && (isset($_COOKIE["\x6d\x6f\x5f\x6f\141\x75\x74\150\x5f\x6c\157\147\x69\156\x5f\141\x70\x70\x5f\x73\x65\163\163\x69\x6f\x6e"]) && $_COOKIE["\155\x6f\137\157\141\165\164\x68\137\x6c\157\147\151\x6e\x5f\x61\160\160\137\163\145\163\163\x69\x6f\x6e"] != "\x6e\x6f\156\145"))) {
        goto I_8;
    }
    $user = get_userdata($kM);
    $pI = $zB->get_config("\x61\x66\x74\145\x72\137\x6c\x6f\x67\157\x75\164\x5f\165\162\x6c");
    MO_Oauth_Debug::mo_oauth_log("\165\163\145\162\40\75\75\x3e\40");
    MO_Oauth_Debug::mo_oauth_log($kM);
    $M3 = get_user_meta($kM, "\155\157\137\x6f\x61\165\x74\x68\137\x63\x6c\x69\145\156\164\x5f\x6c\x61\x73\164\x5f\x69\x64\137\164\x6f\x6b\145\x6e", true);
    MO_Oauth_Debug::mo_oauth_log("\x69\x64\40\x74\x6f\153\x65\x6e\x20\x3d\75\x3e\40");
    MO_Oauth_Debug::mo_oauth_log($M3);
    $pI = str_replace("\43\43\151\x64\137\x74\157\153\145\x6e\x23\x23", $M3, $pI);
    $pI = str_replace("\x23\43\155\x6f\x5f\x70\x6f\x73\x74\x5f\154\157\147\157\x75\164\137\165\x72\151\x23\x23", site_url(), $pI);
    do_action("\155\x6f\x5f\157\141\165\164\150\x5f\x72\145\144\151\162\x65\143\164\137\x6f\x61\165\164\x68\137\x75\163\145\162\x73", $user, $pI);
    setcookie("\x6d\x6f\x5f\157\141\x75\164\150\x5f\x6c\157\x67\x69\156\137\141\x70\160\x5f\163\145\163\163\151\157\156", "\156\x6f\156\x65", null, "\x2f", null, true, true);
    wp_redirect($pI);
    exit;
    I_8:
}
function mo_oauth_client_auto_redirect_external_after_logout($HD, $EH, $user)
{
    MO_Oauth_Debug::mo_oauth_log("\111\x6e\163\x69\144\145\40\154\x6f\x67\x6f\x75\164\40\162\145\144\151\162\x65\143\x74");
    $lT = new \MoOauthClient\Standard\MOUtils();
    $zB = $lT->get_plugin_config();
    if (!(!empty($zB->get_config("\x61\x66\164\x65\x72\x5f\154\157\x67\x6f\x75\x74\137\x75\162\x6c")) && (isset($_COOKIE["\x6d\x6f\x5f\157\x61\x75\x74\150\137\154\x6f\x67\151\x6e\x5f\x61\x70\x70\137\163\145\x73\x73\151\157\156"]) && $_COOKIE["\x6d\x6f\x5f\x6f\x61\165\164\x68\x5f\154\x6f\x67\x69\156\x5f\x61\x70\x70\x5f\x73\145\x73\163\x69\x6f\x6e"] != "\156\x6f\156\x65"))) {
        goto YBm;
    }
    $pI = $zB->get_config("\x61\x66\164\145\162\x5f\154\x6f\x67\157\165\164\x5f\x75\162\x6c");
    $kM = $user->ID;
    $M3 = get_user_meta($kM, "\155\157\x5f\x6f\x61\165\164\150\x5f\x63\x6c\151\x65\x6e\x74\x5f\154\x61\x73\164\x5f\151\x64\x5f\164\x6f\153\145\156", true);
    $pI = str_replace("\43\x23\151\x64\137\164\x6f\x6b\x65\x6e\43\x23", $M3, $pI);
    $pI = str_replace("\x23\43\x6d\x6f\137\x70\157\163\164\x5f\154\x6f\x67\x6f\165\x74\x5f\x75\x72\151\x23\43", site_url(), $pI);
    do_action("\155\x6f\137\157\x61\165\164\150\x5f\162\x65\x64\151\x72\145\143\164\x5f\157\141\x75\164\x68\x5f\165\x73\x65\162\163", $user, $pI);
    setcookie("\x6d\157\x5f\157\x61\165\x74\x68\x5f\x6c\157\x67\151\x6e\x5f\x61\x70\160\x5f\163\x65\163\163\x69\157\x6e", "\156\157\156\x65", null, "\x2f", null, true, true);
    wp_redirect($pI);
    exit;
    YBm:
    return $HD;
}
add_filter("\167\x70\137\x6c\157\x67\157\165\x74", "\x6d\x6f\137\157\x61\165\164\150\x5f\143\x6c\x69\145\156\x74\x5f\141\x75\164\157\x5f\x72\x65\x64\x69\162\x65\x63\x74\x5f\x65\x78\x74\x65\x72\x6e\x61\154\137\141\x66\x74\x65\x72\137\x77\x70\137\154\157\x67\157\165\164", 10, 1);
add_filter("\154\x6f\x67\157\165\x74\137\162\145\144\x69\x72\145\143\x74", "\155\x6f\137\157\x61\165\x74\x68\x5f\x63\154\151\x65\x6e\164\x5f\x61\165\164\157\x5f\x72\145\144\x69\x72\145\143\x74\x5f\145\170\x74\145\162\156\x61\154\x5f\x61\x66\x74\145\162\x5f\154\157\x67\x6f\165\x74", 10, 3);
