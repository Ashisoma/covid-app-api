<?php
require_once __DIR__ . "/../../../vendor/autoload.php";
$requestId = $_GET['request_id'];
if ($requestId == null) {
    die("Lab Request not found");
}
$labRequest = \models\LabRequest::find($requestId);
if ($labRequest == null) {
    die("Lab Request not found");
}
?>

<form action="" onsubmit="preventDefault();" id="formLabRequest">
    <section class="transparent">
        <h6 style="color: #0a58ca; margin-left: 4px;">Laboratory Request Information</h6>
        <div class="row">
            <div class="col-md-6 col-sm-8 p-2">
                <div class="row">
                    <div class="col-6"><h5>Test Type</h5></div>
                    <div class="col-6"><h6 id="testTypeField"></h6></div>
                </div>
                <div class="row">
                    <div class="col-6"><h5>Specimen Type</h5></div>
                    <div class="col-6"><h6 id="specimenTypeField"></h6></div>
                </div>
            </div>
            <div class="col-md-6 col-sm-8">
                <div class="row">
                    <div class="col-6"><h5>Date Collected</h5></div>
                    <div class="col-6"><h6 id="dateCollectedField"></h6></div>
                </div>
                <div class="row">
                    <div class="col-6"><h5>Date Sent To Lab</h5></div>
                    <div class="col-6"><h6 id="dateSentField"></h6></div>
                </div>
            </div>
        </div>
    </section>
    <h1 style="text-align: center">Lab Results Form</h1>
    <hr>
    <div id="divResults" class="row form-bottom-line">
        <div class="col-xl-6 col-sm-12">
            <div class="form-group">
                <label for="inputDateReceived">Date specimen received in lab</label>
                <input type="date" class="form-control" id="inputDateReceived" placeholder=" Enter Date" required>
            </div>
            <div class="form-group">
                <label for="inputConfirmingLab">Name of confirming lab</label>
                <input type="text" class="form-control" id="inputConfirmingLab" placeholder="Name of confirming lab "
                       required>
            </div>
            <div class="form-group">
                <label for="inputAssay">Assay used</label>
                <input type="text" class="form-control" id="inputAssay" placeholder="Assay used ">
            </div>
        </div>
        <div class="col-xl-6 col-sm-12">
            <div class="form-group">
                <label for="selectLabResults">Lab results</label>
                <select class="form-select" name="selectLabResults" id="selectLabResults" required>
                    <option hidden value="">Select value</option>
                </select>
            </div>
            <div class="form-group">
                <label for="selectSequencingDone">Sequencing Done?</label>
                <select class="form-select" name="selectSequencingDone" id="selectSequencingDone">
                    <option hidden value="">Select value</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                    <option value="Unknown">Unknown</option>
                </select>
            </div>
            <div class="form-group">
                <label for="inputLabConfirmationDate">Date of lab confirmation</label>
                <input type="date" class="form-control" id="inputLabConfirmationDate"
                       placeholder="Date of lab confirmation">
            </div>
            <div class="form-group">
                <label for="inputInvestigator">Name of the Interviewer/investigator</label>
                <input type="text" class="form-control" id="inputInvestigator"
                       placeholder="Name of the Interviewer/investigator">
            </div>
        </div>
    </div>
    <hr>
    <button type="button" id="btnSaveForm" class="btn btn-success submit mt-2 mb-5" onclick="saveResult();"><i
                class="fa fa-paper-plane" aria-hidden="true"></i> Submit Form
    </button>


</form>
<style>
    h6 {
        color: #0a58ca;
    }

    h6:hover {
        text-decoration: underline;
    }
</style>
<script>
    const inputDateReceived = document.getElementById('inputDateReceived')
    const inputConfirmingLab = document.getElementById('inputConfirmingLab')
    const inputAssay = document.getElementById('inputAssay')
    const selectLabResults = document.getElementById('selectLabResults')
    const selectSequencingDone = document.getElementById('selectSequencingDone')
    const inputLabConfirmationDate = document.getElementById('inputLabConfirmationDate')
    const inputInvestigator = document.getElementById('inputInvestigator')
    const request = <?php echo $labRequest;?>;
    var patient_id = null
    var request_id = null

    $(document).ready(function () {
        if (localStorage.getItem('checkedInPatient') != null) {
            let patient = JSON.parse(localStorage.getItem('checkedInPatient'))
            patient_id = patient.id
        } else {
            document.getElementById('btnSaveForm').setAttribute('disabled', '')
        }
        if (patient_id !== request.patient_id) {
            toastr.error("An error has occurred. Try again later", Math.floor(Math.random() * 1000))
            return;
        }

        $.ajax({
            dataType: 'json',
            url: "../assets/data.json",
            success: data => {

                testTypes = data.lab_test_types
                request_id = request.id
                document.querySelector("#testTypeField").innerHTML = request.test_type
                document.querySelector("#specimenTypeField").innerHTML = request.specimen_type
                document.querySelector("#dateCollectedField").innerHTML = request.date_collected
                document.querySelector("#dateSentField").innerHTML = request.date_sent_to_lab
                inputDateReceived.value = request.date_received_in_lab
                inputConfirmingLab.value = request.confirming_lab
                inputAssay.value = request.assay_used
                $(selectLabResults).val(request.lab_result)
                $(selectSequencingDone).val(request.sequencing_done)
                inputLabConfirmationDate.value = request.lab_confirmation_date
                inputInvestigator.value = request.investigator
                testTypes.forEach(testType => {
                    if (testType.name === request.test_type) {
                        let results = testType.results
                        results.forEach(result => {
                            let option = document.createElement('option')
                            option.setAttribute('value', result);
                            option.appendChild(document.createTextNode(result));
                            selectLabResults.appendChild(option);
                        })
                    }
                })
                $(inputDateReceived).val(request.date_received_in_lab)
                $(inputConfirmingLab).val(request.confirming_lab)
                $(inputAssay).val(request.assay_used)
                $(selectLabResults).val(request.lab_result)
                $(selectSequencingDone).val(request.sequencing_done)
                $(inputLabConfirmationDate).val(request.lab_confirmation_date)
                $(inputInvestigator).val(request.investigator)
                if (request.date_received_in_lab != null) {
                    document.getElementById("btnSaveForm").setAttribute("disabled", '')
                }

            },
            error: err => {
                toastr.error(err.statusText, err.status)
            }
        })
        // selectSpecimenCollected.addEventListener('change', () => specimenCollectedChanged())
    })

    function saveResult() {
        let date_received_in_lab = inputDateReceived.value.trim(),
            confirming_lab = inputConfirmingLab.value.trim(),
            assay_used = inputAssay.value.trim(),
            lab_result = $(selectLabResults).val(),
            sequencing_done = $(selectSequencingDone).val(),
            lab_confirmation_date = inputLabConfirmationDate.value,
            investigator = inputInvestigator.value.trim(),
            errorMessage = '';

        $.ajax({
            type: "POST",
            url: "saveLabResult",
            data: {
                id: request_id,
                date_received_in_lab: date_received_in_lab,
                confirming_lab: confirming_lab,
                assay_used: assay_used,
                lab_result: lab_result,
                sequencing_done: sequencing_done,
                lab_confirmation_date: lab_confirmation_date,
                investigator: investigator,
            },
            success: () => {
                toastr.success("Lab Results submitted successfully")
                setTimeout(() => window.location.replace("laboratory"), 2000)

            },
            error: err => {
                toastr.error(err.statusText, err.status)
            }
        })


    }

</script>
