<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Support\Facades\Gate;

use Cache;
use DB;

use App\Http\Requests\SettingRequest\SettingUpdate;
use App\Http\Requests\SettingRequest\SettingThemeColor;

class SettingController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * index page method
     *
     * @return void
     */
    public function index()
    {

        if (Gate::allows('settings') == false) {

            redirect('/')->send();

        }
        $settings = Setting::where('name','!=','theme_color')->get();
        return view('settings.index', ['settings' => $settings]);
    }

    /**
     *
     * update settings method
     *
     * @param SettingUpdate $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function update(SettingUpdate $request)
    {


        // if file update and upload else update

        if ($request->hasFile('logo')) // is file
        {
            $file = $request->file('logo');
            $fileName = MD5(date('YmdHis') . $file->getClientOriginalName()) . "." . $file->getClientOriginalExtension();
            $path = public_path('assets/images/settings/');

            if (!is_writable($path))
                return $this->returnWarning('setting.the_path_is_invalid');


            // delete old file not yet for now
            $file->move($path, 'logo-sidebar.png');

        }

        Setting::where('name', 'company_name')->update(['value' => $request->company_name]);
        Setting::where('name', 'company_number')->update(['value' => $request->company_number]);

        // reload cache
        Cache::flush();
        Cache::rememberForever('settings', function () {
            return Setting::select('name', 'value')->get();
        });


        return $this->returnSuccess('setting.update_settings_with_success',cache('settings'));
    }


    /**
     * @param SettingThemeColor $request
     * @return array|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */

    public function updateThemeColor(SettingThemeColor $request)
    {

        Setting::where('name', 'theme_color')->update(['value' => $request->theme_color]);

        // reload cache
        Cache::flush();
        Cache::rememberForever('settings', function () {
            return DB::table('settings')->select('name', 'value')->get();
        });


        return $this->returnSuccess('setting.update_theme_with_success');
    }
}
