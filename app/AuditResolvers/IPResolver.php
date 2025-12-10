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

        $ip_keys = array(
            'HTTP_CF_CONNECTING_IP', // Cloudflare
            'HTTP_X_FORWARDED',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_CLIENT_IP',
            'HTTP_X_REAL_IP',
            'HTTP_FORWARDED',
            'HTTP_FORWARDED_FOR',
            'REMOTE_ADDR'
        );

        $exec = exec("hostname"); //the "hostname" is a valid command in both windows and linux
        $hostname = trim($exec);
        $ip = gethostbyname($hostname);

        info("Host name IP: " . $ip);

        info("This ip:" . $this->getIp());

        foreach ($ip_keys as $key) {

            if (isset($_SERVER[$key]) && !empty($_SERVER[$key])) {

                info($key . ' ip:' . $_SERVER[$key]);

                $ip_addresses = explode(',', $_SERVER[$key]);

                foreach ($ip_addresses as $ip) {

                    $ip = trim($ip);

                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_RES_RANGE | FILTER_FLAG_IPV4)) {

                        return(substr($ip,0,44));

                    }

                }

            }

        }

        return $_SERVER['REMOTE_ADDR'];

    }
}
