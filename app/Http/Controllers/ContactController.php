<?php
namespace App\Http\Controllers;

use App\Exports\ContactsExport;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Contact::where('user_id', Auth::id());

        if ($request->has('category')) {
            // If a category is specified, show all contacts from that category
            $query->where('category', $request->category);
        } else {
            // Otherwise, show all contacts created in the last 7 days
            $query->where('created_at', '>=', now()->subDays(7));
        }

        $contacts = $query->latest()->get();

        $stats = [
            'ami'           => Contact::where('user_id', Auth::id())->where('category', 'ami')->count(),
            'famille'       => Contact::where('user_id', Auth::id())->where('category', 'famille')->count(),
            'professionnel' => Contact::where('user_id', Auth::id())->where('category', 'professionnel')->count(),
            'collegue'      => Contact::where('user_id', Auth::id())->where('category', 'collegue')->count(),
        ];

        return view('dashboard', compact('contacts', 'stats'));
    }

    public function relatedContacts($id)
    {
        // Fetch all related contacts for personA, ensuring the contact is also associated with the authenticated user
        $contacts = Contact::whereHas('relatedContacts', function ($query) use ($id) {
            $query->where('related_persons.personA', $id);
        })->where('user_id', auth()->id())->get();

        return view('relatedpersons', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'phone'    => 'required|string|max:20',
            'category' => 'required|in:ami,famille,professionnel,collegue',
        ]);

        $contact          = new Contact($validated);
        $contact->user_id = Auth::id();
        $contact->save();

        if ($request->has('relatedContacts') && $request->has('relationshipTypes')) {
            $relatedContacts = $request->input('relatedContacts');
            $typeRelations   = $request->input('relationshipTypes');

            foreach ($relatedContacts as $index => $relatedContactId) {
                if (empty($relatedContactId)) {
                    continue;
                }
                // Ignorer les contacts vides

                $type = $typeRelations[$index] ?? 'friend';

                // Vérifier si la relation existe déjà
                $existingRelation = \DB::table('related_persons')
                    ->where(function ($query) use ($contact, $relatedContactId) {
                        $query->where('personA', $contact->id)
                            ->where('personB', $relatedContactId)
                            ->orWhere('personA', $relatedContactId)
                            ->where('personB', $contact->id);
                    })
                    ->exists();

                if (! $existingRelation) {
                    \DB::table('related_persons')->insert([
                        'personA'    => $contact->id,
                        'personB'    => $relatedContactId,
                        'type'       => $type,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        return redirect()->route('dashboard')->with('success', 'Contact ajouté avec succès.');
    }

    public function show(Contact $contact)
    {
        $authUserId = Auth::id();

        // Check if the contact belongs to the user or is shared with them
        $isShared = \DB::table('share_contacts')
            ->where('contact_id', $contact->id)
            ->where('receiver_id', $authUserId)
            ->where('status', 'pending') // Ensure it's pending
            ->exists();

        if ($contact->user_id !== $authUserId && ! $isShared) {
            abort(403, 'You do not have access to this contact.');
        }

        return response()->json($contact);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        if ($contact->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'phone'    => 'required|string|max:20',
            'category' => 'required|in:ami,famille,professionnel,collegue',
        ]);

        $contact->update($validated);

        return redirect()->route('dashboard')->with('success', 'Contact mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        if ($contact->user_id !== Auth::id()) {
            abort(403);
        }

        $contact->delete();

        // return response()->json(['message' => 'Contact supprimé avec succès.']);
        return redirect()->route('dashboard');
    }

    // Export to Excel
    public function exportToExcel(Request $request)
    {
        $category = $request->category;
        $filename = $category ? "contacts_{$category}.xlsx" : 'contacts_recents.xlsx';

        return Excel::download(new ContactsExport($category), $filename);
    }

    // API function to return contacts list for the reltaed contacts
    public function getListOfContactsOfAuthUser()
    {
        try {
            $contacts = Contact::where('user_id', Auth::id())
                ->select('id', 'name', 'email', 'phone')
                ->get();

            return response()->json($contacts);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la récupération des contacts'], 500);
        }
    }

}