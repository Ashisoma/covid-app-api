
const checkedInCard = document.getElementById('checkedInCard')
const btnCheckInPatient = document.getElementById('btnCheckInPatient')
const divNoCheckedIn = document.getElementById('divNoCheckedIn')

function initialize() {
    if(localStorage.getItem('checkedInPatient') != null) {
        checkInPatient(JSON.parse(localStorage.getItem('checkedInPatient')))
    }

}

function viewForm(form) {
    window.location.replace("view_form?form=" + form)
}

function checkInPatient(patient) {
    document.getElementById('headerPatientName').innerText = patient.surname + ' ' + patient.firstName + ' ' + patient.secondName + ' (' + calculateAge(patient.dob) + ' Yrs) '
    document.getElementById('headerFacilityName').innerText = patient.facilityData.name
    document.getElementById('headerPhoneNumber').innerText = patient.phone
    divNoCheckedIn.classList.add('d-none');
    if(checkedInCard.classList.contains('d-none')) checkedInCard.classList.remove('d-none');
    // $('#checkinDialogModal').hide()
    hideModal('checkinDialogModal')
    localStorage.setItem('checkedInPatient', JSON.stringify(patient))
    return false;
}

function checkoutPatient(){
    if(divNoCheckedIn.classList.contains('d-none')) divNoCheckedIn.classList.remove('d-none')
    checkedInCard.classList.add('d-none')
    localStorage.removeItem("checkedInPatient")
}



initialize()
