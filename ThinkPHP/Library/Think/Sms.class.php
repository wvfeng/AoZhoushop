<?php
/**
 * 阿里云短信验证码发送类
 * @author Administrator
 *
 */
namespace Think;

class Sms {
    // 保存错误信息
    private $error;
    // Access Key ID
    private $accessKeyId;
    // Access Access Key Secret
    private $accessKeySecret;
    // 签名
    private $signName;
    // 模版ID
    private $templateCode;

    public function __construct()
    {
        // 配置参数
        $config = unserialize(base64_decode(C('SMS')));
        $this->accessKeyId = $config['accessKeyId'];
        $this->accessKeySecret = $config['accessKeySecret'];
        $this->signName = $config['signName'];
        $this->templateCode = $config['templateCode'];
    }

    private function percentEncode($string) {
        $string = urlencode ( $string );
        $string = preg_replace ( '/\+/', '%20', $string );
        $string = preg_replace ( '/\*/', '%2A', $string );
        $string = preg_replace ( '/%7E/', '~', $string );
        return $string;
    }
    /**
     * 签名
     *
     * @param unknown $parameters
     * @param unknown $accessKeySecret
     * @return string
     */
    private function computeSignature($parameters, $accessKeySecret) {
        ksort ( $parameters );
        $canonicalizedQueryString = '';
        foreach ( $parameters as $key => $value ) {
            $canonicalizedQueryString .= '&' . $this->percentEncode ( $key ) . '=' . $this->percentEncode ( $value );
        }
        $stringToSign = 'GET&%2F&' . $this->percentencode ( substr ( $canonicalizedQueryString, 1 ) );
        $signature = base64_encode ( hash_hmac ( 'sha1', $stringToSign, $accessKeySecret . '&', true ) );
        return $signature;
    }
    /**
     * @param unknown $mobile
     * @param unknown $verify_code
     *
     */
    public function send_verify($mobile, $verify_code) {
        $params = array (   //此处作了修改
            'SignName' => $this->signName,
            'Format' => 'JSON',
            'Version' => '2017-05-25',
            'AccessKeyId' => $this->accessKeyId,
            'SignatureVersion' => '1.0',
            'SignatureMethod' => 'HMAC-SHA1',
            'SignatureNonce' => uniqid (),
            'Timestamp' => gmdate ( 'Y-m-d\TH:i:s\Z' ),
            'Action' => 'SendSms',
            'TemplateCode' => $this->templateCode,
            'PhoneNumbers' => $mobile,
            'TemplateParam' => "{\"code\":\"{$verify_code}\"}"
            //'TemplateParam' => ""   //更换为自己的实际模版
        );
        //var_dump($params);die;
        // 计算签名并把签名结果加入请求参数
        $params ['Signature'] = $this->computeSignature ( $params, $this->accessKeySecret );
        // 发送请求（此处作了修改）
        //$url = 'https://sms.aliyuncs.com/?' . http_build_query ( $params );
        $url = 'http://dysmsapi.aliyuncs.com/?' . http_build_query ( $params );

        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
        curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt ( $ch, CURLOPT_TIMEOUT, 10 );
        $result = curl_exec ( $ch );
        curl_close ( $ch );
        $result = json_decode ( $result, true );
        //var_dump($result);die;
        if (isset ( $result ['Code'] )) {
            if($result ['Code'] == 'OK'){
                return true;
            }else{
                $this->error = $this->getErrorMessage ( $result ['Code'] );
                return false;
            }
        }
    }
    /**
     * 获取详细错误信息
     *
     * @param unknown $status
     */
    public function getErrorMessage($status) {
        // 阿里云的短信 乱八七糟的(其实是用的阿里大于)
        // https://api.alidayu.com/doc2/apiDetail?spm=a3142.7629140.1.19.SmdYoA&apiId=25450
        $message = array (
            'InvalidDayuStatus.Malformed'           => '账户短信开通状态不正确',
            'InvalidSignName.Malformed'             => '短信签名不正确或签名状态不正确',
            'InvalidTemplateCode.MalFormed'         => '短信模板Code不正确或者模板状态不正确',
            'InvalidRecNum.Malformed'               => '目标手机号不正确，单次发送数量不能超过100',
            'InvalidParamString.MalFormed'          => '短信模板中变量不是json格式',
            'InvalidParamStringTemplate.Malformed'  => '短信模板中变量与模板内容不匹配',
            'InvalidSendSms'                        => '触发业务流控',
            'InvalidDayu.Malformed'                 => '变量不能是url，可以将变量固化在模板中',
            'isv.BUSINESS_LIMIT_CONTROL'            => '超出限制，每分钟1条，累计每小时7条',
            'isp.RAM_PERMISSION_DENY'               => 'RAM权限DENY',
            'isv.OUT_OF_SERVICE'                    => '业务停机',
            'isv.PRODUCT_UN_SUBSCRIPT'              => '未开通云通信产品的阿里云客户',
            'isv.PRODUCT_UNSUBSCRIBE'               => '产品未开通',
            'isv.ACCOUNT_NOT_EXISTS'                => '账户不存在',
            'isv.ACCOUNT_ABNORMAL'                  => '账户异常',
            'isv.SMS_TEMPLATE_ILLEGAL'              => '短信模板不合法',
            'isv.SMS_SIGNATURE_ILLEGAL'             => '短信签名不合法',
            'isv.INVALID_PARAMETERS'                => '参数异常',
            'isp.SYSTEM_ERROR'                      => '系统错误',
            'isv.MOBILE_NUMBER_ILLEGAL'             => '非法手机号',
            'isv.MOBILE_COUNT_OVER_LIMIT'           => '手机号码数量超过限制',
            'isv.TEMPLATE_MISSING_PARAMETERS'       => '模板缺少变量',
            'isv.INVALID_JSON_PARAM'                => 'JSON参数不合法，只接受字符串值',
            'isv.BLACK_KEY_CONTROL_LIMIT'           => '黑名单管控',
            'isv.PARAM_LENGTH_LIMIT'                => '参数超出长度限制',
            'isv.PARAM_NOT_SUPPORT_URL'             => '不支持URL',
            'isv.AMOUNT_NOT_ENOUGH'                 => '账户余额不足'
        );
        if (isset ( $message [$status] )) {
            return $message [$status];
        }
        return $status;
    }

    public function getError(){
        return $this->error;
    }
}