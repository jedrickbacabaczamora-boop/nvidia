<?php
namespace App\Http\Services\Payout\Bank;

use App\Http\Services\Payout\Bank\Util\ResponseBankUtilPayoutServices;
/**
 * Laravel/Symfony Developer
 * Name: bukar mai 
 * Telegram: @Mamber001
 * Hire me via Telegram: @Mamber001
 */
class ManualBankPayoutServices
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
        string $bank_name,
        string $account_number,
        string $account_name,
        string $narration = null
    )
    {
        try {

            // Format Response
            $response = ResponseBankUtilPayoutServices::response(200, 0, true, $reference, $reference, $currency, $amount, $method, $bank_code, $bank_name, $account_number, $account_name, $narration);

            // Response
            return $response;

        } catch (\Exception $th) {
            //throw $th;
            return $th;
        }
    }
}
