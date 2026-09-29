<?php
namespace App\Http\Services\Deposit\Bank;

use App\Http\Services\Deposit\Bank\Util\ResponseBankUtilDepositServices;
/**
 * Laravel/Symfony Developer
 * Name: bukar mai 
 * Telegram: @Mamber001
 * Hire me via Telegram: @Mamber001
 */
class ManualBankDepositServices
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

            // Format Response
            $response = ResponseBankUtilDepositServices::response(200, 0, true, $reference, $reference, $currency, $amount, $method);

            // Response
            return $response;

        } catch (\Exception $th) {
            //throw $th;
            return $th;
        }
    }
}
