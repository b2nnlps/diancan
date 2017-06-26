<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\components\functional;

/**
 * Description of PaginationBaseController
 *
 * @author Administrator
 */
class MobilePagination {
    //put your code here
                private $total; //数据表中总记录数
		private $listRows; //每页显示行数
		private $limit;
		private $uri;
		private $pageNum; //页数
		private $config=array('header'=>"条记录", "prev"=>"上一页", "next"=>"下一页", "first"=>"第一页", "last"=>"最后一页");
		private $listNum=0;//设置要显示的页码数
		/*
		 * $total 
		 * $listRows
		 */
		public function __construct($total, $listRows=10, $pa=""){
			$this->total=$total;
			$this->listRows=$listRows;
                        if ($this->getUri($pa)[strlen($this->getUri($pa))-1]=='p'){
                             $this->uri=substr($this->getUri($pa),0,-4);
                        }else{ 
                            $this->uri=$this->getUri($pa);
                        }

                        if(isset($_GET['page']))
                        {
                           $page=(integer)$_GET['page']==0?1:(integer)$_GET['page'];//字符串变为整数
                        }
                        else {
                             $page=1;
                        }
                        
			$this->page=!empty($_GET["page"]) ? $page : 1;
			$this->pageNum=ceil($this->total/$this->listRows);
			$this->limit=$this->setLimit();
		}

		private function setLimit(){
			return "Limit ".($this->page-1)*$this->listRows.", {$this->listRows}";
		}

		private function getUri($pa){
			$url=$_SERVER["REQUEST_URI"].(strpos($_SERVER["REQUEST_URI"], '?')?'':"?").$pa;
			$parse=parse_url($url);

		

			if(isset($parse["query"])){
				parse_str($parse['query'],$params);
				unset($params["page"]);
				$url=$parse['path'].'?'.http_build_query($params);
				
			}

			return $url;
		}

		function __get($args){
			if($args=="limit")
				return $this->limit;
			else
				return null;
		}

		private function start(){
			if($this->total==0)
				return 0;
			else
				return ($this->page-1)*$this->listRows+1;
		}

		private function end(){
			return min($this->page*$this->listRows,$this->total);
		}

		private function first(){
                        $html = "";
			if($this->page==1)
				$html.='';
			else
				$html.="<a href='{$this->uri}&page=1'>{$this->config["first"]}</a>";
                               
			return $html;
		}

		private function prev(){
                 $html = "";
			if($this->page==1)
				$html.='';
			else
				$html.="<a href='{$this->uri}&page=".($this->page-1)."'>{$this->config["prev"]}</a>";

			return $html;
		}

		private function pageList(){
			$linkPage="";
			
			$inum=floor($this->listNum/2);
		
			for($i=$inum; $i>=1; $i--){
				$page=$this->page-$i;

				if($page<1)
					continue;

				$linkPage.="<a href='{$this->uri}&page={$page}'>{$page}</a>";

			}
                        //实现页码点击切换选中时高亮状态
			$linkPage.="<span class='current'>{$this->page}</span>";
			

			for($i=1; $i<=$inum; $i++){
				$page=$this->page+$i;
				if($page<=$this->pageNum)
					$linkPage.="<a href='{$this->uri}&page={$page}'>{$page}</a>";
				else
					break;
			}

			return $linkPage;
		}

		private function next(){
                  $html = "";
			if($this->page==$this->pageNum)
				$html.='';
			else
				$html.="<a href='{$this->uri}&page=".($this->page+1)."'>{$this->config["next"]}</a>";

			return $html;
		}

		private function last(){
            $html = "";
			if($this->page==$this->pageNum)
				$html.='';
			else
				$html.="<a href='{$this->uri}&page=".($this->pageNum)."'>{$this->config["last"]}</a>";

			return $html;
		}

		private function goPage(){
                    return '<div class="goto"><span class="text">跳转页码</span><input type="text" onkeydown="javascript:if(event.keyCode==13){var page=(this.value>'.$this->pageNum.')?'.$this->pageNum.':this.value;location=\''.$this->uri.'&page=\'+page+\'\'}" value="'.$this->page.'" style="width:35px"><input type="button" style="width:30px; background:#68b86c; color:#fff;" value="GO" onclick="javascript:var page=(this.previousSibling.value>'.$this->pageNum.')?'.$this->pageNum.':this.previousSibling.value;location=\''.$this->uri.'&page=\'+page+\'\'"></div>';

		}
		function fpage($display=array(0,1,2)){
			$html[0]="<div class='pxofy'>&nbsp;&nbsp;共有{$this->total}&nbsp;{$this->config["header"]}&nbsp;&nbsp;&nbsp;&nbsp;每页显示".($this->end()-$this->start()+1)."条，本页{$this->start()}-{$this->end()}条&nbsp;&nbsp;&nbsp;&nbsp;{$this->page}/{$this->pageNum}页&nbsp;&nbsp;</div>";
			$html[1]="<div class='pagin-list'>{$this->prev()}{$this->pageList()}{$this->next()}</div>";
			$html[2]="<div class='pagin-list'>{$this->first()}{$this->last()}</div>";
			$html[3]=$this->goPage();
			$fpage='';
			foreach($display as $index){
				$fpage.=$html[$index];
			}
			return $fpage;

		}

}
