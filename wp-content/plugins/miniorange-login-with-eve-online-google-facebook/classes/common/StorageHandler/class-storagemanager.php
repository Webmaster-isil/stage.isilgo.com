<?php


namespace MoOauthClient;

use MoOauthClient\StorageHandler;
class StorageManager
{
    private $storage_handler;
    const PRETTY = "\160\x72\145\164\x74\x79";
    const JSON = "\x6a\163\x6f\156";
    const RAW = "\x72\x61\167";
    public function __construct($A1 = '')
    {
        $this->storage_handler = new StorageHandler(empty($A1) ? $A1 : base64_decode($A1));
    }
    private function decrypt($jB)
    {
        return empty($jB) || '' === $jB ? $jB : strtolower(hex2bin($jB));
    }
    private function encrypt($jB)
    {
        return empty($jB) || '' === $jB ? $jB : strtoupper(bin2hex($jB));
    }
    public function get_state()
    {
        return $this->storage_handler->stringify();
    }
    public function add_replace_entry($HH, $W7)
    {
        if ($W7) {
            goto KI;
        }
        return;
        KI:
        $W7 = is_string($W7) ? $W7 : wp_json_encode($W7);
        $this->storage_handler->add_replace_entry(bin2hex($HH), bin2hex($W7));
    }
    public function get_value($HH)
    {
        $W7 = $this->storage_handler->get_value(bin2hex($HH));
        if ($W7) {
            goto mX;
        }
        return false;
        mX:
        $wn = json_decode(hex2bin($W7), true);
        return json_last_error() === JSON_ERROR_NONE ? $wn : hex2bin($W7);
    }
    public function remove_key($HH)
    {
        $W7 = $this->storage_handler->remove_key(bin2hex($HH));
    }
    public function validate()
    {
        return $this->storage_handler->validate();
    }
    public function dump_all_storage($Ib = self::RAW)
    {
        $VW = $this->storage_handler->get_storage();
        $pc = [];
        foreach ($VW as $HH => $W7) {
            $oh = \hex2bin($HH);
            if ($oh) {
                goto mN;
            }
            goto gR;
            mN:
            $pc[$oh] = $this->get_value($oh);
            gR:
        }
        MW:
        switch ($Ib) {
            case self::PRETTY:
                echo "\x3c\160\x72\145\76";
                print_r($pc);
                echo "\74\x2f\x70\162\145\x3e";
                goto Fc;
            case self::JSON:
                echo \json_encode($pc);
                goto Fc;
            default:
            case self::RAW:
                print_r($pc);
                goto Fc;
        }
        fz:
        Fc:
    }
}
