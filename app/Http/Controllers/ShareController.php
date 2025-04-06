<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShareController extends Controller
{
    public function share(Request $request)
    {
        $senderId   = auth()->id();                   // Current authenticated user
        $receiverId = $request->input('receiver_id'); // User receiving the contact
        $contactIds = $request->input('contact_ids'); // Array of contact IDs being shared

        foreach ($contactIds as $contactId) {
            \DB::table('share_contacts')->updateOrInsert(
                [
                    'sender_id'   => $senderId,
                    'receiver_id' => $receiverId,
                    'contact_id'  => $contactId,
                ],
                ['status' => 'pending', 'created_at' => now(), 'updated_at' => now()]
            );
        }
        return redirect()->back()->with('success', 'Contacts shared successfully!');
    }
    public function updateStatus(Request $request)
    {
        $shareId   = $request->input('share_id'); // Share record ID
        $newStatus = $request->input('status');   // New status (accepted, rejected)

        \DB::table('share_contacts')->where('id', $shareId)->update(['status' => $newStatus]);

        return redirect()->back()->with('success', 'Status updated successfully!');
    }
}