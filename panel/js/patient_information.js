const tablePatientScreeening = document.getElementById("tablePatientScreeening")
const tablePatientScreeening2 = document.getElementById("tablePatientScreeening2")
const tablePatientHistory = document.getElementById("tablePatientHistory")
const tableTriage = document.getElementById("tableTriage")
const liContacts = document.getElementById("liContacts")
const tableLabRequests = document.getElementById("tableLabRequests")
const tableRadRequests = document.getElementById("tableRadRequests")
var checkedInPatient = null;


function initialize() {
    if (localStorage.getItem('checkedInPatient') != null) {
        checkInPatient(JSON.parse(localStorage.getItem('checkedInPatient')))
    }
    getData()
}

function getData(){
    if (checkedInPatient != null) {

        $.ajax({
            type: 'GET',
            url: 'patientManagementData/' + checkedInPatient.id,
            success: response => {
                let data = JSON.parse(response)
                loadLatestTriage(data.lastTriage)
                loadLatestScreening(data.lastScreening)
                loadPatientHistory(data.lastHistory)
                loadContacts(data.contacts)
                loadLabRequests(data.lastLabRequests)
                loadRadRequest(data.lastRadRequests)
            },
            error: err => {
                toastr.error("Unable to load data", err.message)
            }
        })

    }
}

function checkInPatient(patient) {
    checkedInPatient = patient
    document.getElementById('headerPatientName').innerText = patient.surname + ' ' + patient.firstName + ' ' + patient.secondName + ' (' + calculateAge(patient.dob) + ' Yrs) '
    document.getElementById('headerFacilityName').innerText = patient.facilityData.name
    document.getElementById('headerPhoneNumber').innerText = patient.phone
    divNoCheckedIn.classList.add('d-none')
    if (checkedInCard.classList.contains('d-none')) checkedInCard.classList.remove('d-none')
    // $('#checkinDialogModal').modal('hide');
    hideModal('checkinDialogModal')
    localStorage.setItem('checkedInPatient', JSON.stringify(patient))
}

function checkoutPatient() {
    if (divNoCheckedIn.classList.contains('d-none')) divNoCheckedIn.classList.remove('d-none')
    checkedInCard.classList.add('d-none')
    localStorage.removeItem("checkedInPatient")
    var tbody = tableLabRequests.querySelector("tbody");
    tableLabRequests.removeChild(tbody);
    var newBody = document.createElement("tbody");
    tableLabRequests.appendChild(newBody);
}

function loadLatestTriage(triage) {
    let names = ["Date Filled", "Temperature", "Weight", "Height", "SPO2", "ZScore"];
    let attributes = ["triage_time", "temperature", "weight", "height", "spo2", "zscore"];
    let tbody = tableTriage.querySelector("tbody")
    removeAllChildNodes(tbody)
    if (triage == null) return;
    for (let i = 0; i < names.length; i++) {
        let name = names[i], value = triage[attributes[i]]
        let row = tbody.insertRow(i)
        row.insertCell(0).appendChild(document.createTextNode(name))
        row.insertCell(1).appendChild(document.createTextNode(value))
    }
}

