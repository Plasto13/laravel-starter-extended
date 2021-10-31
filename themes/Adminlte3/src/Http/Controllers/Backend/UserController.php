<?php

namespace App\Http\Controllers\Backend;

use App\Authorizable;
use App\Events\Backend\UserCreated;
use App\Events\Backend\UserProfileUpdated;
use App\Events\Backend\UserUpdated;
use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\Userprofile;
use App\Models\UserProvider;
use Carbon\Carbon;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Log;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Users';

        // module name
        $this->module_name = 'users';

        // directory path of the module
        $this->module_path = 'users';

        // module icon
        $this->module_icon = 'c-icon cil-people';

        // module model name, path
        $this->module_model = "App\Models\User";
    }
    /**
     * Block Any Specific User.
     *
     * @param int $id User Id
     *
     * @return Back To Previous Page
     */
    public function block($id)
    {
        $module_name = $this->module_name;
        $module_title = $this->module_title;
        $module_name_singular = Str::singular($this->module_name);
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;

        $module_action = 'Block';

        if (auth()->user()->id == $id || $id == 1) {
            Flash::warning("<i class='fas fa-exclamation-triangle'></i> You can not 'Block' this user!")->important();

            Log::notice(label_case($module_title.' '.$module_action).' Failed | User:'.auth()->user()->name.'(ID:'.auth()->user()->id.')');
        }

        $$module_name_singular = User::withTrashed()->find($id);
        // $$module_name_singular = $this->findOrThrowException($id);

        try {
            $$module_name_singular->status = 2;
            $$module_name_singular->save();

            event(new UserUpdated($$module_name_singular));

            flash('<i class="fas fa-check"></i> '.$$module_name_singular->name.' User Successfully Blocked!')->success();

            return redirect()->back();
        } catch (\Exception $e) {
            throw new GeneralException('There was a problem updating this user. Please try again.');
        }
    }

    /**
     * Unblock Any Specific User.
     *
     * @param int $id User Id
     *
     * @return Back To Previous Page
     */
    public function unblock($id)
    {
        $module_name = $this->module_name;
        $module_title = $this->module_title;
        $module_name_singular = Str::singular($this->module_name);
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;

        $module_action = 'Unblock';

        if (auth()->user()->id == $id || $id == 1) {
            Flash::warning("<i class='fas fa-exclamation-triangle'></i> You can not 'Unblock' this user!")->important();

            Log::notice(label_case($module_title.' '.$module_action).' Failed | User:'.auth()->user()->name.'(ID:'.auth()->user()->id.')');
        }

        $$module_name_singular = User::withTrashed()->find($id);

        try {
            $$module_name_singular->status = 1;
            $$module_name_singular->save();

            event(new UserUpdated($$module_name_singular));

            flash('<i class="fas fa-check"></i> '.$$module_name_singular->name.' User Successfully Unblocked!')->success();

            Log::notice(label_case($module_title.' '.$module_action).' Success | User:'.auth()->user()->name.'(ID:'.auth()->user()->id.')');

            return redirect()->back();
        } catch (\Exception $e) {
            flash('<i class="fas fa-check"></i> There was a problem updating this user. Please try again.!')->error();

            Log::error(label_case($module_title.' '.$module_action).' | User:'.auth()->user()->name.'(ID:'.auth()->user()->id.')');
            Log::error($e);
        }
    }

    /**
     * Remove the Social Account attached with a User.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function userProviderDestroy(Request $request)
    {
        $user_provider_id = $request->user_provider_id;
        $user_id = $request->user_id;

        if (!$user_provider_id > 0 || !$user_id > 0) {
            flash('Invalid Request. Please try again.')->error();

            return redirect()->back();
        } else {
            $user_provider = UserProvider::findOrFail($user_provider_id);

            if ($user_id == $user_provider->user->id) {
                $user_provider->delete();

                flash('<i class="fas fa-exclamation-triangle"></i> Unlinked from User, "'.$user_provider->user->name.'"!')->success();

                return redirect()->back();
            } else {
                flash('<i class="fas fa-exclamation-triangle"></i> Request rejected. Please contact the Administrator!')->warning();
            }
        }

        event(new UserUpdated($$module_name_singular));

        throw new GeneralException('There was a problem updating this user. Please try again.');
    }

    /**
     * Resend Email Confirmation Code to User.
     *
     * @param [type] $hashid [description]
     *
     * @return [type] [description]
     */
    public function emailConfirmationResend($id)
    {
        if ($id != auth()->user()->id) {
            if (auth()->user()->hasAnyRole(['administrator', 'super admin'])) {
                Log::info(auth()->user()->name.' ('.auth()->user()->id.') - User Requested for Email Verification.');
            } else {
                Log::warning(auth()->user()->name.' ('.auth()->user()->id.') - User trying to confirm another users email.');

                abort('404');
            }
        }

        $user = User::where('id', '=', $id)->first();

        if ($user) {
            if ($user->email_verified_at == null) {
                Log::info($user->name.' ('.$user->id.') - User Requested for Email Verification.');

                // Send Email To Registered User
                $user->sendEmailVerificationNotification();

                flash('<i class="fas fa-check"></i> Email Sent! Please Check Your Inbox.')->success()->important();

                return redirect()->back();
            } else {
                Log::info($user->name.' ('.$user->id.') - User Requested but Email already verified at.'.$user->email_verified_at);

                flash($user->name.', You already confirmed your email address at '.$user->email_verified_at->isoFormat('LL'))->success()->important();

                return redirect()->back();
            }
        }
    }
}
