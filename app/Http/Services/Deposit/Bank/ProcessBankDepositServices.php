<?php
namespace App\Http\Services\Deposit\Bank;

use App\Http\Services\Deposit\Bank\ManualBankDepositServices;
use App\Models\Setting;

class ProcessBankDepositServices
{
    private $manual;
    private $qepay;
    private $mapay;

    public function __construct(
        ManualBankDepositServices $manual,
        QePayBankDepositServices $qepay,
        MaPayBankDepositServices $mapay
    )
    {
        $this->manual = $manual;
        $this->qepay = $qepay;
        $this->mapay = $mapay;
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

            // Hold User
            $setting = Setting::first();

            if($setting->auto_deposit) {

            // Verify transfer Type
            if(!in_array($method, ['mapay','qepay'])) throw new \Exception("Deposit not available at the moment");
                
                // Qe Pay
            if(in_array($method, ['qepay'])) {
                $payment = $this->qepay->deposit($reference, $currency, $amount, $method);
            }
            // MaPay
            if(in_array($method, ['mapay'])) {
                $payment = $this->mapay->deposit($reference, $currency, $amount, $method);
            }
                
            }else {
                // Manual
                $payment = $this->manual->deposit($reference, $currency, $amount, $method);
            }

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
