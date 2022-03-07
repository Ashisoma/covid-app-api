<form onsubmit="event.preventDefault();">
    <h1 style="text-align: center">Patient Registration Form</h1>
    <hr>
    <h4>Facility Information</h4>
    <div class="row form-bottom-line">
        <div class="col-xl-6 col-sm-12">
            <div class="form-group">
                <label for="selectFacility">Select Facility</label>
                <select class="form-select" name="selectFacility" id="selectFacility" required>
                    <option hidden value="">Select Facility</option>
                </select>
            </div>

        </div>
        <div class="col-xl-6 col-sm-12">
            <div class="form-group">
                <label for="inputMflCode">Facility MFL Code</label>
                <input type="text" class="form-control" id="inputMflCode" placeholder="Facility mfl code" disabled>
            </div>
        </div>
    </div>
    <h4>Basic Information</h4>
    <div class="row form-bottom-line">
        <div class="col-xl-6 col-sm-12">
            <div class="row">
                <div class="form-group col-6">
                    <label for="inputFirstName">First name</label>
                    <input type="text" class="form-control" id="inputFirstName" placeholder=" Enter First name"
                           required>
                </div>
                <div class="form-group col-6">
                    <label for="inputMiddleName">Middle name</label>
                    <input type="text" class="form-control" id="inputMiddleName" placeholder=" Enter Middle name">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-6">
                    <label for="inputSurname">Surname</label>
                    <input type="text" class="form-control" id="inputSurname" placeholder=" Enter surname" required>
                </div>
                <div class="form-group col-6"><label>Gender</label>
                    <select id="selectGender" class="form-select" required>
                        <option hidden value="">Select gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Intersex">Intersex</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-9">
                    <label for="inputDob">Date of birth</label>
                    <input type="date" class="form-control" id="inputDob" placeholder=" Enter Date of birth" required>
                </div>
                <div class="form-group col-3">
                    <label for="inputAge">Age(Years)</label>
                    <input type="text" class="form-control" id="inputAge" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="selectSource">Patient Department</label>
                <select class="form-select" name="selectSource" id="selectSource" required>
                    <option hidden value="">Select Source</option>
                </select>
            </div>

        </div>
        <div class="col-xl-6 col-sm-12">
            <div class="form-group">
                <label for="inputGuardianId">Guardian Name</label>
                <input type="text" class="form-control" id="inputGuardianName" placeholder=" Enter Guardian Name">
            </div>
            <div class="form-group">
                <label for="inputGuardianId">Guardian ID</label>
                <input type="number" class="form-control" id="inputGuardianId" placeholder=" Enter Guardian ID">
            </div>
            <div class="form-group">
                <label for="selectCitizenship">Citizenship</label>
                <select class="form-select" name="selectCitizenship" id="selectCitizenship" required>
                    <option hidden value="">Select Citizenship</option>
                </select>
            </div>
            <div class="form-group">
                <label for="inputNationalId">National ID</label>
                <input type="number" class="form-control" id="inputNationalId" placeholder=" Enter National Id">
            </div>

        </div>

    </div>
    <hr>
    <h4>Contact Information</h4>
    <div class="row form-bottom-line">
        <div class="col-xl-6 col-sm-12">
            <div class="form-group">
                <label for="inputPhone">Phone number</label>
                <input type="text" class="form-control" id="inputPhone" placeholder="07/01********" required>
            </div>
        </div>
        <div class="col-xl-6 col-sm-12">
            <div class="form-group">
                <label for="inputNokName">Next Of Kin Name</label>
                <input type="text" class="form-control" id="inputNokName" placeholder=" Enter Next Of Kin Name">
            </div>
        </div>
        <div class="col-xl-6 col-sm-12">
            <div class="form-group">
                <label for="inputNokPhone">Next Of Kin Phone</label>
                <input type="text" class="form-control" id="inputNokPhone" placeholder=" Enter Next Of Kin Phone">
            </div>
        </div>
    </div>
    <hr>
    <h4>Place of residence</h4>
    <div class="row form-bottom-line">
        <div class="col-xl-6 col-sm-12">
            <div class="row">
                <div class="form-group col-6">
                    <label for="selectCounty">County</label>
                    <select class="form-select" name="selectCounty" id="selectCounty" required>
                        <option hidden value="">Select County</option>
                    </select>
                </div>
                <div class="form-group col-6">
                    <label for="selectSubCounty">Sub-County</label>
                    <select class="form-select" name="select SubCounty" id="selectSubCounty" required>
                        <option hidden value="">Select Sub-County</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-sm-12">
            <div class="form-group">
                <label for="inputLandmark">Physical address / Landmark</label>
                <input type="text" class="form-control" id="inputLandmark" placeholder="Physical address / Landmark"
                       required>
            </div>
        </div>
    </div>
    <hr>

    <div class="row form-bottom-line">
        <div class="col-xl-6 col-sm-12">
            <div class="form-group">
                <label for="selectEducationLevel">Select Level of Education</label>
                <select class="form-select" name="selectEducationLevel" id="selectEducationLevel">
                    <option hidden value="">Select Education level</option>
                </select>
            </div>
        </div>
        <div class="col-xl-6 col-sm-12">
            <div class="form-group">
                <label for="selectMaritalStatus">Select Marital Status</label>
                <select class="form-control" name="selectMaritalStatus" id="selectMaritalStatus">
                    <option hidden value="">Select marital status</option>
                </select>
            </div>
        </div>
        <div class="col-xl-6 col-sm-12">
            <div class="form-group">
                <label for="inputOccupation">Enter Occupation</label>
                <input type="text" class="form-control" id="inputOccupation" placeholder=" Enter Occupation">
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xl-6 col-sm-12">
            <div class="form-group">
                <label for="selectCaseAlive">Is the case alive?</label>
                <select class="form-select" name="selectCaseAlive" id="selectCaseAlive">
                    <option hidden value="">Select</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>
        </div>
        <div class="col-xl-6 col-sm-12">
            <div class="form-group">
                <label for="selectCaseLocation">Place where the case was investigated</label>
                <select class="form-select" name="selectCaseAlive" id="selectCaseLocation">
                    <option hidden value="">Select Case location</option>
                </select>
            </div>
            <div class="form-group d-none" id="divInvestigatingFacility">
                <label for="selectFacility">Select Facility</label>
                <select class="form-select" name="selectInvestigatingFacility" id="selectInvestigatingFacility"
                        required>
                    <option hidden value="">Select Facility</option>
                </select>
            </div>
        </div>

    </div>
    <hr>
    <button type="button" class="btn btn-success submit mt-5 mb-5" onclick="savePatient()"><i class="fa fa-caret-right"
                                                                                              aria-hidden="true"></i>
        Submit Form
    </button>

