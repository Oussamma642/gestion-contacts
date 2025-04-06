<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShareController extends Controller
{

    /*
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
    */

/*

    public function share(Request $request)
{
    $senderId = auth()->id(); // Authenticated user (sender)
    $receiverId = $request->input('receiver_id'); // Receiving user
    $contactIds = $request->input('contact_ids'); // Array of contact IDs being shared

    foreach ($contactIds as $contactId) {
        // Check if the shared contact already exists
        $exists = \DB::table('share_contacts')->where([
            ['sender_id', '=', $senderId],
            ['receiver_id', '=', $receiverId],
            ['contact_id', '=', $contactId],
        ])->exists();

        if (!$exists) {
            // If it doesn't exist, insert into the database
            \DB::table('share_contacts')->insert([
                'sender_id' => $senderId,
                'receiver_id' => $receiverId,
                'contact_id' => $contactId,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    return redirect()->back()->with('success', 'Contacts shared successfully!');
}
*/

    private function checkIfContactExistsInRecieverUser($contact, $receiverId, $senderId): bool
    {
        // Return true if the contact already belongs to the receiver
        if ($contact->user_id == $receiverId) {
            return true;
        }

        // Check if the shared contact already exists
        return \DB::table('share_contacts')->where([
            ['sender_id', '=', $senderId],
            ['receiver_id', '=', $receiverId],
            ['contact_id', '=', $contact->id],
        ])->exists();
    }

    public function share(Request $request)
    {
        $insertData = [];
        $errors     = [];
        $senderId   = auth()->id();
        $receiverId = $request->input('receiver_id');
        $contactIds = $request->input('contact_ids');
        $contacts   = \DB::table('contacts')->whereIn('id', $contactIds)->get();

        foreach ($contacts as $contact) {
            if (! $this->checkIfContactExistsInRecieverUser($contact, $receiverId, $senderId)) {
                $insertData[] = [
                    'sender_id'   => $senderId,
                    'receiver_id' => $receiverId,
                    'contact_id'  => $contact->id,
                    'status'      => 'pending',
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ];
            } else {
                $errors[] = "Contact ID {$contact->name} already belongs to the receiver.";
            }
        }

        if (! empty($insertData)) {
            \DB::table('share_contacts')->insert($insertData);
        }

        if (! empty($errors)) {
            return redirect()->back()->with('error', implode(', ', $errors));
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

    public function getPendingSharedContacts()
    {
        $sharedContacts = \DB::table('share_contacts')
            ->join('contacts', 'share_contacts.contact_id', '=', 'contacts.id')
            ->join('users', 'share_contacts.sender_id', '=', 'users.id')
            ->where('share_contacts.receiver_id', auth()->id())
            ->where('share_contacts.status', 'pending')
            ->select('share_contacts.id as share_id', 'contacts.id', 'contacts.name', 'users.name as sender_name')
            ->get();

        return response()->json($sharedContacts);
    }

    public function reject(string $id)
    {
        $deleted = \DB::table('share_contacts')->where('id', $id)->delete();
        if ($deleted) {
            return response()->json(['success' => true, 'message' => 'Contact rejected successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to reject contact'], 400);
        }
    }
}