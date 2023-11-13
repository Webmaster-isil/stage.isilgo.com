<?php


namespace MoOauthClient\Premium;

use MoOauthClient\Config;
use MoOauthClient\Standard\SignInSettingsSettings as StandardSignInSettingsSettings;
class SignInSettingsSettings extends StandardSignInSettingsSettings
{
    public function change_current_config($post, $zB)
    {
        global $lT;
        $zB = parent::change_current_config($post, $zB);
        $zB->add_config("\x72\x65\x73\x74\162\x69\x63\164\145\144\137\x64\157\155\141\151\156\x73", isset($post["\x72\x65\x73\164\x72\151\x63\x74\145\x64\x5f\144\x6f\x6d\x61\x69\156\163"]) ? stripslashes(wp_unslash($post["\162\145\163\x74\162\151\143\x74\x65\144\x5f\144\157\155\141\x69\156\163"])) : '');
        $zB->add_config("\x72\x65\x73\164\162\x69\x63\x74\x5f\x74\157\x5f\154\157\x67\147\145\x64\x5f\151\x6e\137\x75\163\145\162\x73", isset($post["\x72\145\163\x74\x72\151\143\x74\137\x74\157\x5f\154\157\x67\147\x65\x64\x5f\151\156\137\165\x73\x65\x72\163"]) ? stripslashes(wp_unslash($post["\x72\x65\x73\164\162\151\143\x74\x5f\x74\157\x5f\154\157\147\147\x65\x64\x5f\151\156\137\165\x73\145\162\x73"])) : '');
        $zB->add_config("\x66\x6f\x72\x63\x65\x64\x5f\x6d\145\163\x73\x61\147\x65", isset($post["\146\x6f\x72\x63\145\x64\137\155\145\163\x73\x61\x67\145"]) ? sanitize_text_field(wp_unslash($post["\146\x6f\x72\143\145\144\137\x6d\x65\x73\x73\x61\x67\145"])) : '');
        $zB->add_config("\153\x65\145\160\137\x65\x78\151\x73\164\x69\156\x67\x5f\x75\163\145\x72\163", isset($post["\153\x65\145\x70\x5f\145\170\x69\x73\164\x69\156\147\x5f\x75\x73\x65\x72\163"]) ? stripslashes(wp_unslash($post["\x6b\x65\145\160\137\x65\170\x69\x73\164\x69\x6e\x67\137\x75\x73\145\162\x73"])) : '');
        $zB->add_config("\x6b\x65\x65\160\x5f\x65\x78\x69\x73\x74\151\x6e\147\x5f\x65\155\x61\x69\x6c\137\x61\x74\164\x72", isset($post["\153\145\x65\x70\x5f\145\x78\x69\x73\164\151\x6e\x67\x5f\x65\155\x61\151\x6c\x5f\x61\x74\x74\x72"]) ? stripslashes(wp_unslash($post["\x6b\x65\145\x70\x5f\x65\x78\x69\163\164\151\156\x67\137\x65\155\x61\151\154\x5f\141\164\164\x72"])) : '');
        $zB->add_config("\141\154\x6c\157\167\137\x72\145\x73\164\x72\x69\143\164\145\144\137\144\157\x6d\x61\x69\156\x73", isset($post["\141\154\154\157\167\137\x72\x65\163\x74\x72\x69\143\x74\x65\x64\x5f\144\x6f\155\141\x69\x6e\x73"]) ? stripslashes(wp_unslash($post["\141\x6c\x6c\x6f\x77\x5f\x72\x65\x73\164\162\151\143\164\x65\x64\x5f\x64\157\x6d\x61\x69\x6e\163"])) : '');
        $zB->add_config("\x61\x75\x74\157\137\x72\x65\x64\x69\162\x65\143\x74\x5f\x65\170\x63\154\165\144\x65\x5f\165\x72\154\163", isset($post["\141\x75\164\x6f\137\162\x65\x64\151\162\145\x63\164\x5f\145\x78\x63\x6c\x75\x64\x65\137\165\x72\x6c\x73"]) ? stripslashes(wp_unslash($post["\141\165\x74\157\137\x72\145\x64\x69\162\x65\x63\164\x5f\x65\x78\143\154\165\x64\145\137\x75\x72\x6c\163"])) : '');
        return $zB;
    }
}
