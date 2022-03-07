const checkedInCard = document.getElementById('checkedInCard')
const btnCheckInPatient = document.getElementById('btnCheckInPatient')
const divNoCheckedIn = document.getElementById('divNoCheckedIn')
const tableLabRequests = document.getElementById('tableLabRequests')

function initialize(){
    if(localStorage.getItem('checkedInPatient') != null) {
        checkInPatient(JSON.parse(localStorage.getItem('checkedInPatient')))
        getLabRequests()
    }
}


function getLabRequests(){
    if(localStorage.getItem('checkedInPatient') == null) {
        return
    }
    let patient = JSON.parse(localStorage.getItem('checkedInPatient'))
    $.ajax({
        type: 'GET',
        url: "lab_requests/" + patient.id,
        success: response => {
            let labRequests = JSON.parse(response)
            loadRequestsToTable(labRequests)
            toastr.success("Lab requests retrieved successfully")
        },
        error: err => {
            toastr.error(err.statusText, err.status)
        }
    })
}

function checkInPatient(patient) {
    document.getElementById('headerPatientName').innerText = patient.surname + ' ' + patient.firstName + ' ' + patient.secondName  + ' (' + calculateAge(patient.dob) + ' Yrs) '
    document.getElementById('headerFacilityName').innerText = patient.facilityData.name
    document.getElementById('headerPhoneNumber').innerText = patient.phone
    divNoCheckedIn.classList.add('d-none')
    if(checkedInCard.classList.contains('d-none')) checkedInCard.classList.remove('d-none')
    // $('#checkinDialogModal').modal('hide');
    hideModal('checkinDialogModal')
    localStorage.setItem('checkedInPatient', JSON.stringify(patient))
}

function checkoutPatient(){
    if(divNoCheckedIn.classList.contains('d-none')) divNoCheckedIn.classList.remove('d-none')
    checkedInCard.classList.add('d-none')
    localStorage.removeItem("checkedInPatient")
    var tbody = tableLabRequests.querySelector("tbody");
    tableLabRequests.removeChild(tbody);
    var newBody = document.createElement("tbody");
    tableLabRequests.appendChild(newBody);
}

function loadRequestsToTable(labRequests) {
    var tbody = tableLabRequests.querySelector("tbody");
    tableLabRequests.removeChild(tbody);
    var newBody = document.createElement("tbody");
    let i = 0
    labRequests.forEach(labRequest => {
        let row = newBody.insertRow(i)
        let specimenTypeText = labRequest.specimen_type
        if(labRequest.specimen_type === "Other"){
            specimenTypeText = labRequest.specimen_type + " (" +labRequest.specimen_type_other+")"
        }
        row.insertCell(0).appendChild(document.createTextNode(i+1))
        row.insertCell(1).appendChild(document.createTextNode(labRequest.test_type))
        row.insertCell(2).appendChild(document.createTextNode(specimenTypeText))
        row.insertCell(3).appendChild(document.createTextNode(labRequest.date_collected))
        row.insertCell(4).appendChild(document.createTextNode(labRequest.date_sent_to_lab))
        row.insertCell(5).appendChild(document.createTextNode(labRequest.date_received_in_lab == null ? '' : labRequest.date_received_in_lab))
        row.insertCell(6).appendChild(document.createTextNode(labRequest.confirming_lab))

        let actionsCell = row.insertCell(7)
        let btnViewRequest = document.createElement("a");
        btnViewRequest.setAttribute("href", "#");
        btnViewRequest.setAttribute("data-tooltip", "tooltip");
        btnViewRequest.setAttribute("title", "View Request");
        btnViewRequest.setAttribute("data-placement", "bottom");
        btnViewRequest.classList.add("btn");
        btnViewRequest.classList.add("btn-light");
        btnViewRequest.classList.add("btn-circle");
        btnViewRequest.classList.add("btn-sm");
        btnViewRequest.classList.add("app-button");
        btnViewRequest.innerHTML = '<i class="fas fa-eye"></i>';
        btnViewRequest.addEventListener("click", () => viewRequest(labRequest));

        let actionDiv = document.createElement("div");
        actionDiv.classList.add("row");
        actionDiv.appendChild(btnViewRequest);

        actionsCell.appendChild(actionDiv);

        i++
    });
    tableLabRequests.appendChild(newBody);
    $(tableLabRequests).DataTable();
}

function viewRequest(request){
    // localStorage.setItem('labRequest', JSON.stringify(request))
    window.location.replace("view_form?form=Laboratory Result&request_id="+request.id)
}


initialize()