<div class="modal fade" id="checkinDialogModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Check In Patient</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="search-container">
                    <form id="facilityForm" action="code.php" method="POST" onsubmit="event.preventDefault();">



                        <div class="input-group mb-2">
                            <input type="text" class="form-control" placeholder="Search" id="inputSearch">
                            <button class="btn btn-default" type="submit" onclick="searchPatient();">
                                <i class="fa fa-search"></i>
                            </button>

                        </div>

                    </form>
                </div>

                <hr>
                <div class="card-body">

                    <table class="table table-striped" id="tableSearchResults">

                        <tbody>
                            <!-- <tr>
                                <td>
                                    <h6>Names: Sample</h6>
                                    <h6>Facility: Sample</h6>
                                    <p>Details: Sample</p>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success submit mt-2 mb-5 float-right"><i class="fas fa-sign-in-alt" aria-hidden="true"></i>Check in Patient</button>
                                </td>
                            </tr> -->

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .search-container button:hover {
        background: #ccc;
    }
</style>

<script>
    const inputSearch = document.getElementById('inputSearch')
    const tableSearchResults = document.getElementById('tableSearchResults')
    $(document).ready(function() {
        $("#checkinDialogModal").on("hide.bs.modal", () => {
            clearSearchDialog()
        })

    })

    function searchPatient() {
        let searchString = inputSearch.value.trim();
        $.ajax({
            type: "GET",
            url: "searchPatient/" + searchString,
            success: response => {
                loadSearchResults(JSON.parse(response))
            },
            error: err => {
                toastr.error("Unable to search patient")
            }
        })
    }

    function loadSearchResults(patients) {
        let tbody = tableSearchResults.querySelector('tbody');
        tableSearchResults.removeChild(tbody);
        let newBody = document.createElement('tbody')
        let i = 0
        patients.forEach(patient => {
            let row = newBody.insertRow(i)
            let detailsTd = row.insertCell(0)
            let nameHeader = document.createElement('h6')
            nameHeader.innerText = "Name: " + patient.firstName + ' ' + patient.secondName + ' ' + patient.surname
            let facilityHeader = document.createElement('h6')
            facilityHeader.innerText = "Facility: " + patient.facilityData.name
            detailsTd.appendChild(nameHeader)
            detailsTd.appendChild(facilityHeader)
            let actionTd = row.insertCell(1)

            let checkInBtn = document.createElement('button')
            checkInBtn.classList.add('btn', 'btn-success', 'submit', 'mt-2', 'mb-5', 'float-right')
            checkInBtn.innerHTML = "<i class=\"fas fa-sign-in-alt\"></i>Check in"
            checkInBtn.addEventListener('click', () => checkInPatient(patient))
            actionTd.appendChild(checkInBtn)
            i++
        })
        tableSearchResults.appendChild(newBody)
    }

    function clearSearchDialog() {
        inputSearch.value = ''
        let tbody = tableSearchResults.querySelector('tbody');
        tableSearchResults.removeChild(tbody);
        let newBody = document.createElement('tbody')
        tableSearchResults.appendChild(newBody)
    }
</script>