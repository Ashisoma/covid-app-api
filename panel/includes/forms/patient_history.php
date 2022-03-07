<form action="" onsubmit="event.preventDefault();" id="formHistory">
    <h1 style="text-align: center">Patient History</h1>
    <hr>
    <div class="row form-bottom-line">
        <div class="col-xl-6 col-sm-12">
            <div class="form-group">
                <label for="selectTravelled">Has the patient travelled in the 14 days prior to symptom onset?</label>
                <select class="form-select" name="selectTravelled" id="selectTravelled">
                    <option hidden value="">Select</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>
            <div id="divPlacesTravelled" class="form-group d-none">
                <label for="inputPlacesTravelled">Please specify the places the patient travelled</label>
                <textarea class="form-control" name="inputPlacesTravelled" id="inputPlacesTravelled" cols="30"></textarea>
            </div>
            <div id="divContact" class="form-group">
                <label for="selectContact">Had close contact with a person with acute respiratory?</label>
                <select class="form-select" name="selectContact" id="selectContact">
                    <option hidden value="">Select</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>
            <div class="form-group d-none" id="divContactSetting">
                <label for="inputContactSetting">Specify contact setting</label>
                <input type="text" class="form-control" placeholder="Enter Value" name="inputContactSetting" id="inputContactSetting" />
            </div>
        </div>
        <div class="col-xl-6 col-sm-12">
            <div class="form-group">
                <label for="selectVaccinated">Vaccinated</label>
                <select class="form-select" name="selectVaccinated" id="selectVaccinated">
                    <option hidden value="">Select</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>
            <div class="form-group require_vaccinated d-none">
                <label for="inputFirstDoseDate">Date of First Dose</label>
                <input type="date" class="form-control" placeholder="Enter Value" name="inputFirstDoseDate" id="inputFirstDoseDate" />
            </div>
            <div class="form-group require_vaccinated d-none">
                <label for="selectFirstDose">First Dose Vaccine Name</label>
                <select class="form-select" name="selectFirstDose" id="selectFirstDose">
                    <option hidden value="">Select Vaccine</option>
                </select>
            </div>
            <div class="form-group require_vaccinated d-none">
                <label for="inputSecondDoseDate">Date of Second Dose</label>
                <input type="date" class="form-control" placeholder="Enter Value" name="inputSecondDoseDate" id="inputSecondDoseDate" />
            </div>
            <div class="form-group require_vaccinated d-none">
                <label for="selectSecondDose">Second Dose Vaccine Name</label>
                <select class="form-select" name="selectSecondDose" id="selectSecondDose">
                    <option hidden value="">Select Vaccine</option>
                </select>
            </div>
        </div>
    </div>

    <hr>
    <button type="button" id="btnSaveForm" class="btn btn-success submit mt-2 mb-5" onclick="saveHistory();"><i class="fa fa-paper-plane" aria-hidden="true"></i> Save</button>
    
</form>

