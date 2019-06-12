<?php
/**
 * @category XiaoiBot
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 10/26/15 17:22
 * @since
 */

/**
 * Class XiaoiBot
 * @description
 * <code>
 *      变量全部采用下划线分隔
 *      函数采用驼峰
 *  所有的数据返回均为数组[code,data]
 *  如果code != 200 ,则code对应的是错误 信息
 *
 * </code>
 */
class XiaoiBot
{
    const VERSION = '0.0.1';
    /**
     *
     */
    const METHOD_POST = 'POST';
    const METHOD_GET = 'GET';
    /**
     * @var string appkey
     */
    public $app_key;
    /**
     * @var string app secret
     */
    public $app_secret;
    /**
     * @var string 默认值,对应官网例子上的 : $realm
     */
    public $defined_string = 'xiaoi.com';
    /**
     * @var int 超时时间
     */
    public $timeout = 120;

    /**
     * XiaoiBot constructor.
     * @param array $configs
     */
    public function __construct( $configs = array() )
    {
        foreach ($configs as $c_key => $c_value) {
            $this->$c_key = $c_value;
        }
    }

    /**
     * 主动设置 appkey和appsecret
     * @param $app_key
     * @param $app_secret
     */
    public function setAppInfo( $app_key, $app_secret )
    {
        $this->app_key = $app_key;
        $this->app_secret = $app_secret;
    }

    /**
     * @param $question string
     * @param $userId string
     * @param int $type 0|1
     * @param string $platform [weixin,yixin,custom,....]
     * @return array [code,数据返回] 当type=0时返回纯文本,当type=1时返回数组
     * @see http://cloud.xiaoi.com/help/smart.jsp
     * <code>
     *  默认type=0时,直接使用返回值即可
     *  如果type=1请到官方看一下详细说明,这里仅列出字段:
     *     Response	顶级元素	表示xml为智能问答响应。
     *     Type	    响应类型。此元素客户端不用解析，仅分析调试及日志等使用。
     *     Content	回答内容。回答内容中出现的[link]标签需要客户端以参数指明的意义渲染成对应的链接形式。
     *              为纯文本类型。例如："你好，我的名字叫小i"。"查看更多内需请点击[link url="http://www.xiaoi.com"]这里[/link]"
     *     Words	分词结果，不包含弱语义词。（只有机器人理解了的问题才会输出）
     *     Similarity	0到1范围相似度值。（只有机器人理解了的问题才会输出）	例如："您好！"
     *     Commands	非文本的语义表述。	例如："1"
     *     RelatedQuestions	相关问题列表。第一条为与用户问题语义一致的知识点。
     * </code>
     */
    public function ask( $question, $userId = "", $type = 0, $platform = "custom" )
    {
        $url = "http://nlp.xiaoi.com/ask.do";
        $data = array(
            'question' => (string) $question,
            'userId' => (string) $userId,
            'type' => in_array( $type, array( 0, 1 ) ) ? $type : 0,
            'platform' => (string) $platform
        );
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        return $this->post( $url, $data, $headers );
    }

    /**
     * @param $file string 文件路径,要能够被读取
     * @return array [code,识别后的文本]
     */
    public function recog( $file )
    {
        $url = "http://vcloud.xiaoi.com/recog.do";
        if (filesize( $file ) > 2048000) {
            return [ 502, '文件不能超过2M' ];
        }
        $data = file_get_contents( $file );
        $headers = array(
            'X-AUE: speex',
            'X-TXE: UTF-8',
            'X-AUF: audio/L16;rate=16000',
            'Content-Type: application/audio',
            'Content-Length: ' . strlen( $data ),
            'get_header' => 0,
        );
        return $this->post( $url, $data, $headers );
    }

    /**
     * @param $text string 要转换的文字
     * @return array [code,音频文件内容]
     * @description 将音频文件内容写入文件即可
     */
    public function synth( $text )
    {
        $url = "http://vcloud.xiaoi.com/synth.do";
        $headers = array(
            'X-AUE: speex',
            'X-TXE: UTF-8',
            'X-AUF: audio/L16;rate=16000',
            'Content-Type: text/plain',
            'Content-Length: ' . strlen( $text ),
            'get_header' => 0,
        );
        return $this->post( $url, $text, $headers );
    }

