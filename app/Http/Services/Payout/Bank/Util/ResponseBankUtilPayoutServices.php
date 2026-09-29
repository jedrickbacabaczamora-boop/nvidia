<?php
namespace App\Http\Services\Payout\Bank\Util;
/**
 * Laravel/Symfony Developer
 * Name: bukar mai 
 * Telegram: @MB_TECH_Admin
 * Hire me via Telegram: @MB_TECH_Admin
 */
class ResponseBankUtilPayoutServices
{
    
    /**
     * Format Transfer Payment
     * 
     * @param int status
     * @param int status id
     * @param bool auto
     * @param string reference
     * @param string currency
     * @param string amount
     * @param string method
     * @param string bank code
     * @param string bank name
     * @param string account number
     * @param string account name
     * @param string narration
     * 
     * @return array
     */
    public static function response(
        int $status,
        int $status_id,
        bool $auto,
        string $reference,
        string $orderRef,
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

        // Data method
        $data = [
            'status' => $status,
            'auto' => $auto,
            'reference' => $reference,
            'order_ref' => $orderRef,
            'method' => $method,
            'currency' => $currency,
            'amount' => number_format($amount, 2, '.', ''),
            'bank_name' => $bank_name,
            'bank_code' => $bank_code,
            'account_number' => $account_number,
            'account_name' => $account_name,
            'narration' => $narration,
            'status_id' => $status_id
        ];

        // Response
        return $data;
    }
}
