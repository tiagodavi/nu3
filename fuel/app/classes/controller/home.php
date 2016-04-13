<?php

class Controller_Home extends Controller_Rest
{	
  	const NEGATIVE = 0;
  	const POSITIVE = 1;
  	const ID = '8961657a9594868f8a4e77babe8db1f7';

	public function get_index()
	{
		return $this->response(View::forge('home/index'));
	}
	public function get_find_cities()
	{		
		$term = preg_replace('/\s+/', '', \Input::get('term'));
			
		if(empty($term)){
			return $this->send_response(
		        static::NEGATIVE,
		        'City not found'
  			);
		}

		return $this->send_response(
			static::POSITIVE,
			'Result',
			$this->get_source($term)
		);
	}
	private function send_response($status, $message, $response = array())
	{
		return $this->response(
	      array(
	        'status'   => $status,
	        'message'  => $message,
	        'response' => $response
	 	  )
	    );
	}
	private function get_source($term)
	{
		$result = $this->open_data_source($term);
		
		$info['city']['name'] = "{$result->city->name},{$result->city->country}";
		$info['city']['data'] = array();
				
		foreach($result->list as $val) {

			list($weather) = $val->weather;
			list($date)    = explode(' ', $val->dt_txt);
			
			if( ! array_key_exists($date, $info['city']['data'])) {

				$info['city']['data'][$date]['temp_min'] = $val->main->temp_min;
				$info['city']['data'][$date]['temp_max'] = $val->main->temp_max;
				$info['city']['data'][$date]['humidity'] = $val->main->humidity;
				$info['city']['data'][$date]['weather_name']  = $weather->main;
				$info['city']['data'][$date]['weather_desc']  = $weather->description;			
			}						
		}

		return $info;
	}
	private function open_data_source($term)
	{	
		return json_decode ( file_get_contents (
			"http://api.openweathermap.org/data/2.5/forecast?q={$term}&mode=json&appid=".static::ID
		));
	}
	
}