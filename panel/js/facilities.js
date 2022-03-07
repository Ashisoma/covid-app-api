
var counties = []
const facilityDataTable = document.getElementById('facilityDataTable')

function initialize() {

    $.ajax({
        type: "GET",
        url: "counties_data",
        success: function (response) {
            var mResponse = JSON.parse(response);
            let code = mResponse.code;
            if (code == 200) {
                counties = mResponse.data;
                for (let i = 0; i < counties.length; i++) {
                    let county = counties[i];
                    let option = document.createElement('option');
                    option.setAttribute('value', county.code);
                    option.appendChild(document.createTextNode(county.name));
                    document.getElementById('countySelect').appendChild(option);
                }
            } else {
                var error = [];
                error.status = code;
                error.message = mResponse.message;
                toastr.error("Unable to load data")
            }
        },
        error: function (error) {
            toastr.error("Unable to load data")
        }
    })
}

$.ajax({
    type: "GET",
    url: 'get_projects',
    success: response => {
        let projects = JSON.parse(response)
        projects.forEach(project => {
            let option = document.createElement("option");
            option.setAttribute("value", project.id);
            option.appendChild(document.createTextNode(project.name));
            document.getElementById('projectSelect').appendChild(option)
        })
    },
    error: err => {

    }
})

$.ajax({
    type: "GET",
    url: "get_facilities",
    success: function (response) {
        var facilities = JSON.parse(response);
        loadDataToTable(facilities);
    },
    error: err => {
        // handleAjaxError(err)
    }
});

function loadDataToTable(facilities) {
    var tbody = facilityDataTable.querySelector('tbody');
    facilityDataTable.removeChild(tbody);
    var newBody = document.createElement('tbody');
    for (var i = 0; i < facilities.length; i++) {
        let facility = facilities[i];

        var editUser = document.createElement("a");
        editUser.setAttribute("href", "#");
        editUser.setAttribute('data-toggle', 'modal');
        editUser.setAttribute('data-target', '#facilityDialogModal');
        editUser.classList.add("btn");
        editUser.classList.add("btn-light");
        editUser.classList.add("btn-circle");
        editUser.classList.add("btn-sm");
        editUser.classList.add("app-button");
        editUser.innerHTML = "<i class=\"fas fa-edit\"></i>"
        editUser.addEventListener('click', () => editFacility(facility));

        var row = newBody.insertRow(i);
        row.insertCell(0).appendChild(document.createTextNode(i + 1));
        row.insertCell(1).appendChild(document.createTextNode(facility.mflCode));
        row.insertCell(2).appendChild(document.createTextNode(facility.name));
        row.insertCell(3).appendChild(document.createTextNode(facility.countyData == null ? '' :facility.countyData.name));
        row.insertCell(4).appendChild(document.createTextNode(facility.subcountyData == null ? '' : facility.subcountyData.name));
        var actionsCell = row.insertCell(5);

        var actionDiv = document.createElement('div');
        actionDiv.classList.add('row');

        actionDiv.appendChild(editUser);


        actionsCell.appendChild(actionDiv);
    }
    facilityDataTable.appendChild(newBody);
    $(facilityDataTable).DataTable();
}


initialize()