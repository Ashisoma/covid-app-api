<form action="" onsubmit="event.preventDefault();" id="formLabRequest">
    <h1 style="text-align: center">Lab Request Form</h1>
    <hr>
    <div class="row form-bottom-line">
        <div class="col-xl-6 col-sm-12">

            <div class="form-group">
                <label for="selectSpecimenCollected">Specimen Collected?</label>
                <select class="form-select" name="selectSpecimenCollected" id="selectSpecimenCollected" required>
                    <option hidden value="">Select value</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>
            <div class="form-group">
                <label for="inputReasonNotCollected">if no (reason)</label>
                <textarea class="form-control" id="inputReasonNotCollected" placeholder=" Enter Reason Not collected "
                          disabled></textarea>
            </div>
            <div class="form-group">
                <label for="inputDateCollected">Date Specimen collected</label>
                <input type="date" class="form-control" id="inputDateCollected" placeholder=" Enter Date" required>
            </div>
        </div>

        <div class="col-xl-6 col-sm-12">

            <div class="form-group">
                <label for="inputDateSentToLab">Date Sent To Lab</label>
                <input type="date" class="form-control" id="inputDateSentToLab" placeholder=" Enter Date" required>
            </div>
            <div class="row">
                <label class="col-6">Test Type</label>
                <label class="col-6">Specimen Type</label>
            </div>

            <div id="divTestTypesCheck">
                <div class="row">
                    <div class="col-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="checkbox" id="checkboxOne"
                                   value="NP Swab">
                            <label class="form-check-label" for="checkboxOne">Test Type</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <select class="form-select" name="select1" id="select1">
                            <option value="">Select a specimen type</option>
                        </select>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <hr>
    <button type="button" id="btnSaveForm" class="btn btn-success submit mt-2 mb-5" onclick="saveLabRequest();"><i
                class="fa fa-play" aria-hidden="true"></i> Submit Form
    </button>
</form>

