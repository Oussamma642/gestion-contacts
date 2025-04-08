<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShareController extends Controller
{

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
            if ($deleted) {
                return response()->json(['success' => true, 'message' => 'Contact rejected successfully']);
            } else {
                return response()->json(['success' => false, 'message' => 'Failed to reject contact'], 400);
            }
        }

    }

    /*
    public function accept(Request $request)
    {
        $deleted = \DB::table('share_contacts')->where('id', $request->input('sharedId'))->delete();

        \DB::table('contacts')->insert([
            'user_id' => auth()->id(),
            'name' => $request->input('sharedName'),
            'email' => $request->input('sharedEmail'),
            'phone' => $request->input('sharedPhone'),
            'category' => $request->input('ShareCategory'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('dashboard');
    }
    */

    public function accept(Request $request)
    {
        $data = $request->all();

        \DB::table('share_contacts')->where('id', $data['sharedId'])->delete();

        \DB::table('contacts')->insert([
            'user_id'    => auth()->id(),
            'name'       => $data['sharedName'],
            'email'      => $data['sharedEmail'],
            'phone'      => $data['sharedPhone'],
            'category'   => $data['ShareCategory'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['message' => 'Contact accepted successfully']);
    }

}