<?php

namespace App\Http\Services\Deposit\Bank;

use App\Http\Services\Deposit\Bank\Util\ResponseBankUtilDepositServices;
use App\Models\PaymentMethod;
use App\Models\Setting;
use Illuminate\Support\Facades\URL;
/**
 * Laravel/Symfony Developer
 * Name: bukar mai 
 * Telegram: @Mamber001
 * Hire me via Telegram: @Mamber001
 */
class qePayBankDepositServices
{

    /**
     * Deposit Payment
     *
     * @param string reference
     * @param string currency
     * @param string amount
     * @param string method
     */
    public function deposit(
        string $reference,
        string $currency,
        string $amount,
        string $method
    )
    {
        try {

            // Request Body
            $requestBody = array(
                "version" => "1.0",
                "mch_id" => "****",
                "pay_type" => '****',
                "trade_amount" => $amount,
                "mch_order_no" => $reference,
                "notify_url" => URL::route('ipn.qepay.payin'),
                "order_date" => date('Y-m-d H:i:s'),
                "goods_name" => 'Order '.$reference,
                "sign_type" => "MD5"
              );

            // Send Curl Request
            $sendRequest = $this->curlRequest('POST', 'pay/web', $requestBody);

            // Exception
            if($sendRequest instanceof \Exception) throw new \Exception($sendRequest->getMessage());

            // Format Response
            $response = ResponseBankUtilDepositServices::response(200, 2, true, $reference, $sendRequest['mchOrderNo'], $currency, $amount, $method, $sendRequest['payInfo']);

            // Response
            return $response;

        } catch (\Exception $th) {
            //throw $th;
            return $th;
        }
    }

    /**
     * Cur Request
     * send request
     *
     * @param string method
     * @param string endpoint
     * @param string body
     */
    public function curlRequest(
        string $method,
        string $endpoint,
        array $body = []
    ){

        try {

            // Find Setting
            $setting = PaymentMethod::where(['tag' => 'qepay', 'status' => 'active'])->first();

            // Exception
            if(!$setting) throw new \Exception("Service not enabled at the moment");

            // Parse setting
            $setting = json_decode($setting->settings);

            $body['mch_id'] = $setting->mchtId->value;
            $body['pay_type'] = $setting->payin_channel->value;

            // Sign Data
            $signData = $body;
            unset($signData['sign_type']);

            // Build Sign
            $sign = self::buildSignDigest($signData, $setting->secret_key->value);
            $body['sign'] = $sign;

            // Convert request data to JSON
            $jsonData = http_build_query($body);

            // Curl Request
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://pay.qeawapay.com/'.$endpoint,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $jsonData,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            // there was an error contacting
            if ($err) throw new \Exception('Curl returned error: ' . $err);

            // Convert Json to Json Array
            $response_array = json_decode($response,true);

            // Check status
            if(!in_array($httpcode, ['200'])) throw new \Exception($response_array['tradeMsg']);

            // Check if successful
            if($response_array['respCode'] != 'SUCCESS') throw new \Exception($response_array['tradeMsg']);


            return $response_array;

        } catch (\Exception $th) {
            //throw $th;
            return $th;
        }
    }

    public static function buildSignDigest($data, $md5_key) {
        // Remove the 'sign' field from the data
        unset($data['sign']);

        // Sort the array by key in ascending order according to ASCII values
        ksort($data);

        // Concatenate the string in the format key=value&key=value
        $signString = '';
        foreach ($data as $key => $value) {
            if (!empty($value)) {
                $signString .= $key . '=' . $value . '&';
            }
        }

        // Append the private key to the string
        $signString .= 'key=' . $md5_key;

        // Perform MD5 signature on the generated string
        $sign = md5($signString);

        return $sign;
    }
}