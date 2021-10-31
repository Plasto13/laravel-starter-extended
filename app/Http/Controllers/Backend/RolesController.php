<?php

namespace App\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Log;

class RolesController extends Controller
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Roles';

        // module name
        $this->module_name = 'roles';

        // directory path of the module
        $this->module_path = 'roles';

        // module icon
        $this->module_icon = 'c-icon cil-people';

        // module model name, path
        $this->module_model = "App\Models\Role";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $$module_name = $module_model::with('permissions')->paginate();

        Log::info(label_case($module_title.' '.$module_action).' | User:'.auth()->user()->name.'(ID:'.auth()->user()->id.')');

        return view(
            "backend.$module_path.index",
            compact('module_title', 'module_name', "$module_name", 'module_icon', 'module_name_singular', 'module_action')
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Create';

        $roles = Role::get();
        $permissions = Permission::select('name', 'id', 'module_name', 'display_name', 'description')->get();

        Log::info(label_case($module_title.' '.$module_action).' | User:'.auth()->user()->name.'(ID:'.auth()->user()->id.')');

        return view("backend.$module_name.create", compact('module_title', 'module_name', 'module_icon', 'module_action', 'roles', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Store';

        $$module_name_singular = Role::create($request->except('permissions'));

        $permissions = $request['permissions'];

        // Sync Permissions
        if (isset($permissions)) {
            $$module_name_singular->syncPermissions($permissions);
        } else {
            $permissions = [];
            $$module_name_singular->syncPermissions($permissions);
        }

        Log::info(label_case($module_title.' '.$module_action).' | User:'.auth()->user()->name.'(ID:'.auth()->user()->id.')');

        return redirect("admin/$module_name")->with('flash_success', "$module_name added!");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Show';

        $$module_name_singular = $module_model::findOrFail($id);

        Log::info(label_case($module_title.' '.$module_action).' | User:'.auth()->user()->name.'(ID:'.auth()->user()->id.')');

        return view(
            "backend.$module_name.show",
            compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_action', 'module_name_singular', "$module_name_singular")
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Edit';

        $permissions = Permission::select('name', 'id', 'module_name', 'display_name', 'description')->get();

        $$module_name_singular = $module_model::findOrFail($id);

        Log::info(label_case($module_title.' '.$module_action).' | User:'.auth()->user()->name.'(ID:'.auth()->user()->id.')');

        return view("backend.$module_name.edit", compact('module_title', 'module_name', "$module_name_singular", 'module_name_singular', 'module_icon', 'module_action', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Update';

        $$module_name_singular = $module_model::findOrFail($id);

        $this->validate($request, [
            'name'        => 'required|max:20|unique:roles,name,'.$id,
            'permissions' => 'required',
        ]);

        $input = $request->except(['permissions']);
        $permissions = $request['permissions'];
        $$module_name_singular->fill($input)->save();

        $p_all = Permission::all(); //Get all permissions

        foreach ($p_all as $p) {
            $$module_name_singular->revokePermissionTo($p); //Remove all permissions associated with role
        }

        foreach ($permissions as $permission) {
            $p = Permission::where('name', '=', $permission)->firstOrFail(); //Get corresponding form //permission in db
            $$module_name_singular->givePermissionTo($p);  //Assign permission to role
        }

        Log::info(label_case($module_title.' '.$module_action).' | User:'.auth()->user()->name.'(ID:'.auth()->user()->id.')');

        return redirect("admin/$module_name");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Destroy';

        $$module_name_singular = Role::findOrFail($id);

        $user_roles = auth()->user()->roles()->pluck('id');
        $role_users = $$module_name_singular->users;

        if ($id == 1) {
            Alert::add("<i class='fas fa-exclamation-triangle'></i> You can not delete 'Administrator'!")flash();

            Log::notice(label_case($module_title.' '.$module_action).' Failed | User:'.auth()->user()->name.'(ID:'.auth()->user()->id.')');

            return redirect()->route("backend.$module_name.index");
        } elseif (in_array($id, $user_roles->toArray())) {
            Alert::add("<i class='fas fa-exclamation-triangle'></i> You can not delete your Role!")flash();

            Log::notice(label_case($module_title.' '.$module_action).' Failed | User:'.auth()->user()->name.'(ID:'.auth()->user()->id.')');

            return redirect()->route("backend.$module_name.index");
        } elseif ($role_users->count()) {
            Alert::add("<i class='fas fa-exclamation-triangle'></i> Can not be deleted! ".$role_users->count().' user found!')flash();

            Log::notice(label_case($module_title.' '.$module_action).' Failed | User:'.auth()->user()->name.'(ID:'.auth()->user()->id.')');

            return redirect()->route("backend.$module_name.index");
        }

        try {
            if ($$module_name_singular->delete()) {
                Alert::add('Role successfully deleted!')->flash();

                Log::info(label_case($module_title.' '.$module_action).' | User:'.auth()->user()->name.'(ID:'.auth()->user()->id.')');

                return redirect()->back();
            }
        } catch (\Exception $e) {
            Log::error($e);

            Log::error('Can not delete role with id '.$id);
        }
    }
}
