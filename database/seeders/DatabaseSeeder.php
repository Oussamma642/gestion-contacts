<?php
namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Contact;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // \App\Models\Contact::factory()->count(5)->create();

        // Contact::factory(20)->create();

        foreach (Contact::all() as $contactA) {
            $contactB = Contact::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $contactA->relatedContacts()->attach($contactB, [
                'type' => collect(['friend', 'sibling', 'cousin', 'spouse', 'parent_of', 'child_of', 'mentor_of', 'mentee_of'])->random(),
            ]);
        }
    }
}