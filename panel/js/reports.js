const btnGenerateReport = document.getElementById("btnGenerateReport")
const inputStartDate = document.getElementById("inputStartDate")
const inputEndDate = document.getElementById("inputEndDate")
const btnPdfReport = document.getElementById("btnPdfReport")
const btnExcelReport = document.getElementById("btnExcelReport")
const selectReport = document.getElementById("selectReport")

var reports = []

function initialize(){
    $.ajax({
        dataType: 'json',
        url: "../assets/data.json",
        success: data => {
            reports = data.reports
            reports.forEach(report => {
                let option = document.createElement('option')
                option.setAttribute('value', report.id);
                option.appendChild(document.createTextNode(report.name));
                selectReport.appendChild(option);
            })
        },
        error: err => {
            toastr.error(err.statusText, err.status)
        }
    })

    btnPdfReport.addEventListener('click', ()=>generateReport("pdf"))
    btnExcelReport.addEventListener('click', ()=>generateReport("excel"))
}

function generateReport(type){
    window.open('report/covidData')
}



initialize()
