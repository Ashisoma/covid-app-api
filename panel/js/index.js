



function initialize(){
    $.ajax({
        type: "GET",
        url: "getDashboardData",
        success: response => {
            let data = JSON.parse(response)
            loadScreenings(data.screenings)
            loadRequests(data.labRequests, [])
        },
        error: error => {
            toastr.error("Unable to load data c0z = " + error.message)
        }
    })
}

function loadScreenings(screenings){

    /**
     * 
     * 
     |-----------------Covid presumptive ----------------------|x3e
fever_history, general_weakness,cough, sore_throat, runny_nose,
 loss_of_taste, loss_of_smell, breathing_difficulty, irritability,
 nausea, shortness_of_breath, pain
    
     |----------------- TB presumptive --------------------|x3e
     fever_history,cough, weight_loss, night_sweats, breathing_difficulty,
     headache, irritability,pain
     *
     */
    let presumptiveCovid = 0, presumptiveTB = 0;
    screenings.forEach(screening => {
        //for covid
        if(screening.fever_history === "Yes"
        || screening.general_weakness === "Yes"
        || screening.cough === "Yes"
        || screening.sore_throat === "Yes"
        || screening.runny_nose === "Yes"
        || screening.loss_of_taste === "Yes"
        || screening.loss_of_smell === "Yes"
        || screening.breathing_difficulty === "Yes"
        || screening.irritability === "Yes"
        || screening.nausea === "Yes"
        || screening.shortness_of_breath === "Yes"
        || screening.pain === "Yes"
        ) presumptiveCovid++
        // for TB
        if(screening.fever_history === "Yes" 
        || screening.cough === "Yes"
        || screening.weight_loss === "Yes"
        || screening.night_sweats === "Yes"
        || screening.breathing_difficulty === "Yes"
        || screening.headache === "Yes"
        || screening.irritability === "Yes"
        || screening.pain === "Yes"
        ) presumptiveTB++        
    })
    document.getElementById("pPresumptiveTb").innerText = presumptiveTB
    document.getElementById("pPresumptiveCovid").innerText = presumptiveCovid
    document.getElementById("pTotalScreened").innerText = screenings.length
}

function loadRequests(labRequests, radiologyRequests){
    let labRequestsReceived = 0, radiologyRequestsReceived = 0
    let tbConfirmed = 0, covidConfirmed = 0
    labRequests.forEach(labRequest => {
        if(labRequest.date_received_in_lab != null) {
            labRequestsReceived++
            if(labRequest.test_type === "GeneXpert") {
                if(labRequest.lab_result === "MTB +, RR"
                ||labRequest.lab_result === "MTB+, RS") tbConfirmed++
            } else if(labRequest.test_type === "Sputum Microscopy"
            || labRequest.test_type === "Culture") {
                if(labRequest.lab_result === "Pos") tbConfirmed++
            }
        }

    })
    radiologyRequests.forEach(radiologyRequest => {
        //TODO Fix later
        if(radiologyRequest.date_received_in_rad != null) radiologyRequestsReceived++
    })
    document.getElementById("pLabRequestsSent").innerText = labRequests.length
    document.getElementById("pRadRequestsSent").innerText = radiologyRequests.length
    document.getElementById("pLabRequestsReceived").innerText = labRequestsReceived
    document.getElementById("pRadRequestsReceived").innerText = radiologyRequestsReceived

    document.getElementById("pTBConfirmed").innerText = tbConfirmed
    document.getElementById("pCovidConfirmed").innerText = covidConfirmed

}


initialize()
