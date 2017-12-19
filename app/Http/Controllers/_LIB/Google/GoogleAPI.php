<?php
//$transfer = GoogleAPIController::get_transfer( 'ABC', 'ja', 'zh-TW' );
namespace App\Http\Controllers\_LIB\Google;

class GoogleAPI
{
    /*
     *
     */
    public static function get_transfer ( $str, $from_lang, $to_lang )
    {
        $params['key'] = env( 'GOOGLE_API_KEY' );
        $params['source'] = $from_lang;
        $params['target'] = $to_lang;
        $params['q'] = urlencode( $str );
        $url = env( 'GOOGLE_TRANSFER_API_URL' );
        $result = GoogleAPI::curl( $url, 1, 0, $params );
        $result = json_decode( $result, true );

        return $result['data']['translations'][0]['translatedText'];
    }

    /**
     * @param $url 请求网址
     * @param bool $params 请求参数
     * @param int $ispost 请求方式
     * @param int $https https协议
     * @return bool|mixed
     */
    public static function curl ( $url, $https = 1, $ispost = 0, $params = false )
    {
        $httpInfo = [];
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1 );
        curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 30 );
        curl_setopt( $ch, CURLOPT_TIMEOUT, 30 );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        if ($https) {
            curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false ); // 对认证证书来源的检查
            curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false ); // 从证书中检查SSL加密算法是否存在
        }
        if ($ispost) {
            curl_setopt( $ch, CURLOPT_POST, true );
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $params );
            curl_setopt( $ch, CURLOPT_URL, $url );
        } else {
            if ($params) {
                if (is_array( $params )) {
                    $params = http_build_query( $params );
                }
                curl_setopt( $ch, CURLOPT_URL, $url . '?' . $params );
            } else {
                curl_setopt( $ch, CURLOPT_URL, $url );
            }
        }

        $response = curl_exec( $ch );

        if ($response === false) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
        $httpInfo = array_merge( $httpInfo, curl_getinfo( $ch ) );
        curl_close( $ch );

        return $response;
    }
}
