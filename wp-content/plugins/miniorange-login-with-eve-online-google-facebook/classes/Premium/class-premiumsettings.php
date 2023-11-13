<?php


namespace MoOauthClient\Premium;

use MoOauthClient\Standard\StandardSettings;
use MoOauthClient\Premium\AppSettings;
use MoOauthClient\Premium\SignInSettingsSettings;
class PremiumSettings
{
    private $standard_settings;
    public function __construct()
    {
        $this->standard_settings = new StandardSettings();
        add_action("\x61\144\155\x69\156\x5f\151\156\151\164", array($this, "\x6d\157\x5f\157\x61\x75\164\150\x5f\x63\x6c\151\x65\x6e\x74\137\x70\x72\x65\x6d\x69\x75\x6d\137\x73\145\164\x74\x69\156\147\163"));
    }
    public function mo_oauth_client_premium_settings()
    {
        $ii = new SignInSettingsSettings();
        $iX = new AppSettings();
        $iX->save_app_settings();
        $iX->save_advanced_grant_settings();
        $ii->mo_oauth_save_settings();
        if (!is_multisite()) {
            goto vL;
        }
        $Rg = new MultisiteSettings();
        $Rg->save_multisite_settings();
        vL:
    }
}
