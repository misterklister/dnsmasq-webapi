<?php

    class DNSRecord {
        private $settings;

        public function __construct(Array $settings) {
            $this->settings = $settings;
        }

        private function apply() {
            exec($this->settings["dnsmasq_update_cmd"]);
        }

        private function insert(String $host, String $ip) {
            $line = "address=/" . $host. "/" . $ip . "\n";
            file_put_contents($this->settings["hosts_file"], $line, FILE_APPEND);
        }

        public function add(String $query) {
            parse_str($query, $parts);

            $this->insert($parts["host"], $parts["ip"]);
            $this->apply();
        }

        public function rm(String $query) {

            parse_str($query, $parts);

            $lines = [];
            $entries = file($this->settings["hosts_file"]);
            foreach ($entries as $k => $v) {
                $p = explode("/", $v);
                if ($p[1] === $parts["host"]) continue;
                $lines[] = $v;
            }
            $str = implode("\n", $lines);
            file_put_contents($this->settings["hosts_file"], $str);
            
            $this->apply();
        }
    }

?>