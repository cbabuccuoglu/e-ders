<?php

namespace App\Http\Controllers;

use App\Utilities\FlashNotification;
use Illuminate\Http\Request;

use Setting;
use App\User;
use Auth;
use DB;
use Config;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
            return view('users.index', compact(['users','countusers']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

          $create = User::create($request->all());

            if ($create) {

                //FlashNotification::message('İşleminiz başarıyla gerçekleşti')->success();
                return redirect()->route('users.index');
            } else {
                //FlashNotification::message('Hatalı İşlem!')->error();
                return redirect()->back();
            }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
            $users = User::find($id);
            return view('users.show', compact('users'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

            $users = User::find($id);
            $roles = Role::all()->pluck('name', 'id');
            $staff= Staff::all()->pluck('name','id');

            $user_id=$users->id;
            return view('users.edit', compact(['users', 'roles','last_activity','staff']));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

            $update = User::find($id)->update($request->all());
            if ($update) {
           //     FlashNotification::message('İşleminiz başarıyla gerçekleşti')->success();
                return redirect()->route('users.index');
            } else {
            //    FlashNotification::message('Hatalı İşlem!')->error();
                return redirect()->back();
            }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            $username=User::find($id)->name;
            $delete = User::find($id)->delete();

            if ($delete) {
               // FlashNotification::message('İşleminiz başarıyla gerçekleşti')->success();
                return redirect()->route('users.index');
            } else {
                // FlashNotification::message('İşleminiz başarıyla gerçekleşti')->success();
                return redirect()->back();
            }

    }

    public function loginSubmit(Request $request)
    {

        // Validate the form data
        $this->validate($request, [
            'email'   => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email',$request->email)->orWhere('username',$request->email)->orWhere('tcno',$request->email)->first();

        if ($user!=NULL) {
            $field = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'username' : 'tcno';

            if (\Auth::attempt([
                $field => $request->email,
                'password' => $request->password],
                $request->remember)
            );

           /* activity('kullanıcı')
                ->log($user->name." "."Kullanıcısı Sisteme Giriş Yaptı.");

          /*  $user->update([
                'last_login_at' => Carbon::now()->toDateTimeString(),
                'last_login_ip' => $request->getClientIp()
            ]);*/

            return redirect()->intended(route('/'));
        }


        return redirect()->back();




    }


    public function usertoLdap($user) {
        $ldap_string= $user->ldap_distinguishedname;
        $base_dn= config('adldap.connections.default.connection_settings.base_dn');

        preg_match_all('@CN=(.*?),(.*?),'.$base_dn.'@si', $ldap_string, $ldap_explode);

$suffix = ','.$ldap_explode[2][0].','.$base_dn;
config(['adldap.connections.default.connection_settings.account_suffix' => $suffix]);



        return ['suffix' => $suffix, 'username' => $ldap_explode[1][0]];

    }


    public function getLdapUsers(){
        Artisan::call('user:getldap');

        return 1;

    }
}
