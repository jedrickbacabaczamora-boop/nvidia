<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    // This function will render the page to add a bank card
    public function showBankCardInfo()
    {
        // Example bank list (replace this with your actual data fetching logic, e.g., from the database)
        $bank_list = [
            ['bank_code' => '001', 'name' => 'Bank A'],
            ['bank_code' => '002', 'name' => 'Bank B'],
            ['bank_code' => '003', 'name' => 'Bank C'],
        ];

        // Fetch user bank details (assuming you're using auth() to get logged-in user)
        $user = auth()->user();
        $bankAccount = $user->bankAccount; // Assuming your User model has a bankAccount relationship

        // Passing bank_list and bank details to the view
        return view('bank-card-info', compact('bank_list', 'bankAccount'));
    }
}