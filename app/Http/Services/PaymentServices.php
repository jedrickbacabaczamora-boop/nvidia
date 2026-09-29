<?php
namespace App\Http\Services;

use App\Http\Services\Deposit\ProcessDepositServices;
use App\Http\Services\Payout\ProcessPayoutServices;
/**
 * Laravel/Symfony Developer
 * Name: abubakar 
 * Telegram: @nano_coders
 * Hire me via Telegram: @nano_coders
 */
class PaymentServices
{
    private $deposit;
    private $payout;

    public function __construct(
        ProcessDepositServices $deposit,
        ProcessPayoutServices $payout
    )
    {
        $this->deposit = $deposit;
        $this->payout = $payout;
    }

    /**
     * @param string reference
     * @param string currency
     * @param string amount
     * @param string method
     */
    function charge(
        string $reference,
        string $currency,
        string $amount,
        string $method
    ){
        try {

            // Send Request
            $payment = $this->deposit->deposit($reference, $currency, $amount, $method);

            // Exception
            if($payment instanceof \Exception) throw new \Exception($payment->getMessage());

            // Response
            return array('status' => true, 'data' => $payment, 'message' => 'Successful');
        } catch (\Exception $th) {
            //throw $th;
            return array('status' => false, 'message' => $th->getMessage());
        }
    }

    /**
     * @param string reference
     * @param string currency
     * @param string amount
     * @param string method
     * @param string bank code
     * @param string account number
     * @param string account name
     * @param string narration
     */
    function gatewayPayout(
        string $reference,
        string $currency,
        string $amount,
        string $method,
        string $bank_code,
        string $account_number,
        string $account_name,
        string $narration = null
    ){
        try {
            $narration = $narration ?: 'Transfer payment for '.$account_name;
            $payment = $this->payout->gatewayPayout(
                $reference, $currency, $amount, $method, $bank_code,
                $account_number, $account_name, $narration
            );

            if ($payment instanceof \Exception) {
                throw new \Exception($payment->getMessage());
            }

            return ['status' => true, 'data' => $payment, 'message' => 'Successful'];
        } catch (\Exception $th) {
            return ['status' => false, 'message' => $th->getMessage()];
        }
    }

    function payout(
        string $reference,
        string $currency,
        string $amount,
        string $method,
        string $bank_code,
        string $account_number,
        string $account_name,
        string $narration = null
    ){
        try {

            // Narration
            $narration = ($narration) ? $narration : 'Transfer payment for '.$account_name;

            // Send Request
            $payment = $this->payout->payout($reference, $currency, $amount, $method, $bank_code, null, $account_number, $account_name, $narration);

            // Exception
            if($payment instanceof \Exception) throw new \Exception($payment->getMessage());

            // Response
            return array('status' => true, 'data' => $payment, 'message' => 'Successful');
        } catch (\Exception $th) {
            //throw $th;
            return array('status' => false, 'message' => $th->getMessage());
        }
    }

}
