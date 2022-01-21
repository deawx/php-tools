<?php
/**
 * @Description:
 * @Author: Mr.LiuQHui
 * @Date: 2020/7/17 5:08 下午
 */


namespace phpTools;


use phpTools\encrypt\Aes;
use phpTools\encrypt\S3Des;
use phpTools\encrypt\Rsa;

/**
 * @Description: 轻量级加解密
 * @Class EncryptTools
 * @Package phpTools
 */
class EncryptTools
{

    /**
     * AES 加解密
     */
    const AES = 1;

    /**
     * 3DES 加解密
     */
    const STD3DES = 2;

    /**
     * aes 加密模型
     */
    const MODE_AES_ECB = 'ECB';

    /**
     * aes 加密模型
     */
    const MODE_AES_CBC = 'CBC';

    /**
     * 加密
     *
     * @param $body string  数据
     * @param $type string  解密类型
     * @param $key string   解密key
     * @param $modeType string   AES解密的modeType
     * @param $iv string   偏移量
     * @return bool|mixed|string
     */
    public static function encrypt($body, $type, $key, $modeType = self::MODE_AES_ECB, $iv = "")
    {
        switch ($type) {
            case self::STD3DES:
                $bodyRet = S3Des::encrypt($key, $body);
                break;
            case self::AES:
                $bodyRet = Aes::encrypt($key, $body, $modeType, $iv);
                break;
            default:
                return $body;
        }
        return $bodyRet;
    }

    /**
     * 解密
     *
     * @param $body string  数据
     * @param $type string  解密类型
     * @param $key string   解密key
     * @param $modeType string   AES解密的modeType
     * @param $iv string   偏移量
     * @return bool|mixed|string
     */
    public static function decrypt($body, $type, $key, $modeType = self::MODE_AES_ECB, $iv = "")
    {
        switch ($type) {
            case self::STD3DES:
                $bodyRet = S3Des::decrypt($key, $body);
                break;
            case self::AES:
                $bodyRet = Aes::decrypt($key, $body, $modeType, $iv);
                break;
            default:
                return $body;
        }
        return $bodyRet;
    }

    /**
     * Brief: RSA加密
     * Author: Shershon(tanxiaoshan@weimiao.cn)
     * DateTime: 2021/12/28 下午1:58
     * @param $body
     * @param $encrypt
     * @param $publicKey
     */
    public static function rsaEncrypt($body, &$encrypt, $publicKey)
    {
        Rsa::openssl_public_encrypt($body, $encrypt, $publicKey);
    }

    /**
     * Brief: RSA解密
     * Author: Shershon(tanxiaoshan@weimiao.cn)
     * DateTime: 2021/12/28 下午1:58
     * @param $body
     * @param $decrypt
     * @param $privateKey
     */
    public static function rsaDecrypt($body, &$decrypt, $privateKey)
    {
        Rsa::openssl_private_decrypt($body, $decrypt, $privateKey);
    }

    /**
     * Brief: 生成签名
     * Author: Shershon(tanxiaoshan@weimiao.cn)
     * DateTime: 2021/12/28 上午9:15
     */
    public static function getSign($params, $secretKey)
    {
        ksort($params);
        $q = http_build_query($params);
        $q .= $secretKey;
        return md5($q);
    }
}