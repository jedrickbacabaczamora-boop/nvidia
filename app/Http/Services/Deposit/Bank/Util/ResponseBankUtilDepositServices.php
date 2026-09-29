<?php
namespace App\Http\Services\Deposit\Bank\Util;

class ResponseBankUtilDepositServices
{
    
    /**
     * Format Deposit Payment
     * 
     * @param int status
     * @param int status id
     * @param bool auto
     * @param string reference
     * @param string currency
     * @param string amount
     * @param string method
     * @param string link
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
        string $link = null
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
            'link' => $link,
            'status_id' => $status_id
        ];

        // Response
        return $data;
    }
}
