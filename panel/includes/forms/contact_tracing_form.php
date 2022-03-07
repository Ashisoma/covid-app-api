<div class="accordion transparent" id="accordion">

    <h1 style="text-align: center">Patient Contacts</h1>

    <hr>
    <div class="tab-content card mb-0 transparent" id="divContactCard">

    </div>

</div>

<button class="btn btn-primary ml-auto float-right mt-4 mb-3" data-toggle="modal" data-target="#dialogContact"
        id="btnAddContact">
    <span class="icon text-white-50">
        <i class="fas fa-user-plus"></i>
    </span>
    <span class="text">Add A Contact</span>
</button>

<!-- add Contact dialog -->
<div class="modal fade" id="dialogContact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Contact Dialog</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="code.php" method="POST" onsubmit="event.preventDefault();" id="formContact">

                <div class="modal-body">
                    <label for="inputContactName">Contact Names</label>
                    <div class="row">
                        <div class="form-group col-6">
                            <input type="text" name="inputFirstName" id="inputFirstName" class="form-control"
                                   placeholder="First Name" autocomplete="off" required>
                        </div>
                        <div class="form-group col-6">
                            <input type="text" name="inputMiddleName" id="inputMiddleName" class="form-control"
                                   placeholder="Middle name" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" name="inputSurname" id="inputSurname" class="form-control"
                               placeholder="Surname" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label for="inputPhone">Phone Number</label>
                        <input type="number" name="inputPhone" id="inputPhone" class="form-control"
                               placeholder="Enter phone number" autocomplete="off" required>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" name="btnSaveContact" id="btnSaveContact" class="btn btn-primary">Save
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- add tracings dialog -->
<div class="modal fade" id="dialogTracing" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Contact Tracing</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="code.php" method="POST" onsubmit="event.preventDefault();" id="tracingForm">

                <div class="modal-body row">

                    <div class="col-xl-6 col-sm-12">

                        <div class="form-group">
                            <label for="selectContactTraced">Contact traced succesfully</label>
                            <select class="form-select" name="selectContactTraced" id="selectContactTraced" required>
                                <option hidden value="">Select value</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputTracingDate">Tracing date</label>
                            <input type="date" class="form-control" id="inputTracingDate" placeholder=" Enter Date">
                        </div>
                        <div class="form-group">
                            <label for="inputTracerName">Tracer Name</label>
                            <input type="text" class="form-control" id="inputTracerName" placeholder="Specify">
                        </div>
                        <div class="col-xl-12">
                            <label for="">Location Information</label>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="selectCounty">County</label>
                                    <select class="form-select" name="selectCounty" id="selectCounty">
                                        <option hidden value="">Select County</option>
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label for="selectSubCounty">Sub-County</label>
                                    <select class="form-select" name="selectSubCounty" id="selectSubCounty">
                                        <option hidden value="">Select Sub-County</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-xl-6 col-sm-12">
                        <div class="form-group">
                            <label for="selectContactTested">Contact tested</label>
                            <select class="form-select" name="selectContactTested" id="selectContactTested">
                                <option hidden value="">Select value</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputTestingDate">Testing date</label>
                            <input type="date" class="form-control" id="inputTestingDate" placeholder=" Enter Date">
                        </div>
                        <div class="form-group">
                            <label for="selectTestOutcome">Test outcome</label>
                            <select class="form-select" name="selectTestOutcome" id="selectTestOutcome">
                                <option hidden value="">Select value</option>
                                <option value="Positive">Positive</option>
                                <option value="Negative">Negative</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" name="savebtn" id="saveClientBtn" class="btn btn-primary"
                            onclick="saveContactTracing();">Save
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="modal fade" id="dialogRegister" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Register Contact</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>

