<?php
namespace Modules\Setting\Http\Controllers\Backend;

use Log;
use Illuminate\Support\Str;
use Illuminate\Session\Store;
use Illuminate\Routing\Controller;
use Nwidart\Modules\Facades\Module;
use Illuminate\Support\Facades\Auth;
use Modules\Setting\Http\Requests\SettingRequest;
use Modules\Setting\Repositories\SettingRepository;

class SettingController extends Controller
{
    protected $setting;
    protected $session;
    protected $module_title;
    protected $module_path;
    protected $module_icon;
    protected $module_model;

    public function __construct(SettingRepository $setting, Store $session)
    {
        $this->module = app('modules');
        $this->setting = $setting;
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
     * @return Redirect
     */
    public function index()
    {
        $module_title = $this->module_title;

        $module_action = 'Show';

        // Log::info(label_case($module_title . ' ' . $module_action) . ' | User:' . Auth::user()->name . '(ID:' . Auth::user()->id . ')');
        return redirect()->route('backend.setting.module', ['Core']);
    }

    public function store(SettingRequest $request)
    {
        $this->setting->createOrUpdate(array_filter($request->all()));

        $module_title = $this->module_title;

        $module_action = 'Store';

        Log::info(label_case($module_title . ' ' . $module_action) . ' | User:' . Auth::user()->name . '(ID:' . Auth::user()->id . ')');

        return redirect()->route('backend.setting.index')
            ->withSuccess(trans('setting::messages.settings saved'));
    }

    public function getModuleSettings($currentModule)
    {
        $allEnabled = $this->module->allEnabled();
        $currentModule = Module::find($currentModule);
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Edit';
        $modulesWithSettings = $this->setting->moduleSettings($allEnabled);

        Log::info(label_case($module_title . ' ' . $module_action) . ' | User:' . Auth::user()->name . '(ID:' . Auth::user()->id . ')');
        $this->session->put('module', $currentModule->getLowerName());

        $modulesWithSettings = $this->setting->moduleSettings($allEnabled);

        $translatableSettings = $this->setting->translatableModuleSettings($currentModule->getLowerName());
        $plainSettings = $this->setting->plainModuleSettings($currentModule->getLowerName());

        $dbSettings = $this->setting->savedModuleSettings($currentModule->getLowerName());
        return view(
            'setting::admin.index',
            compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_action', 'module_name_singular', 'modulesWithSettings', 'dbSettings', 'plainSettings', 'translatableSettings', 'currentModule')
        );
    }
}
