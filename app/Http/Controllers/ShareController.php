<?php
namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ShareContact;
use Illuminate\Http\Request;

class ShareController extends Controller
{

    private function checkIfContactExistsInReceiverUser(Contact $contact, int $receiverId, int $senderId): bool
    {
        // Case 1: Contact already belongs to the receiver (same user_id)
        if ($contact->user_id == $receiverId) {
            return true;
        }

        // Case 2: A shared contact with same sender, receiver and contact already exists
        $alreadyShared = ShareContact::where([
            ['sender_id', '=', $senderId],
            ['receiver_id', '=', $receiverId],
            ['contact_id', '=', $contact->id],
        ])->exists();

        if ($alreadyShared) {
            return true;
        }

        // Case 3: A contact with the same phone already exists in the receiver's contacts
        $phoneExists = Contact::where('user_id', $receiverId)
            ->where('phone', $contact->phone)
            ->exists();

        if ($phoneExists) {
            return true;
        }

        // None of the conditions matched, so it's safe to share
        return false;
    }

    public function share(Request $request)
    {
        $senderId   = auth()->id();
        $receiverId = $request->input('receiver_id');
        $contactIds = $request->input('contact_ids');

        $errors     = [];
        $insertData = [];

        // Prevent sharing with self
        if ($receiverId == $senderId) {
            return redirect()->back()->with('error', 'You cannot share a contact with yourself.');
        }

        // Get contacts owned by the sender
        $contacts = Contact::whereIn('id', $contactIds)
            ->where('user_id', $senderId)
            ->get();

        foreach ($contacts as $contact) {
            if (! $this->checkIfContactExistsInReceiverUser($contact, $receiverId, $senderId)) {
                $insertData[] = [
                    'sender_id'   => $senderId,
                    'receiver_id' => $receiverId,
                    'contact_id'  => $contact->id,
                    'status'      => 'pending',
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ];
            } else {
                $errors[] = "The contact '{$contact->name}' is already shared or owned by the receiver.";
            }
        }

        if (! empty($insertData)) {
            ShareContact::insert($insertData);
        }

        if (! empty($errors)) {
            return redirect()->back()->with('error', implode(', ', $errors));
        }

        return redirect()->back()->with('success', 'Contacts shared successfully!');
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

    public function accept(Request $request)
    {
        $data = $request->all();

        $deleted = \DB::table('share_contacts')->where('id', $data['sharedId'])->delete();

        if (! $deleted) {
            return response()->json(['success' => false, 'message' => 'Failed to reject contact'], 400);
        }

        $inserted = \DB::table('contacts')->insert([
            'user_id'    => auth()->id(),
            'name'       => $data['sharedName'],
            'email'      => $data['sharedEmail'],
            'phone'      => $data['sharedPhone'],
            'category'   => $data['ShareCategory'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if (! $inserted) {return response()->json(['success' => false, 'message' => 'Failed to insert the  contact'], 400);}
        return response()->json(['message' => 'Contact accepted successfully']);
    }

}