<?php
namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\RelatedPerson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Contact::where('user_id', Auth::id());

        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        // $contacts = $query->latest()->get();
        $contacts = $query->where('created_at', '>=', now()->subDays(7))->latest()->get();

        $stats = [
            'ami'           => Contact::where('user_id', Auth::id())->where('category', 'ami')->count(),
            'famille'       => Contact::where('user_id', Auth::id())->where('category', 'famille')->count(),
            'professionnel' => Contact::where('user_id', Auth::id())->where('category', 'professionnel')->count(),
            'collegue'      => Contact::where('user_id', Auth::id())->where('category', 'collegue')->count(),
        ];

        return view('dashboard', compact('contacts', 'stats'));
    }

    public function relatedPersons($id)
    {
        // Fetch related persons with their contacts and relation type
        $relatedPersons = RelatedPerson::where('personA', $id)
            ->with(['personB', 'typeRelation']) // Load related contact and relation type
            ->get();
    
        return view('relatedpersons', compact('relatedPersons'));
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

        return redirect()->route('dashboard')->with('success', 'Contact ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        if ($contact->user_id !== Auth::id()) {
            abort(403);
        }

        return response()->json($contact);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
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

        return response()->json(['message' => 'Contact supprimé avec succès.']);
    }
}