function loadLatestScreening(screening) {
    let names = ["Date Screened", "History of Fever", "Chills", "General Weakness", "Cough", "Sore Throat", "Runny Nose",
        "Loss of Weight", "Night sweats", "Loss of Taste(New)", "Loss of Smell(New)", "Difficulty In Breathing",
        "Diarrhoea", 'Confusion', "Headache", "Irritability", "Nausea", 'Vomiting', "Abdominal Pain", 'Chest Pain', 'Joint Pain', 'Muscle Pain'];
    let attributes = ['date_screened', 'fever_history', "chills", 'general_weakness', 'cough', 'sore_throat', 'runny_nose',
        'weight_loss', 'night_sweats', 'loss_of_taste', 'loss_of_smell', 'breathing_difficulty', 'diarrhoea', 'confusion',
        'headache', 'irritability', 'nausea', 'vomiting', 'abdominal_pain', 'chest_pain', 'joint_pain', 'muscle_pain']
    let tbody = tablePatientScreeening.querySelector("tbody")
    let tbody2 = tablePatientScreeening2.querySelector("tbody")
    removeAllChildNodes(tbody)
    removeAllChildNodes(tbody2)
    if (screening == null) return
    let half = Math.round(names.length / 2)
    for (let i = 0; i < names.length; i++) {
        let name = names[i], value = screening[attributes[i]]
        let row = i < half ? tbody.insertRow(i) : tbody2.insertRow(i-half)
        row.insertCell(0).appendChild(document.createTextNode(name))
        row.insertCell(1).appendChild(document.createTextNode(value))
    }
}

function loadPatientHistory(history) {
    let names = ['Date Taken', 'Travelled In The last 14 days', 'Places Travelled', 'Contact With Anyone infected', 'Contact Setting', 'Vaccinated', 'First Dose', 'First Dose Date',
        'Second Dose', 'Second_dose_date']
    let attributes = ['date_taken', 'travelled', 'places_travelled', 'contact_with_infected', 'contact_setting', 'vaccinated', 'first_dose_name', 'first_dose_date',
        'second_dose_name', 'second_dose_date']
    let tbody = tablePatientHistory.querySelector("tbody")
    removeAllChildNodes(tbody)
    if (history == null) return
    for (let i = 0; i < names.length; i++) {
        let name = names[i], value = history[attributes[i]]
        let row = tbody.insertRow(i)
        row.insertCell(0).appendChild(document.createTextNode(name))
        row.insertCell(1).appendChild(document.createTextNode(value))
    }
}

function loadLabRequests(labRequests) {
    let tbody = tableLabRequests.querySelector("tbody")
    removeAllChildNodes(tbody)
    let i = 0
    labRequests.forEach(labRequest => {
        let row = tbody.insertRow(i)
        row.insertCell(0).appendChild(document.createTextNode(labRequest.specimen_type === "Other" ? labRequest.specimen_type + '(' + labRequest.specimen_type_other + ')' : labRequest.specimen_type));
        row.insertCell(1).appendChild(document.createTextNode(labRequest.test_type))
        row.insertCell(2).appendChild(document.createTextNode(labRequest.date_collected))
        row.insertCell(3).appendChild(document.createTextNode(labRequest.date_sent_to_lab))
        row.insertCell(4).appendChild(document.createTextNode(labRequest.confirming_lab))
        row.insertCell(5).appendChild(document.createTextNode(labRequest.lab_result))
        i++
    })
}

function loadRadRequest(radRequests) {
    let tbody = tableRadRequests.querySelector("tbody")
    removeAllChildNodes(tbody)
    let i = 0
    radRequests.forEach(radRequest => {
        let row = tbody.insertRow(i)
        row.insertCell(0).appendChild(document.createTextNode(radRequest.date_requested));
        row.insertCell(1).appendChild(document.createTextNode(radRequest.date_done))
        row.insertCell(2).appendChild(document.createTextNode(radRequest.results))
        row.insertCell(3).appendChild(document.createTextNode(radRequest.comments))
        i++
    })
}

function loadContacts(contacts) {
    removeAllChildNodes(liContacts)
    contacts.forEach(contact => {
        let li = document.createElement('li')
        li.classList.add('list-group-item', 'mb-2')
        let nameHeader = document.createElement('h6')
        nameHeader.appendChild(document.createTextNode(contact.firstName + ' ' + contact.middleName + ' ' + contact.surname))
        let contactP = document.createElement('p')
        contactP.appendChild(document.createTextNode(contact.phoneNumber))
        li.appendChild(nameHeader)
        li.appendChild(contactP)
        liContacts.appendChild(li)
    })
}



initialize()
