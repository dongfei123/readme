<?php
/**
 * @category demo.php
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 11/2/15 17:12
 * @since
 */

include('XiaoiBot.php');
//$bot = new XiaoiBot( [ 'app_key' => 'cKj3PLDTp61r', 'app_secret' => 'ybC6j5tVAHg1tFUDj4IO' ] );
$bot = new XiaoiBot();
/**
 * 有两种方法给appkey和secret赋值
 */
$bot->setAppInfo( 'mCN1Shbb1gpr', '7x6zFXAppByfITjeRmiM' );
/**
 * 文字识别,这一块由于返回值和种类偏多,最好还是看一下线上的说明
 */
$askResult = $bot->ask('你的性别');
echo "<pre>";
print_r( $askResult );
