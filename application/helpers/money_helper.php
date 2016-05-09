<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by sublime text.
 * User: htan
 * Date: 8/15/14
 * Time: 11:09 AM
 */
function formatMoney($string)
{
    $CI = &get_instance();
    $result=round($string,2);
    $result=number_format($result, 0, '', '.').' VND';
    return $result;
}
/*providerCommissionAmountPaypal*/
function providerCommissionAmountPaypal($amount){
	if ($amount<3000) {
		# code...
		$result=$amount+($amount*4.4)/100;
	}
	elseif ($amount>3000 && $amount<10000) {
		# code...
		$result=$amount+($amount*3.9)/100;
	}
	elseif ($amount>10000 && $amount<100000) {
		# code...
		$result=$amount+($amount*3.7)/100;
	}
	elseif ($amount>100000) {
		# code...
		$result=$amount+($amount*3.4)/100;
	}
	$result=$result+0.3;
	return round($result,2);
}
?>