<script>
    const selectTravelled = document.getElementById("selectTravelled")
    const inputPlacesTravelled = document.getElementById("inputPlacesTravelled")
    const selectContact = document.getElementById("selectContact")
    const inputContactSetting = document.getElementById("inputContactSetting")
    const selectVaccinated = document.getElementById("selectVaccinated")
    const inputFirstDoseDate = document.getElementById("inputFirstDoseDate")
    const selectFirstDose = document.getElementById("selectFirstDose")
    const inputSecondDoseDate = document.getElementById("inputSecondDoseDate")
    const selectSecondDose = document.getElementById("selectSecondDose")

    var patient_id = null

    $(document).ready(function() {
        if (localStorage.getItem('checkedInPatient') != null) {
            let patient = JSON.parse(localStorage.getItem('checkedInPatient'))
            patient_id = patient.id
        } else {
            document.getElementById('btnSaveForm').setAttribute('disabled', '')
        }
        selectVaccinated.addEventListener('change', () => vaccinatedChanged())
        selectContact.addEventListener('change', () => closeContactChanged())
        selectTravelled.addEventListener('change', () => travelledChanged())
        $.ajax({
            type: "GET",
            url: "vaccines",
            success: response => {
                let vaccines = JSON.parse(response)
                vaccines.forEach(vaccine => {
                    let option = document.createElement('option');
                    option.setAttribute('value', vaccine.id);
                    option.appendChild(document.createTextNode(vaccine.name));
                    selectFirstDose.appendChild(option);
                    selectSecondDose.appendChild(option.cloneNode(true));
                })
            },
            error: err => {
                toastr.error(err.statusText, err.status)
            }
        })
    })

    function saveHistory() {
        if (patient_id === null) return;
        let travelled = $(selectTravelled).val(),
            places_travelled = inputPlacesTravelled.value.trim(),
            contact_with_infected = $(selectContact).val(),
            contact_setting = inputContactSetting.value.trim(),
            vaccinated = $(selectVaccinated).val(),
            first_dose = $(selectFirstDose).val(),
            first_dose_date = inputFirstDoseDate.value.trim(),
            second_dose = $(selectSecondDose).val(),
            second_dose_date = inputSecondDoseDate.value.trim();

        let errorMessage = ''
        if(travelled === '') errorMessage += "Select a valid option for travelling. \n"
        else if(travelled === "Yes"){
            if (places_travelled === '') errorMessage += "Specify the places travelled. \n"
        }
        if(contact_with_infected === '') errorMessage += "Select a valid option for contact with infected. \n"
        else if(contact_with_infected === "Yes"){
            if (places_travelled === '') errorMessage += "Specify the contact setting. \n"
        }
        if(errorMessage !== '') {
            toastr.error(errorMessage)
            return;
        }
        $.ajax({
            type: "POST",
            url: "savePatientHistory",
            data: {
                patient_id: patient_id,
                travelled: travelled,
                places_travelled: places_travelled,
                contact_with_infected: contact_with_infected,
                contact_setting: contact_setting,
                vaccinated: vaccinated,
                first_dose: first_dose,
                first_dose_date: first_dose_date,
                second_dose: second_dose,
                second_dose_date: second_dose_date
            },
            success: response => {
                toastr.success("Patient history saved successfully");
                clearHistoryForm()
            },
            error: err => {
                toastr.error(err.statusText, err.status)
            }
        })
    }

    function vaccinatedChanged() {
        let selected = $(selectVaccinated).val()
        let dependables = document.querySelectorAll('.require_vaccinated')
        if (selected === "Yes") {
            for (let i = 0; i < dependables.length; i++) {
                let div = dependables[i]
                div.classList.contains("d-none") ? div.classList.remove("d-none") : ''
                let select = div.querySelector('select')
                
            }
        } else {
            for (let i = 0; i < dependables.length; i++) {
                let div = dependables[i]
                div.classList.contains("d-none") ? '' : div.classList.add("d-none")
                let select = div.querySelector('select')
                if (select != null) $(select).val('')
                let input = div.querySelector('input')
                if (input != null) input.value = ''
            }
        }
    }

    function closeContactChanged(){
        let selected = $(selectContact).val()
        let divContactSetting = document.getElementById('divContactSetting')
        if (selected === 'Yes'){
            divContactSetting.classList.remove('d-none')
        } else {
            divContactSetting.classList.contains('d-none') ||divContactSetting.classList.add('d-none')
            inputContactSetting.value = ''
        }
    }

    function travelledChanged(){
        let selected = $(selectTravelled).val()
        let divPlacesTravelled = document.getElementById('divPlacesTravelled')
        if (selected === 'Yes'){
            divPlacesTravelled.classList.remove('d-none')
        } else {
            divPlacesTravelled.classList.contains('d-none') ||divPlacesTravelled.classList.add('d-none')
            inputPlacesTravelled.value = ''
        }
    }

    function clearHistoryForm() {
        document.getElementById('formHistory').reset()
    }
</script>