<?php
namespace Modules\Setting\Http\Controllers\Backend;

use Log;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Support\Renderable;
use Modules\Setting\Repositories\SettingRepository;

class SettingController extends Controller
{
    public function __construct(SettingRepository $setting, Store $session)
    {
        $this->setting = $setting;
        $this->module = app('modules');
        $this->session = $session;

        // Page Title
        $this->module_title = 'Settings';

        // module name
        $this->module_name = 'setting';

        // directory path of the module
        $this->module_path = 'settings';

        // module icon
        $this->module_icon = 'fas fa-cogs';

        // module model name, path
        $this->module_model = "Modules\Setting\Entities\Setting";
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Edit';
        $modulesWithSettings = $this->setting->moduleSettings($this->module->allEnabled());

        Log::info(label_case($module_title . ' ' . $module_action) . ' | User:' . Auth::user()->name . '(ID:' . Auth::user()->id . ')');
        return view(
            'setting::admin.index',
            compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_action', 'module_name_singular', 'modulesWithSettings')
        );
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('setting::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('setting::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('setting::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
