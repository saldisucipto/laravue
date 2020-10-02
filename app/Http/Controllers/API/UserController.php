<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Image;
use Intervention\Image\ImageManager;
use App\User;
use Validator;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get data 
        // $data = User::get()->paginate(10);
        // ACL Protected Controller
        $this->authorize('isAdmin');
        return User::orderBy('id', 'ASC')->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // test
        // return ['message' => 'I Have Your Data'];
        // create user 
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:user,email,'.$user->id,
            'password' => 'required|min:6'
        ]);
        

        $data = $request->all();

        $save = new User;
        $save->name = $data['name'];
        $save->email = $data['email'];
        $save->type = $data['type'];
        $save->bio = $data['bio'];
        $save->photo = $data['photo'];
        $save->password = Hash::make($data['password']);
        $save->save();
        return \response()->json([
            'message' => 'Berhasil Membuat User Baru'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $user = User::findOrFail($id);
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            //'email' => ['required', 'string', 'email', 'max:255', 'unique:users'].,
            'password' => ['somtimes', 'string', 'min:8'],
        ]);
        $user->update($request->all());

        //update user
        return ['message' => 'update the user info'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // user delete 
        $user = User::findOrFail($id);
        // delete user 
        $user->delete();
        return ['message' => 'User Deleted'];
    }

    // profile controller 
    public function profile(){
        return \auth('api')->user();
    }

    public function updateProfile(Request $request){
        $users = auth('api')->user();

        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,'.$users->id,
            'bio' => 'required|string',
            'password' => 'sometimes|min:6'
        ]);

        $curentPhoto = $users->photo;
        if($request->photo != $curentPhoto ){
            $name = time().'.'.explode('/', \explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
            Image::make($request->photo)->save(public_path('img/profile/'). $name);
            //return ['message' => 'Success'];
            $request->merge(['photo' => $name]);

            $userPhoto = public_path('img/profile/').$curentPhoto;
            if(\file_exists($userPhoto)){
                @\unlink($userPhoto);
            }
        }
        if($request->password){
            $passowrdmake = Hash::make($request['password']);
            $users->update(['password' => $passowrdmake]);
            return ['message' => 'Success Password Dirubah'];
        }

      $users->update($request->all());
      return ['message' => 'Success'];

    }
}
