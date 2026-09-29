<?php
namespace App\Http\Services\Payout\Bank;

use App\Models\Setting;
/**
 * Laravel/Symfony Developer
 * Name: bukar mai 
 * Telegram: @Mamber001
 * Hire me via Telegram: @Mamber001
 */
class ProcessBankPayoutServices
{
    private $manual;
    private $qepay;
    private $mapay;

    public function __construct(
        ManualBankPayoutServices $manual,
        QePayBankPayoutServices $qepay,
        MaPayBankPayoutServices $mapay
    )
    {
        $this->manual = $manual;
        $this->qepay = $qepay;
        $this->mapay = $mapay;
    }

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
    public function gatewayTransfer(
        string $reference,
        string $currency,
        string $amount,
        string $method,
        string $bank_code,
        string $bank_name = null,
        string $account_number,
        string $account_name,
        string $narration = null
    )
    {
        try {
            $setting = Setting::first();
            $gateway = $setting->auto_transfer_default ?? null;

            if (!in_array($gateway, ['mapay', 'qepay'], true)) {
                throw new \Exception('Payout gateway is not configured.');
            }

            $payment = $gateway === 'qepay'
                ? $this->qepay->transfer($reference, $currency, $amount, $method, $bank_code, $bank_name, $account_number, $account_name, $narration)
                : $this->mapay->transfer($reference, $currency, $amount, $method, $bank_code, $bank_name, $account_number, $account_name, $narration);

            if ($payment instanceof \Exception) {
                throw new \Exception($payment->getMessage());
            }

            return $payment;
        } catch (\Exception $th) {
            return $th;
        }
    }

    public function transfer(
        string $reference,
        string $currency,
        string $amount,
        string $method,
        string $bank_code,
        string $bank_name = null,
        string $account_number,
        string $account_name,
        string $narration = null
    )
    {
        try {

            // Hold User
            $setting = Setting::first();

            if($setting->auto_transfer) {

                // Verify transfer Type
                if(!in_array($setting->auto_transfer_default, ['mapay','qepay'])) throw new \Exception("Payout not available at the moment");
                
                // qepay
                if(in_array($setting->auto_transfer_default, ['qepay'])) {
                $payment = $this->qepay->transfer($reference, $currency, $amount, $method, $bank_code, $bank_name, $account_number, $account_name, $narration);
            
                }
                // mapay
                if(in_array($setting->auto_transfer_default, ['mapay'])) {
                $payment = $this->mapay->transfer($reference, $currency, $amount, $method, $bank_code, $bank_name, $account_number, $account_name, $narration);
            
                }
                
            }else {
                // Manual
                $payment = $this->manual->transfer($reference, $currency, $amount, $method, $bank_code, $bank_name, $account_number, $account_name, $narration);
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