</form>

<script>
    const selectFacility = document.getElementById("selectFacility")
    const inputMflCode = document.getElementById("inputMflCode")
    const inputFirstName = document.getElementById("inputFirstName")
    const inputMiddleName = document.getElementById("inputMiddleName")
    const inputSurname = document.getElementById("inputSurname")
    const inputDob = document.getElementById("inputDob")
    const inputAge = document.getElementById("inputAge")
    const selectCounty = document.getElementById("selectCounty")
    const selectGender = document.getElementById("selectGender")
    const selectSubCounty = document.getElementById("selectSubCounty")
    const inputGuardianName = document.getElementById("inputGuardianName")
    const inputGuardianId = document.getElementById("inputGuardianId")
    const selectCitizenship = document.getElementById("selectCitizenship")
    const inputNationalId = document.getElementById("inputNationalId")
    const inputPhone = document.getElementById("inputPhone")
    const selectEducationLevel = document.getElementById("selectEducationLevel")
    const selectMaritalStatus = document.getElementById("selectMaritalStatus")
    const selectCaseAlive = document.getElementById("selectCaseAlive")
    const selectCaseLocation = document.getElementById("selectCaseLocation")
    const inputOccupation = document.getElementById("inputOccupation")
    const inputNokName = document.getElementById("inputNokName")
    const inputNokPhone = document.getElementById("inputNokPhone")
    const selectSource = document.getElementById("selectSource")
    const inputLandmark = document.getElementById("inputLandmark")
    const selectInvestigatingFacility = document.getElementById("selectInvestigatingFacility")

    var counties = []
    var facilities = []


    $(document).ready(function () {
        selectCounty.addEventListener("change", event => {
            selectedCountyChange()
        })
        let i = 0
        selectFacility.addEventListener("change", () => facilitySelectedChanged())
        inputDob.addEventListener("change", () => dobChanged())
        selectCaseLocation.addEventListener('change', () => caseLocationChanged())
        $.ajax({
            dataType: "json",
            url: '../assets/data.json',
            success: data => {
                let nationalities = data.nationalities
                i++
                nationalities.forEach(nationality => {
                    let option = document.createElement('option');
                    option.setAttribute('value', nationality);
                    option.appendChild(document.createTextNode(nationality));
                    selectCitizenship.appendChild(option);
                })
                let educationLevels = data.education_levels
                educationLevels.forEach(educationLevel => {
                    let option = document.createElement('option');
                    option.setAttribute('value', educationLevel);
                    option.appendChild(document.createTextNode(educationLevel));
                    selectEducationLevel.appendChild(option);
                })
                let maritalStatuses = data.marital_statuses
                maritalStatuses.forEach(maritalStatus => {
                    let option = document.createElement('option');
                    option.setAttribute('value', maritalStatus);
                    option.appendChild(document.createTextNode(maritalStatus));
                    selectMaritalStatus.appendChild(option);
                })
                let casePlaces = data.case_places
                casePlaces.forEach(casePlace => {
                    let option = document.createElement('option');
                    option.setAttribute('value', casePlace);
                    option.appendChild(document.createTextNode(casePlace));
                    selectCaseLocation.appendChild(option);
                })
                let patientSources = data.patient_sources
                patientSources.forEach(source => {
                    let option = document.createElement('option');
                    option.setAttribute('value', source);
                    option.appendChild(document.createTextNode(source));
                    selectSource.appendChild(option);
                })
                loadCheckedInPatient(i)
            },
            error: err => {

            }
        })
        $.ajax({
            type: "GET",
            url: "counties_data",
            success: response => {
                var mResponse = JSON.parse(response);
                let code = mResponse.code;
                if (code == 200) {
                    i++
                    counties = mResponse.data;
                    for (let i = 0; i < counties.length; i++) {
                        let county = counties[i];
                        let option = document.createElement('option');
                        option.setAttribute('value', county.code);
                        option.appendChild(document.createTextNode(county.name));
                        selectCounty.appendChild(option);
                    }
                    loadCheckedInPatient(i);
                } else {
                    var error = [];
                    error.status = code;
                    error.message = mResponse.message;
                    toastr.error("Unable to load data")
                }
            },
            error: err => {
                toastr.error("Unable to load data")
            }
        })
        $.ajax({
            type: "GET",
            url: 'get_facilities',
            success: response => {
                facilities = JSON.parse(response)
                i++
                facilities.forEach(facility => {
                    let option = document.createElement('option');
                    option.setAttribute('value', facility.mflCode);
                    option.appendChild(document.createTextNode(facility.name));
                    selectFacility.appendChild(option);
                    selectInvestigatingFacility.appendChild(option.cloneNode(true));
                })
                loadCheckedInPatient()
            },
            error: err => {
                toastr.error("Unable to load data")
            }
        })
    })

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

    function facilitySelectedChanged() {
        let selected = $(selectFacility).val();
        facilities.forEach(facility => {
            if (selected == facility.mflCode) {
                inputMflCode.value = facility.mflCode
            }
        })
    }

    function caseLocationChanged() {
        let selected = $(selectCaseLocation).val()
        if (selected === 'Health Facility') {
            document.getElementById('divInvestigatingFacility').classList.remove('d-none')
        } else {
            document.getElementById('divInvestigatingFacility').classList.add('d-none')
            $(selectInvestigatingFacility).val('')
        }
    }

    function dobChanged() {
        let dob = inputDob.value
        if (dob !== '') {
            inputAge.value = calculateAge(dob)
        } else inputAge.value = ""
    }

    function savePatient() {
        let id = ''
        if (localStorage.getItem('checkedInPatient') != null) {
            let patient = JSON.parse(localStorage.getItem('checkedInPatient'))
            id = patient.id
        }
        let facility = $(selectFacility).val()
        let firstName = inputFirstName.value.trim();
        let secondName = inputMiddleName.value.trim();
        let surname = inputSurname.value.trim();
        let nationalID = inputNationalId.value.trim();
        let guardianID = inputGuardianId.value.trim();
        let guardianName = inputGuardianName.value.trim();
        let phone = inputPhone.value.trim();
        let occupation = inputOccupation.value.trim();
        let citizenship = $(selectCitizenship).val()
        let gender = selectGender.options[selectGender.selectedIndex].value
        let maritalStatus = $(selectMaritalStatus).val()
        let educationLevel = $(selectEducationLevel).val()
        let dob = inputDob.value.trim();
        let alive = $(selectCaseAlive).val()
        let caseLocation = $(selectCaseLocation).val()
        let county = $(selectCounty).val()
        let subCounty = $(selectSubCounty).val()
        let nokName = inputNokName.value.trim();
        let department = $(selectSource).val()
        let landmark = inputLandmark.value.trim()
        let nokPhone = inputNokPhone.value.trim();
        let investigatingFacility = $(selectInvestigatingFacility).val()
        let errorMsg = ''
        if (facility === "") errorMsg += "Select facility. \n"
        if (firstName === "") errorMsg += "Enter first name. \n"
        if (surname === "") errorMsg += "Enter surname. \n"
        if (dob === "") errorMsg += "Enter date of birth. \n"
        if (phone.length < 10) errorMsg += "Enter a valid phone. \n"
        if (citizenship === '') errorMsg += "Select a valid citizenship. \n"
        if (gender === '') errorMsg += "Select a valid gender. \n"
        if (county === '') errorMsg += "Select a valid county. \n"
        if (subCounty === '') errorMsg += "Select a valid sub county. \n"
        if (landmark.length < 10) errorMsg += "Enter a valid landmark. \n"
        if (department === '') errorMsg += "Select a valid patient department. \n"
        if (errorMsg !== "") {
            toastr.error(errorMsg)
            return
        }
        let data = new FormData();
        data.append('id', id)
        data.append('facility', facility)
        data.append('firstName', firstName)
        data.append('secondName', secondName)
        data.append('surname', surname)
        data.append('nationalID', nationalID)
        data.append('guardianID', guardianID)
        data.append('guardianName', guardianName)
        data.append('phone', phone)
        data.append('occupation', occupation)
        data.append('citizenship', citizenship)
        data.append('gender', gender)
        data.append('maritalStatus', maritalStatus)
        data.append('educationLevel', educationLevel)
        data.append('dob', dob)
        data.append('alive', alive)
        data.append('caseLocation', caseLocation)
        data.append('county', county)
        data.append('subCounty', subCounty)
        data.append('nokName', nokName)
        data.append('department', department)
        data.append('landmark', landmark)
        data.append('nokPhone', nokPhone)
        data.append('investigatingFacility', investigatingFacility)

        $.ajax({
            type: "POST",
            url: 'save_patient',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: () => {
                toastr.success("Patient Information saved successfully")
            },
            error: err => {
                toastr.error("Unable to process your request. ", err.statusText)
            }
        })

    }

    function loadCheckedInPatient(i) {
        if (localStorage.getItem('checkedInPatient') != null && i === 3) {
            let patient = JSON.parse(localStorage.getItem('checkedInPatient'))
            $(selectFacility).val(patient.facility);
            inputMflCode.value = patient.facility
            inputFirstName.value = patient.firstName
            inputMiddleName.value = patient.secondName
            inputSurname.value = patient.surname
            inputDob.value = patient.dob
            $(selectCounty).val(patient.county)
            selectedCountyChange()
            $(selectGender).val(patient.gender)
            $(selectSubCounty).val(patient.subCounty)
            inputGuardianName.value = patient.guardianName
            inputGuardianId.value = patient.guardianID
            $(selectCitizenship).val(patient.citizenship)
            inputNationalId.value = patient.nationalID
            inputPhone.value = patient.phone
            $(selectEducationLevel).val(patient.educationLevel)
            $(selectMaritalStatus).val(patient.maritalStatus)
            $(selectCaseAlive).val(patient.alive)
            $(selectCaseLocation).val(patient.caseLocation)
            caseLocationChanged()
            $(selectInvestigatingFacility).val(patient.investigatingFacility)
            $(selectSource).val(patient.department)
            inputOccupation.value = patient.occupation
            inputNokName.value = patient.nokName
            inputNokPhone.value = patient.nokPhone
            inputLandmark.value = patient.landmark
            dobChanged()
        }
    }
</script>