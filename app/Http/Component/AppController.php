<?php

namespace App\Http\Component;

use App\Http\Controllers\Controller;

/**
 * Laravel/Symfony Developer
 * Name: Muongozo
 * Telegram: @muongozotrader
 * Hire me via Telegram: muongozotrader
 */
class AppController extends Controller
{

    protected function handleResponse($request, $message, $status, $data = [])
    {
        if ($request->ajax()) {
            return response()->json(['status' => $status, 'data' => $data, 'message' => $message], $status);
        } else {

            $notify[] = ['success', $message];
            return back()->withNotify($notify);
        }
    }

    protected function handleResponseRedirect($request, $message, $status, $data = null, $routername = null, $param = [])
    {
        // Buld Link
        $link = ($routername) ? url(route($routername, $param)) : null;

        if ($request->ajax()) {

            return response()->json(['status' => $status, 'link' => $link, 'message' => $message], $status);
        } else {

            $notify_status = ($status == 200) ? 'success' : 'error';
            // With Router
            if($routername) return redirect()->route($routername, $param)->with($notify_status, $message);

            // With link
            return redirect($link);
        }
    }

    protected function handleResponseRedirectAway($request, $message, $status, $link = null)
    {
        if ($request->ajax()) {

            return response()->json(['status' => $status, 'link' => $link, 'message' => $message], $status);
        } else {

            // With link
            return redirect()->away($link);
        }
    }
}
