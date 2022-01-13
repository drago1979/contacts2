<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\PhoneNumber;

class PhoneNumberController extends Controller
{
    public function destroy(Contact $contact, PhoneNumber $phoneNumber)
    {
        $phoneNumber->delete();
    }
}
