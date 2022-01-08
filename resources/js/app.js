/*
|--------------------------------------------------------------------------
| Custom JS code
|--------------------------------------------------------------------------
| This file contains application`s custom JS code
|
*/


/* Adding "exists-flag" to all contacts & numbers retrieved from DB; This flag
*  will be used by the backend to resolve if record needs to be created
*  or updated (2 code blocks)
*/
contactsDb.map(function (contact) {
    contact.exists = true;
});

contactsDb.forEach(function (item, index) {
    item['phone_numbers'].map(function (phone_number) {
        phone_number.exists = true
    })
});


/* This variable-Model is used to initialize ViewModel with values
*/
let contactsModel = ko.mapping.fromJS(contactsDb);


// --------------------------------------------------------
// KNOCKOUT JS VIEW-MODEL
// --------------------------------------------------------

function contactsViewModel() {
    let self = this;

    /* Initial values to show in markup
    */
    self.contacts = contactsModel;


    // --------------------------------------------------------
    // ADDING NEW, EMPTY, INPUTS  for Numbers & Contacts
    // --------------------------------------------------------

    // Adding empty fields for phone description & number
    self.addNewNumberField = function (contact) {
        let newNumberField = {
            id: "temporaryNumberId" + contact.id,
            contact_id: contact.id,
            description: "",
            number: "",
            exists: false
        };

        let newNumberModel = ko.mapping.fromJS(newNumberField);

        /* Finding the array index of the contact that the phone
         * number will be assigned to
         */
        let contactIndex = self.contacts.indexOf(contact);

        /* Adding the phone number to contact
         */
        self.contacts()[contactIndex].phone_numbers.push(newNumberModel);
    }

    // Adding empty fields for new contact

    /* Contact`s "Temporary ID" generator
     */
    let newContactTemporaryId = 0;

    /* Adding new contact
    */
    self.addNewContactField = function () {
        let newContactField = {
            id: "temporaryContactId" + newContactTemporaryId,
            first_name: "",
            last_name: "",
            phone_numbers: [],
            exists: false
        };

        let newContactModel = ko.mapping.fromJS(newContactField);

        self.contacts.push(newContactModel);

        newContactTemporaryId++;
    };

    // --------------------------------------------------------
    // DELETING RECORDS (CONTACTS AND NUMBERS)
    // --------------------------------------------------------

    /* When "delete" is clicked, store the observable (to be deleted)
     * in this variable
     */
    let RecordForDeletion = (function () {
        let record;

        return {
            get: function () {
                return record;
            },
            set: function (value) {
                record = value;
                console.log(record);
            },
        }
    }());

    /* Depending on the record type (contact or number) - choose the deletion path
     */
    self.chooseDeletionPath = function (record) {

        /* When "delete" is clicked, store the observable
        */
        RecordForDeletion.set(record);

        if (record.exists() === true) {
            $('#js-delete-existing-record-modal').modal('show');
        }

        if (record.exists() === false) {
            self.determineHowToDeleteUiRecord();
        }
    }

    /* Delete existing records from the DB
    */
    self.deleteDbRecord = function () {
        $.ajax({
            url: RecordForDeletion.get().delete_url(),
            type: 'post',
            data: $('#js-delete-existing-record-form').serialize(),
            success: function () {
                $('#js-delete-existing-record-modal').modal('hide');
                self.determineHowToDeleteUiRecord();
            },
            error: function () {
                alert('An error occurred. Please try again later or contact our support.')
                $('#js-delete-existing-record-modal').modal('hide');
            }
        });


    }
    /* Depending on the record type (contact or number) - choose how to
     * delete from UI
     */
    self.determineHowToDeleteUiRecord = function () {
        "contact_id" in RecordForDeletion.get() ?
            self.removeNumber(RecordForDeletion.get()) :
            self.removeContact(RecordForDeletion.get());
    }

    /* Delete contact from UI
    */
    self.removeContact = function (item) {
        self.contacts.remove(item);
        self.informOnDeletionAndResetVariable();
    }

    /* Delete number from UI
    */
    self.removeNumber = function (item) {
        let contactIndex;

        /* Find array key for the contact to whom the number for deletion
         * belongs to
         */
        for (let key in self.contacts()) {
            if (self.contacts()[key].id() === RecordForDeletion.get().contact_id()) {
                contactIndex = key;
            }
        }

        self.contacts()[contactIndex].phone_numbers.remove(item);
        self.informOnDeletionAndResetVariable();
    }

    /* Inform the user when record is deleted. Only for records that
     * exist in DB. Reset the "RecordForDeletion" variable.
     */
    self.informOnDeletionAndResetVariable = function () {
        setTimeout(function () {
            if (RecordForDeletion.get().exists() === true) {
                alert('Record deleted.');
            }

            RecordForDeletion.set(null);

        }, 200);

    }


    // --------------------------------------------------------
    // SAVING RECORDS (CONTACTS AND NUMBERS) - when "save" is clicked
    // --------------------------------------------------------
    self.handleSave = function () {
        let payload = {
            _token: token,
            contacts: ko.toJS(self.contacts)
        };

        $.post({
            url: $('#form').attr('action'),
            data: payload,
            success: function () {
                alert('If you made any changes - they are saved.');
                location.reload();
            },
            error: function () {
                alert('An error occurred. Please try again later or contact our support.')
            }
        });
    };
}

// --------------------------------------------------------
// BINDING
// --------------------------------------------------------
const contactsApp = document.querySelector('#form-ko');

ko.applyBindings(new contactsViewModel(), contactsApp);
