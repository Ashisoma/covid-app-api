
const checkedInCard = document.getElementById('checkedInCard')

function initialize() {
    if (localStorage.getItem('checkedInPatient') != null) {
        let patient = JSON.parse(localStorage.getItem('checkedInPatient'))
        document.getElementById('headerPatientName').innerText = patient.surname + ' ' + patient.firstName + ' ' + patient.secondName + ' (' + calculateAge(patient.dob) + ' Yrs) '
        document.getElementById('headerFacilityName').innerText = patient.facilityData.name
        document.getElementById('headerPhoneNumber').innerText = patient.phone
        
    } else {
        checkedInCard.classList.add('d-none')
    }
}













initialize()
