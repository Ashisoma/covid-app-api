const inputCategoryName = document.getElementById('inputCategoryName')
const inputCategoryDesc = document.getElementById('inputCategoryDesc')
const divPermissions = document.getElementById('divPermissions')
const categoriesTable = document.getElementById('categoriesTable')
const accessLevelSelect = document.getElementById('accessLevelSelect')


var userPermissions = null
var editedCategory = ''

function initialize() {
  $("#userCategoryModal").on("hide.bs.modal", () => {
    clearCategoryDialog()
  });
  document.getElementById('btnSaveCategory').addEventListener("click", () =>saveCategory())

  $.ajax({
    type: "GET",
    url: "get_permissions",
    success: function (response) {
      var permissions = JSON.parse(response);
      loadtocheckbox(permissions);
      getCategories()
    },
    error: function (error) {
      handleAjaxError(error);
    },
  });
  $.ajax({
    dataType: "json",
    url: "../assets/data.json",
    success: data => {

        let accessLevels = data.access_levels
        accessLevels.forEach(accessLevel => {
            let option = document.createElement("option");
            option.setAttribute("value", accessLevel);
            option.appendChild(document.createTextNode(accessLevel));
            accessLevelSelect.appendChild(option)
        })
    }
})

}

function getCategories(){
  $.ajax({
    type: "GET",
    url: 'user_categories',
    success: response => {
      let categories = JSON.parse(response)
      loadUserCategories(categories)
    },
    error: err => {

    }
  })
}

function loadtocheckbox(permissions) {
  userPermissions = permissions
  for (var i = 0; i < permissions.length; i++) {
    let permission = permissions[i];
    console.log(permission.name);

    // create the div container for the checkbox
    checkboxdiv = document.createElement("div");
    checkboxdiv.classList.add("custom-control");
    checkboxdiv.classList.add("custom-checkbox");
    checkboxdiv.classList.add("ml-2");

    //create checkbox
    let checkBox = document.createElement("input");
    checkBox.setAttribute("type", "checkbox");
    checkBox.classList.add("custom-control-input");
    // checkBox.classList.add("permgroup_" + permissionname.grouped);
    checkBox.setAttribute("id", permission.id);



    // create a label for the checkbox
    var label = document.createElement("label");
    label.setAttribute("for", permission.id);
    label.classList.add("custom-control-label");

    label.appendChild(document.createTextNode(permission.name));

    checkboxdiv.appendChild(checkBox);
    checkboxdiv.appendChild(label);

    divPermissions.appendChild(checkboxdiv);
  }
}

function loadUserCategories(categories) {
  var tbody = categoriesTable.querySelector("tbody");
  categoriesTable.removeChild(tbody);
  var newBody = document.createElement("tbody");
  for (var i = 0; i < categories.length; i++) {
    let category = categories[i];
    let name = category.name;
    let description = category.description;
    let permissions = category.permissions;
    let access_level = category.access_level;

    var permissionlist = document.createElement("ul");
    permissionlist.classList.add("list-inline");

    for (let z = 0; z < permissions.length; z++) {
      let permission = permissions[z];

      var permissionitem = document.createElement("li");
      permissionitem.classList.add("permission-tag");
      if (userPermissions != null) {
        userPermissions.forEach(perm => {
          if (perm.id == permission) {
            permissionitem.appendChild(document.createTextNode(perm.name));
          }
        })
      }

      permissionlist.appendChild(permissionitem);
    }


    var editUserCategory = document.createElement("a");
    editUserCategory.setAttribute("href", "#");
    editUserCategory.setAttribute("data-toggle", "modal");
    editUserCategory.setAttribute("data-target", "#userCategoryModal");
    editUserCategory.setAttribute("data-tooltip", "tooltip");
    editUserCategory.setAttribute("title", "Edit User Category");
    editUserCategory.setAttribute("data-placement", "bottom");
    editUserCategory.classList.add("btn");
    editUserCategory.classList.add("btn-light");
    editUserCategory.classList.add("btn-circle");
    editUserCategory.classList.add("btn-sm");
    editUserCategory.classList.add("app-button");
    editUserCategory.innerHTML = '<i class="fas fa-edit"></i>';
    editUserCategory.addEventListener("click", () =>
      funEditCategory(category)
    );

    var deleteUserCategory = document.createElement("a");
    deleteUserCategory.setAttribute("href", "#");
    deleteUserCategory.setAttribute("data-tooltip", "tooltip");
    deleteUserCategory.setAttribute("title", "Delete User Category");
    deleteUserCategory.setAttribute("data-placement", "bottom");
    deleteUserCategory.classList.add("btn");
    deleteUserCategory.classList.add("btn-light");
    deleteUserCategory.classList.add("btn-circle");
    deleteUserCategory.classList.add("btn-sm");
    deleteUserCategory.classList.add("app-button");
    deleteUserCategory.innerHTML = '<i class="fas fa-trash"></i>';

    var row = newBody.insertRow(i);
    row.insertCell(0).appendChild(document.createTextNode(name));
    row.insertCell(1).appendChild(document.createTextNode(description));
    row.insertCell(2).appendChild(document.createTextNode(access_level));
    var permissioncol = row.insertCell(3);
    permissioncol.setAttribute("width", "60%");
    permissioncol.appendChild(permissionlist);
    console.dir(permissionlist);
    var actionsCell = row.insertCell(4);

    var actionDiv = document.createElement("div");
    actionDiv.classList.add("row");

    actionDiv.appendChild(editUserCategory);
    // actionDiv.appendChild(deleteUserCategory);
    actionsCell.appendChild(actionDiv);
  }
  categoriesTable.appendChild(newBody);
  $('[data-tooltip="tooltip"]').tooltip();
  $(categoriesTable).DataTable();
}

function funEditCategory(category) {
  editedCategory = category.id
  inputCategoryName.value = category.name;
  inputCategoryDesc.value = category.description;
  $(accessLevelSelect).val(category.access_level)
  let checkBoxes = divPermissions.querySelectorAll('input')
  for (let i = 0; i < checkBoxes.length; i++){
    let checkbox = checkBoxes[i]
    console.log('Here and there' + checkbox.getAttribute('id'));
    if(category.permissions.includes(checkbox.getAttribute('id'))){
      checkbox.checked = true
    }
  }
}

function clearCategoryDialog() {
  editedCategory = ''
  document.getElementById("formCategory").reset()
}

function saveCategory() {
  var name = inputCategoryName.value
  var description = inputCategoryDesc.value
  let access_level = accessLevelSelect.options[accessLevelSelect.selectedIndex].value
  var chkboxes = divPermissions.querySelectorAll("input")
  let permissions = []
  for (let c = 0; c < chkboxes.length; c++) {
    let chkbox = chkboxes[c]
    if (chkbox.checked == true) {
      permissions.push(chkbox.id);
      console.log(chkbox.id);
    }
  }

  $.ajax({
    type: "POST",
    url: "save_user_category",
    data: {
      id: editedCategory,
      name: name,
      access_level: access_level,
      description: description,
      permissions: permissions,
    },
    success: function (response) {
      let categories = JSON.parse(response)
      loadUserCategories(categories)
      toastr.success("Saved successfully")
      hideModal("userCategoryModal")
    },
    error: function (error) {
      console.log(error);
      toastr.error("Unable to save user category")
      //   handleAjaxError(error);
    },
  });
}



initialize()