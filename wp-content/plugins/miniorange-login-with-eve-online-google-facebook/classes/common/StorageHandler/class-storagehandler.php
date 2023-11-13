<?php


namespace MoOauthClient;

class StorageHandler
{
    private $storage;
    public function __construct($A1 = '')
    {
        $JG = empty($A1) || '' === $A1 ? json_encode([]) : sanitize_text_field(wp_unslash($A1));
        $this->storage = json_decode($JG, true);
    }
    public function add_replace_entry($HH, $W7)
    {
        $this->storage[$HH]["\x56"] = $W7;
        $this->storage[$HH]["\x48"] = md5($W7);
    }
    public function get_value($HH)
    {
        if (isset($this->storage[$HH])) {
            goto SG;
        }
        return false;
        SG:
        $W7 = $this->storage[$HH];
        if (!(!is_array($W7) || !isset($W7["\126"]) || !isset($W7["\x48"]))) {
            goto rE;
        }
        return false;
        rE:
        if (!(md5($W7["\126"]) !== $W7["\110"])) {
            goto wB;
        }
        return false;
        wB:
        return $W7["\x56"];
    }
    public function remove_key($HH)
    {
        if (!isset($this->storage[$HH])) {
            goto U7;
        }
        unset($this->storage[$HH]);
        U7:
    }
    public function stringify()
    {
        global $lT;
        $VW = $this->storage;
        $VW[\bin2hex("\x75\x69\144")]["\x56"] = bin2hex(MO_UID);
        $VW[\bin2hex("\x75\151\x64")]["\x48"] = md5($VW[\bin2hex("\165\151\x64")]["\x56"]);
        return $lT->base64url_encode(wp_json_encode($VW));
    }
    public function get_storage()
    {
        return $this->storage;
    }
}
