<div class="modal fade" id="facilityDialogModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Facility</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="facilityForm" action="code.php" method="POST" onsubmit="event.preventDefault();">

                <div class="modal-body">

                    <div class="form-group">
                        <label>MFL Code</label>
                        <input type="text" name="Code" id='inputMflCode' class="form-control" placeholder="Enter Facility MFL Code" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Facility Name</label>
                        <input type="text" name="facilityname" id='inputName' class="form-control" placeholder="Enter Facility Name" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Project</label>
                        <select id="projectSelect" class="form-control">
                            <option selected hidden value="">Select Project</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>County</label>
                        <select id="countySelect" class="form-control">
                            <option selected hidden value="">Select County</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Sub County</label>
                        <select id="subcountySelect" class="form-control">
                            <option selected hidden value="">Select Sub County</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="registerbtn" class="btn btn-primary" id="btnSaveFacility">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>
<script>
    const countySelect = document.getElementById("countySelect")
    const inputMflCode = document.getElementById("inputMflCode")
    const inputName = document.getElementById("inputName")
    const subcountySelect = document.getElementById("subcountySelect")
    const projectSelect = document.getElementById("projectSelect")

    var editedFacility = ''

    function saveFacility() {
        let name = inputName.value;
        let mfl_code = inputMflCode.value;
        let project = projectSelect.options[projectSelect.selectedIndex].value
        let county = countySelect.options[countySelect.selectedIndex].value;
        let subcounty = subcountySelect.options[subcountySelect.selectedIndex].value;
        let error = false
        if (name.length < 1) {
            error = true;
        }
        if (mfl_code.length < 5) {
            error = true;
        }
        if (county.length < 1) {
            error = true;
        }
        if (subcounty.length < 1) {
            error = true;
        }
        if (error) {
            return;
        }

        $.ajax({
            type: "POST",
            url: "save_facility",
            data: {
                id: editedFacility,
                name: name,
                mflCode: mfl_code,
                project: project,
                county: county,
                subCounty: subcounty
            },
            success: function(response) {
                var facilities = JSON.parse(response);
                $('#facilityDialogModal').modal('hide');
                loadDataToTable(facilities);
                toastr.success('Facility saved successfully')
            },
            error: err => {
                toastr.error("Unable to save facilities")
            }
        })

    }

    function editFacility(facility) {
        editedFacility = facility.id
        inputName.value = facility.name;
        inputMflCode.value = facility.mflCode;
        $(projectSelect).val(facility.project)
        console.log(facility.subCounty);
        $(countySelect).val(facility.county)
        selectedCountyChange();
        $(subcountySelect).val(facility.subCounty)



    }

    function clearFacilityDialog() {
        editedFacility = ''
        document.getElementById("facilityForm").reset()
    }

    document.getElementById('btnSaveFacility').addEventListener('click', () => saveFacility())
    $("#facilityDialogModal").on("hide.bs.modal", () => {
        clearFacilityDialog()
    });
    countySelect.addEventListener('change', () => selectedCountyChange());

    function selectedCountyChange() {
        let selected = countySelect.options[countySelect.selectedIndex].value;
        let len = subcountySelect.options.length;
        for (let i = 1; i <= len; i++) {
            subcountySelect.options[i] = null;
        }
        for (let i = 0; i < counties.length; i++) {
            let county = counties[i];
            if (county.code == selected) {
                let subcounties = county.subcounties;
                for (let j = 0; j < subcounties.length; j++) {
                    let sub = subcounties[j];
                    let option = document.createElement('option');
                    option.setAttribute('value', sub.id);
                    option.appendChild(document.createTextNode(sub.name));
                    subcountySelect.appendChild(option);
                }
                break;
            }
        }
    }
</script>