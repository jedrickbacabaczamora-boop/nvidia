<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Icon;
use Illuminate\Http\Request;

class IconController extends Controller
{
    public $route = 'admin.icon';
    public function index()
    {
        $data = Icon::find(1);
        return view('admin.pages.icon.index', compact('data'));
    }

    public function insert_or_update(Request $request)
    {
        $model = Icon::find(1);
        $path1 = uploadImage(false ,$request, 'recharge', 'upload/icon/', null, null ,$model->recharge);
        $path2 = uploadImage(false ,$request, 'recharge_button', 'upload/icon/', null, null ,$model->recharge_button);
        $path3 = uploadImage(false ,$request, 'withdraw', 'upload/icon/', null, null ,$model->withdraw);
        $path4 = uploadImage(false ,$request, 'withdraw_button', 'upload/icon/', null, null ,$model->withdraw_button);
        $path5 = uploadImage(false ,$request, 'invitation', 'upload/icon/', null, null ,$model->invitation);
        $path6 = uploadImage(false ,$request, 'team', 'upload/icon/', null, null ,$model->team);
        $path7 = uploadImage(false ,$request, 'apps', 'upload/icon/', null, null ,$model->apps);
        $path8 = uploadImage(false ,$request, 'lucky_draw', 'upload/icon/', null, null ,$model->lucky_draw);
        $path9 = uploadImage(false ,$request, 'robot', 'upload/icon/', null, null ,$model->robot);
        $path10 = uploadImage(false ,$request, 'about', 'upload/icon/', null, null ,$model->about);
        $path11 = uploadImage(false ,$request, 'profile_bank', 'upload/icon/', null, null ,$model->profile_bank);
        $path12 = uploadImage(false ,$request, 'profile_invite', 'upload/icon/', null, null ,$model->profile_invite);
        $path13 = uploadImage(false ,$request, 'profile_mining', 'upload/icon/', null, null ,$model->profile_mining);
        $path14 = uploadImage(false ,$request, 'profile_team', 'upload/icon/', null, null ,$model->profile_team);
        $path15 = uploadImage(false ,$request, 'profile_faq', 'upload/icon/', null, null ,$model->profile_faq);
        $path16 = uploadImage(false ,$request, 'profile_income', 'upload/icon/', null, null ,$model->profile_income);
        $path17 = uploadImage(false ,$request, 'profile_touch', 'upload/icon/', null, null ,$model->profile_touch);
        $path18 = uploadImage(false ,$request, 'profile_password', 'upload/icon/', null, null ,$model->profile_password);
        $path19 = uploadImage(false ,$request, 'profile_logout', 'upload/icon/', null, null ,$model->profile_logout);
        $path20 = uploadImage(false ,$request, 'team_banner', 'upload/icon/', null, null ,$model->team_banner);
        $path21 = uploadImage(false ,$request, 'team_details_banner', 'upload/icon/', null, null ,$model->team_details_banner);
        $path22 = uploadImage(false ,$request, 'team_label1', 'upload/icon/', null, null ,$model->team_label1);
        $path23 = uploadImage(false ,$request, 'team_label2', 'upload/icon/', null, null ,$model->team_label2);
        $path24 = uploadImage(false ,$request, 'team_label3', 'upload/icon/', null, null ,$model->team_label3);
        $path25 = uploadImage(false ,$request, 'profile_reword', 'upload/icon/', null, null ,$model->profile_reword);

        $model->recharge = $path1 ?? $model->recharge;
        $model->recharge_button = $path2 ?? $model->recharge_button;
        $model->withdraw = $path3 ?? $model->withdraw;
        $model->withdraw_button = $path4 ?? $model->withdraw_button;
        $model->invitation = $path5 ?? $model->invitation;
        $model->team = $path6 ?? $model->team;
        $model->apps = $path7 ?? $model->apps;
        $model->lucky_draw = $path8 ?? $model->lucky_draw;
        $model->robot = $path9 ?? $model->robot;
        $model->about = $path10 ?? $model->about;
        $model->profile_bank = $path11 ?? $model->profile_bank;
        $model->profile_invite = $path12 ?? $model->profile_invite;
        $model->profile_mining = $path13 ?? $model->profile_mining;
        $model->profile_team = $path14 ?? $model->profile_team;
        $model->profile_faq = $path15 ?? $model->profile_faq;
        $model->profile_income = $path16 ?? $model->profile_income;
        $model->profile_touch = $path17 ?? $model->profile_touch;
        $model->profile_reword = $path25 ?? $model->profile_reword;
        $model->profile_password = $path18 ?? $model->profile_password;
        $model->profile_logout = $path19 ?? $model->profile_logout;
        $model->team_banner = $path20 ?? $model->team_banner;
        $model->team_details_banner = $path21 ?? $model->team_details_banner;
        $model->team_label1 = $path22 ?? $model->team_label1;
        $model->team_label2 = $path23 ?? $model->team_label2;
        $model->team_label3 = $path24 ?? $model->team_label3;
        $model->update();
        return redirect()->route($this->route.'.index')->with('success', 'Icon Updated Successfully.');
    }
}
