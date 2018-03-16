<?php
namespace Service\Service;

use Service\Service\UserBehavior;
use Think\Exception;
use Think\Model;


class Leaguer extends UserBehavior
{
	const REGULAR = 0;
	const REGULAR_MONEY = 0;
	const SILVER_MEMBER = 1;
	const SILVER_MEMBER_MONEY = 200;
	const GOLD_MEMBER = 2;
	const GOLD_MEMBER_MONEY = 1000;
	const PLATINUM_MEMBER = 3;
	const PLATINUM_MEMBER_MONEY = 5000;
	const DIAMOND_MEMBER = 4;
	const DIAMOND_MEMBER_MONEY = 20000;
	const TERM_OF_VALIDITY = 7776000;
	const RESET_RENEW = 1;/*充值*/
	const SHOPPING = 2;//购物

	const MEMBER = [
		self::REGULAR => '普通会员',
		self::SILVER_MEMBER => '白银会员',
		self::GOLD_MEMBER => '黄金会员',
		self::PLATINUM_MEMBER => '白金会员',
		self::DIAMOND_MEMBER => '钻石会员'
	];

	const MEMBER_MONEY_ARRAY = [
		self::SILVER_MEMBER => self::SILVER_MEMBER_MONEY,
		self::GOLD_MEMBER => self::GOLD_MEMBER_MONEY,
		self::PLATINUM_MEMBER => self::PLATINUM_MEMBER_MONEY,
		self::DIAMOND_MEMBER => self::DIAMOND_MEMBER_MONEY,

	];

	static private $amountOfMoney;
	static private $memberId;


	public function __construct($amountOfMoney,$memberId)
	{
		self::$amountOfMoney = $amountOfMoney;
		self::$memberId		 = $memberId;
	}

	/**
	 * 验证金额是否合法并且返回符合金额对应的充值金额
	 * @return boolean
	 */
	static function verifyTheAmount()
	{
		if(in_array(self::$amountOfMoney,[self::SILVER_MEMBER_MONEY,self::GOLD_MEMBER_MONEY
			,self::PLATINUM_MEMBER_MONEY, self::DIAMOND_MEMBER_MONEY])) {
			switch (self::$amountOfMoney) {
				case self::SILVER_MEMBER_MONEY:
					return self::SILVER_MEMBER;
				break;
				case self::GOLD_MEMBER_MONEY:
					return self::GOLD_MEMBER;
					break;
				case self::PLATINUM_MEMBER_MONEY:
					return self::PLATINUM_MEMBER;
					break;
				case self::DIAMOND_MEMBER_MONEY:
					return self::DIAMOND_MEMBER;
					break;
			}
		}
		return false;
	}

	/**
	 * 根据会员身份计算会员补偿差价并生成会员订单
	 * @return string
	 */
	public function amountOfPayment()
	{
		$newLevel     = static::verifyTheAmount();
		$memberResult = parent::obtainMembershipGrade(self::$memberId);
		$amount       = self::$amountOfMoney;
		if ($newLevel){
			if($memberResult['rank_status']) {
				$level = $memberResult['rank_level'];
				if($level < $newLevel) {
					$amount = self::$amountOfMoney - $memberResult['price_record'];
				}
			}
			$number = parent::orderNumber();
			$tranDbMysql = new Model();
			$tranDbMysql -> startTrans();

			$memberOrderModel = $this -> MemberOrder;
			$memberOrderModel -> money  = $amount;
			$memberOrderModel -> time   = time();
			$memberOrderModel -> uid    = self::$memberId;
			$memberOrderModel -> level  = $newLevel;
			$memberOrderModel -> number = $number;
			$memberOrderModel -> status = 0;
			$tranDbMysqlArray[] = $memberOrderModel -> add();

			if(in_array(false,$tranDbMysqlArray)){
				$tranDbMysql -> rollback();
			}
			$tranDbMysql -> commit();
			return $number;
		}
	}

	public function test()
	{
		print_r(parent::obtainMembershipGrade(self::$memberId));
	}
}