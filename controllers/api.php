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
    
    public function __construct($ci) {
        
        $this->ci = $ci;
        $this->db = $ci->db;

        $this->data = array();
        
    }

    public function legend() {



    }
    
    public function getScreenshots() {
        
        $res = $this->db->query("SELECT * from screenshots where flag=1 order by id");
        while ($row = $res->fetch()) {
            $this->data[] = $row;
        }
        
    }

    public function __destruct() {

        echo json_encode($this->data);

    }

}