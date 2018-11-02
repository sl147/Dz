<?php

/**
 * Description of AdminControllers
 *
 * @author DOM
 */
class AdminController {


    public function actionIndex() {
    	$orderList = Order::getAllOrderInJob();
    	$title = "Адмін головна";

        require_once ('views/admin/index.php');
        return true;    
    }


    public function parseUrl($data) {
        $doc = phpQuery::newDocument($data);
        //print_r($doc);
        $data = [];
        $i = 0;
        foreach ($doc->find("#products-list .odd") as $val) {
            $val   = pq($val);
            $data[$i]['article'] = $val->find(".code-cell .product-name")->text();
            $rrp = $val->find(".catalog-price")->text();
            $arRrp = explode("грн.", $rrp);
            $price = $arRrp[0];
            $data[$i]["price"] = $price;
            $i++;
           
        }
        foreach ($doc->find("#products-list .even") as $val) {
            $val   = pq($val);
            $data[$i]['article'] = $val->find(".code-cell .product-name")->text();
            $rrp = $val->find(".catalog-price")->text();
            $arRrp = explode("грн.", $rrp);
            $price = $arRrp[0];
            $data[$i]["price"] = $price;
            $i++;
           
        }        
//echo "count=".count($data);
        for ($i=0; $i < count($data); $i++) { 
            $article = $data[$i]['article'];
            $price   = $data[$i]['price'];
            //echo "art:$article   rrp=$price<br>";
           if (!empty($article) & ($price > 0)) {
                if (Auxiliary::isArticle($article)) {
                    $res = Auxiliary::saveParseRosa ($article,$price);
                }                
            }
        }
        $next = "https://opt.rosa.ua".$doc->find(".catalog-pager .current-page")->next()->attr("href");
        echo "<br> href:".$next;
        return $next;
    }

    public function actionParsHTML() {


        require_once 'views/admin/phpQuery-onefile.php';
        require_once ('template/Parser.php');
        //$url = "https://rosa.ua/catalog";
        $start = 1;
        $end = 1363;
        $url = "https://opt.rosa.ua/catalog/?PAGEN_1=".$start;
        $parser = new Parser();
        $parser->set(CURLOPT_FOLLOWLOCATION, true)
        ->set(CURLOPT_TIMEOUT , 0);
        $data = $parser->exec($url);
//var_dump($data);

        $next = self::parseUrl($data);
        //echo "first $next";
        //$nom = 0; 
        for ($i=$start; $i < $end; $i++) {
            echo "<br>page: $i<br>";
/*            $nom++;
            if ($nom == 15) {
                $nom = 0;
                //sleep(10);
            }*/
            $data = $parser->exec($next);
            $next = self::parseUrl($data);
            //echo "next:$next<br>";
      
        }
        //require_once ('views/admin/parsHTML.php');
        return true;    
    }

    public function actionViewParse($page = 1) {
        //$total = Auxiliary::getTotalParse();
        $totCount = new Count ("parseRosa");
        $total = $totCount->get();
        $parserList = Auxiliary::getAllParseItem($page);
        $title = "view Parse";
        $pagination   = new Pagination($total, $page, 15 , 'page-');
        require_once ('views/admin/viewParse.php');
        return true;    
    }

    public function actionUploadParseItems() {
    $isUpload = false;
    if(isset($_POST['submit'])) {
        $fname  = $_FILES['file']['name'];
        move_uploaded_file ($_FILES['file'] ['tmp_name'],$fname);
        $lines = file($fname);
        foreach ($lines as $line_num => $line) {
            $str     = explode( ';', $line );
            $kod_t   = intval($str[0]);
            $price   = $str[1];
            $article = $str[2];
            $res     = Auxiliary::saveParseItems($kod_t,$price,$article);
            echo "kod=$kod_t<br>";
        }
        $isUpload = true;
    }
    require_once ('views/admin/UploadParseItems.php');
    return true;
    }    
}