<script>
    const inputFirstName = document.getElementById('inputFirstName')
    const inputMiddleName = document.getElementById('inputMiddleName')
    const inputSurname = document.getElementById('inputSurname')
    const inputPhone = document.getElementById('inputPhone')
    const selectCounty = document.getElementById('selectCounty')
    const selectSubCounty = document.getElementById('selectSubCounty')
    const selectContactTraced = document.getElementById('selectContactTraced')
    const inputTracingDate = document.getElementById('inputTracingDate')
    const inputTracerName = document.getElementById('inputTracerName')
    const selectContactTested = document.getElementById('selectContactTested')
    const inputTestingDate = document.getElementById('inputTestingDate')
    const selectTestOutcome = document.getElementById('selectTestOutcome')
    const divContactCard = document.getElementById('divContactCard')

    var patient_id = null
    var editedContact = ''
    var viewedContact = ''
    var editedTracing = ''
    var counties = []
    $(document).ready(function () {
        if (localStorage.getItem('checkedInPatient') != null) {
            let patient = JSON.parse(localStorage.getItem('checkedInPatient'))
            patient_id = patient.id
            getContacts()
        } else {
            document.getElementById('btnSaveContact').setAttribute('disabled', '')
        }
        document.getElementById('btnSaveContact').addEventListener('click', () => saveContact())

        $.ajax({
            type: "GET",
            url: "counties_data",
            success: response => {
                var mResponse = JSON.parse(response);
                let code = mResponse.code;
                if (code == 200) {
                    counties = mResponse.data;
                    for (let i = 0; i < counties.length; i++) {
                        let county = counties[i];
                        let option = document.createElement('option');
                        option.setAttribute('value', county.code);
                        option.appendChild(document.createTextNode(county.name));
                        selectCounty.appendChild(option);
                    }
                } else {
                    var error = [];
                    error.status = code;
                    error.message = mResponse.message;
                    toastr.error("Unable to load data")
                }
            },
            error: err => {
                toastr.error("Unable to load data", err.status)
            }
        })
        $("#dialogContact").on("hide.bs.modal", () => {
            clearContactDialog()
        });
        $("#dialogTracing").on("hide.bs.modal", () => {
            clearTracingDialog()
        });

        selectCounty.addEventListener('change', () => selectedCountyChange())
        selectContactTraced.addEventListener('change', () => contactTracedChanged())
        selectContactTested.addEventListener('change', () => contactTestedChanged())
    })

    function saveContactTracing() {
        if (localStorage.getItem('checkedInPatient') == null) {
            toastr.error("No Patient checked in");
            return
        }
        let county = $(selectCounty).val(),
            subcounty = $(selectSubCounty).val(),
            contactTraced = $(selectContactTraced).val(),
            tracingDate = inputTracingDate.value.trim(),
            tracerName = inputTracerName.value.trim(),
            contactTested = $(selectContactTested).val(),
            testingDate = inputTestingDate.value.trim(),
            testOutcome = $(selectTestOutcome).val()

        let formData = new FormData();
        formData.append('id', editedTracing)
        formData.append('contact_id', viewedContact)
        formData.append('county', county)
        formData.append('subcounty', subcounty)
        formData.append('contactTraced', contactTraced)
        formData.append('tracingDate', tracingDate)
        formData.append('tracerName', tracerName)
        formData.append('contactTested', contactTested)
        formData.append('testingDate', testingDate)
        formData.append('testOutcome', testOutcome)
        $.ajax({
            type: 'POST',
            url: 'save_contact_tracing',
            processData: false,
            cache: false,
            contentType: false,
            data: formData,
            success: response => {
                toastr.success("Contact trace saved successfully")
                hideModal('dialogTracing')
                getContacts()
            },
            error: err => {
                toastr.error("Unable to save contact trace. ", err.status)
            }
        })
    }

    function saveContact() {
        if (localStorage.getItem('checkedInPatient') == null) {
            toastr.error("No Patient checked in");
            return
        }
        let patientID = patient_id,
            firstName = inputFirstName.value.trim()
        middleName = inputMiddleName.value.trim()
        surname = inputSurname.value.trim()
        phone = inputPhone.value.trim();

        let formData = new FormData();
        formData.append('id', editedContact)
        formData.append('patient_id', patient_id)
        formData.append('firstName', firstName)
        formData.append('middleName', middleName)
        formData.append('surname', surname)
        formData.append('phoneNumber', phone)
        $.ajax({
            type: 'POST',
            url: 'save_contact',
            processData: false,
            cache: false,
            contentType: false,
            data: formData,
            success: response => {
                toastr.success("Contact trace saved successfully")
                hideModal('dialogContact')
                getContacts()
            },
            error: err => {
                toastr.error("Unable to save contact. ", err.status)
            }
        })
    }

    function getContacts() {
        $.ajax({
            type: 'GET',
            url: 'getContacts/' + patient_id,
            success: response => {
                loadContacts(JSON.parse(response))
            },
            error: err => {
                toastr.error("Unable to get contact. ", err.status)
            }
        })
    }

    function selectedCountyChange() {
        let selected = selectCounty.options[selectCounty.selectedIndex].value;
        let len = selectSubCounty.options.length;
        //FIXME Maybe later
        // console.dir(selectSubCounty.options);
        // for (let i = 1; i < len; i++) {
        //     console.log('removing : ' + selectSubCounty.options[i].value);
        //     selectSubCounty.options[i] = null;
        // }
        selectSubCounty.innerHTML = "<option hidden value=\"\">Select Sub-County</option>"
        for (let i = 0; i < counties.length; i++) {
            let county = counties[i];
            if (county.code == selected) {
                console.log(county.subcounties);
                let subcounties = county.subcounties;
                for (let j = 0; j < subcounties.length; j++) {
                    let sub = subcounties[j];
                    let option = document.createElement('option');
                    option.setAttribute('value', sub.id);
                    option.appendChild(document.createTextNode(sub.name));
                    selectSubCounty.appendChild(option);
                }
                break;
            }
        }
    }

    function contactTracedChanged() {
        let selected = $(selectContactTraced).val();
        if (selected === "Yes") {
            if (inputTracingDate.hasAttribute('disabled')) inputTracingDate.removeAttribute('disabled')
            if (inputTracerName.hasAttribute('disabled')) inputTracerName.removeAttribute('disabled')
            if (selectContactTested.hasAttribute('disabled')) selectContactTested.removeAttribute('disabled')
        } else {
            inputTracingDate.value = ''
            inputTracingDate.setAttribute('disabled', '')
            inputTracerName.value = ''
            inputTracerName.setAttribute('disabled', '')
            $(selectContactTested).val('')
            selectContactTested.setAttribute('disabled', '')
            contactTestedChanged()
        }
    }

    function contactTestedChanged() {
        let selected = $(selectContactTested).val();
        if (selected === "Yes") {
            if (inputTestingDate.hasAttribute('disabled')) inputTestingDate.removeAttribute('disabled')
            if (selectTestOutcome.hasAttribute('disabled')) selectTestOutcome.removeAttribute('disabled')
        } else {
            inputTestingDate.value = ''
            inputTestingDate.setAttribute('disabled', '')
            $(selectTestOutcome).val('')
            selectTestOutcome.setAttribute('disabled', '')
        }
    }

    function loadContacts(contacts) {
        removeAllChildNodes(divContactCard)
        contacts.forEach(contact => {
                let someDiv = document.createElement("div")
                someDiv.classList.add("card-header")
                someDiv.classList.add("collapsed")
                someDiv.classList.add("mb-2", "ml-1", "mr-1", "mt-1")
                someDiv.setAttribute("data-toggle", "collapse")
                someDiv.setAttribute("href", "#collapseCard" + contact.id)
                //some a
                let a = document.createElement("a")
                a.classList.add("card-title")
                a.classList.add("mr-4")
                // some h6
                let h6 = document.createElement("h6")
                h6.classList.add("font-weight-bold")
                h6.classList.add("text-dark")
                h6.innerText = "Name: " + contact.firstName + " " + contact.middleName + " " + contact.surname

                // some button edit contact
                let buttonEditContact = document.createElement("button")
                buttonEditContact.innerHTML = "<span class=\"icon text-white-50\"><i data-feather=\"more-vertical\" class=\"fas fa-edit mt-1\"></i></span><span class=\"text\"> Edit Contact</span>"
                buttonEditContact.classList.add("btn")
                buttonEditContact.classList.add("btn-info")
                buttonEditContact.classList.add("btn-icon-split")
                buttonEditContact.classList.add("mr-4")
                buttonEditContact.classList.add("mt-4")
                buttonEditContact.setAttribute("data-toggle", "modal");
                buttonEditContact.setAttribute("data-target", "#dialogContact")
                buttonEditContact.setAttribute("data-placement", "bottom")
                buttonEditContact.addEventListener("click", () => editContact(contact));
                // some button add tracing
                let buttonAddTracing = document.createElement("button")
                buttonAddTracing.innerHTML = "<span class=\"icon text-white-50\"><i data-feather=\"more-vertical\" class=\"fas fa-plus mt-1\"></i></span><span class=\"text\"> Add Tracing</span>"
                buttonAddTracing.classList.add("btn")
                buttonAddTracing.classList.add("btn-info")
                buttonAddTracing.classList.add("btn-icon-split")
                buttonAddTracing.classList.add("mr-4")
                buttonAddTracing.classList.add("mt-4")
                buttonAddTracing.classList.add("float-right")
                buttonAddTracing.setAttribute("data-toggle", "modal");
                buttonAddTracing.setAttribute("data-target", "#dialogTracing")
                buttonAddTracing.setAttribute("data-placement", "bottom")
                buttonAddTracing.addEventListener("click", () => {
                    viewedContact = contact.id
                })
                // bottom buttons' div
                let divButtons = document.createElement("div");
                divButtons.classList.add("btn-toolbar")
                divButtons.setAttribute("role", "toolbar")
                divButtons.appendChild(buttonEditContact)
                divButtons.appendChild(buttonAddTracing)
                // some other div
                let div = document.createElement("div")
                div.classList.add("mt-2")
                div.classList.add("text-silver")
                div.innerText = "Phone Number: " + contact.phoneNumber;
                a.appendChild(h6)
                a.appendChild(div)
                someDiv.appendChild(a)
                divContactCard.appendChild(someDiv)
                /*******````~~~~~~~~~~Collapsing part */
                let collapseDiv = document.createElement("div")
                collapseDiv.classList.add("card-body")
                collapseDiv.classList.add("collapse")
                collapseDiv.setAttribute("id", "collapseCard" + contact.id)
                collapseDiv.setAttribute("data-parent", "#accordion")
                let tableDiv = document.createElement("div")
                tableDiv.classList.add("datatable")
                let table = document.createElement("table")
                table.classList.add("table")
                table.classList.add("table-bordered")
                table.classList.add("table-hover")
                table.setAttribute("width", "100%")
                table.setAttribute("cellspacing", "0")
                table.style.background = "#FFFFFF"

                let thead = document.createElement("thead")
                let tableHeaders = "<tr><th>ID</th><th>County</th><th>subcounty</th><th>Traced</th><th>Date Traced</th><th>Tracer Name</th><th>Tested</th><th>Date Tested</th><th>Outcomes</th><th>Actions</th></tr>"
                thead.innerHTML = tableHeaders
                let tfoot = document.createElement("tfoot")
                tfoot.innerHTML = tableHeaders
                let tbody = document.createElement("tbody")
                table.appendChild(thead)
                table.appendChild(tfoot)
                let tracings = contact.tracings
                let i = 0
                tracings.forEach(tracing => {

                    let row = tbody.insertRow(i)
                    row.insertCell(0).appendChild(document.createTextNode(i + 1));
                    row.insertCell(1).appendChild(document.createTextNode(tracing.countyName));
                    row.insertCell(2).appendChild(document.createTextNode(tracing.subCountyName));
                    row.insertCell(3).appendChild(document.createTextNode(tracing.contactTraced));
                    row.insertCell(4).appendChild(document.createTextNode(tracing.tracingDate));
                    row.insertCell(5).appendChild(document.createTextNode(tracing.tracerName));
                    row.insertCell(6).appendChild(document.createTextNode(tracing.contactTested));
                    row.insertCell(7).appendChild(document.createTextNode(tracing.testingDate));
                    row.insertCell(8).appendChild(document.createTextNode(tracing.testOutcome));
                    let actionsCell = row.insertCell(9);

                    let btnEditContact = document.createElement("a");
                    btnEditContact.setAttribute("href", "#");
                    btnEditContact.setAttribute("data-toggle", "modal");
                    btnEditContact.setAttribute("data-target", "#dialogTracing");
                    btnEditContact.setAttribute("data-tooltip", "tooltip");
                    btnEditContact.setAttribute("title", "Edit Tracing");
                    btnEditContact.setAttribute("data-placement", "bottom");
                    btnEditContact.classList.add("btn");
                    btnEditContact.classList.add("btn-light");
                    btnEditContact.classList.add("btn-circle");
                    btnEditContact.classList.add("btn-sm");
                    btnEditContact.classList.add("app-button");
                    btnEditContact.innerHTML = '<i class="fas fa-edit"></i>';
                    btnEditContact.addEventListener("click", () => {
                        viewedContact = contact.id
                        editTracing(tracing)
                    });


                    let actionDiv = document.createElement("div");
                    actionDiv.classList.add("row");
                    actionDiv.appendChild(btnEditContact);

                    actionsCell.appendChild(actionDiv);


                })
                table.appendChild(tbody)
                tableDiv.appendChild(table)
                collapseDiv.appendChild(tableDiv)
                collapseDiv.appendChild(divButtons)
                divContactCard.appendChild(collapseDiv)
            }
        )
    }

    function editContact(contact) {
        editedContact = contact.id;
        inputFirstName.value = contact.firstName;
        inputMiddleName.value = contact.middleName;
        inputSurname.value = contact.surname;
        inputPhone.value = contact.phoneNumber
    }

    function editTracing(tracing) {
        editedTracing = tracing.id
        if (tracing.county !== '') $(selectCounty).val(tracing.county)
        selectedCountyChange()
        if (tracing.subcounty !== '') $(selectSubCounty).val(tracing.subcounty)
        $(selectContactTraced).val(tracing.contactTraced)
        inputTracingDate.value = tracing.tracingDate
        inputTracerName.value = tracing.tracerName
        $(selectContactTested).val(tracing.contactTested)
        inputTestingDate.value = tracing.testingDate
        $(selectTestOutcome).val(tracing.testOutcome)
        contactTracedChanged()
        contactTestedChanged()
    }

    function clearContactDialog() {
        editedContact = ''
        document.getElementById('formContact').reset()
    }

    function clearTracingDialog() {
        editedTracing = ''
        viewedContact = ''
        document.getElementById('tracingForm').reset()
    }
</script>