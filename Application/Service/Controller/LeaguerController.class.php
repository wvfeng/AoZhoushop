<?php
namespace Service\Controller;

use Common\Controller\CommonController;
use Service\Service\Leaguer;


class LeaguerController extends CommonController
{
	public function leaguer()
	{
		$memberId = 1;
		$leaguer = new Leaguer(I('post.amountOfMoney'),$memberId);
		print_r($leaguer -> amountOfPayment());
	}
}