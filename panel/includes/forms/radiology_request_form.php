<form action="" onsubmit="event.preventDefault();" id="formRadRequest">
    <h1 style="text-align: center">Radiology Request Form</h1>
    <hr>
    <div class="row form-bottom-line">
        <div class="col-xl-6 col-sm-12">
            <div class="form-group">
                <label for="inputDateRequested">Date Requested</label>
                <input type="date" class="form-control" id="inputDateRequested" placeholder=" Enter Date" required>
            </div>
            <div class="form-group">
                <label for="selectTestType">Imaging Type</label>
                <select class="form-select" name="selectTestType" id="selectTestType" required>
                    <option hidden value="">Select value</option>
                </select>
            </div>
            <div class="form-group">
                <label for="inputResults">Results</label>
                <textarea class="form-control" name="Results" id="inputResults" placeholder="Results" required></textarea>
            </div>
            <div class="form-group">
                <label for="selectConclusion">Conclusion</label>
                <select class="form-select" name="selectConclusion" id="selectConclusion" required>
                    <option hidden value="">Select value</option>
                </select>
            </div>
            <label for="">Attach Files</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="fileInput" multiple
                       name="upload_files" accept=".json,.jpg,.png,.pdf,.tif">
                <label class="custom-file-label" for="fileSelectorInput" id="selectedFilesLabel">Select file(s)</label>
            </div>
            <div class="form-group">
                <label for="inputDateDone">Date Done</label>
                <input type="date" class="form-control" id="inputDateDone" placeholder=" Enter Date Done" required>
            </div>
            <div class="form-group">
                <label for="inputComments">Comments</label>
                <textarea class="form-control" id="inputComments" placeholder=" Any comments"></textarea>
            </div>

        </div>

    </div>

    <button type="button" id="btnSaveForm" class="btn btn-success submit mt-2 mb-5" onclick="saveRadRequest();"><i
                class="fa fa-paper-plane" aria-hidden="true"></i> Submit Form
    </button>

</form>

<script>
    const selectConclusion = document.getElementById('selectConclusion')
    const inputResults = document.getElementById('inputResults')
    const inputDateRequested = document.getElementById('inputDateRequested')
    const selectTestType = document.getElementById('selectTestType')
    const inputDateDone = document.getElementById('inputDateDone')
    const inputComments = document.getElementById('inputComments')
    const fileInput = document.getElementById('fileInput')
    var patient_id = null
    var fileList = []
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
                let xray_results = data.xray_results
                xray_results.forEach(result => {
                    let option = document.createElement('option')
                    option.setAttribute('value', result);
                    option.appendChild(document.createTextNode(result));
                    selectConclusion.appendChild(option);
                })
                let testTypes = data.xray_test_types
                testTypes.forEach(testType => {
                    let option = document.createElement('option')
                    option.setAttribute('value', testType);
                    option.appendChild(document.createTextNode(testType));
                    selectTestType.appendChild(option);
                })

            },
            error: err => {
                toastr.error(err.statusText, err.status)
            }
        })

        fileInput.addEventListener('change', ev => {
            fileList = []
            fileList.push(...fileInput.files)
            let fileNames = ''
            for (let i = 0; i < fileList.length; i++) {
                let file = fileList[i]
                let fileName = file.name
                if (i === 0) fileNames += fileName
                else fileNames += ', ' + fileName
            }
            document.querySelector('#selectedFilesLabel').innerHTML = fileNames
            console.log(fileList)
        })
    })

    function saveRadRequest() {
        if (localStorage.getItem('checkedInPatient') == null) {
            return
        }
        // ['date_requested', 'patient_id', 'date_done', 'test_type', 'results', 'comments', 'files', 'submitted_by']
        let date_requested = inputDateRequested.value;
        let date_done = inputDateDone.value, test_type = $(selectTestType).val(),
            results = $(inputResults).val(), conclusion = $(selectConclusion).val(), comments = inputComments.value.trim();
        let error = ""
        if (date_requested === '') error += "Enter a valid date requested. \n"
        if (date_done === '') error += "Enter a valid date done. \n"
        if (date_done !== '' && date_requested !== '') {
            let dateOne = new Date(date_requested), dateTwo = new Date(date_done)
            if (dateOne.getTime() > dateTwo.getTime()) error += "Date done cannot be greater than date requested. \n"
        }
        if (test_type === '') error += "Select a valid test type. \n"
        if (results === '') error += "Select a valid result. \n"
        if (error !== '') {
            toastr.error(error)
            return
        }
        let formData = new FormData()
        formData.append("date_requested", date_requested)
        formData.append("patient_id", patient_id)
        formData.append("date_done", date_done)
        formData.append("test_type", test_type)
        formData.append("results", results)
        formData.append("conclusion", conclusion)
        formData.append("comments", comments)
        for (var index = 0; index < fileList.length; index++) {
            formData.append("upload_files[]", fileInput.files[index]);
        }
        let request = null
        if (window.XMLHttpRequest) {
            request = new XMLHttpRequest();
        } else {
            request = new ActiveXObject("Microsoft.XMLHTTP");
        }
        request.open("POST", "saveRadRequest")
        request.onload = () => {
            console.log("Status : " + request.status)
            if (request.status == 200) {
                toastr.success("Form saved successfully.")
                document.getElementById('formRadRequest').reset()
                document.querySelector('#selectedFilesLabel').innerHTML = 'Select File(s)'
            } else {
                toastr.error("Unable to process request. ", request.status)
            }

        }

        request.send(formData)
        toastr.info("Processing... please wait.")

    }

    function uploadSelectedFiles() {
        let formData = new FormData()
        // formData.set('upload_files[]', ...fileInput.files)
        for (var index = 0; index < fileList.length; index++) {
            formData.append("upload_files[]", fileInput.files[index]);
        }
        // formData.append('upload_files', fileList)
        let request = new XMLHttpRequest()
        request.open('POST', 'uploadFiles')
        request.send(formData)
    }
</script>
