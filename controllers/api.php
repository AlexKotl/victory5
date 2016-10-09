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

       // var_dump(\Slim\Slim::getInstance());

    }
    
    public function getScreenshots() {
        
        $res = $this->db->query("SELECT * from screenshots where flag=1 order by id");
        while ($row = $res->fetch()) {

            if (file_exists($this->path . "/" . $row['filename'])) {
                $this->data[] = $row;
            }

        }
        
    }

    public function __destruct() {

        header('Content-Type: application/json');
        echo json_encode($this->data);

    }

}
