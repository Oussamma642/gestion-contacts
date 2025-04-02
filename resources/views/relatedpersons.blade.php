@extends('dashboard-layouts.app')

@section('content')
<main class="p-3 sm:p-4 lg:p-6">
    <div class="overflow-x-auto">

        <h1 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-4">
            Related Contacts of {{$contacts[0]->name}}
        </h1>

        <table class="min-w-full table-auto divide-y divide-gray-200 border border-gray-300">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nom
                    </th>
                    <th
                        class="hidden sm:table-cell px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Email
                    </th>
                    <th
                        class="hidden md:table-cell px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Phone
                    </th>
                    <th
                        class="hidden md:table-cell px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Category
                    </th>
                    <th
                        class="hidden md:table-cell px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Relationship Type
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($contacts as $contact)
                @foreach($contact->relatedContacts as $relatedContact)
                <tr>
                    <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                        {{$relatedContact->name}}
                    </td>
                    <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                        {{$relatedContact->email}}
                    </td>
                    <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                        {{$relatedContact->phone}}
                    </td>
                    <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                        {{$relatedContact->category}}
                    </td>
                    <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                        {{$relatedContact->pivot->type}}
                    </td>
                </tr>
                @endforeach
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                        No contact found
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</main>
@endsection