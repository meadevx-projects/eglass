<?php
class Pagination{
	
	private $rowsPerPage=10;
	private $pageNum = 1;
	private $offset,$self,$eachside=2,$startpage,$endpage;
	private $maxPage, $page, $numrows=0;
	public $result;
	public $pagination = array();
		
	function getMaxPage(){
		return $this->maxPage;
	}
	function paging($resultSet,$count=NULL,$page){
		global $dbObj;
		$this->pagination[2]='';
		$this->pagination[4]='';
		
		if(!is_null($count)){
			$this->rowsPerPage=$count;
		}
	
		
		$this->self = '?'.$page;
			
		if(isset($_GET['records']) && ($_GET['records'] > 0)){
			$this->rowsPerPage = $_GET['records'];
		}
		if(isset($_GET['page']) && ($_GET['page'] > 0)){
    		$this->pageNum = $_GET['page'];
		}
		
		$this->offset = ($this->pageNum - 1) * $this->rowsPerPage;
		
		$this->numrows=count($resultSet);
	//	var_dump($resultSet);
		$this->pagination[7]=array_slice($resultSet,$this->offset,$this->rowsPerPage);
		
		
		if($this->numrows > 0)
			$this->maxPage = ceil($this->numrows/$this->rowsPerPage);
		else
			$this->maxPage = 1;
		
		if ($this->pageNum > $this->eachside +1) {
			$this->pagination[2]='....';
			$this->startpage = $this->pageNum - $this->eachside; 
		}else{
			$this->startpage = 1;	
		}
		
		if ($this->pageNum + $this->eachside < $this->maxPage) {
			$this->pagination[4]='....';
			$this->endpage = $this->pageNum + $this->eachside; 
		}else{
			$this->endpage = $this->maxPage;	
		}
		
		$this->pagination[3]=' ';	
		for($this->page = $this->startpage; $this->page <= $this->endpage; $this->page++){
    		if($this->page == $this->pageNum){
        		$this->pagination[3] .= ' <a style="text-decoration:underline;">'.$this->page.'</a> ';   // no need to create a link to current page
    		}else{
        		if(isset($_REQUEST['records']) && $_REQUEST['records'] > 0)
					$this->pagination[3] .= ' <a href="'.$this->self.'&amp;page='.$this->page.'&amp;records='.$_GET['records'].'">'.$this->page.'</a> ';
				else
					$this->pagination[3] .= ' <a href="'.$this->self.'&amp;page='.$this->page.'">'.$this->page.'</a> ';
    		}        
		}
		if($this->pageNum > 1){
    		$this->page = $this->pageNum - 1;
			if(isset($_GET['records']) && ($_GET['records'] > 0))
				$this->pagination[1] = ' <a href="'.$this->self.'&amp;page='.$this->page.'&amp;records='.$_GET['records'].'"><</a> ';
			else
    			$this->pagination[1] = ' <a href="'.$this->self.'&amp;page='.$this->page.'"><</a> ';
    		
			if(isset($_GET['records']) && ($_GET['records'] > 0))
				$this->pagination[0] = ' <a href="'.$this->self.'&amp;page=1&amp;records='.$_GET['records'].'"><<</a> ';
			else
				$this->pagination[0] = ' <a href="'.$this->self.'&amp;page=1"><<</a> ';
		}else{
    		$this->pagination[0]  = '&nbsp;'; // we're on page one, don't print previous link
    		$this->pagination[1] = '&nbsp;'; // nor the first page link	
		}
		if($this->pageNum < $this->maxPage){
    		$this->page = $this->pageNum + 1;
			if(isset($_GET['records']) && ($_GET['records'] > 0))
				$this->pagination[5] = ' <a href="'.$this->self.'&amp;page='.$this->page.'&amp;records='.$_GET['records'].'">></a> ';
			else
    			$this->pagination[5] = ' <a href="'.$this->self.'&amp;page='.$this->page.'">></a> ';
			if(isset($_GET['records']) && ($_GET['records'] > 0))
				$this->pagination[6] = ' <a href="'.$this->self.'&amp;page='.$this->maxPage.'&amp;records='.$_GET['records'].'">>></a> ';
			else
				$this->pagination[6] = ' <a href="'.$this->self.'&amp;page='.$this->maxPage.'">>></a> ';
		}else{
    		$this->pagination[5] = '&nbsp;'; // we're on the last page, don't print next link
    		$this->pagination[6] = '&nbsp;'; // nor the last page link
		}
		
		
		
		// Changes for Each Page Starting Record Number & Ending Record Number - Start
		$pnrecords=$count;
		if(isset($_GET['records']))
		{
		$pnrecords=$_GET['records'];
		}
		
		$pnpage=1;
		if(isset($_GET['page']))
		{
		$pnpage=$_GET['page'];
		}
		
		$records_num_start=($pnrecords*$pnpage)-($pnrecords-1);
		
		
		$records_num_end=($pnrecords*$pnpage)-(($pnrecords*$pnpage)-count($resultSet));
		if(count($resultSet)>($pnrecords*$pnpage))
		{
		$records_num_end=($pnrecords*$pnpage);
		}
		
		
		$this->pagination[8] = $records_num_start;
		$this->pagination[9] = $records_num_end;
		// Changes for Each Page Starting Record Number & Ending Record Number - End
				
		
		return $this->pagination;
	}
}
?>