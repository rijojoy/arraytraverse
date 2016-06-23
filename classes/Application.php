<?php
namespace classes;

class Application{
	
	public $template;
	public $result = array();
	public $parentArr = array();
	public function __construct()
	{
		$this->template = array(
		                            'project_id' => '',
									'channel_id' => '',
									'campaign_id' => '',
									'ad_network_id' => '',
									'ad_space_id' => '',
									'insertion_id' => '',
									'reach_impression' => '',
									'click_average' => '',
									'click' => '',
									'click_rate' => '',
									'impression_average' => '',
									'number_of_days' => '',
									'impression' => '',
									'click_rate_average' => ''
		                       );
	}
	
	public function loadData($fileName)
	{
		return json_decode(file_get_contents($fileName));
	}
	
	public function loopRecursive($data)
	{
		
		return $this->loopIt($data);
		
	}
	
	public function loopIt($data)
	{
		$resultArr = $this->template;
		$returnArr = array();
		$mergedArr = array();
		$arrKeys = array();
		
		foreach($data as $k => $val)
		{
				
				if(isset($val['metrics']))
				{
					$mergedArr = array_merge($resultArr,$val['metrics']);
				}
				
				
				
				if(is_array($val))
				{
					$endKey = end($this->parentArr);
					switch($endKey['parent'])
					{
						case "project":
						$mergedArr['project_id'] = $k;
						$this->template['project_id'] = $k;
						break;
						
						case "channel":
						$mergedArr['channel_id'] = $k;
						$this->template['channel_id'] = $k;
						break;
						
						case "campaign":
						$mergedArr['campaign_id'] = $k;
						$this->template['campaign_id'] = $k;
						break;
						
						case "ad_network":
						$mergedArr['ad_network_id'] = $k;
						$this->template['ad_network_id'] = $k;
						break;
						
						case "ad_space":
						$mergedArr['ad_space_id'] = $k;
						$this->template['ad_space_id'] = $k;
						break;
						
						case "insertion":
						$mergedArr['insertion_id'] = $k;
						$this->template['insertion_id'] = $k;
						break;
						
					}
					
					$this->parentArr[] = array(
					                   "parent" => $k
									 );
					
					$this->result[] = $mergedArr;
					
					
					$this->loopIt($val);
					
				}
				else
				{
					//echo $k.'-'.$val. "<br>";
				}
				
				
							
		}
		return $this->result;
		
	}
}
?>