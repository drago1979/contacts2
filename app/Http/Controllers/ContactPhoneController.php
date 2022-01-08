<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactPhoneRequest;
use App\Models\Contact;


class ContactPhoneController extends Controller
{

    public function storeUpdate(ContactPhoneRequest $request)
    {
        foreach ($request->input('contacts') as $contact) {

            // Perform update for existing contacts:
            if ($contact['exists'] === 'true') {
                $this->update($contact);
            }

            // Create non existing contacts
            if ($contact['exists'] === 'false') {
                $this->store($contact);
            }
        }
    }

    public function update($contact)
    {
        $dbContact = Contact::find($contact['id']);

        // UpdateOrCreate will be performed only if existing contact has a phone number
        if (isset($contact['phone_numbers'])) {

            foreach ($contact['phone_numbers'] as $phoneNumber) {

                $dbContact->phoneNumbers()->updateOrCreate(
                    ['id' => $phoneNumber['id']],
                    ['description' => $phoneNumber['description'], 'number' => $phoneNumber['number']]
                );
            }
        }

        $dbContact->update($contact);
    }

    public function store($contact)
    {
        $dbContact = Contact::create($contact);

        // Create numbers will be performed only if contact has a phone number attached
        if (isset($contact['phone_numbers'])) {

            foreach ($contact['phone_numbers'] as $phoneNumber) {

                $dbContact->phoneNumbers()->create($phoneNumber);
            }
        }
    }
}
