<form action="" onsubmit="event.preventDefault();" id="formLinkage">
    <h1 style="text-align: center">Linkage Form</h1>
    <hr>
    <div class="row form-bottom-line">
        <div class="col-xl-6 col-sm-12">
            <div class="form-group">
                <label for="inputWeight">Weight</label>
                <input type="number" min="2" max="150" class="form-control" id="inputWeight" placeholder="Enter Weight" required>
            </div>
            <div class="form-group">
                <label for="inputHeight">Height</label>
                <input type="number" min="10" max="220" class="form-control" id="inputHeight" placeholder="Enter Height" required>
            </div>
            <div class="form-group">
                <label for="inputBmi">BMI</label>
                <input type="number" class="form-control" id="inputBmi" placeholder="BMI" required readonly>
            </div>
        </div>
        <div class="col-xl-6 col-sm-12">
            <div class="form-group">
                <label for="inputLinkageDate">Linkage Date</label>
                <input type="date" class="form-control" id="inputLinkageDate" placeholder=" Enter Date" required>
            </div>
            <div class="form-group">
                <label for="selectLinkageDepartment">Linkage Department</label>
                <select class="form-select" name="selectLinkageDepartment" id="selectLinkageDepartment" required>
                    <option hidden value="">Select value</option>
                </select>
            </div>
            <div class="form-group">
                <label for="inputLinkageNumber">Linkage Number</label>
                <input type="number" class="form-control" id="inputLinkageNumber" placeholder=" Enter Number">
            </div>
        </div>
    </div>
    <hr>
    <div class="row form-bottom-line">
        <div class="col-xl-6 col-sm-12">
            <div class="form-group">
                <label for="selectRegiment">Regiment</label>
                <select class="form-select" name="selectRegiment" id="selectRegiment" required>
                    <option hidden value="">Select Regiment</option>
                </select>
            </div>
            <div class="form-group">
                <label for="selectHivStatus">HIV Status</label>
                <select class="form-select" name="selectHivStatus" id="selectHivStatus" required>
                    <option hidden value="">Select value</option>
                    <option value="Positive">Positive</option>
                    <option value="Negative">Negative</option>
                    <option value="Negative">Unknown</option>
                </select>
            </div>
        </div>
        <div class="col-xl-6 col-sm-12 require_tb d-none">
            <div class="form-group">
                <label for="inputDotManager">DOT Manager</label>
                <input type="text" class="form-control" id="inputDotManager" placeholder="Enter DOT Manager" required>
            </div>
            <div class="form-group require_tb d-none">
                <label for="selectTbType">Type Of TB</label>
                <select class="form-select" name="selectTbType" id="selectTbType" required>
                    <option hidden value="">Select value</option>
                    <option value="PTB">PTB</option>
                    <option value="EPTB">EPTB</option>
                </select>
            </div>
            <div class="form-group require_tb d-none">
                <label for="inputEptbSubtype">EPTB Subtype</label>
                <input type="text" class="form-control" id="inputEptbSubtype" placeholder="EPTB Subtype" required>
            </div>
            <div class="form-group require_tb d-none">
                <label for="selectPatientType">Type Of Patient</label>
                <select class="form-select" name="selectPatientType" id="selectPatientType" required>
                    <option hidden value="">Select Type Of Patient</option>
                </select>
            </div>
            <div class="form-group require_tb d-none">
                <label for="selectCulture">Culture/DST</label>
                <select class="form-select" name="selectCulture" id="selectCulture" required>
                    <option hidden value="">Select Culture/DST</option>
                    <option value="Yes">Yes</option>
                    <option value="Not Applicable">Not Applicable</option>
                    <option value="Done No Results">Done No Results</option>
                    <option value="No Growth">No Growth</option>
                </select>
            </div>
        </div>
    </div>
    <hr>
    <button type="button" class="btn btn-success submit mt-5 mb-5" id="btnSaveForm" onclick="saveLinkage()"><i
                class="fa fa-caret-right" aria-hidden="true"></i> Submit Form
    </button>
</form>

