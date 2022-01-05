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
                    <div id="" class="row mb-2">

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

                            <!-- DELETE SINGLE CONTACT BUTTON -->
                            @can('update-delete-store')
                                <div class="row">
                                    <div class="col-lg">
                                        <button type="button"
                                                class="btn btn-link c-btn-link link-danger c-padding-left-remove"
                                                data-bs-toggle="modal" data-bs-target="#js-delete-existing-record-modal"
                                            {{--                                            onclick="passUrlAndMarkupElementIdToExistingRecordDeleteModal(--}}
                                            {{--                                                '#contact_id_{{ $contact->id }}',--}}
                                            {{--                                                '{{ route('contacts.delete', [$contact->id]) }}') "--}}
                                        >
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            @endcan


                        </div>

                        {{--                    <!-- CONTACTS PHONE NUMBERS -->--}}
                        <div class="col-lg-7">

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
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#js-delete-existing-record-modal"
                                                {{--                                                                onclick="passUrlAndMarkupElementIdToExistingRecordDeleteModal(--}}
                                                {{--                                                                    '#contact_id_{{ $contact->id }}_phone_number_id_{{ $contactPhone->id }}',--}}
                                                {{--                                                                    '{{ route('phone_numbers.delete', [$contact->id, $contactPhone->id]) }}') "--}}
                                            >
                                                Delete
                                            </button>
                                        </div>
                                    @endcan

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
                                            Add number <span data-bind="text: $data.id"></span>
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


        </div>


    </div>

    @include('includes.modals')

    <!-- If user is redirected to the page after clicking "save", "value" attribute = "1" -->
    <!-- This value is used by JS -->
    <input id="js-reload-after-save" type="hidden" name="status" value="{{ session('reload_after_save') }}">

    <!-- knockoutjs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.5.1/knockout-latest.js"
            integrity="sha512-2AL/VEauKkZqQU9BHgnv48OhXcJPx9vdzxN1JrKDVc4FPU/MEE/BZ6d9l0mP7VmvLsjtYwqiYQpDskK9dG8KBA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>


        var contactsDb = {{ \Illuminate\Support\Js::from($contacts->toArray()) }};
        var token = {{ \Illuminate\Support\Js::from(csrf_token()) }}

        function contactsViewModel() {
            var self = this;

            self.contacts = ko.observableArray(contactsDb);

            for (let key in self.contacts()) {
                self.contacts()[key].exists = true;

                self.contacts()[key]['phone_numbers'] = ko.observableArray(self.contacts()[key]['phone_numbers']);

            }

            console.log('contacts after exists: ', self.contacts());


            // console.log(self.contacts());

            // Adding new phones to existing contact -> UNCOMMENT
            // self.contacts()[0]['phone_numbers'].push({
            //     id: "",
            //     contact_id: "",
            //     description: "",
            //     number: ""
            // });
            // Adding new phones to existing contact <-


            // Adding new CONTACT -> UNCOMMENT
            // self.contacts().push({
            //     id: "",
            //     first_name: "",
            //     last_name: "",
            //     exists: false
            // });

            self.addNewNumberField = function (e) {
                // console.log(e.id);
                alert('bum');

                self.contacts()[0]['phone_numbers'].push({
                    id: "temporaryId" + e.id,
                    contact_id: "",
                    description: "",
                    number: ""
                });




            }

            var newContactTemporaryId = 0;

            self.addNewContactField = function () {

                // console.log(self.contacts());

                self.contacts.push({
                    id: "t" + newContactTemporaryId,
                    first_name: "",
                    last_name: "",
                    exists: false
                });


                newContactTemporaryId++;
                // console.log(self.contacts());

            };

            // Adding new CONTACT <- UNCOMMENT


            // When saving ALL records:
            self.handleSave = function () {

                let payload = {
                    _token: token,
                    contacts: ko.toJS(self.contacts)
                }


                $.post({
                    url: $('#form').attr('action'),
                    // type: 'post',
                    data: payload,
                    success: function (data1) {
                        // location.reload();

                        alert('success');
                        // deleteExistingAndNonExistingRecordFromMarkup($('#js-modal-delete-existing-record-delete-button').attr('data-markupid'));
                        // $('#js-delete-existing-record-modal').modal('hide');
                        // console.log('**********');
                        // console.log(data1);
                        // console.log('**********');


                    },
                    error: function () {
                        alert('An error occurred. Please try again later or contact our support.')
                        // $('#js-delete-existing-record-modal').modal('hide');
                    }
                })
            }


        }

        const contactsApp = document.querySelector('#form-ko');

        ko.applyBindings(new contactsViewModel(), contactsApp);


    </script>

@endsection
