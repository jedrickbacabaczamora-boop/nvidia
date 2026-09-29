<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
      public function show($id)
      {
  if (!auth()->check()) {
 abort(403, 'You are not logged in.');
 }

 $purchase = Purchase::with(['package', 'userLedgers'])->findOrFail($id);


if ((int) $purchase->user_id !== (int) auth()->id()) {
abort(403, 'Unauthorized access.');
 }

return view('app.main.order-detail', compact('purchase'));
 }
}
