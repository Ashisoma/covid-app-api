const userDataTable = document.getElementById('userDataTable')



function initialize() {
    
    $.ajax({
        type: "GET",
        url: 'user_categories',
        success: response => {
            let categories = JSON.parse(response)
            categories.forEach(category => {
                let option = document.createElement("option");
                option.setAttribute("value", category.id);
                option.appendChild(document.createTextNode(category.name));
                document.getElementById('categorySelect').appendChild(option)
            })
        },
        error: err => {

        }
    })
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
        url: 'get_facilities',
        success: response => {
            let facilities = JSON.parse(response)
            facilities.forEach(facility => {
                let option = document.createElement("option");
                option.setAttribute("value", facility.mflCode);
                option.appendChild(document.createTextNode(facility.name));
                document.getElementById('facilitySelect').appendChild(option)
            })
        },
        error: err => {

        }
    })
    $.ajax({
        type: "GET",
        url: 'get_users',
        success: response => {
            let users = JSON.parse(response)
            loadUsersToTable(users)
        },
        error: err => {

        }
    })

}

function loadUsersToTable(users) {
    var tbody = userDataTable.querySelector("tbody");
    userDataTable.removeChild(tbody);
    var newBody = document.createElement("tbody");
    for (let i = 0; i < users.length; i++) {
        let user = users[i];
        var status = "";

        if (user.active === 1) {
            status = "Active";
        } else {
            status = "Inactive";
        }
        var editUser = document.createElement("a");
        editUser.setAttribute("href", "#");
        editUser.setAttribute("data-toggle", "modal");
        editUser.setAttribute("data-target", "#addUsermodal");
        editUser.setAttribute("data-tooltip", "tooltip");
        editUser.setAttribute("title", "Edit User Details");
        editUser.setAttribute("data-placement", "bottom");
        editUser.classList.add("btn");
        editUser.classList.add("btn-light");
        editUser.classList.add("btn-circle");
        editUser.classList.add("btn-sm");
        editUser.classList.add("app-button");
        editUser.innerHTML = '<i class="fas fa-edit"></i>';
        editUser.addEventListener("click", () =>
            funEditUser(user)
        );

        var deleteUser = document.createElement("a");
        deleteUser.setAttribute("href", "#");
        deleteUser.setAttribute("data-tooltip", "tooltip");
        deleteUser.setAttribute("title", "Delete this User");
        deleteUser.setAttribute("data-placement", "bottom");
        deleteUser.classList.add("btn");
        deleteUser.classList.add("btn-light");
        deleteUser.classList.add("btn-circle");
        deleteUser.classList.add("btn-sm");
        deleteUser.classList.add("app-button");
        deleteUser.innerHTML = '<i class="fas fa-trash"></i>';
        deleteUser.addEventListener("click", () => funDeleteUser(user.id));

        var row = newBody.insertRow(i);
        row.insertCell(0).appendChild(document.createTextNode(i + 1));
        row.insertCell(1).appendChild(document.createTextNode(user.names));
        row.insertCell(2).appendChild(document.createTextNode(user.email));
        row.insertCell(3).appendChild(document.createTextNode(user.phone));
        row.insertCell(4).appendChild(document.createTextNode(user.projectData == null ? '' : user.projectData.name));
        row.insertCell(5).appendChild(document.createTextNode(user.facilityData == null ? '' : user.facilityData.name));
        row.insertCell(6).appendChild(document.createTextNode(user.categoryData == null ? '' : user.categoryData.name));
        row.insertCell(7).appendChild(document.createTextNode(status));
        var actionsCell = row.insertCell(8);

        var actionDiv = document.createElement("div");
        actionDiv.classList.add("row");
        actionDiv.appendChild(editUser);

        actionsCell.appendChild(actionDiv);
    }
    userDataTable.appendChild(newBody);
    // $('[data-tooltip="tooltip"]').tooltip();
    $(userDataTable).DataTable();
}


initialize()

