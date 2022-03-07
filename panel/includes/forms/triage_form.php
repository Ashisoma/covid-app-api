<form action="" onsubmit="event.preventDefault();" id="formTriage">
    <h1 style="text-align: center">Triage Form</h1>
    <hr>
    <div class="row form-bottom-line">
        <div class="col-xl-6 col-sm-12">
            <div class="row">

            </div>
            <div class="form-group">
                <label for="inputTemperature">Temperature (degrees Celsius)</label>
                <input type="number" class="form-control" id="inputTemperature" placeholder=" Enter Temperature"
                       required>
            </div>
            <div class="form-group">
                <label for="inputSpo2">SPO2</label>
                <input type="number" class="form-control" id="inputSpo2" max="100" min="0" placeholder=" Enter SPO2">
            </div>
            <div class="form-group">
                <label for="inputWeight">Weight(Kg)</label>
                <input type="number" class="form-control" id="inputWeight" placeholder=" Enter Weight" max="150" min="2" required>
            </div>
            <div class="form-group">
                <label for="inputHeight">Height(cm)</label>
                <input type="number" class="form-control" id="inputHeight" placeholder=" Enter Height" max="220" min="20" required>
            </div>
            <div class="form-group">
                <label for="inputZScore">ZScore</label>
                <input type="text" class="form-control" id="inputZScore" placeholder=" Enter ZScore">
            </div>

        </div>
        <div class="col-xl-6 col-sm-12">

        </div>
        <hr>
    </div>
    <button type="button" id="btnSaveForm" class="btn btn-success submit mt-2 mb-5"><i class="fa fa-paper-plane"
                                                                                       aria-hidden="true"></i>
        Submit Form
    </button>
    <a href="view_form?form=screening" class="float-right">Go to Screening</a>
</form>

<script>
    const inputTemperature = document.getElementById("inputTemperature")
    const inputWeight = document.getElementById("inputWeight")
    const inputHeight = document.getElementById("inputHeight")
    const inputSpo2 = document.getElementById("inputSpo2")
    const inputZScore = document.getElementById("inputZScore")
    const selectCough = document.getElementById("selectCough")
    const selectDifficultyInBreathing = document.getElementById("selectDifficultyInBreathing")
    const selectWeightLoss = document.getElementById("selectWeightLoss")

    var patient_id = null;

    $(document).ready(function () {
        if (localStorage.getItem('checkedInPatient') != null) {
            let patient = JSON.parse(localStorage.getItem('checkedInPatient'))
            patient_id = patient.id
        } else {
            document.getElementById('btnSaveForm').setAttribute('disabled', '')
        }
        document.getElementById('btnSaveForm').addEventListener('click', () => saveTriage())
    })

    function saveTriage() {
        if (localStorage.getItem('checkedInPatient') == null) {
            return
        }
        let temperature = inputTemperature.value.trim()
        let weight = inputWeight.value.trim()
        let height = inputHeight.value.trim()
        let spo2 = inputSpo2.value.trim()
        let zScore = inputZScore.value.trim()
        let bmi = Math.abs(weight/(height*height))
        console.log(bmi)

        let data = new FormData()
        data.append('temperature', temperature)
        data.append('weight', weight)
        data.append('height', height)
        data.append('spo2', spo2)
        data.append('zscore', zScore)
        data.append('patient_id', patient_id)
        data.append('triage_time', DateFormatter.formatDate(new Date(), 'YYYY-MM-DD HH:mm:ss'))

        $.ajax({
            type: "POST",
            url: "saveTriage",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: response => {
                document.getElementById('formTriage').reset();
                toastr.success("Form saved successfully")
            },
            error: err => {
                toastr.error("Unable to save form")
            }
        })
    }

</script>
