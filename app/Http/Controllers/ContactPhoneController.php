<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactPhoneRequest;
use App\Models\Contact;


class ContactPhoneController extends Controller
{
    public function getPayload(ContactPhoneRequest $request)
    {


//        die(var_dump($request->all()));

        !($contacts = $request->input('contacts')) ?: $this->updateExistingContacts($contacts);

        !($newContacts = $request->input('new_contacts')) ?: $this->createNewContacts($newContacts);

//        return redirect(route('contacts.edit_all'))->with('reload_after_save', true);

    }

    /* Updates existing contact info (f_name, l_name) and phone_number attributes
       and adds new numbers */
    public function updateExistingContacts($contacts)
    {
//        die(var_dump('hello'));

        foreach ($contacts as $contact) {

            // Perform update for existing contacts:
            if ($contact['exists'] === 'true') {

                $dbContact = Contact::find($contact['id']);

                // If existing contact has no phone numbers, we will skip updateOrCreate
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

            // Create non existing contacts
            if ($contact['exists'] === 'false') {

                $dbContact = Contact::create($contact);

                // If no numbers were added to new contact, we will skip "create" numbers
                if (isset($contact['phone_numbers'])) {
                    foreach ($contact['phone_numbers'] as $phoneNumber) {

                        $dbContact->phoneNumbers()->create($phoneNumber);
                    }
                }
            }
        }
    }

    // Creates new contacts with phone numbers
    public function createNewContacts($newContacts)
    {
        foreach ($newContacts as $newContact) {

            $dbContact = Contact::create($newContact);

            // If no numbers were added to new contact, we will skip "create" numbers
            if (isset($newContact['phone_numbers'])) {
                foreach ($newContact['phone_numbers'] as $phoneNumber) {

                    $dbContact->phoneNumbers()->create($phoneNumber);
                }
            }
        }
    }

}
