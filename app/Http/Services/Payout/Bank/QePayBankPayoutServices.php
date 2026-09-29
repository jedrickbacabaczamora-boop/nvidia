<?php
namespace App\Http\Services\Payout\Bank;

use App\Http\Services\Payout\Bank\Util\ResponseBankUtilPayoutServices;
use App\Models\BankList;
use App\Models\PaymentMethod;
use App\Models\Setting;
use Illuminate\Support\Facades\URL;

/**
 * Laravel/Symfony Developer
 * Name: bukar mai 
 * Telegram: @Mamber001
 * Hire me via Telegram: @Mamber001
 */
class QePayBankPayoutServices
{

    /**
     * Transfer Payment
     * 
     * @param string reference
     * @param string currency
     * @param string amount
     * @param string method
     * @param string bank code
     * @param string bank name
     * @param string account number
     * @param string account name
     * @param string narration
     */
    public function transfer(
        string $reference,
        string $currency,
        string $amount,
        string $method,
        string $bank_code,
        string $bank_name = null,
        string $account_number,
        string $account_name,
        string $narration = 'Goods'
    )
    {
        try {

            // Get Support Code
            //$bank_list = BankList::where(['bank_code' => $bank_code, 'status' => 1])->first();

            // Exception
            //if(!$bank_list) redirect()->route('mybank')->with("error", "Bank Name not available. Please update your bank info again");

            // Request Body
            $requestBody = array(
                "mch_id" => '****',
                "transfer_amount" => $amount,
                "mch_transferId" => $reference,
                "back_url" => URL::route('ipn.qepay.payout'),
                "apply_date" => date('Y-m-d H:i:s'),
                "bank_code" => $bank_code,
                "receive_name" => $account_name,
                "receive_account" => $account_number,
                //"remark" => $swift_code,
                "sign_type" => "MD5"
              );

            // Send Curl Request
            $sendRequest = $this->curlRequest('POST', 'pay/transfer', $requestBody);

            // Exception
            if($sendRequest instanceof \Exception) throw new \Exception($sendRequest->getMessage());

            // Format Response
            $response = ResponseBankUtilPayoutServices::response(200, 2, true, $reference, $sendRequest['merTransferId'], $currency, $amount, $method, $bank_code, $bank_name, $account_number, $account_name, $narration);

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

            // Sign Data
            $signData = $body;
            unset($signData['sign_type']);

            // Build Sign
            $sign = self::buildSignDigest($signData, $setting->payment_key->value);
            $body['sign'] = $sign;

            // Convert request data to JSON
            $jsonData = http_build_query($body);

            // Curl Request
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://pay.qeawapay.com/'.$endpoint,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_CONNECTTIMEOUT => 10,
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
            if ($httpcode !== 200) throw new \Exception($response_array['errorMsg'] ?? 'Payment gateway HTTP error: ' . $httpcode);

            // Check if successful
            if (($response_array['respCode'] ?? null) !== 'SUCCESS') throw new \Exception($response_array['errorMsg'] ?? 'Payment gateway rejected the payout.');


            curl_close($curl);

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
