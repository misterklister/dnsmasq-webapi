<?php

    class DNSRecord {
        private $settings;

        public function __construct(Array $settings) {
            $this->settings = $settings;
        }

        private function apply() {
            exec($this->settings["dnsmasq_update_cmd"]);
        }

        public function add(String $query) {
            parse_str($query, $parts);

            $record = $parts["record"];
            $data = $parts["data"];
            $domain = $parts["domain"];
            $priority = isset($parts["priority"]) ? $parts["priority"] : "";

            switch ($record) {
                case $record === "A":
                    $line = "address=/" . $domain. "/" . $data;
                    break;
                case $record === "FORWARD":
                    $line = "server=/" . $domain. "/" . $data;
                    break;
                case $record === "MX":
                    $line = "mx-host=" . $domain. "," . $data . "," . $priority;
                    break;
                case $record === "TXT":
                    $line = "txt-record=" . $domain. "," . $data;
                    break;
            }

            file_put_contents($this->settings["hosts_file"], $line . "\n", FILE_APPEND);

            $this->apply();
        }
    }

?>