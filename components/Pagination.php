<?php
    class Pagination
    {
        public $currentPage;
        public $perpage;
        public $total;
        public $countPages;
        public $uri;
        public $request;

        public function __construct($page, $perpage, $total) {
            $this->perpage = $perpage;
            $this->total = $total;
            $this->countPages = $this->getCountPages();
            $this->currentPage = $this->getCurrentPages($page);
            
            $this->uri = $this->getParams();
            $this->request = $this->getRequest();

        }
        
        public function getCountPages()
        {
            return ceil($this->total/$this->perpage) ? : 1;
        }

        public function __toString()
        {
            return $this->getHtml();
        }
        public function getCurrentPages($page)
        {
              if (!$page || $page < 1 ) $page = 1;
              if (!$page > $this->countPages )  $page = $this->countPages;
              return $page;
        }
        public function getStart($page)
        {
            return ($this->currentPage - 1 ) * $this->perpage;
        }

        public function getParams(){
            $url = $_SERVER['REQUEST_URI'];
            
            $url = explode('?', $url);
            $url_arr = rtrim($url[0], '/') . '/';
            //var_dump($url_arr);
            $url_arr = explode('/', $url_arr);
           // var_dump($url_arr);
            if(is_numeric($url_arr[2])  && is_numeric($url_arr[3])){
                $uri = '/'.$url_arr[1] . '/'.$url_arr[2].'/'.$url_arr[3]; // համապատասխանում է ֆիլտրված կատեգորիաներին 
            }
            elseif(is_numeric($url_arr[2])){
                $uri = '/'.$url_arr[1] . '/'.$url_arr[2];  // համապատասխանում է գլխավոր կատեգորիաներին     
            }else{
                $uri = $url_arr[0] . '/'.$url_arr[1];  
            }  
           // echo $uri;   
            return $uri;
        }
        public function getRequest(){
            $url = $_SERVER['REQUEST_URI'];
            $pattern = '?';
            $url = explode('?', $url); 
            if(count($url) == 1){
                return false;
            }
            return '?'.$url[1];
     
        }

        public function getHtml(){
            $back = null;
            $forward = null;
            $startpage = null;
            $endpage = null;
            $page2left = null;
            $page1left = null;
            $page2right = null;
            $page1right = null;
            if( $this->currentPage > 1 ){
                $back = "<li><a class='nav-link' href='{$this->uri}/page=".( $this->currentPage - 1 )."{$this->request}'>&lt;</a></li>";
            }
            if($this->currentPage < $this->countPages){
                $forward = "<li><a class='nav-link' href='{$this->uri}/page=".($this->currentPage + 1 )."{$this->request}'>&gt;</a></li>";
            }
            if($this->currentPage > 3){
                $startpage = "<li><a class='nav-link' href='{$this->uri}/page=1{$this->request}'>&laquo;</a></li>";
            }
            if($this->currentPage < ($this->countPages - 2)){
                $endpage = "<li><a class='nav-link' href='{$this->uri}/page={$this->countPages}{$this->request}'>&raquo;</a></li>";
            }
            if($this->currentPage - 2 > 0){
                $page2left = "<li><a class='nav-link' href='{$this->uri}/page=".($this->currentPage - 2)."{$this->request}'>".($this->currentPage - 2)."</a></li>";
            }
            if($this->currentPage - 1 > 0){
                $page1left = "<li><a class='nav-link' href='{$this->uri}/page=" .($this->currentPage - 1). "{$this->request}'>" .($this->currentPage - 1). "</a></li>";
            }

            if($this->currentPage + 1 <= $this->countPages){
                $page1right = "<li><a class='nav-link' href='{$this->uri}/page=".($this->currentPage + 1)."{$this->request}'>".($this->currentPage + 1)."</a></li>";
            }
            if($this->currentPage + 2 <= $this->countPages){
                $page2right = "<li><a class='nav-link' href='{$this->uri}/page=".($this->currentPage + 2)."{$this->request}'>".($this->currentPage + 2)."</a></li>";
            }
            return '<ul class="pagination ">'. $startpage.$back.$page2left.$page1left.'<li class="nav-link active"><a>'.$this->currentPage.'</a></li>'.$page1right.$page2right.$forward.$endpage . '</ul>'; 
        }
        public function h($str)
        {
            return htmlspecialchars($str); 
        }
    }
?>