<script>
    var patient_id = null

    const inputWeight = document.getElementById("inputWeight")
    const inputHeight = document.getElementById("inputHeight")
    const inputBmi = document.getElementById("inputBmi")
    const inputLinkageDate = document.getElementById("inputLinkageDate")
    const selectLinkageDepartment = document.getElementById("selectLinkageDepartment")
    const inputLinkageNumber = document.getElementById("inputLinkageNumber")
    const selectRegiment = document.getElementById("selectRegiment")
    const selectHivStatus = document.getElementById("selectHivStatus")
    const inputDotManager = document.getElementById("inputDotManager")
    const selectTbType = document.getElementById("selectTbType")
    const inputEptbSubtype = document.getElementById("inputEptbSubtype")
    const selectPatientType = document.getElementById("selectPatientType")
    const selectCulture = document.getElementById("selectCulture")

    $(document).ready(function () {
        if (localStorage.getItem('checkedInPatient') != null) {
            let patient = JSON.parse(localStorage.getItem('checkedInPatient'))
            patient_id = patient.id
        } else {
            document.getElementById('btnSaveForm').setAttribute('disabled', '')
        }

        $.ajax({
            dataType: "json",
            url: '../assets/data.json',
            success: data => {
                let patient_types = data.patient_types
                patient_types.forEach(patient_type => {
                    let option = document.createElement('option');
                    option.setAttribute('value', patient_type);
                    option.appendChild(document.createTextNode(patient_type));
                    selectPatientType.appendChild(option);
                })
                let linkage_depts = data.linkage_depts
                linkage_depts.forEach(linkage_dept => {
                    let option = document.createElement('option');
                    option.setAttribute('value', linkage_dept);
                    option.appendChild(document.createTextNode(linkage_dept));
                    selectLinkageDepartment.appendChild(option);
                })
            },
            error: err => {
                toastr.error(err.statusText, err.status)
            }
        })
        inputWeight.addEventListener('change', () => writeBmi())
        inputHeight.addEventListener('change', () => writeBmi())
        selectLinkageDepartment.addEventListener('change', () => linkageDepartmentChanged())
    })

    function saveLinkage() {
        ['patient_id', 'weight', 'bmi', 'linkage_date', 'linkage_dept', 'linkage_number', 'dot_manager', 'tb_type', 'eptb_subtype',
            'patient_type', 'culture', 'regiment', 'hiv_status']
        if (patient_id === null) return;

        let weight = inputWeight.value.trim(), height = inputHeight.value.trim(), linkage_date = inputLinkageDate.value,
            linkage_dept = $(selectLinkageDepartment).val(), linkage_number = inputLinkageNumber.value.trim(),
            dot_manager = inputDotManager.value.trim(),
            tb_type = $(selectTbType).val(),
            eptb_subtype = inputEptbSubtype.value.trim(), patient_type = $(selectPatientType).val(),
            culture = $(selectCulture).val(),
            regiment = $(selectRegiment).val(), hiv_status = $(selectHivStatus).val(), errorMsg = ''

        if (isNaN(weight) || isNaN(height)) {
            errorMsg += "Enter valid values for weight and height \n"
        } else {
            if((weight <= 1 || weight > 150) || height < 10 || height > 220){
                errorMsg += "Enter valid values for weight and height 2<w<150 10<h<220 \n"
            }
        }
        if (linkage_date === '') errorMsg += "Enter a valid value for linkage date \n"
        if (linkage_dept === '') {
            errorMsg += "Enter a valid value for linkage department \n"
        } else if (linkage_dept === 'TB Clinic' || linkage_dept === 'CCC Clinic') {
            if (linkage_number === '') errorMsg += "Linkage number is required for TB and CCC departments"
        }
        if (dot_manager === "") errorMsg += "Enter DOT Manager"
        if (tb_type === "") errorMsg += "Enter TB Type"
        if (eptb_subtype === "") errorMsg += "Enter EPTB Subtype"
        if (patient_type === "") errorMsg += "Select a valid patient type"
        if (hiv_status === "") errorMsg += "Select a valid HIV Status"
        // if (regiment === "") errorMsg += "Select a valid regiment"
        if (errorMsg !== "") {
            toastr.error(errorMsg)
            return;
        }
        let formData = new FormData()
        formData.append('patient_id', patient_id)
        formData.append('weight', weight)
        formData.append('height', height)
        formData.append('linkage_date', linkage_date)
        formData.append('linkage_dept', linkage_dept)
        formData.append('linkage_number', linkage_number)
        formData.append('dot_manager', dot_manager)
        formData.append('tb_type', tb_type)
        formData.append('eptb_subtype', eptb_subtype)
        formData.append('patient_type', patient_type)
        formData.append('culture', culture)
        formData.append('regiment', regiment)
        formData.append('hiv_status', hiv_status)
        $.ajax({
            url: 'link_patient',
            type: 'POST',
            cache: false,
            processData: false,
            contentType: false,
            data: formData,
            success: response => {
                toastr.success("Linkage saved successfully.")
                document.getElementById('formLinkage').reset()
            },
            error: err => {
                toastr.error(err.statusText, err.status)
            }
        })
    }

    function writeBmi() {
        let height = inputHeight.value.trim(), weight = inputWeight.value.trim();
        if (isNaN(height) || isNaN(weight)) return
        if (height <= 0) return
        let bmi = weight / ((height / 100) * (height / 100))
        inputBmi.value = bmi.toFixed(2)
    }

    function linkageDepartmentChanged(){
        let selected = $(selectLinkageDepartment).val()
        let dependables = document.querySelectorAll('.require_tb')
        if (selected === 'TB Clinic' || selected === 'CCC Clinic') {
            inputLinkageNumber.hasAttribute("required") || inputLinkageNumber.setAttribute('required', '')
            if(selected === 'TB Clinic'){
                for (let i = 0; i < dependables.length; i++) {
                    let div = dependables[i]
                    div.classList.contains("d-none") ? div.classList.remove("d-none") : ''
                    let select = div.querySelector('select')

                }
            } else{
                for (let i = 0; i < dependables.length; i++) {
                    let div = dependables[i]
                    div.classList.contains("d-none") ? '' : div.classList.add("d-none")
                    let select = div.querySelector('select')
                    if (select != null) $(select).val('')
                    let input = div.querySelector('input')
                    if (input != null) input.value = ''
                }
            }
        } else {
            inputLinkageNumber.removeAttribute('required')
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

</script>
