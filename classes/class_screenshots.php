<?php
/**
 * Created by PhpStorm.
 * User: slicer
 * Date: 06.10.16
 * Time: 21:13
 */

namespace Victory;

class Screenshots {

    private $webcam_url;

    public function __construct($url) {

        $this->webcam_url = $url;

    }

    public function download() {
        $r = file_get_contents($this->webcam_url);

        if ($r) {
            $timestamp = time();
            $filename = date("Y_m_d_H_i") . ".jpg";
            file_put_contents(__DIR__ . "/../upload/screenshots/{$filename}", $r) or die("Cannot download file");
            return array(
                'timestamp' => $timestamp,
                'filename' => $filename,
            );
        }
        else {
            return false;
        }
    }


}