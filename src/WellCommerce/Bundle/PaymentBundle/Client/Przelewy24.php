<?php

namespace WellCommerce\Bundle\PaymentBundle\Client;

/**
 * Class Przelewy24
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class Przelewy24
{
    const VERSION = '3.2';
    
    /**
     * Live system URL address
     *
     * @var string
     */
    private $hostLive = "https://secure.przelewy24.pl/";
    
    /**
     * Sandbox system URL address
     *
     * @var string
     */
    private $hostSandbox = "https://sandbox.przelewy24.pl/";
    
    /**
     * Use Live (false) or Sandbox (true) enviroment
     *
     * @var bool
     */
    private $testMode = false;
    
    /**
     * Merchant id
     *
     * @var int
     */
    private $merchantId = 0;
    
    /**
     * Merchant posId
     *
     * @var int
     */
    private $posId = 0;
    
    /**
     * Salt to create a control sum (from P24 panel)
     *
     * @var string
     */
    private $salt = "";
    
    /**
     * Array of POST data
     *
     * @var array
     */
    private $postData = [];
    
    public function __construct(int $merchantId, int $posId, string $salt, bool $testMode = false)
    {
        $this->merchantId = $merchantId;
        $this->posId      = $posId;
        $this->salt       = $salt;
        $this->testMode   = $testMode;
        
        if ($this->merchantId === 0) {
            $this->merchantId = $this->posId;
        }
        
        if ($testMode) {
            $this->hostLive = $this->hostSandbox;
        }
        
        $this->addValue("p24_merchant_id", $merchantId);
        $this->addValue("p24_pos_id", $this->posId);
        $this->addValue("p24_api_version", self::VERSION);
    }
    
    public function getHost()
    {
        return $this->hostLive;
    }
    
    public function addValue(string $name, string $value)
    {
        $this->postData[$name] = $value;
    }
    
    public function testConnection()
    {
        $crc                    = md5($this->posId . "|" . $this->salt);
        $ARG["p24_merchant_id"] = $this->merchantId;
        $ARG["p24_pos_id"]      = $this->posId;
        $ARG["p24_sign"]        = $crc;
        $RES                    = $this->callUrl("testConnection", $ARG);
        
        return $RES;
    }
    
    public function trnRegister(bool $redirect = false)
    {
        $crc = md5($this->postData["p24_session_id"] . "|" . $this->posId . "|" . $this->postData["p24_amount"] . "|" . $this->postData["p24_currency"] . "|" . $this->salt);
        
        $this->addValue("p24_sign", $crc);
        
        $RES = $this->callUrl("trnRegister", $this->postData);
        if ($RES["error"] == "0") {
            
            $token = $RES["token"];
            
        } else {
            
            return $RES;
            
        }
        if ($redirect) {
            $this->trnRequest($token);
            
        }
        
        return ["error" => 0, "token" => $token];
        
        
    }
    
    public function trnRequest(string $token, bool $redirect = true)
    {
        if ($redirect) {
            header("Location:" . $this->hostLive . "trnRequest/" . $token);
            
            return "";
        } else {
            return $this->hostLive . "trnRequest/" . $token;
        }
    }
    
    public function trnVerify(): array
    {
        $crc = md5($this->postData["p24_session_id"] . "|" . $this->postData["p24_order_id"] . "|" . $this->postData["p24_amount"] . "|" . $this->postData["p24_currency"] . "|" . $this->salt);
        
        $this->addValue("p24_sign", $crc);
        
        $RES = $this->callUrl("trnVerify", $this->postData);
        
        return $RES;
        
    }
    
    private function callUrl(string $function, $ARG)
    {
        
        if (!in_array($function, ["trnRegister", "trnRequest", "trnVerify", "testConnection"])) {
            
            return ["error" => 201, "errorMessage" => "class:Method not exists"];
            
        }
        
        $REQ = [];
        
        foreach ($ARG as $k => $v) {
            $REQ[] = $k . "=" . urlencode($v);
        }
        
        $url        = $this->hostLive . $function;
        $user_agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";
        if ($ch = curl_init()) {
            
            if (count($REQ)) {
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, join("&", $REQ));
            }
            
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            if ($result = curl_exec($ch)) {
                $INFO = curl_getinfo($ch);
                curl_close($ch);
                
                if ($INFO["http_code"] != 200) {
                    
                    return ["error" => 200, "errorMessage" => "call:Page load error (" . $INFO["http_code"] . ")"];
                    
                } else {
                    
                    $RES = [];
                    $X   = explode("&", $result);
                    
                    foreach ($X as $val) {
                        
                        $Y                = explode("=", $val);
                        $RES[trim($Y[0])] = urldecode(trim($Y[1]));
                    }
                    if (!isset($RES["error"])) {
                        return ["error" => 999, "errorMessage" => "call:Unknown error"];
                    }
                    
                    return $RES;
                    
                }
                
                
            } else {
                curl_close($ch);
                
                return ["error" => 203, "errorMessage" => "call:Curl exec error"];
                
            }
            
        } else {
            
            return ["error" => 202, "errorMessage" => "call:Curl init error"];
            
        }
    }
}
