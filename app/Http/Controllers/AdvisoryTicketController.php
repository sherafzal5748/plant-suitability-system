<?php

namespace App\Http\Controllers;

use App\Models\AdvisoryTicket;
use App\Models\AdvisoryTicketReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvisoryTicketController extends Controller
{
    /**
     * The user-facing Support page: shows the ticket form plus the
     * user's own ticket history and any botanist replies.
     */
    public function index()
    {
        $tickets = AdvisoryTicket::where('user_id', Auth::id())
            ->with('replies')
            ->latest()
            ->get();

        // The user is looking at this page right now, so mark any
        // unseen replies on their tickets as read.
        AdvisoryTicketReply::whereIn('advisory_ticket_id', $tickets->pluck('id'))
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('frontend.support', compact('tickets'));
    }

    /**
     * Handle submission of the "Submit Advisory Ticket" form.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'topic'   => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        AdvisoryTicket::create([
            'user_id' => Auth::id(),
            'topic'   => $validated['topic'],
            'message' => $validated['message'],
            'status'  => 'open',
        ]);

        return back()->with('success', 'Your advisory ticket has been submitted. A botanist will respond soon.');
    }

    /**
     * Admin: list every advisory ticket, optionally filtered by status.
     */
    public function adminIndex(Request $request)
    {
        $tickets = AdvisoryTicket::with(['user', 'replies'])
            ->when($request->query('status'), fn ($q, $status) => $q->where('status', $status))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.tickets.index', compact('tickets'));
    }

    /**
     * Admin: view one ticket in full, with its reply thread.
     */
    public function adminShow(AdvisoryTicket $ticket)
    {
        $ticket->load(['user', 'replies.admin']);

        return view('admin.tickets.show', compact('ticket'));
    }

    /**
     * Admin: post a reply to a ticket. This is what the user sees as
     * their "notification" — it flips is_read to false for them.
     */
    public function reply(Request $request, AdvisoryTicket $ticket)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        $ticket->replies()->create([
            'admin_id' => Auth::id(),
            'message'  => $validated['message'],
            'is_read'  => false,
        ]);

        $ticket->update(['status' => 'answered']);

        return back()->with('success', 'Reply sent to the user.');
    }

    /**
     * JSON endpoint polled by the header notification bell (regular
     * users only) to know whether they have unread botanist replies.
     */
    public function unreadCount()
    {
        $count = AdvisoryTicketReply::whereHas('ticket', function ($q) {
                $q->where('user_id', Auth::id());
            })
            ->where('is_read', false)
            ->count();

        return response()->json(['count' => $count]);
    }

        /**
     * Admin: permanently delete a ticket (and its replies, via cascade).
     */
    public function destroy(AdvisoryTicket $ticket)
    {
        $ticket->delete();

        return redirect()->route('admin.tickets')->with('success', 'Ticket deleted.');
    }
}