    /**
     * post data
     * @param $url
     * @param $data
     * @param array $headers
     * @return array [code,data]
     */
    public function post( $url, $data, $headers = array() )
    {
        $headers[] = "Connection: keep-alive";
        $headers[] = "Cache-Control: no-cache";
        $headers[] = "Pragma: no-cache";
        $headers[] = "User-Agent: xiaoi-bot(" . self::VERSION . ")";
        $headers[] = $this->getXauthHeader( $url );
        if (function_exists( 'curl_init' )) {
            $result = $this->curlPost( $url, $data, $headers );
        }else {
            $result = $this->fgtPost( $url, $data, $headers );
        }
        $code = $result[0];
        if ($code == 200 && strpos( $result[1], '<html>' ) !== false) {//返回的内容不是标准数据
            $code = 500;
            preg_match( '|<title>.*?(\d+).*?</title>|isu', $result[1], $matches );
            if ($matches) {
                $code = $matches[1];
            }
            preg_match( '|<h2>(.*?)</h2>|isu', $result[1], $matches );
            if ($matches) {
                $result[1] = $matches[1];
            }else {
                $result[1] = preg_replace( "/[\n{1,}|\s{3,}]/isu", "", strip_tags( $result[1] ) );
            }
        }
        return [ $code, $result[1] ];
    }

    /**
     * @param $url
     * @return string
     */
    protected function getXauthHeader( $url )
    {
        $url_info = parse_url( $url );
        $action = $url_info['path'];
        return "X-Auth: " . $this->getXauth( $action );
    }

    /**
     * @param $action
     * @return string
     */
    protected function getXauth( $action )
    {
        /**
         * appkey sign
         */
        $appkey_sign = sha1( join( ":", array( $this->app_key, $this->defined_string, $this->app_secret ) ) );
        /**
         * get nonce
         */
        $nonce = "";
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        for ($i = 0; $i < 40; $i++) {
            $nonce .= $chars[mt_rand( 0, strlen( $chars ) - 1 )];
        }
        /**
         * get method sign
         */
        $method_sign = sha1( join( ":", array( self::METHOD_POST, $action ) ) );
        $sign = sha1( join( ":", array( $appkey_sign, $nonce, $method_sign ) ) );
        $xAuthArr = array( 'app_key' => $this->app_key, 'nonce' => $nonce, 'signature' => $sign );
        $xAuths = array();
        foreach ($xAuthArr as $k => $val) {
            $xAuths[] = sprintf( '%s="%s"', $k, $val );
        }
        return join( ", ", $xAuths );
    }

    /**
     * @param $url
     * @param $data
     * @param array $headers
     * @return array [code,data]
     */
    protected function curlPost( $url, $data, $headers = array() )
    {
        $data = is_array( $data ) ? http_build_query( $data, '', '&' ) : $data;
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch, CURLOPT_POST, 1 );
        if (@is_file( $data ) && file_exists( $data )) {
            if (version_compare( PHP_VERSION, '5.5.0', '<' ) == true) {
                curl_setopt( $ch, CURLOPT_POSTFIELDS, "@" . $data );
            }else {
                curl_setopt( $ch, CURLOPT_POSTFIELDS, curl_file_create( $data ) );
            }
        }else {
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
        }
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $ch, CURLOPT_HEADER, isset( $headers['get_header'] ) ? $headers['get_header'] : 0 );
        curl_setopt( $ch, CURLOPT_TIMEOUT, (int) $this->timeout );
        $result = curl_exec( $ch );
        $errno = curl_errno( $ch );
        $errmsg = curl_error( $ch );
        curl_close( $ch );
        if ($errno) {
            return array( 500 + (int) $errno, $errmsg );
        }
        return array( 200, $result );
    }

    /**
     * @param $url
     * @param $data
     * @param array $headers
     * @return array [code,data]
     */
    protected function fgtPost( $url, $data, $headers = array() )
    {
        $data = !is_array( $data ) ?: http_build_query( $data, '', '&' );
        $code = 200;
        try{
            $result = file_get_contents( $url, null, stream_context_create( array(
                'http' => array(
                    'method' => self::METHOD_POST,
                    'content' => $data,
                    'timeout' => (int) $this->timeout,
                    'header' => join( "\r\n", $headers ),
                )
            ) ) );
        }catch( \Exception $e ){
            $http_status = $http_response_header[0];
            preg_match( '|(\d{2,})|isu', $http_status, $matches );
            $code = 500 + (int) $e->getCode();
            if ($matches) {
                $code = $matches[1];
            }
            $result = $e->getMessage();
        }
        return array( $code, $result );
    }
}
