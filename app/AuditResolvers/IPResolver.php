<?php

namespace App\AuditResolvers;

use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Contracts\Resolver;

class IPResolver implements Resolver
{
    public static function resolve_(Auditable $auditable)
    {

        if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) {

            $ip = getenv("HTTP_CLIENT_IP");

        } else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) {

            $ip = getenv("HTTP_X_FORWARDED_FOR");

        } else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) {

            $ip = getenv("REMOTE_ADDR");

        } else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) {

            $ip = $_SERVER['REMOTE_ADDR'];

        } else {

            $ip = "unknown";

        }

        return(substr($ip,0,44));

    }

    public static function resolve(Auditable $auditable) {

        $client_ip = null;

        if (isset($_SERVER['HTTP_CLOUDFRONT_VIEWER_ADDRESS'])) {
            $client_ip = $_SERVER['HTTP_CLOUDFRONT_VIEWER_ADDRESS'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            // Fallback for older setups or other proxies, though CloudFront-Viewer-Address is preferred
            $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $client_ip = trim($ips[0]); // The first IP is generally the client's
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            // Fallback if no proxy headers are present (e.g., direct access)
            $client_ip = $_SERVER['REMOTE_ADDR'];
        }

        return(substr($client_ip,0,44));


    }
}
