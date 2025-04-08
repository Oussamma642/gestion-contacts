<?php

namespace App\Exports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ContactsExport implements FromCollection, WithHeadings
{
    protected $category;

    public function __construct($category = null)
    {
        $this->category = $category;
    }

    public function collection()
    {
        $query = Contact::where('user_id', auth()->id());

        if ($this->category) {
            $query->where('category', $this->category);
        } else {
            $query->where('created_at', '>=', now()->subDays(7));
        }

        return $query->select('name', 'email', 'phone', 'category')->get();
    }

    public function headings(): array
    {
        return ['Name', 'Email', 'Phone', 'Category'];
    }
}