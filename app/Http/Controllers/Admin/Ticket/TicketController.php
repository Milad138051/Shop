<?php

namespace App\Http\Controllers\Admin\Ticket;

use Illuminate\Http\Request;
use App\Models\Ticket\Ticket;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\TicketRequest;

class TicketController extends Controller
{
	public function __construct()
	{
		$this->middleware('can:ticket-show')->only(['newTickets','openTickets','closeTickets','index','show']);
        $this->middleware('can:ticket-answer')->only(['answer']);
        $this->middleware('can:ticket-change')->only(['change']);
	}

	public function newTickets()
	{
		$tickets = Ticket::where('seen', 0)->paginate(10);

		foreach ($tickets as $ticket) {
			$ticket->seen = 1;
			$res = $ticket->save();
		}
		return view('admin.ticket.index', compact('tickets'));
	}

	public function openTickets()
	{
		$tickets = Ticket::where('status', 0)->paginate(10);
		return view('admin.ticket.index', compact('tickets'));
	}

	public function closeTickets()
	{
		$tickets = Ticket::where('status', 1)->paginate(10);
		return view('admin.ticket.index', compact('tickets'));
	}

	public function index()
	{
		$tickets = Ticket::whereNull('ticket_id')->paginate(10);
		return view('admin.ticket.index', compact('tickets'));
	}


	public function show(Ticket $ticket)
	{
		//dd(auth()->user()->ticketAdmin);
		return view('admin.ticket.show', compact('ticket'));
	}

	public function change(Ticket $ticket)
	{
		$ticket->status = $ticket->status == 0 ? 1 : 0;
		$ticket->save();
		return redirect()->back()->with('alert-section-success', 'تغییر شما با موفقیت انجام شد');
	}


	public function answer(TicketRequest $request, Ticket $ticket)
	{
		if ($ticket->parent == null) {
			$user = auth()->user();
			$inputs = $request->all();
			$inputs['subject'] = $ticket->subject;
			$inputs['seen'] = 1;
			$inputs['reference_id'] = $user->id;
			// $inputs['category_id']=$ticket->category_id;
			// $inputs['user_id'] = $ticket->user_id;
			// $inputs['priority_id']=$ticket->priority_id;
			$inputs['ticket_id'] = $ticket->id;
			$inputs['description'] = $request->description;

			Ticket::create($inputs);
			return redirect()->back();
			//->with('swal-success', '  پاسخ شما با موفقیت ثبت شد');

		} else {

			return redirect()->back()->with('alert-section-error', 'خطایی رخ داد');
		}
	}

}
