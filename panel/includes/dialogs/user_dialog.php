<div class="modal fade" id="addUsermodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="code.php" method="POST" id="formUser" onsubmit="event.preventDefault();">

                <div class="modal-body">

                    <div class="form-group">
                        <label>Names</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Names" id="inputUserName" required>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <select id="genderSelect" class="form-select">
                            <option hidden value="">Select gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="number" name="name" class="form-control" placeholder="Enter Phone Number" id="inputPhone" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="name" class="form-control" placeholder="Enter Email" id="inputEmail" required>
                    </div>
                    <div class="form-group">
                        <label>User Category</label>
                        <select id="categorySelect" class="form-select">
                            <option hidden value="">Select User Category</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Project</label>
                        <select id="projectSelect" class="form-select">
                            <option hidden value="">Select Project</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Facility</label>
                        <select id="facilitySelect" class="form-select">
                            <option hidden value="0">Select Facility</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="btnClose">Close</button>
                    <button type="submit" name="btnSubmit" class="btn btn-primary" id="btnSaveUser">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var editedUser = ''
    const inputUserName = document.getElementById("inputUserName")
    const genderSelect = document.getElementById("genderSelect")
    const inputPhone = document.getElementById("inputPhone")
    const inputEmail = document.getElementById("inputEmail")
    const categorySelect = document.getElementById("categorySelect")
    const projectSelect = document.getElementById("projectSelect")
    const facilitySelect = document.getElementById("facilitySelect")

    function saveUser() {
        let name = inputUserName.value.trim()
        let gender = genderSelect.options[genderSelect.selectedIndex].value
        let email = inputEmail.value.trim()
        let phone = inputPhone.value.trim()
        let project = projectSelect.options[projectSelect.selectedIndex].value
        let category = categorySelect.options[categorySelect.selectedIndex].value
        let facility = facilitySelect.options[facilitySelect.selectedIndex].value
        $.ajax({
            type: "POST",
            url: "save_user",
            data: {
                id: editedUser,
                names: name,
                gender: gender,
                email: email,
                phone: phone,
                project: project,
                category: category,
                facility: facility
            },
            success: response => {
                let users = JSON.parse(response)
                // $('#addUsermodal').modal('hide');
                hideModal('addUsermodal')
                console.log("Here now");
                loadUsersToTable(users)
            },
            error: err => {

            }
        })
    }

    function funEditUser(user) {
        editedUser = user.id
        inputUserName.value = user.names
        $(genderSelect).val(user.gender)
        inputPhone.value = user.phone
        inputEmail.value = user.email
        $(categorySelect).val(user.category)
        $(projectSelect).val(user.project)
        $(facilitySelect).val(user.facility)
    }

    function clearUserDialog() {
        editedUser = ''
        document.getElementById("formUser").reset()
    }

    document.getElementById('btnSaveUser').addEventListener('click', () => saveUser())
    $("#userCategoryModal").on("hide.bs.modal", () => {
        clearUserDialog()
    });
</script>