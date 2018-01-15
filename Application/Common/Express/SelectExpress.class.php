<?php
//声明命名空间
namespace Common\Express;
/**
 * 快递查询
 */
class SelectExpress
{
    //电商ID
    private $EBusinessID = '1319997';
    //电商加密私钥，快递鸟提供，注意保管，不要泄漏
    private $AppKey      = '20d40c8a-1416-488a-885d-e8c3f05b6e0e';
    //请求url
    private $ReqURL      = 'http://api.kdniao.cc/Ebusiness/EbusinessOrderHandle.aspx';

    //订单编号 非必需
    public $OrderCode    = '';
    //快递公司  必须
    public $ShipperCode  = '';
    //订单编号  必须
    public $LogisticCode = '';

    public function _initialize($LogisticCode = null,$ShipperCode = null,$OrderCode = null){
        if(empty($LogisticCode) || empty($ShipperCode)) return false;
        if(is_array($LogisticCode)){
            $this->OrderCode    = $LogisticCode['OrderCode'];
            $this->ShipperCode  = $LogisticCode['ShipperCode'];
            $this->LogisticCode = $LogisticCode['LogisticCode'];
        }else{
            $this->OrderCode    = $OrderCode;
            $this->ShipperCode  = $ShipperCode;
            $this->LogisticCode = $LogisticCode;
        }
    }
    //调用查询物流轨迹
    //---------------------------------------------
    public function Send(){
        return static::getOrderTracesByJson();
    }

    //---------------------------------------------

    /**
     * Json方式 查询订单物流轨迹
     */
    function getOrderTracesByJson(){

        $requestData = [
            'OrderCode'    => $this->OrderCode,
            'ShipperCode'  => $this->ShipperCode,
            'LogisticCode' => $this->LogisticCode
        ];
        $requestData = json_encode($requestData);
        $datas = array(
            'EBusinessID' => $this->EBusinessID,
            'RequestType' => '1002',
            'RequestData' => urlencode($requestData) ,
            'DataType' => '2',
        );
        $datas['DataSign'] = static::encrypt($requestData, $this->AppKey);
        $result = static::sendPost($this->ReqURL, $datas);

        //根据公司业务处理返回的信息......

        return $result;
    }

    /**
     *  post提交数据
     * @param  string $url 请求Url
     * @param  array $datas 提交的数据
     * @return url响应返回的html
     */
    function sendPost($url, $datas) {
        $temps = array();
        foreach ($datas as $key => $value) {
            $temps[] = sprintf('%s=%s', $key, $value);
        }
        $post_data = implode('&', $temps);
        $url_info = parse_url($url);
        if(empty($url_info['port']))
        {
            $url_info['port']=80;
        }
        $httpheader = "POST " . $url_info['path'] . " HTTP/1.0\r\n";
        $httpheader.= "Host:" . $url_info['host'] . "\r\n";
        $httpheader.= "Content-Type:application/x-www-form-urlencoded\r\n";
        $httpheader.= "Content-Length:" . strlen($post_data) . "\r\n";
        $httpheader.= "Connection:close\r\n\r\n";
        $httpheader.= $post_data;
        $fd = fsockopen($url_info['host'], $url_info['port']);
        fwrite($fd, $httpheader);
        $gets = "";
        $headerFlag = true;
        while (!feof($fd)) {
            if (($header = @fgets($fd)) && ($header == "\r\n" || $header == "\n")) {
                break;
            }
        }
        while (!feof($fd)) {
            $gets.= fread($fd, 128);
        }
        fclose($fd);

        return $gets;
    }

    /**
     * 电商Sign签名生成
     * @param data 内容
     * @param appkey Appkey
     * @return DataSign签名
     */
    function encrypt($data, $appkey) {
        return urlencode(base64_encode(md5($data.$appkey)));
    }
}