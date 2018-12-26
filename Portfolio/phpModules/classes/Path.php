<?php
class Path{
    private $_path = array(),
            $_db;

    public function __construct(){
        
        $this->_path = explode('/',$_SERVER['REQUEST_URI']);
        $this->_db = DB::getInstance();
    }
    public function print_path(){
        $ret='';
        $x=1;
       
        foreach($this->_path as $path){
             if(!$path){
                 if(!$this->equals($this->path()[0], $this->path()[1])){
                    $ret.="<a href=\"/\">home</a>";
                 }else{
                     if($x>1)
                        $ret.="Home";
                 }
             }else{
                 if(count($this->_path)>2&&$x===2)
                    $ret.="<a href=\"/{$path}\">{$path}</a>";
                else
                    $ret.=$path;
             }
            if($x<$this->count()&&!$this->equals($this->path()[0], $this->path()[1])){
                $ret.=" / ";
            }
            $x++;
        }
        return $ret;
    }
    public function path()
    {
        return $this->_path;
    }
    private function count(){
        return count($this->_path);
    }
    private function equals($case1,$case2){
        return ($case1===$case2) ? true : false;
    }
}