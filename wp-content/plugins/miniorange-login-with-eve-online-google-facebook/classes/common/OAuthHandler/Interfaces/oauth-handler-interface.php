<?php


namespace MoOauthClient;

interface OauthHandlerInterface
{
    public function get_token($oA, $nt, $o5, $u0);
    public function get_access_token($oA, $nt, $o5, $u0);
    public function get_id_token($oA, $nt, $o5, $u0);
    public function get_resource_owner_from_id_token($M3);
    public function get_resource_owner($Ts, $T2);
    public function get_response($cX);
}
