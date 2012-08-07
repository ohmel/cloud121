<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class WebsiteSearch extends CWidget {

    public $model = array();
    public $criteria;

    public function init() {
        $this->execute();
        if (isset($_GET['search_txt'])) {
            return $results = $this->run_search($_GET['search_txt']);
        }
    }

    public function execute() {

//        $html = "<form action=\"resultspage.php\" method=\"get\">";
//        $html .= "<input type=\"hidden\" name=\"r\" value=\"{$_GET['r']}\" size=\"40\">";
//        $html .= "<input type=\"text\" name=\"search_txt\" size=\"40\">";
//        $html .= "<input type=\"submit\" value=\"Search Website\">";
//        $html .= "</form>";
//        
//        echo $html;
    }

    public function run_search($search_text) {
//        echo $search_text;exit;
        $search_text = "%" . $search_text . "%";
        $rsArr = array();
        $b = 0;
        foreach ($this->model as $key => $value) {
            $criteria = new CDbCriteria;
            $flds = array();
            $arrdata = explode(", ", $value[0]);
            for ($i = 0; $i < count($arrdata); $i++) {
                $flds[] = "{$arrdata[$i]} like :searchtxt";
            }
            $fields = implode(' or ', $flds);
            $criteria->condition = $fields;
            $criteria->params = array(':searchtxt' => $search_text);
            $obj = new $key;
            $obj2 = $obj->findAll($criteria);
//               echo $fields;
            if ($obj2) {
                foreach ($obj2 as $value2) {
//                print_r($this->model[$key][1]);
                    $shet = explode(", ", $this->model[$key][1]);
//                echo "<br/>";
                    $title = $shet[0];
                    $desc = $shet[1];
                    $id = $this->model[$key][2];
                    $rsArr[$b]['search_title'] = $value2->$title;
                    $rsArr[$b]['search_desc'] = $value2->$desc;
                    $char = strtolower(substr($key, 0, 1));
                    $rsArr[$b]['search_link'] = $char . strtolower(substr($key, 1)) . "/view&id=" . $value2->$id;
                }
//            echo $key."<br/>";
                $b++;
            }
        }
//        exit;
        return $rsArr;
//        echo "<pre>";
//        print_r($rsArr);
//        echo "</pre>";
////        exit;
    }

}