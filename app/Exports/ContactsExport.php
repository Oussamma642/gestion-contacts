<?php

namespace App\Exports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ContactsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Fetch the required columns for the export
        // return Contact::select('name', 'email', 'phone', 'category')->get();
        return Contact::where('user_id', auth()->id())->select('name', 'email', 'phone', 'category')->get();    

    }

    public function headings(): array
    {
        // Define the column headings in the Excel file
        return ['Name', 'Email', 'Phone', 'Category'];
    }
}