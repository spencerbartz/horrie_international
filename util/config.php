<?php
    function config($path)
    {
        $config_file = 'etc/config.json';
        $config = json_decode(file_get_contents($config_file), true);

        $path_parts = explode('.', $path);

        $config_val = $config;;

        foreach ($path_parts as $part) {
            if (array_key_exists($part, $config_val)) {
                $config_val = $config_val[$part];
            } else {
                throw new Exception("Error: config key $part does not exist");
            }
        }

        return $config_val;
    }
?>