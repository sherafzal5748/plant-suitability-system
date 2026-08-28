<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Store a new message (from the Contact Us form — public).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:100',
            'email'     => 'required|email|max:150',
            'message'   => 'required|string|max:2000',
        ]);

        Message::create($validated);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Your message has been sent!']);
        }

        return back()->with('contact_success', 'Your message has been sent successfully!');
    }
    

    /**
     * Admin: list all messages (paginated, with optional filter).
     */
    public function index(Request $request)
    {
        $filter = $request->input('filter', 'all'); // all | unread | read

        $query = Message::latest();
        if ($filter === 'unread') $query->where('is_read', false);
        if ($filter === 'read')   $query->where('is_read', true);

        $messages    = $query->paginate(15)->withQueryString();
        $unreadCount = Message::where('is_read', false)->count();


        if ($request->ajax()) {
            return response()->json([
                'unreadCount' => $unreadCount,
                'total'       => $messages->total(),
                'showing'     => $messages->count(),
                'from'        => $messages->firstItem() ?? 0,
                'to'          => $messages->lastItem()  ?? 0,
                'prevPage'    => $messages->currentPage() > 1 ? $messages->currentPage() - 1 : null,
                'nextPage'    => $messages->hasMorePages() ? $messages->currentPage() + 1 : null,
                'lastPage'    => $messages->lastPage(),
                'currentPage' => $messages->currentPage(),
                'rows'        => $messages->map(fn($m) => [
                    'id'        => $m->id,
                    'full_name' => $m->full_name,
                    'email'     => $m->email,
                    'message'   => $m->message,
                    'is_read'   => $m->is_read,
                    'created_at'=> $m->created_at->format('M j, Y · g:i A'),
                    'time_ago'  => $m->created_at->diffForHumans(),
                ]),
            ]);
        }

        return view('admin.message', compact('messages', 'unreadCount', 'filter'));
    }

    /**
     * Admin: mark a single message as read and return its content.
     */
    public function show(Request $request, Message $message)
    {
        $message->update(['is_read' => true]);

        return response()->json([
            'id'         => $message->id,
            'full_name'  => $message->full_name,
            'email'      => $message->email,
            'message'    => $message->message,
            'is_read'    => true,
            'created_at' => $message->created_at->format('M j, Y · g:i A'),
            'time_ago'   => $message->created_at->diffForHumans(),
            'unreadCount'=> Message::where('is_read', false)->count(),
        ]);
    }

    /**
     * Admin: delete a single message.
     */
    public function destroy(Request $request, Message $message)
    {
        $message->delete();

        if ($request->ajax()) {
            return response()->json([
                'success'     => true,
                'unreadCount' => Message::where('is_read', false)->count(),
            ]);
        }

        return back()->with('success', 'Message deleted.');
    }

    /**
     * Admin: bulk delete all read OR all unread messages.
     */
    public function destroyFiltered(Request $request)
    {
        $type = $request->input('type'); // 'read' or 'unread'

        $deleted = match($type) {
            'read'   => Message::where('is_read', true)->delete(),
            'unread' => Message::where('is_read', false)->delete(),
            default  => 0,
        };

        return response()->json([
            'success'     => true,
            'deleted'     => $deleted,
            'unreadCount' => Message::unread()->count(),
        ]);
    }

    /**
     * Public API: get unread count for the notification badge.
     */
    public function unreadCount()
    {
        return response()->json(['count' => Message::where('is_read', false)->count()]);

    }
}