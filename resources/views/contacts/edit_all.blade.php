@extends('layouts.app')

@section('content')

    <div class="container c-container">
        <!--    FORM TITLE  -->
        <div class="row">
            <div class="col-lg">
                <h2>Contacts</h2>
            </div>
        </div>

        <!--    FIELDS` TITLES    -->
        <div class="row">

            <div class="col-lg-5">
                <div class="row">
                    <div class="col-lg">
                        <h6>First Name</h6>
                    </div>

                    <div class="col-lg">
                        <h6>Last Name</h6>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <h6>Phone Numbers</h6>
            </div>
        </div>

        <!--    SEPARATOR LINE between "column titles" & "contacts" -->
        <div class="row">
            <div class="col">
                <div class="c-border-line mb-2 mx-auto"></div>
            </div>
        </div>


        <div id="form-ko">

            <!-- FORM CONTAINING ALL CONTACT DATA (contacts & phone numbers)    -->
            {{--        knockoutjs model --}}
            <form action="{{ route('contacts_and_numbers') }}"
                  method="POST"
                  id="form"
                  data-bind="submit: handleSave"
            >
                @csrf

                {{--            <div id="js-contacts-wrapper">--}}
                <div id="js-contacts-wrapper" data-bind="foreach: contacts">

                    <!-- ONE CONTACT DATA (name & phone) -->

                    {{--                <div id="contact_id_{{ $contact->id }}" class="row mb-2">--}}
                    <div id="" class="row mb-2" data-bind="attr: {'data-contactid': id}">

                        <!--    ONE CONTACT NAME (first, last) -->
                        <div class="col-lg-5">

                            {{--                        <input type="hidden" name="contacts[{{ $contact->id }}][id]"--}}
                            {{--                               value="{{ $contact->id }}">--}}

                            <input type="hidden" name=""
                                   value=""

                            >

                            <div class="row">
                                <div class="col-lg">
                                    {{--                                <input type="text" name="contacts[{{ $contact->id }}][first_name]"--}}
                                    {{--                                       value="{{ $contact->first_name }}"--}}
                                    {{--                                       required--}}
                                    {{--                                >--}}

                                    <input type="text"
                                           name=""
                                           value=""
                                           data-bind="value: first_name"
                                        {{--                                           data-bind="value: first_name, valueUpdate: 'afterkeydown'"--}}
                                    >

                                </div>

                                <div class="col-lg">
                                    {{--                                <input type="text" name="contacts[{{ $contact->id }}][last_name]"--}}
                                    {{--                                       value="{{ $contact->last_name }}"--}}
                                    {{--                                       required--}}
                                    {{--                                >--}}

                                    <input type="text" name=""
                                           value=""
                                           data-bind="value: last_name"
                                    >

                                </div>
                            </div>

                            <!-- DELETE CONTACT BUTTON -->
                            @can('update-delete-store')
                                <div class="row">
                                    <div class="col-lg">
                                        <button type="button"
                                                class="btn btn-link c-btn-link link-danger c-padding-left-remove"
                                                {{--                                                data-bs-toggle="modal" --}}
                                                data-bs-target="#js-delete-existing-record-modal"
                                                {{--                                            onclick="passUrlAndMarkupElementIdToExistingRecordDeleteModal(--}}
                                                {{--                                                '#contact_id_{{ $contact->id }}',--}}
                                                {{--                                                '{{ route('contacts.delete', [$contact->id]) }}') "--}}
                                                data-bind="click: $parent.chooseDeletionPath"
                                        >
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            @endcan


                        </div>

                        {{--                    <!-- CONTACTS PHONE NUMBERS -->--}}
                        <div class="col-lg-7">

                            <div data-bind="if: typeof phone_numbers !== 'undefined'">

                                {{--                                        <div id="js-contact_id_{{ $contact->id }}_phones"--}}
                                {{--                                             data-contactid= {{ $contact->id }}--}}
                                <div id="js-contact_id__phones"
                                     data-contactid=""
                                     data-bind="foreach: phone_numbers"
                                >

                                    <!-- CONTACTS SINGLE PHONE NUMBER -->
                                    {{--                                            <div id="contact_id_{{ $contact->id }}_phone_number_id_{{ $contactPhone->id }}"--}}
                                    {{--                                                 class="row">--}}
                                    <div id="contact_id__phone_number_id_"
                                         class="row">

                                        {{--                                                <input type="hidden"--}}
                                        {{--                                                       name="contacts[{{ $contact->id }}][phone_numbers][{{ $contactPhone->id }}][id]"--}}
                                        {{--                                                       value="{{ $contactPhone->id }}">--}}
                                        <input type="hidden"
                                               name=""
                                               value="">

                                        {{--                                                <input type="hidden"--}}
                                        {{--                                                       name="contacts[{{ $contact->id }}][phone_numbers][{{ $contactPhone->id }}][contact_id]"--}}
                                        {{--                                                       value="{{ $contact->id }}">--}}
                                        <input type="hidden"
                                               name=""
                                               value="">

                                        <div
                                            class="{{ Auth::user()->can('update-delete-store') ? 'col-lg-5' : 'col-lg-6' }}">
                                            {{--                                                    <input class="mb-2"--}}
                                            {{--                                                           type="text"--}}
                                            {{--                                                           name="contacts[{{ $contact->id }}][phone_numbers][{{ $contactPhone->id }}][description]"--}}
                                            {{--                                                           value="{{ $contactPhone->description }}"--}}
                                            {{--                                                           required--}}
                                            {{--                                                    >--}}
                                            <input class="mb-2"
                                                   type="text"
                                                   name=""
                                                   value=""
                                                   data-bind="value: description"
                                            >
                                        </div>

                                        <div
                                            class="{{ Auth::user()->can('update-delete-store') ? 'col-lg-5' : 'col-lg-6' }}">
                                            {{--                                                    <input class="mb-2"--}}
                                            {{--                                                           type="text"--}}
                                            {{--                                                           name="contacts[{{ $contact->id }}][phone_numbers][{{ $contactPhone->id }}][number]"--}}
                                            {{--                                                           value="{{ $contactPhone->number }}"--}}
                                            {{--                                                           required--}}
                                            {{--                                                    >--}}
                                            <input class="mb-2"
                                                   type="text"
                                                   name=""
                                                   value=""
                                                   data-bind="value: number"
                                            >
                                        </div>

                                        <!-- DELETE SINGLE PHONE NUMBER BUTTON -->
                                        @can('update-delete-store')

                                            <div class="col-lg-2">

                                                <button type="button"
                                                        class="btn btn-link c-btn-link link-danger"
                                                        {{--                                                        data-bs-toggle="modal"--}}
                                                        {{--                                                        data-bs-target="#js-delete-existing-record-modal"--}}
                                                        {{--                                                                onclick="passUrlAndMarkupElementIdToExistingRecordDeleteModal(--}}
                                                        {{--                                                                    '#contact_id_{{ $contact->id }}_phone_number_id_{{ $contactPhone->id }}',--}}
                                                        {{--                                                                    '{{ route('phone_numbers.delete', [$contact->id, $contactPhone->id]) }}') "--}}
                                                        data-bind="click: $root.chooseDeletionPath"

                                                >
                                                    Delete
                                                </button>
                                            </div>
                                        @endcan

                                    </div>
                                </div>

                            </div>

                            <!-- ADD NEW PHONE NUMBER (to existing contact) BUTTON -->
                            @can('update-delete-store')

                                <div class="row">
                                    <div class="col-lg">
                                        <button
                                            {{--                                                        onclick="addNewNumberFieldExistingContact('#js-contact_id_{{ $contact->id }}_phones', {{ $contact->id }})"--}}
                                            type="button"
                                            class="btn btn-link c-btn-link link-danger c-padding-left-remove"
                                            data-bind="click: $parent.addNewNumberField"
                                        >
                                            Add number
                                        </button>
                                    </div>
                                </div>
                            @endcan
                        </div>

                        <!--        Separator (line) - comes after single contact -->
                        <div class="row">
                            <div class="col">
                                <div class="c-border-line mb-2 mx-auto"></div>
                            </div>
                        </div>
                    </div>


                </div>

                <!-- ADD NEW CONTACT & SUBMIT FORM BUTTONS -->
                @can('update-delete-store')

                    <div class="row">
                        <div class="col-lg-2">
                            {{--                            <button--}}
                            {{--                                class="c-main-button c-padding-left-remove"--}}
                            {{--                                onclick="addNewContactField('js-contacts-wrapper')"--}}
                            {{--                                type="button"--}}
                            {{--                            >--}}
                            {{--                                Add a contact--}}
                            {{--                            </button>--}}

                            <button
                                class="c-main-button c-padding-left-remove"
                                {{--                                onclick="addNewContactField('js-contacts-wrapper')"--}}
                                type="button"
                                data-bind="click: addNewContactField"
                            >
                                Add a contacty
                            </button>


                        </div>

                        <div class="col-lg-1">
                            <button
                                class="c-main-button"
                                type="submit"
                            >
                                Save
                            </button>
                        </div>
                    </div>

                @endcan

            </form>

            @include('includes.modals')
        </div>


    </div>



    <!-- If user is redirected to the page after clicking "save", "value" attribute = "1" -->
    <!-- This value is used by JS -->
    <input id="js-reload-after-save" type="hidden" name="status" value="{{ session('reload_after_save') }}">

    <!-- knockoutjs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.5.1/knockout-latest.js"
            integrity="sha512-2AL/VEauKkZqQU9BHgnv48OhXcJPx9vdzxN1JrKDVc4FPU/MEE/BZ6d9l0mP7VmvLsjtYwqiYQpDskK9dG8KBA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- KnockoutJS plugin: mapping -->
    <script src="{{ asset('js/plugins/ko-mapping-plugin.js') }}"></script>

    <script>

        var token = {{ \Illuminate\Support\Js::from(csrf_token()) }};

        /* Initial value for contacts, after page loading; It will be mapped to a Model */
        var contactsDb = {!! $contacts->toJson() !!};

        /* Adding exists-flag to all contacts & numbers retrieved from DB; This flag will be used by
         * the backend to resolve if record needs to be created or updated (2 blocks)
         */
        contactsDb.map(function (contact) {
            contact.exists = true;
        });

        contactsDb.forEach(function (item, index) {
            item['phone_numbers'].map(function (phone_number) {
                phone_number.exists = true
            })
        });


        /* This variable-Model is used to initialize ViewModel with values */
        let contactsModel = ko.mapping.fromJS(contactsDb);

        function contactsViewModel() {
            let self = this;

            self.contacts = contactsModel;

            self.addNewNumberField = function (contact) {
                let newNumberField = {
                    id: "temporaryNumberId" + contact.id,
                    contact_id: contact.id,
                    description: "",
                    number: "",
                    exists: false
                };

                let newNumberModel = ko.mapping.fromJS(newNumberField);

                let contactIndex = self.contacts.indexOf(contact);

                self.contacts()[contactIndex].phone_numbers.push(newNumberModel);
            }


            /* Stores observable of the record to be deleted after clicking
             * the "delete" for contacts or numbers
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


            self.chooseDeletionPath = function (record) {
                /* Writes the observable into the variable */
                RecordForDeletion.set(record);

                // TRY / CATCH ????
                if (record.exists() === true) {
                    $('#js-delete-existing-record-modal').modal('show');
                }

                if (record.exists() === false) {
                    self.determineHowToDeleteUiRecord();
                }
            }

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

            self.determineHowToDeleteUiRecord = function () {

                // NEFUNKCIONALAN BLOK - ZA ANALIZU
                // try {
                //     self.removeNumber(RecordForDeletion.get());
                //
                //     // if (RecordForDeletion.get().contact_id()) {
                //     //     console.log('number');
                //     //     self.removeNumber(RecordForDeletion.get());
                //     // }
                // } finally {
                //     console.log('contact');
                //     self.removeContact(RecordForDeletion.get());
                //
                // }

                /* Determining if record is:
                *  a) Contact or
                *  b) Number
                */
                if (!("contact_id" in RecordForDeletion.get())) {
                    self.removeContact(RecordForDeletion.get());
                }

                if ("contact_id" in RecordForDeletion.get()) {
                    self.removeNumber(RecordForDeletion.get());
                }

            }

            self.removeContact = function (item) {
                self.contacts.remove(item);
                self.informOnDeletion();
            }

            self.removeNumber = function (item) {

                let contactIndex;
                for (let key in self.contacts()) {
                    // console.log('self.contacts()[key]', self.contacts()[key]);
                    // console.log('self.contacts()[key].contact_id()', self.contacts()[key].id());

                    if (self.contacts()[key].id() == RecordForDeletion.get().contact_id()) {
                        contactIndex = key;
                    }
                }

                self.contacts()[contactIndex].phone_numbers.remove(item);
                self.informOnDeletion();

            }

            /* Inform the user when DB existing record is deleted */
            self.informOnDeletion = function () {
                setTimeout(function () {
                    if (RecordForDeletion.get().exists() === true) {
                        alert('Record deleted.');
                    }
                }, 200);
            }

            /* Temporary ID number generator */
            let newContactTemporaryId = 0;

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


            // To save ALL records:
            self.handleSave = function () {
                let payload = {
                    _token: token,
                    contacts: ko.toJS(self.contacts)
                };

                $.post({
                    url: $('#form').attr('action'),
                    data: payload,
                    success: function () {
                        location.reload();

                        alert('If you made any changes - they are saved.');
                    },
                    error: function () {
                        alert('An error occurred. Please try again later or contact our support.')
                    }
                });
            };

        }

        const contactsApp = document.querySelector('#form-ko');

        ko.applyBindings(new contactsViewModel(), contactsApp);


    </script>

@endsection
