<?php
/**
 * Created by PhpStorm.
 * User: slicer
 * Date: 08.10.16
 * Time: 20:54
 */

class API {
    
    protected $ci;
    protected $db;
    protected $data;
    public $path;
    
    public function __construct($ci) {
        
        $this->ci = $ci;
        $this->db = $ci->db;

        $this->path = __DIR__ . "/../upload/screenshots";

        $this->data = array();
        
    }

    public function legend() {

        $this->data = '';

        foreach ($this->ci->routes as $k => $v) {
            $this->data .= "<h2>{$k}</h2> {$v['description']}";
        }

    }
    
    public function getScreenshots() {
        if ($_REQUEST['period'] == 30) {
	        $add_query = " and timestamp > " . (time() - 60*60*24 * 30);
        }
        
        $res = $this->db->query("SELECT * from screenshots where flag=1 {$add_query} order by id");
        while ($row = $res->fetch()) {
	        
	        $hour = (int)date('G', $row['timestamp']);
	        if ($_REQUEST['time']=='day' && ($hour>17 || $hour<8)) continue;
	        if ($_REQUEST['time']=='night' && ($hour>7 && $hour<19)) continue;

            if (file_exists($this->path . "/" . $row['filename'])) {
                $this->data[] = $row;
            }

        }
        
    }

    public function __destruct() {

        if (is_array($this->data)) {
            header('Content-Type: application/json');
            echo json_encode($this->data);
        }

        else {
            echo $this->data;
        }


    }

}