<script>
    const selectSpecimenCollected = document.getElementById('selectSpecimenCollected')
    const inputReasonNotCollected = document.getElementById('inputReasonNotCollected')
    const inputDateCollected = document.getElementById('inputDateCollected')
    const inputDateSentToLab = document.getElementById('inputDateSentToLab')
    const selectSpecimenType = document.getElementById('selectSpecimenType')
    const selectTestType = document.getElementById('selectTestType')
    const divTestTypesCheck = document.getElementById("divTestTypesCheck")
    var patient_id = null
    var request_id = null
    var testTypes = []
    $(document).ready(function () {
        if (localStorage.getItem('checkedInPatient') != null) {
            let patient = JSON.parse(localStorage.getItem('checkedInPatient'))
            patient_id = patient.id
        } else {
            document.getElementById('btnSaveForm').setAttribute('disabled', '')
        }

        $.ajax({
            dataType: 'json',
            url: "../assets/data.json",
            success: data => {

                testTypes = data.lab_test_types
                fillTestTypeChecks(testTypes)

                //loading viewed request
                if (localStorage.getItem('labRequest') != null) {
                    let request = JSON.parse(localStorage.getItem('labRequest'))
                    request_id = request.id
                    $(selectSpecimenCollected).val(request.specimen_collected)
                    inputReasonNotCollected.value = request.reason_not_collected
                    $(selectSpecimenType).val(request.specimen_type)
                    $(selectTestType).val(request.test_type)
                    inputDateCollected.value = request.date_collected
                    inputDateSentToLab.value = request.date_sent_to_lab

                    document.getElementById('divResults').classList.remove('d-none')

                    specimenCollectedChanged();
                    localStorage.removeItem("labRequest")
                }
            },
            error: err => {
                toastr.error(err.statusText, err.status)
            }
        })
        selectSpecimenCollected.addEventListener('change', () => specimenCollectedChanged())
    })

    function saveLabRequest() {
        let testTypes = getSelectedTestTypes()
        console.log(testTypes)
        let specimen_collected = $(selectSpecimenCollected).val(),
            reason_not_collected = inputReasonNotCollected.value.trim(),
            date_collected = inputDateCollected.value.trim(),
            date_sent_to_lab = inputDateSentToLab.value.trim(),
            errorMessage = '';
/*
        if (date_received_in_lab !== '') {
            if (confirming_lab === '') errorMessage += "Enter Name of confirming lab \n"
            if (lab_result === '') errorMessage += "Enter The results \n"

        }*/
        //TODO do tests
        $.ajax({
            type: "POST",
            url: "saveLabRequest",
            data: {
                id: request_id,
                patient_id: patient_id,
                specimen_collected: specimen_collected,
                reason_not_collected: reason_not_collected,
                date_collected: date_collected,
                date_sent_to_lab: date_sent_to_lab,
                testTypes: testTypes
            },
            success: response => {
                toastr.success("Lab Request sent successfully")
                clearForm()
            },
            error: err => {
                toastr.error(err.statusText, err.status)
            }
        })

    }


    function testTypeChanged() {
        let selected = $(selectTestType).val();
        selectLabResults.innerHTML = "<option hidden value=\"\">Select Value</option>"
        testTypes.forEach(testType => {
            if (selected === testType.name) {
                testType.results.forEach(result => {
                    let option = document.createElement('option')
                    option.setAttribute('value', result);
                    option.appendChild(document.createTextNode(result));
                    selectLabResults.appendChild(option);
                })
            }
        })

        inputAssay.setAttribute('disabled', '')
        if (selected === "GeneXpert") {
            inputAssay.removeAttribute('disabled')
        }
    }

    function specimenCollectedChanged() {
        let selected = $(selectSpecimenCollected).val();
        if (selected === "No") {
            if (inputReasonNotCollected.hasAttribute('disabled')) inputReasonNotCollected.removeAttribute('disabled')
        } else {
            inputReasonNotCollected.setAttribute('disabled', '')
        }
    }

    function fillTestTypeChecks(testTypes) {
        removeAllChildNodes(divTestTypesCheck)
        let i = 0
        console.log(testTypes)
        testTypes.forEach(testType => {
            let rowDiv = document.createElement("div")
            rowDiv.classList.add("row", "mb-1")
            rowDiv.setAttribute("id", "rowDiv" + i)
            let colOneDiv = document.createElement("div")
            colOneDiv.classList.add("col-6")
            let checkDiv = document.createElement("div")
            checkDiv.classList.add("form-check")
            let testTypeCheck = document.createElement("input")
            testTypeCheck.classList.add("form-check-input")
            testTypeCheck.setAttribute("type", "checkbox")
            testTypeCheck.setAttribute("name", "checkbox" + i)
            testTypeCheck.setAttribute("id", "checkbox" + i)
            testTypeCheck.setAttribute("value", testType.name)
            let testTypeLabel = document.createElement("label")
            testTypeLabel.classList.add("form-check-label")
            testTypeLabel.setAttribute("for", "checkbox" + i)
            testTypeLabel.innerText = testType.name
            checkDiv.appendChild(testTypeCheck)
            checkDiv.appendChild(testTypeLabel)
            colOneDiv.appendChild(checkDiv)
            let colTwoDiv = document.createElement("div")
            colTwoDiv.classList.add("col-6")
            let selectDiv = document.createElement("div")
            selectDiv.classList.add("form-check")
            let specimenTypeSelect = document.createElement("select")
            specimenTypeSelect.classList.add("form-select")
            specimenTypeSelect.setAttribute("name", "select" + i)
            specimenTypeSelect.setAttribute("id", "select" + i)
            specimenTypeSelect.setAttribute("disabled", '')
            specimenTypeSelect.innerHTML = '<option value="" selected hidden>Select a specimen type</option>'
            let specimenTypes = testType.specimen_types
            specimenTypes.forEach(specimenType => {
                let option = document.createElement('option')
                option.setAttribute('value', specimenType)
                option.innerText = specimenType
                specimenTypeSelect.appendChild(option)
            })
            colTwoDiv.appendChild(specimenTypeSelect)

            testTypeCheck.addEventListener('change', ev => {
                if(testTypeCheck.checked) {
                    specimenTypeSelect.setAttribute("required", '')
                    if (specimenTypeSelect.hasAttribute('disabled')) specimenTypeSelect.removeAttribute('disabled')
                } else {
                    specimenTypeSelect.setAttribute('disabled', '')
                    if (specimenTypeSelect.hasAttribute('required')) specimenTypeSelect.removeAttribute('required')
                    $(specimenTypeSelect).val("")
                }
            })
            rowDiv.appendChild(colOneDiv)
            rowDiv.appendChild(colTwoDiv)
            divTestTypesCheck.appendChild(rowDiv)
            i++
        })
    }

    function getSelectedTestTypes(){
        let testTypes = []
        let containers = divTestTypesCheck.querySelectorAll('.row')
        for (let i = 0; i < containers.length; i++){
            let container = containers[i]
            let checkBox = container.querySelector("input")
            if(checkBox.checked){
                let specimenSelect = container.querySelector("select")
                let testType = {
                    name : checkBox.value,
                    specimen_type: $(specimenSelect).val()
                }
                testTypes.push(testType)
            }
        }
        return testTypes
    }

    function clearForm() {
        document.getElementById('formLabRequest').reset()
        specimenCollectedChanged()
    }

</script>
