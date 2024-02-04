<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Admin\User\CustomerRequest;
use Illuminate\Support\Facades\Hash;


class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:users-show');

    }

    public function index()
    {
        $users = User::where('user_type', 0)->orderBy('id','DESC')->get();
        return view('admin.user.customer.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.customer.create');

    }

    public function store(CustomerRequest $request, User $user, ImageService $imageService)
    {
        $inputs = $request->all();

        if ($request->hasFile('profile_photo_path')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'users');
            $result = $imageService->save($request->file('profile_photo_path'));

            if ($result === false) {
                return redirect()->route('admin.user.admin-user.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');

            }

            $inputs['profile_photo_path'] = $result;
        }

        $inputs['password'] = Hash::make($request->password);
        $inputs['user_type'] = 0;
        $user = User::create($inputs);

        $details = [
            'message' => 'کاربر مشتری جدید در سایت ثبت شد',
        ];
        $adminUser = User::find(1);
        // $adminUser->notify(new NewUserRegistered($details));

        return redirect()->route('admin.user.customer.index')->with('swal-success', 'کاربر مشتری با موفقیت ثبت شد');
    }

    public function edit(User $user)
    {
        return view('admin.user.customer.edit', compact('user'));
    }


    public function update(CustomerRequest $request, User $user, ImageService $imageService)
    {
        $inputs = $request->all();

        if ($request->hasFile('profile_photo_path')) {
            if (!empty($user->profile_photo_path)) {
                $imageService->deleteImage($user->profile_photo_path);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'users');
            $result = $imageService->save($request->file('profile_photo_path'));
            if ($result === false) {
                return redirect()->route('admin.user.customer.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['profile_photo_path'] = $result;
        }


        $user->update($inputs);
        return redirect()->route('admin.user.customer.index')->with('swal-success', 'کاربر با موفقیت ویرایش شد');
    }


    public function destroy(User $user, ImageService $imageService)
    {
        if (!empty($user->profile_photo_path)) {
            $imageService->deleteImage($user->profile_photo_path);
        }

        $user->forceDelete();
        return redirect()->route('admin.user.customer.index')->with('swal-success', 'ایتم مورد نظر با موفقیت حذف شد ');
    }

    // public function status(User $user)
    // {
    //     $user->status = $user->status == 0 ? 1 : 0;
    //     $result = $user->save();
    //     if ($result) {

    //         if ($user->status == 0) {
    //             return response()->json(['status' => true, 'checked' => false]);
    //         } else {
    //             return response()->json(['status' => true, 'checked' => true]);
    //         }
    //     } else {
    //         return response()->json(['status' => false]);
    //     }
    // }

    public function activation(User $user)
    {
        $user->activation = $user->activation == 0 ? 1 : 0;
        if($user->activation==1){
            $user->activation_date=now();
         }else{
            $user->activation_date=null;
         }
        $result = $user->save();
        if ($result) {

            if ($user->activation == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}
