<?php

namespace App\Http\Controllers\Front\Profile;

use Illuminate\Http\Request;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\TicketFile;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Services\File\FileService;
use App\Http\Requests\Front\Profile\StoreTicketRequest;
use App\Http\Requests\Front\Profile\StoreTicketAnswerRequest;

class TicketController extends Controller
{
    public function index()
	{
		$user=auth()->user();
		$tickets=$user->tickets()->orderBy('id','DESC')->whereNull('ticket_id')->get();
		return view('front.profile.tickets.tickets',compact('tickets'));
	}
	
    public function show(Ticket $ticket)
    {
        return view('front.profile.tickets.show',compact('ticket'));
    }
	
	// public function change(Ticket $ticket)
	// {
	// 	$ticket->status=$ticket->status == 0 ? 1 : 0;
	// 	$ticket->save();
	// 	return redirect()->back()->with('alert-section-success', 'تغییر شما با موفقیت انجام شد');
	// }
	
	public function answer(StoreTicketAnswerRequest $request, Ticket  $ticket,FileService $fileService)
	{
	  DB::transaction(function () use ($request, $fileService,$ticket) {

         // ticketAnswer body
		if($ticket->parent == null){
		$user=auth()->user();
		$inputs=$request->all();
		$inputs['subject']=$ticket->subject;
		$inputs['seen']=1;
		//$inputs['reference_id']=$user->ticketAdmin->id;
		// $inputs['category_id']=$ticket->category_id;
		$inputs['user_id']=$ticket->user_id;
		// $inputs['priority_id']=$ticket->priority_id;
		$inputs['ticket_id']=$ticket->id;
		$inputs['description']=$request->description;

		$ticket=Ticket::create($inputs);
		}
		
		 // ticket file
         if($request->hasFile('file')){
            $fileService->setExclusiveDirectory('files' . DIRECTORY_SEPARATOR . 'ticket-files');
            $fileService->setFileSize($request->file('file'));
            $fileSize = $fileService->getFileSize();
			$result = $fileService->moveToPublic($request->file('file'));          
            //$result = $fileService->moveToStorage($request->file('file'));
            $fileFormat = $fileService->getFileFormat();
            $inputs['ticket_id'] = $ticket->id;
            $inputs['file_path'] = $result;
            $inputs['file_size'] = $fileSize;
            $inputs['file_type'] = $fileFormat;
            $inputs['user_id'] = $user->id;
            $file = TicketFile::create($inputs);
		 }
		
	  });
	  
	  	    return back()->with('alert-section-success', 'پاسخ شما با موفقیت ثبت شد');

	}
	
	public function create()
	{
		// $ticketCategories=TicketCategory::all();
		// $ticketPriorities=TicketPriority::all();
		return view('front.profile.tickets.create');
	}	
	
	public function store(StoreTicketRequest $request,FileService $fileService)
	{
		$user=auth()->user();
        DB::transaction(function () use ($request, $fileService, $user) {

		 // ticket body
		 $inputs=$request->all();
		 $inputs['user_id']=$user->id;
		 $ticket=Ticket::create($inputs);
		
		 // ticket file
         if($request->hasFile('file')){
            $fileService->setExclusiveDirectory('files' . DIRECTORY_SEPARATOR . 'ticket-files');
            $fileService->setFileSize($request->file('file'));
            $fileSize = $fileService->getFileSize();
			$result = $fileService->moveToPublic($request->file('file'));          
            //$result = $fileService->moveToStorage($request->file('file'));
            $fileFormat = $fileService->getFileFormat();
            $inputs['ticket_id'] = $ticket->id;
            $inputs['file_path'] = $result;
            $inputs['file_size'] = $fileSize;
            $inputs['file_type'] = $fileFormat;
            $inputs['user_id'] = $user->id;
            $file = TicketFile::create($inputs);
		 }
		
		});
		
	     return redirect()->route('front.profile.my-tickets')->with('alert-section-success', 'تیکت شما با موفقیت ثبت شد');
		
	}
	
}
