<?php

/**
 * CloudFlare 사용시 실제 방문자 IP 및 SSL 사용 여부를
 * 정확하게 파악하지 못하는 문제를 해결하는 클래스
 * 웹서버에 mod_cloudflare를 설치하기 곤란한 경우 사용한다
 * 
 * Written by 기진곰 <kijin@kijinsung.com>
 * License: Public Domain
 * 
 * [그누보드 사용법]
 * common.php 상단(에러설정 직후)에 인클루드하여 사용할 것
 * extend 폴더에 넣으면 너무 늦게 실행되므로 안됨
 * 
 * [XpressEngine 사용법]
 * config/config.user.inc.php 파일에 넣어 사용할 것
 * 파일이 존재하지 않을 경우 생성하면 됨
 */
class FixCloudFlare
{
	/**
	 * CloudFlare에서 사용하는 IP 대역 목록
	 * 참고: https://www.cloudflare.com/ips
	 */
	public static $cf_ip_ranges = array(
		'103.21.244.0/22',
		'103.22.200.0/22',
		'103.31.4.0/22',
		'104.16.0.0/13',  // 2021년 조정
		'104.24.0.0/14',  // 2021년 추가
		'108.162.192.0/18',
		'131.0.72.0/22',  // 2016년 추가
		'141.101.64.0/18',
		'162.158.0.0/15',
		'172.64.0.0/13',
		'173.245.48.0/20',
		'188.114.96.0/20',
		'190.93.240.0/20',
		'197.234.240.0/22',
		'198.41.128.0/17',
		'199.27.128.0/21',
	);
	
	/**
	 * CloudFlare를 통해 방문한 경우, 방문자 IP와 HTTPS 사용 여부를 파악한다
	 */
	public static function fixVisitorInfo()
	{
		foreach (self::$cf_ip_ranges as $range)
		{
			if (self::inRange($_SERVER['REMOTE_ADDR'], $range))
			{
				if (isset($_SERVER['HTTP_CF_CONNECTING_IP']))
				{
					$_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_CF_CONNECTING_IP'];
				}
				if (strpos($_SERVER['HTTP_CF_VISITOR'], 'https') !== false)
				{
					$_SERVER['HTTPS'] = 'on';
				}
				return true;
			}
		}
		return false;
	}
	
	/**
	 * IPv4 주소가 IP 대역에 포함되어 있는지 확인하는 함수
	 */
	public static function inRange($ip, $range)
	{
		list($range, $netmask) = explode('/', $range);
		$ip = ip2long($ip) & (0xffffffff << (32 - $netmask));
		$range = ip2long($range) & (0xffffffff << (32 - $netmask));
		return $ip == $range;
	}
}

/**
 * 위에서 선언한 클래스를 호출해 준다
 * 이거 빼먹으면 안되는거 알죠?
 */
FixCloudFlare::fixVisitorInfo();