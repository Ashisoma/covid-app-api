<form action="" onsubmit="event.preventDefault();" id="formPatientManagement">
    <h1 style="text-align: center">Patient Management Form</h1>
    <hr>
    <div class="row form-bottom-line">
        <div class="col-xl-6 col-sm-12">

            <div class="form-group">
                <label for="inputOnsetDate">Date of onset of symptoms</label>
                <input type="date" class="form-control" id="inputOnsetDate" required>
            </div>
            <div class="form-group">
                <label for="selectHospitalAdmitted">Admitted to hospital</label>
                <select class="form-control" name="selectHospitalAdmitted" id="selectHospitalAdmitted" required>
                    <option hidden value="">Select</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>
            <div class="row d-none" id="divAdmitted">
                <label for="">Specify</label>
                <div class="form-group col-5">
                    <label for="inputAdmissionDate">Date of admission</label>
                    <input type="date" class="form-control" id="inputAdmissionDate" placeholder=" Enter Temperature" required>
                </div>
                <div class="form-group col-7">
                    <label for="selectFacility">Select Hospital</label>
                    <select class="form-control" name="selectFacility" id="selectFacility" required>
                        <option hidden value="">Select Facility</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="selectIsolated">Taken To Isolation</label>
                <select class="form-control" name="selectIsolated" id="selectIsolated">
                    <option hidden value="">Select</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>
            <div class="form-group d-none" id="divIsolated">
                <label for="inputDateIsolated">Date of Isolation</label>
                <input type="date" class="form-control" id="inputDateIsolated" placeholder=" Enter Temperature" required>
            </div>
            <div class="form-group">
                <label for="selectIcuAdmitted">Patient Admitted to ICU</label>
                <select class="form-control" name="selectIcuAdmitted" id="selectIcuAdmitted">
                    <option hidden value="">Select</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>
        </div>

        <div class="col-xl-6 col-sm-12">
            <div class="form-group">
                <label for="selectVentilated">Patient Ventilated</label>
                <select class="form-control" name="selectVentilated" id="selectVentilated">
                    <option hidden value="">Select</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>
            <div class="form-group">
                <label for="selectHealthStatus">Health Status(At time of Reporting)</label>
                <select class="form-control" name="selectHealthStatus" id="selectHealthStatus">
                    <option hidden value="">Select</option>
                    <option value="Stable">Stable</option>
                    <option value="Untable">Unstable</option>
                </select>
            </div>
            <div class="form-group">
                <label for="selectOutcome">Outcome</label>
                <select class="form-control" name="selectOutcome" id="selectOutcome" required>
                    <option hidden value="">Select</option>
                    <option value="Discharged">Discharged</option>
                    <option value="Death">Death</option>
                </select>
            </div>
            <div class="form-group">
                <label for="inputOutcomeDate">Date of Outcomes</label>
                <input type="date" class="form-control" id="inputOutcomeDate" placeholder=" Enter Temperature" required>
            </div>
            <div class="form-group">
                <label for="selectSymptomsResolved">Symptoms Resolved</label>
                <select class="form-control" name="selectSymptomsResolved" id="selectSymptomsResolved" required>
                    <option hidden value="">Select</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>
            <div class="form-group d-none" id="divResolved">
                <label for="inputDateResolved">Date symptoms resolution</label>
                <input type="date" class="form-control" id="inputDateResolved" placeholder=" Enter Temperature" required>
            </div>

        </div>

    </div>

    <hr>
    <button type="button" id="btnSaveForm" class="btn btn-success submit mt-2 mb-5"><i class="fa fa-paper-plane" aria-hidden="true"></i> Submit Form</button>
</form>

