<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\BonusController;
use App\Http\Controllers\admin\CommonController;
use App\Http\Controllers\admin\FundController;
use App\Http\Controllers\admin\HiruSliderController;
use App\Http\Controllers\admin\IconController;
use App\Http\Controllers\admin\ManageUserController;
use App\Http\Controllers\admin\ManageWithdrawController;
use App\Http\Controllers\admin\NoticeController;
use App\Http\Controllers\admin\PackageController;
use App\Http\Controllers\admin\PaymentMethodController;
use App\Http\Controllers\admin\RebateController;
use App\Http\Controllers\admin\AdminWithdrawProofController;
use App\Http\Controllers\user\OnepayController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\TaskController;
use App\Http\Controllers\admin\VipSliderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\user\IpnQePayController;
use App\Http\Controllers\user\MiningController;
use App\Http\Controllers\user\PurchaseController;
use App\Http\Controllers\user\GetBonusController;
use App\Http\Controllers\user\TeamController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\user\SpinController;
use App\Http\Controllers\user\UserFundInvestController;
use App\Http\Controllers\user\WithdrawController;
use App\Http\Controllers\user\WithdrawProofController;
use App\Http\Controllers\user\WithdrawProofPublicController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('clear', function () {
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    return redirect()->back();
});



/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware('throttle:limit-check')->group(function (){

    Route::prefix('admin')->group(function () {
        Route::get('/', function () {
            return redirect()->route('admin.login');
        });
        Route::get('login', [AdminController::class, 'login'])->name('admin.login');
        Route::post('login', [AdminController::class, 'login_submit'])->name('admin.login-submit');
    });

    Route::prefix('admin')->middleware('admin')->group(function () {
        Route::get('logout', [AdminController::class, 'logout'])->name('admin.logout');
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        //All Table Status
        Route::post('/table/status', [CommonController::class, 'status']);

        //ADMIN PROFILE
        Route::get('/withdraw-proofs', [AdminWithdrawProofController::class, 'index'])->name('admin.withdraw.proofs');
        Route::post('/withdraw-proofs/{id}/status', [AdminWithdrawProofController::class, 'updateStatus'])->name('admin.withdraw.proofs.status');
        //Route::get('/proofs', [AdminWithdrawProofController::class, 'index'])->name('admin.proofs.index');
        //Route::post('/proofs/{id}/approve', [AdminWithdrawProofController::class, 'approve'])->name('admin.proofs.approve');
        //Route::post('/proofs/{id}/reject', [AdminWithdrawProofController::class, 'reject'])->name('admin.proofs.reject');


        Route::get('profile', [AdminController::class, 'profile'])->name('admin.profile');
        Route::get('change/password', [AdminController::class, 'change_password'])->name('admin.changepassword');
        Route::post('check/password', [AdminController::class, 'check_password'])->name('admin.check.password');
        Route::post('change/password', [AdminController::class, 'change_password_submit'])->name('admin.changepasswordsubmit');
        Route::get('profile/update', [AdminController::class, 'profile_update'])->name('admin.profile.update');
        Route::post('profile/update', [AdminController::class, 'profile_update_submit'])->name('admin.profile.update-submit');

        //Notice
        Route::get('salary', [AdminController::class, 'salaryView'])->name('admin.salary');
        Route::get('salary-submit', [AdminController::class, 'commission'])->name('admin.salary.submit');
        Route::get('notice', [NoticeController::class, 'index'])->name('admin.notice.index');
        Route::get('notice/view/{id}', [NoticeController::class, 'view'])->name('admin.notice.view');
        Route::get('notice/create/{id?}', [NoticeController::class, 'create'])->name('admin.notice.create');
        Route::post('notice/insert-update', [NoticeController::class, 'insert_or_update'])->name('admin.notice.insert');
        Route::delete('notice/delete/{id}', [NoticeController::class, 'delete'])->name('admin.notice.delete');

        //Notice
        Route::get('hiruslider', [HiruSliderController::class, 'index'])->name('admin.hiruslider.index');
        Route::get('hiruslider/create/{id?}', [HiruSliderController::class, 'create'])->name('admin.hiruslider.create');
        Route::post('hiruslider/insert-update', [HiruSliderController::class, 'insert_or_update'])->name('admin.hiruslider.insert');
        Route::delete('hiruslider/delete/{id}', [HiruSliderController::class, 'delete'])->name('admin.hiruslider.delete');

        //Fund
        Route::get('fund', [FundController::class, 'index'])->name('admin.fund.index');
        Route::get('fund/create/{id?}', [FundController::class, 'create'])->name('admin.fund.create');
        Route::post('fund/insert-update', [FundController::class, 'insert_or_update'])->name('admin.fund.insert');
        Route::delete('fund/delete/{id}', [FundController::class, 'delete'])->name('admin.fund.delete');
        Route::get('fund/view/{id}', [FundController::class, 'view'])->name('admin.fund.view');

        //Manage Customers
        Route::get('customers', [ManageUserController::class, 'customers'])->name('admin.customer.index');
        Route::get('customers/status/{id}', [ManageUserController::class, 'customersStatus'])->name('admin.customer.status');
        Route::get('customers/login/{id}', [ManageUserController::class, 'user_acc_login'])->name('admin.customer.login');
        Route::post('customers/change-password', [ManageUserController::class, 'user_acc_password'])->name('admin.customer.change-password');
        Route::get('search/user', [ManageUserController::class, 'search'])->name('admin.search.user');
        Route::get('search/user/action', [ManageUserController::class, 'searchSubmit'])->name('admin.search.submit');
        Route::post('provide/bonus/code', [ManageUserController::class, 'bonusCode'])->name('admin.customer.bonus');

        //Ban/Unban
        Route::get('/user-unban/{id}',  [ManageUserController::class, 'unban'])->name('admin.user.unban');
        Route::get('/user-ban/{id}',  [ManageUserController::class, 'ban'])->name('admin.user.ban');

        //Purchase Record
        Route::get('purchase/record', [ManageUserController::class, 'purchaseRecord'])->name('admin.purchase.index');
        Route::get('developer', [AdminController::class, 'developer'])->name('admin.developer.index');

        //VIP
        Route::get('package', [PackageController::class, 'index'])->name('admin.package.index');
        Route::get('package/create/{id?}', [PackageController::class, 'create'])->name('admin.package.create');
        Route::post('package/insert-update', [PackageController::class, 'insert_or_update'])->name('admin.package.insert');
        Route::delete('package/delete/{id}', [PackageController::class, 'delete'])->name('admin.package.delete');
        Route::get('package/view/{id}', [PackageController::class, 'view'])->name('admin.package.view');

        //Task
        Route::get('task', [TaskController::class, 'index'])->name('admin.task.index');
        Route::get('task/create/{id?}', [TaskController::class, 'create'])->name('admin.task.create');
        Route::post('task/insert-update', [TaskController::class, 'insert_or_update'])->name('admin.task.insert');
        Route::delete('task/delete/{id}', [TaskController::class, 'delete'])->name('admin.task.delete');

        //bonus
        Route::get('bonus', [BonusController::class, 'index'])->name('admin.bonus.index');
        Route::get('bonus/status/{id}', [BonusController::class, 'status'])->name('admin.bonus.status');
        Route::get('bonus/create/{id?}', [BonusController::class, 'create'])->name('admin.bonus.create');
        Route::post('bonus/insert-update', [BonusController::class, 'insert_or_update'])->name('admin.bonus.insert');
        Route::delete('bonus/delete/{id}', [BonusController::class, 'delete'])->name('admin.bonus.delete');
        Route::get('bonus/uses', [BonusController::class, 'bonuslist'])->name('admin.bonuslist.index');//Customer bonus uses

        //VIP slider
        Route::get('vipslider', [VipSliderController::class, 'index'])->name('admin.vipslider.index');
        Route::get('vipslider/create/{id?}', [VipSliderController::class, 'create'])->name('admin.vipslider.create');
        Route::post('vipslider/insert-update', [VipSliderController::class, 'insert_or_update'])->name('admin.vipslider.insert');
        Route::delete('vipslider/delete/{id}', [VipSliderController::class, 'delete'])->name('admin.vipslider.delete');

        //Payment
        Route::get('method', [PaymentMethodController::class, 'index'])->name('admin.method.index');
        Route::get('method/create/{id?}', [PaymentMethodController::class, 'create'])->name('admin.method.create');
        Route::post('method/insert-update', [PaymentMethodController::class, 'insert_or_update'])->name('admin.method.insert');
        Route::delete('method/delete/{id}', [PaymentMethodController::class, 'delete'])->name('admin.method.delete');

        //Handle Customer
        Route::get('customer/pending/payment', [ManageUserController::class, 'pendingPayment'])->name('admin.payment.pending');
        Route::get('customer/approved/payment', [ManageUserController::class, 'approvedPayment'])->name('admin.payment.approved');
        Route::get('customer/rejected/payment', [ManageUserController::class, 'rejectedPayment'])->name('admin.payment.rejected');
        Route::post('customer/payment/status/{id}', [ManageUserController::class, 'paymentStatus'])->name('payment.status.change');

        Route::get('customer/pss/', [ManageUserController::class, 'ppss'])->name('admin.user.ppss');

         Route::get('customer/payment/approved/{id}', [ManageUserController::class, 'paymentStatusApproved'])->name('payment.status.change.approved');

        Route::get('customer/payment/rejected/{id}', [ManageUserController::class, 'paymentStatusRejected'])->name('payment.status.change.rejected');
        Route::get('customer/payment/pending/{id}', [ManageUserController::class, 'paymentStatusPending'])->name('payment.status.change.pending');

        //Handle Customer Withdraw
        Route::get('customer/process/withdraw', [ManageWithdrawController::class, 'processWithdraw'])->name('admin.withdraw.process');
        Route::get('customer/pending/withdraw', [ManageWithdrawController::class, 'pendingWithdraw'])->name('admin.withdraw.pending');
        Route::get('customer/approved/withdraw', [ManageWithdrawController::class, 'approvedWithdraw'])->name('admin.withdraw.approved');
        Route::get('customer/rejected/withdraw', [ManageWithdrawController::class, 'rejectedWithdraw'])->name('admin.withdraw.rejected');
        Route::post('customer/withdraw/status/{id}', [ManageWithdrawController::class, 'withdrawStatus'])->name('withdraw.status.change');

        //Settings
        Route::get('setting', [SettingController::class, 'index'])->name('admin.setting.index');
        Route::post('setting/insert-update', [SettingController::class, 'insert_or_update'])->name('admin.setting.insert');

        Route::get('rebate', [RebateController::class, 'index'])->name('admin.rebate.index');
        Route::post('rebate/insert-update', [RebateController::class, 'insert_or_update'])->name('admin.rebate.insert');

        //Icons
        Route::get('icon', [IconController::class, 'index'])->name('admin.icon.index');
        Route::post('icon/insert-update', [IconController::class, 'insert_or_update'])->name('admin.icon.insert');

        //Balance add/minus
        Route::get('balance/add', [ManageUserController::class, 'add_balance'])->name('admin.user.balance.add');
        Route::get('balance/minus', [ManageUserController::class, 'minus_balance'])->name('admin.user.balance.minus');


        //List
        Route::get('mining/with-customer', [ManageUserController::class, 'continue_mining'])->name('admin.mining_purchase.index');
        //List
        Route::prefix('admin/secret')->group(function () {
        Route::get('task/request', [TaskController::class, 'task_request'])->name('admin.task.request.index');
        Route::get('task/request/status/{id}/{status}', [TaskController::class, 'task_request_status'])->name('admin.task.request.status');
        Route::get('task/request/status-legacy/{id}/{status}', [TaskController::class, 'task_request_status'])->name('admin.request.status');
        });

        Route::get('mining/with-customer', [ManageUserController::class, 'continue_mining'])->name('admin.mining_purchase.index');
    });

    /*
    |--------------------------------------------------------------------------
    | User Routes
    |--------------------------------------------------------------------------
    */

    Route::get('/', function(){
        return redirect()->route('login');
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', function (){
            return redirect()->route('home');
        })->name('dashboard');

        Route::get('/home', [UserController::class, 'home'])->name('home');
        Route::get('/mining', [MiningController::class, 'running_mining'])->name('user.mining');
        Route::get('/my-team', [TeamController::class, 'team'])->name('user.team');
        Route::get('/package-details/{id}', [UserController::class, 'package_details'])->name('package.details');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('setting', [UserController::class, 'setting'])->name('setting');

        Route::post('change-password', [UserController::class, 'setting_change_password'])->name('setting.change.password');

        Route::get('/change/password', [ProfileController::class, 'change_password'])->name('user.change.password');
        Route::post('/change/password/confirm', [ProfileController::class, 'change_password_confirm'])->name('user.change.password.confirmation');

        Route::get('user', [UserController::class, 'profile'])->name('profile');

        Route::get('my-personal-details' , [UserController::class, 'personal_details'])->name('user.personal-details');
        
        //Bank Setup
        Route::get('add-bank', [UserController::class, 'add_bank'])->name('user.bank');
        Route::get('add-bank-setup', [UserController::class, 'add_bank_setup'])->name('user.bank_setup');
        Route::post('add-bank-setup-confirm', [UserController::class, 'add_bank_setup_confirm'])->name('user.bank_setup_confirm');
        

        //Withdraw
        //Route::get('/withdraw-proof', [WithdrawProofController::class, 'index'])->name('user.withdraw.proof');
        //Route::post('/withdraw-proof', [WithdrawProofController::class, 'dataSubmit'])->name('user.withdraw.proof.submit');



        Route::get('withdraw', [WithdrawController::class, 'withdraw'])->name('user.withdraw');
        Route::post('withdraw-request', [WithdrawController::class, 'withdrawRequest'])->name('user.withdraw.request');
        
        Route::get('recharge', [UserController::class, 'recharge'])->name('user.recharge');
        Route::get('user/payment/{amount}', [OnepayController::class, 'paymentMethod']);
        Route::get('user/payment/{amount}/{method}', [OnepayController::class, 'payment_confirm']);
        Route::post('user/payment/submit', [OnepayController::class, 'depositSubmit'])->name('depositSubmit');
        Route::post('/deposit-confirm', [UserController::class, 'deposit_confirm'])->name('deposit_confirm');
        Route::get('recharge/history', [OnepayController::class, 'recharge_record'])->name('recharge.history.preview');
        Route::post('user/payment/submit', [OnepayController::class, 'depositSubmit'])->name('depositSubmit');

        //Ledger
        Route::get('deposit/history', [UserController::class, 'deposit_history'])->name('deposit.history');
        Route::get('withdraw/history', [WithdrawController::class, 'withdraw_history'])->name('withdraw.history');
        Route::get('commission/history', [UserController::class, 'commission'])->name('commission');
        Route::get('team/commission', [UserController::class, 'team_commission_history'])->name('team.commission');
        Route::get('reword/history', [UserController::class, 'reword_history'])->name('reword.history');
        Route::get('spin/history', [SpinController::class, 'spin_history'])->name('spin.history');
        Route::get('amount/history', [UserController::class, 'amount_history'])->name('user.balance.history');

        //VIP
        Route::get('/product', [UserController::class, 'vip'])->name('vip');
        Route::get('/vip/details/{id}', [UserController::class, 'vip_details'])->name('vip.details');
        Route::get('/balanceDetails', [UserController::class, 'history'])->name('history');
        Route::get('/all/history', [UserController::class, 'history_all'])->name('history.all');
        Route::get('/income/history', [UserController::class, 'history_income'])->name('income.history');
        Route::get('/orders', [UserController::class, 'ordered'])->name('order');
        Route::get('/orders/{id}', [OrderController::class, 'show'])->name('order.show');

        Route::get('/vip/commission', [UserController::class, 'vip_commission'])->name('vip.commission');
        Route::get('/tasks', [UserController::class, 'task'])->name('task');
        Route::get('purchase/vip/{id}', [PurchaseController::class, 'purchaseConfirmation'])->name('user.purchase.vip');
        Route::get('purchase/confirmation/{id}', [PurchaseController::class, 'purchaseConfirmation'])->name('purchase.confirmation');

        //invite 
        Route::get('/vip', [UserController::class, 'community'])->name('community');
        Route::get('/add/community', [UserController::class, 'add_com'])->name('add.com');
        Route::get('/invitation', [UserController::class, 'invite'])->name('user.invite');
        Route::get('/help', [UserController::class, 'service'])->name('service');
        Route::get('/appreview', [UserController::class, 'appreview'])->name('appreview');
        Route::get('/rule', [UserController::class, 'rule'])->name('user.rule');
        Route::get('/notice', [UserController::class, 'notice'])->name('notice');
    
        
        Route::get('submit-bonus-check/{code}', [SpinController::class, 'submitbonuscheck']);
        Route::get('submit-bonus-amount', [SpinController::class, 'submitbonusamount']);
                //checkin

        //Team
        Route::get('team', [TeamController::class, 'team'])->name('team');
        Route::get('member/1', [TeamController::class, 'teama'])->name('teama');
        Route::get('member/2', [TeamController::class, 'teamb'])->name('teamb');
        Route::get('member/3', [TeamController::class, 'teamc'])->name('teamc');




        Route::get('about', function(){return view('app.main.about');})->name('about');

        // Bonus routes
        Route::get('/lottery', [SpinController::class, 'showSpin'])->name('spin.show');
        Route::post('/spin-now', [SpinController::class, 'spinNow'])->name('spin.now');


        Route::get('/member', [WithdrawProofPublicController::class, 'index'])->name('withdrawal.public.index');
        Route::get('/member/done', [WithdrawProofController::class, 'create'])->name('proof.create');
        Route::post('/submit-proof', [WithdrawProofController::class, 'store'])->name('proof.store');

        Route::get('my-bonus', [GetBonusController::class, 'index'])->name('user.bonus');
        Route::get('submit-bonus-amount/{code}', [SpinController::class, 'submitbonusamount'])->name('user.bonus.amount.submit');

        //Funding
        Route::get('fund', [UserFundInvestController::class, 'fund'])->name('fund');
        Route::get('my/fund', [UserFundInvestController::class, 'myfund'])->name('my.fund');
        Route::get('fund-invest-confirm/{id}', [UserFundInvestController::class, 'fund_confirmation'])->name('fund.invest.confirm');

        Route::get('lucky', [UserController::class, 'lucky'])->name('lucky');
        Route::get('checkin/history', [UserController::class, 'checkin_history'])->name('checkin.history');

        //Investment
        Route::get('task/claim/{task_id}', [MiningController::class, 'apply_task_commission'])->name('user.received.reward');
        Route::get('apply-for-task-commission/{id}', [MiningController::class, 'apply_task_commission']);
        Route::get('received-amount', [MiningController::class, 'received_amount'])->name('user.received.amount');

        //Apk
        //GET BONUS
        Route::get('get-bonus', [GetBonusController::class, 'index'])->name('user.get.bonus');
        Route::post('/submit-bonus', [GetBonusController::class, 'submitBonusCode'])->name('user.submit-bonus');
        Route::get('submit-checkin', [GetBonusController::class, 'checkin'])->name('user.checkin');
                Route::get('get-bonus-preview', [GetBonusController::class, 'preview'])->name('user.bonus-preview');
        Route::post('spin.get-amount', [GetBonusController::class, 'preview'])->name('user.bonus.amount.preview');



        Route::get('clear/cached', [UserController::class, 'cacheClear'])->name('clear.cached');

    });

    Route::get('download-apk', [UserController::class, 'download_apk'])->name('user.download.apk');
});

//CronJob Commission
Route::get('commission-interest', [AdminController::class, 'commission']);
Route::post('ipn/wp6502/in', [IpnQePayController::class, 'ipnDeposit'])->name('ipn.qepay.payin');
Route::post('ipn/wp5d02/out', [IpnQePayController::class, 'ipnTransfer'])->name('ipn.qepay.payout');

require __DIR__.'/auth.php';
