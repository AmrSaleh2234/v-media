<?php
namespace App\Traits;
use Hash;
use Illuminate\Http\Request as RequestForm;
use Request;
trait ProfileTrait {

    public function editProfile()
    {
        $type = Request::segment(1) ?? "";
        $admin_type = getRouteName($type);
        $class = $this->class;
        $user = $this->user;
        $new = 1;
        return view($admin_type.'.users.profile', compact('admin_type','user','new','class'));
    }

    public function updateProfile(RequestForm $request)
    {
        $type = Request::segment(1) ?? "";
        $admin_type = getRouteName($type);
        $user = $this->user;
        $id = $user->id;
        $this->validate($request, [
                'name' => 'required|min:3|max:255',
                'user_name' => 'nullable',
                'email' => 'nullable|email|unique:users,email,' . $id,
                // 'phone' => 'required|max:50|unique:users,phone,' . $id,
                'password' => 'nullable|min:8|same:confirm-password',
            ]);

            $input = $request->all();
            foreach ($input as $key => $value) {
                    $input[$key] = stripslashes(trim(filter_var($value, FILTER_SANITIZE_STRING)));
                if($input[$key] == ""){
                    $input[$key] = NULL;
                }
            }
            if($request->file('image')){
                $input['image']  = $this->uploadImage($request->file('image'), "profiles");
            }else{
                $input = array_except($input, array('image'));
            }
            $input = array_except($input, array('phone','branch_id','group_id','is_delegate','is_client','admin_project_id','unit_id','project_id','type','active'));
            if (!empty($input['password'])) {
                $input['password'] = Hash::make($input['password']);
            } else {
                $input = array_except($input, array('password'));
            }
            // $input['image'] = NULL;
            $user->update($input);
            if ($id == $this->user->id) {
                app()->setLocale($input['locale']);
            }
            return redirect()->route($admin_type.'.users.edit.profile')->with('success', __('Profile updated successfully'));

    }
}




