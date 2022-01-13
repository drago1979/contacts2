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

        {{--        knockoutjs model --}}
        <div id="form-ko">

            <!-- FORM CONTAINING ALL CONTACT DATA (contacts & phone numbers)    -->

            <form action="{{ route('contacts_and_numbers') }}"
                  method="POST"
                  id="form"
                  data-bind="submit: handleSave"
            >

                <div data-bind="foreach: contacts">

                    <!-- ONE CONTACT DATA (name & phone) -->

                    <div id="" class="row mb-2" data-bind="attr: {'data-contactid': id}">

                        <!--    ONE CONTACT NAME (first, last) -->
                        <div class="col-lg-5">

                            <div class="row">
                                <div class="col-lg">
                                    <input type="text"
                                           value=""
                                           data-bind="value: first_name"
                                           required
                                    >
                                </div>

                                <div class="col-lg">
                                    <input type="text" name=""
                                           value=""
                                           data-bind="value: last_name"
                                           required
                                    >
                                </div>
                            </div>

                            <!-- DELETE CONTACT BUTTON -->
                            @can('update-delete-store')
                                <div class="row">
                                    <div class="col-lg">
                                        <button type="button"
                                                class="btn btn-link c-btn-link link-danger c-padding-left-remove"
                                                data-bind="click: $parent.chooseDeletionPath"
                                        >
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            @endcan


                        </div>

                        <!-- CONTACTS PHONE NUMBERS -->
                        <div class="col-lg-7">


                            <div id="js-contact_id__phones"
                                 data-contactid=""
                                 data-bind="foreach: phone_numbers"
                            >

                                <!-- CONTACTS SINGLE PHONE NUMBER -->
                                <div id="contact_id__phone_number_id_"
                                     class="row">

                                    <div
                                        class="{{ Auth::user()->can('update-delete-store') ? 'col-lg-5' : 'col-lg-6' }}">

                                        <input class="mb-2"
                                               type="text"
                                               value=""
                                               data-bind="value: description"
                                               required
                                        >
                                    </div>

                                    <div
                                        class="{{ Auth::user()->can('update-delete-store') ? 'col-lg-5' : 'col-lg-6' }}">
                                        <input class="mb-2"
                                               type="text"
                                               value=""
                                               data-bind="value: number"
                                               required
                                        >
                                    </div>

                                    <!-- DELETE SINGLE PHONE NUMBER BUTTON -->
                                    @can('update-delete-store')

                                        <div class="col-lg-2">

                                            <button type="button"
                                                    class="btn btn-link c-btn-link link-danger"
                                                    data-bind="click: $root.chooseDeletionPath"
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
                            <button
                                class="c-main-button c-padding-left-remove"
                                type="button"
                                data-bind="click: addNewContactField"
                            >
                                Add a contact
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


    <script>

        var token = {{ \Illuminate\Support\Js::from(csrf_token()) }};

        /* Initial value for contacts, after page loading; It will be mapped to a Model */
        var contactsDb = {!! $contacts->toJson() !!};

    </script>

@endsection
