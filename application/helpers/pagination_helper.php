<?php

function paginate($url='#',$total_rows,$limit,$page, $search_param=""){
	$CI =& get_instance();
		$adjacents = 3;
		if ($page <= 0) $page = 1;
		$prev = $page - 1;	
		$next = $page + 1;
		$lastpage = ceil($total_rows/$limit);
		$lpm1 = $lastpage - 1;

		if($lastpage > 1){
			$CI->pm->sUl(array('class'=>"pagination pull-right"));
				if($page > 1){
					$CI->pm->sLi();
						$CI->pm->A('&laquo;',$url."/".$prev.$search_param,array());
					$CI->pm->eLi();
				}
				else{
					$CI->pm->sLi(array('class'=>'disabled'));
						$CI->pm->A('&laquo;',$url."/".$prev.$search_param,array());
					$CI->pm->eLi();
				}

				if ($lastpage < 7 + ($adjacents * 2)){
					for ($counter = 1; $counter <= $lastpage; $counter++){
						if ($counter == $page){
							$CI->pm->sLi(array('class'=>'disabled'));
								$CI->pm->A($counter,$url."/".$counter.$search_param,array());
							$CI->pm->eLi();
						}
						else{
							$CI->pm->sLi();
								$CI->pm->A($counter,$url."/".$counter.$search_param,array());
							$CI->pm->eLi();					
						}
					}
				}
				elseif($lastpage > 5 + ($adjacents * 2)){
					if($page < 1 + ($adjacents * 2)){
						for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
							if ($counter == $page){
								$CI->pm->sLi(array('class'=>'disabled'));
									$CI->pm->A($counter,$url."/".$counter.$search_param,array());
								$CI->pm->eLi();
							}
							else{
								$CI->pm->sLi();
									$CI->pm->A($counter,$url."/".$counter.$search_param,array());
								$CI->pm->eLi();					
							}
						}
						$CI->pm->sLi(array('class'=>'disabled'));
							$CI->pm->A('...','#',array());
						$CI->pm->eLi();
						$CI->pm->sLi();
							$CI->pm->A($lpm1,$url."/".$lpm1.$search_param,array());
						$CI->pm->eLi();
						$CI->pm->sLi();
							$CI->pm->A($lastpage,$url."/".$lastpage.$search_param,array());
						$CI->pm->eLi();		
					}
					#
					elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)){
						$CI->pm->sLi();
							$CI->pm->A(1,$url."/1".$search_param,array());
						$CI->pm->eLi();
						$CI->pm->sLi();
							$CI->pm->A(2,$url."/2".$search_param,array());
						$CI->pm->eLi();
						$CI->pm->sLi(array('class'=>'disabled'));
							$CI->pm->A('...','#',array());
						$CI->pm->eLi();
						for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++){
							if ($counter == $page){
								$CI->pm->sLi(array('class'=>'disabled'));
									$CI->pm->A($counter,$url."/".$counter.$search_param,array());
								$CI->pm->eLi();
							}
							else{
								$CI->pm->sLi();
									$CI->pm->A($counter,$url."/".$counter.$search_param,array());
								$CI->pm->eLi();					
							}					
						}
						$CI->pm->sLi(array('class'=>'disabled'));
							$CI->pm->A('...','#',array());
						$CI->pm->eLi();
						$CI->pm->sLi();
							$CI->pm->A($lpm1,$url."/".$lpm1.$search_param,array());
						$CI->pm->eLi();
						$CI->pm->sLi();
							$CI->pm->A($lastpage,$url."/".$lastpage.$search_param,array());
						$CI->pm->eLi();
					}
					#
					else{
						$CI->pm->sLi();
							$CI->pm->A(1,$url."/1".$search_param,array());
						$CI->pm->eLi();
						$CI->pm->sLi();
							$CI->pm->A(2,$url."/2".$search_param,array());
						$CI->pm->eLi();
						$CI->pm->sLi(array('class'=>'disabled'));
							$CI->pm->A('...','#',array());
						$CI->pm->eLi();
						for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++){
							if ($counter == $page){
								$CI->pm->sLi(array('class'=>'disabled'));
									$CI->pm->A($counter,$url."/".$counter.$search_param,array());
								$CI->pm->eLi();
							}
							else{
								$CI->pm->sLi();
									$CI->pm->A($counter,$url."/".$counter.$search_param,array());
								$CI->pm->eLi();					
							}						
						}
					}
					#	
				}	

				if($page < $counter - 1){
					$CI->pm->sLi();
						$CI->pm->A('&raquo;',$url."/".$next.$search_param,array());
					$CI->pm->eLi();
				}
				else{
					$CI->pm->sLi(array('class'=>'disabled'));
						$CI->pm->A('&raquo;',$url."/".$next.$search_param,array());
					$CI->pm->eLi();
				}
			$CI->pm->eUl();			
		}
	return $CI->pm->getCode();
}

?>