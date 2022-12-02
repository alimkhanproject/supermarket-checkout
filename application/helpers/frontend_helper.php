<?php
	if(!function_exists('getTotalPrice'))
	{
	 	function getTotalPrice()
		{
			$CI =& get_instance();

			$cart_items = $CI->cart->contents();

			$total = 0;
			if(!empty($cart_items))
			{
				foreach ($cart_items as $key => $row) 
				{
					$total += $row['each_sub_total'];
				}
			}

			return $total;
		}
	}			
?>