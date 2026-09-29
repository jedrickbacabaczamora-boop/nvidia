<?php


use App\Models\Purchase;
use App\Models\User;
use Stichoza\GoogleTranslate\GoogleTranslate;

if (! function_exists('main_root')) {
    function main_root()
    {
        return "public";
    }
}

if (! function_exists('admin_file_root')) {
    function admin_file_root()
    {
        return "public/admin";
    }
}

if (! function_exists('frontend_file_root')) {
    function frontend_file_root()
    {
        return "public/frontend";
    }
}

if (! function_exists('admin')) {
    function admin()
    {
        return \Illuminate\Support\Facades\Auth::guard('admin');
    }
}
/*
if (! function_exists('price')) {
    function price($price)
    {
        return currency().number_format($price, 0);
    }
}


if (! function_exists('depositPrice')) {
    function depositPrice($amount){
        return currency().number_format($amount, 0);
    }
}

if (! function_exists('currency')) {
    function currency()
    {
        return 'R';
    }
}*/ 
if (!function_exists('price')) {
    function price($price)
    {
        return str_replace("," , "" , setting('currency') . number_format($price, 2));
        $currency = '$';
        return $currency . number_format($price, 2);
    }
}

if (! function_exists('user')) {
    function user()
    {
        return \Illuminate\Support\Facades\Auth::user();
    }
}

if (! function_exists('not_found_img')) {
    function not_found_img()
    {
        return '/public/common/img/404.png';
    }
}

if (! function_exists('success_redirect')) {
    function success_redirect($route, $type)
    {
        return redirect()->route($route)->with('success', "Item $type Successfully.");
    }
}

if (! function_exists('error_redirect')) {
    function error_redirect($route, $type, $message)
    {
        return redirect()->route($route)->with($type, $message);
    }
}


if (! function_exists('uploadImage')) {
    function uploadImage($true_II_false_normal ,$request ,$input, $dir, $w=null, $h=null, $oldInput=null)
    {
        $path = public_path(str_replace('/public/', '', $oldInput));
        if ($request->hasFile($input)) {
            if (File::exists($path)){
                File::delete($path);
            }
        }

        if ($request->hasFile($input)) {
            $file = $request->file($input);
            $namewithextension = $file->getClientOriginalName(); //Name with extension 'filename.jpg'
            $name = explode('.', $namewithextension)[0]; // Filename 'filename'
            $extension = $file->getClientOriginalExtension();
            $file_name = time(). Str::random(3) . '.' . $extension;

            if ($true_II_false_normal){
                $destinationPath = public_path($dir);
                $imgFile = Image::make($request->file($input)->getRealPath());
                $imgFile->resize($w, $h, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$file_name);
            }else{
                $request->file($input)->move(public_path($dir), $file_name);
            }

            \Artisan::call('view:clear');
            \Artisan::call('cache:clear');
            $path = '/public/'. $dir . $file_name;
            return $path;
        }
        return null;
    }
}

if (! function_exists('deleteImage')) {
    function deleteImage($oldInput)
    {
        $path = public_path(str_replace('/public/', '', $oldInput));
        if (File::exists($path)){
            File::delete($path);
        }
        return true;
    }
}

if (! function_exists('view_image')) {
    function view_image($imageName)
    {
        $mainUrl = env('IMAGE_VIEW_SET');
        if ($mainUrl == null){
            $mainUrl = url('');
        }
        return $mainUrl . $imageName;
    }
}


if (! function_exists('createSlug')){
    function createSlug($table_model, $title, $id = 0)
    {
        $slug = Str::slug($title);
        $allSlugs = getRelatedSlugs($table_model, $slug, $id);
        if (!$allSlugs->contains('slug', $slug)) {
            return $slug;
        }
        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }
        throw new \Exception('Can not create a unique slug');
    }
}
//$object->slug = Helper::createSlug('\Category',$request->name);

if (! function_exists('getRelatedSlugs')){
    function getRelatedSlugs($table_model, $slug, $id = 0)
    {
        $model_name = "App\Models" . $table_model;


        $data = $model_name::where('slug', 'like', $slug . '%')
            ->where('id', '<>', $id)
            ->get();
        return $data;
    }
}


if(! function_exists('setting')){
    function setting($column)
    {
        $setting = \App\Models\Setting::select('id', "$column")->first();
        if ($setting){
            $column = $setting->{$column};
        }else{
            $column = "Data Is Empty";
        }
        return $column;
    }
}


if(! function_exists('my_vips')){
    function my_vips()
    {
        $purchaseVips = Purchase::where('user_id', \auth()->id())->orderByDesc('id')->get();
        $vids = [];
        foreach ($purchaseVips as $el)
        {
            array_push($vids, $el->package_id );
        }
        return $vids;
    }
}

if(! function_exists('my_active_vips')){
    function my_active_vips()
    {
        $purchaseVips = Purchase::where('user_id', \auth()->id())->where('status', 'active')->orderByDesc('id')->get();
        $vids = [];
        foreach ($purchaseVips as $el)
        {
            array_push($vids, $el->package_id );
        }
        return $vids;
    }
}

if(! function_exists('my_inactive_vips')){
    function my_inactive_vips()
    {
        $purchaseVips = Purchase::where('user_id', \auth()->id())->where('status', 'inactive')->orderByDesc('id')->get();
        $vids = [];
        foreach ($purchaseVips as $el)
        {
            array_push($vids, $el->package_id );
        }
        return $vids;
    }
}


if(! function_exists('translator')){
    function translator($text)
    {
        return $text;
        $text = GoogleTranslate::trans($text, app()->getLocale());
        return $text;
    }
}
if(! function_exists('registration_bonus')){
    function registration_bonus()
    {
        return 25;
    }
}
if(! function_exists('registration_reword')){
    function registration_reword()
    {
        return 15;
    }
}
function debit_user_wallet($user_id, $type, $currency, $amount) {

    $user = User::find($user_id);

    // Default Data
    $data = [
        'status' => false,
        'old_balance' => $user->balance,
        'new_balance' => $user->balance,
        'message' => 'Successful'
    ];

    // Recharge Balance
    if($type == 1) {

        if($user->balance < $amount){
            //$data['status'] = false;
            $data['message'] = 'You dont have enough recharge balance';

            return $data;
        }

        // Debit Wallet
        $user->balance = $user->balance - $amount;
        $user->save();

        $data['status'] = true;
        $data['new_balance'] = $user->balance;
    }

    // balance Balance
    if($type == 2) {

        if($user->balance < $amount){
            //$data['status'] = false;
            $data['message'] = 'You dont have enough withdrawal balance';

            return $data;
        }
        
        $data['old_balance'] = $user->balance;

        // Debit Wallet
        $user->balance = $user->balance - $amount;
        $user->save();

        $data['status'] = true;
        $data['new_balance'] = $user->balance;
    }

    return $data;
}

function credit_user_wallet($user_id, $type, $currency, $amount) {

    $user = User::find($user_id);

    // Default Data
    $data = [
        'status' => false,
        'old_balance' => $user->balance,
        'new_balance' => $user->balance,
        'message' => 'Successful'
    ];

    // Recharge Balance
    if($type == 1) {

        // Credit Wallet
        $user->balance = $user->balance + $amount;
        $user->save();

        $data['status'] = true;
        $data['new_balance'] = $user->balance;
    }

    // balance Balance
    if($type == 2) {

        $data['old_balance'] = $user->balance;

        // Debit Wallet
        $user->balance = $user->balance + $amount;
        $user->save();

        $data['status'] = true;
        $data['new_balance'] = $user->balance;
    }

    return $data;
}



?>
