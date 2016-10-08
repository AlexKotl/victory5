<?php
/**
 * Created by PhpStorm.
 * User: slicer
 * Date: 08.10.16
 * Time: 20:20
 */

class Capture {

    private $ci;
    private $db;

    public function __construct($ci) {
        $this->ci = $ci;
        $this->db = $ci->db;
    }

    public function capture() {

        // check last time
        $last_timestamp = $this->db->getColumn("select timestamp from screenshots order by id desc limit 1");
        if (time() - $last_timestamp < 60 * $this->ci->settings['time_interval']) {
            die("Screenshot already retrieved. Come back later");
        }

        $screenshot = $this->ci->screenshots->download();

        if ($screenshot) {
            $this->db->query("INSERT INTO `screenshots` 
            (`filename`,`timestamp`,`flag`) 
            VALUES ('{$screenshot['filename']}', '{$screenshot['timestamp']}', '1');");
            echo "Screenshot {$screenshot['filename']} successfully parsed.";
        }
        else {
            die("Cannot download screenshot");
        }

    }

}