<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Ticket\TicketAdmin;
use App\Http\Controllers\Controller;

class TicketAdminController extends Controller
{

    public function __construct()
	{
		$this->middleware('can:ticket-admin-show')->only(['index']);
        $this->middleware('can:ticket-admin-set')->only(['set']);
	}


    // public function index()
    // {
    //     $admins = User::where('user_type', 1)->paginate(10);
    //     return view('admin.ticket.admin.index', compact('admins'));
    // }


    // public function set(User $admin)
    // {
    //     TicketAdmin::where('user_id', $admin->id)->first() ? TicketAdmin::where(['user_id' => $admin->id])->forceDelete() : TicketAdmin::create(['user_id' => $admin->id]);

    //     $admin->roles()->sync($request->roles);


    //     return redirect()->route('admin.ticket.admin.index')->with('swal-success', 'تغییر شما با موفقیت انجام شد');
    // }


    // public function search(Request $request)
    // {
	// 	if($request->search){
    //         $admins=User::where('user_type',1)->where(function ($query) use ($request) {
    //             $query->where('name','LIKE',"%".$request->search."%")->orWhere('first_name','LIKE',"%".$request->search."%")->orWhere('last_name','LIKE',"%".$request->search."%")->orWhere('mobile','LIKE',"%".$request->search."%")->orWhere('email','LIKE',"%".$request->search."%");
    //         })->paginate(10);
	// 	}else{
    //         $admins=User::where('user_type',1)->orderBy('id','DESC')->paginate(10);
	// 	}    
        
    //     return view('admin.ticket.admin.index', compact('admins'));

    // }


}
