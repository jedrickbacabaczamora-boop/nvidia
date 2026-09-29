<?php
namespace App\Http\Services\Deposit;

use App\Http\Services\Deposit\Bank\ProcessBankDepositServices;
/**
 * Laravel/Symfony Developer
 * Name: bukar mai 
 * Telegram: @MB_TECH_Admin
 * Hire me via Telegram: @MB_TECH_Admin
 */
class ProcessDepositServices
{
    private $bank;

    public function __construct(
        ProcessBankDepositServices $bank
    )
    {
        $this->bank = $bank;
    }

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

            // Verify Method
            if(!in_array($method, ['mapay','qepay','watchpay'])) throw new \Exception("Sorry payment method not available ");

            // Process
            $payment = $this->bank->deposit($reference, $currency, $amount, $method); 

            // Exception
            if($payment instanceof \Exception) throw new \Exception($payment->getMessage());

            // Response
            return $payment;

        } catch (\Exception $th) {
            //throw $th;
            return $th;
        }
    }
}