<script>
    const inputOnsetDate = document.getElementById("inputOnsetDate")
    const selectHospitalAdmitted = document.getElementById("selectHospitalAdmitted")
    const inputAdmissionDate = document.getElementById("inputAdmissionDate")
    const selectFacility = document.getElementById("selectFacility")
    const selectIsolated = document.getElementById("selectIsolated")
    const inputDateIsolated = document.getElementById("inputDateIsolated")
    const selectIcuAdmitted = document.getElementById("selectIcuAdmitted")
    const selectVentilated = document.getElementById("selectVentilated")
    const selectHealthStatus = document.getElementById("selectHealthStatus")
    const selectOutcome = document.getElementById("selectOutcome")
    const inputOutcomeDate = document.getElementById("inputOutcomeDate")
    const selectSymptomsResolved = document.getElementById("selectSymptomsResolved")
    const inputDateResolved = document.getElementById("inputDateResolved")
    
    var patient_id = null
    var facilities = []
    $(document).ready(function() {
        if (localStorage.getItem('checkedInPatient') != null) {
            let patient = JSON.parse(localStorage.getItem('checkedInPatient'))
            patient_id = patient.id
        } else {
            document.getElementById('btnSaveForm').setAttribute('disabled', '')
        }

        selectHospitalAdmitted.addEventListener("change", () => hospitalAdmittedChanged())
        selectIsolated.addEventListener("change", () => isolatedChanged())
        selectSymptomsResolved.addEventListener("change", () => symptomsResolvedChanged())
        document.getElementById("btnSaveForm").addEventListener("click", () => save())

        $.ajax({
            type: "GET",
            url: 'get_facilities',
            success: response => {
                facilities = JSON.parse(response)
                facilities.forEach(facility => {
                    let option = document.createElement('option');
                    option.setAttribute('value', facility.mflCode);
                    option.appendChild(document.createTextNode(facility.name));
                    selectFacility.appendChild(option);
                })
            },
            error: err => {
                toastr.error("Unable to load data")
            }
        })
    })

    function save() {
        let symptoms_onset_date = inputOnsetDate.value,
        admitted_to_hospital = $(selectHospitalAdmitted).val(),
        facility_code = $(selectFacility).val(),
        date_admitted = inputAdmissionDate.value,
        isolated = $(selectIsolated).val(),
        date_isolated = inputDateIsolated.value,
        admitted_to_icu = $(selectIcuAdmitted).val(),
        ventilated = $(selectVentilated).val(),
        health_status = $(selectHealthStatus).val(),
        outcome = $(selectOutcome).val(),
        outcome_date = inputOutcomeDate.value,
        symptoms_resolved = $(selectSymptomsResolved).val(),
        date_resolved = inputDateResolved.value
// TODO Test data validity

        let formData = new FormData();
        formData.append("patient_id", patient_id)
        formData.append("symptoms_onset_date", symptoms_onset_date)
        formData.append("admitted_to_hospital", admitted_to_hospital)
        formData.append("facility_code", facility_code)
        formData.append("date_admitted", date_admitted)
        formData.append("isolated", isolated)
        formData.append("date_isolated", date_isolated)
        formData.append("admitted_to_icu", admitted_to_icu)
        formData.append("ventilated", ventilated)
        formData.append("health_status", health_status)
        formData.append("outcome", outcome)
        formData.append("outcome_date", outcome_date)
        formData.append("symptoms_resolved", symptoms_resolved)
        formData.append("date_resolved", date_resolved)

        $.ajax({
            type: "POST",
            url: "savePatientManagement",
            cache: false,
            processData: false,
            contentType: false,
            data: formData,
            success: response => {
                toastr.success("Saved successfully")
                clearForm()
            },
            error: err => {
                toastr.error("Error encountered while saving form")
            }
        })
    }

    function hospitalAdmittedChanged() {
        let selected = $(selectHospitalAdmitted).val()
        if (selected === "Yes") {
            document.getElementById('divAdmitted').classList.remove('d-none')
        } else {
            document.getElementById('divAdmitted').classList.add('d-none')
        }
    }

    function isolatedChanged() {
        let selected = $(selectIsolated).val()
        if (selected === "Yes") {
            document.getElementById('divIsolated').classList.remove('d-none')
        } else {
            document.getElementById('divIsolated').classList.add('d-none')
        }
    }

    function symptomsResolvedChanged() {
        let selected = $(selectSymptomsResolved).val()
        if (selected === "Yes") {
            document.getElementById('divResolved').classList.remove('d-none')
        } else {
            document.getElementById('divResolved').classList.add('d-none')
        }
    }

    function clearForm() {
        document.getElementById('formPatientManagement').reset()
        hospitalAdmittedChanged()
        isolatedChanged()
        symptomsResolvedChanged()
    }
</script>