<?php

    require_once('dnsrecord.class.php');

    $dnsrecord = new DNSRecord([
        "hosts_file" => "/etc/dnsmasq.d/hosts.conf",
        "dnsmasq_update_cmd" => "cd / && /usr/bin/supervisorctl restart dnsmasq"
    ]);

    $parts = explode("?", $_SERVER["REQUEST_URI"]);
    $path = $parts[0];
    $query = $parts[1];

    switch ($path) {
        case "/add":
            $dnsrecord->add($query);
            break;
        case "/rm":
            $dnsrecord->rm($query);
            break;
    }
?>