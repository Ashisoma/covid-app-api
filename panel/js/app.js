
var DateFormatter = {
    monthNames: [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ],
    dayNames: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
    formatDate: function (date, format) {
        var self = this;
        format = self.getProperDigits(format, /d+/gi, date.getDate());
        format = self.getProperDigits(format, /M+/g, date.getMonth() + 1);
        format = format.replace(/y+/gi, function (y) {
            var len = y.length;
            var year = date.getFullYear();
            if (len == 2)
                return (year + "").slice(-2);
            else if (len == 4)
                return year;
            return y;
        })
        format = self.getProperDigits(format, /H+/g, date.getHours());
        format = self.getProperDigits(format, /h+/g, self.getHours12(date.getHours()));
        format = self.getProperDigits(format, /m+/g, date.getMinutes());
        format = self.getProperDigits(format, /s+/gi, date.getSeconds());
        format = format.replace(/a/ig, function (a) {
            var amPm = self.getAmPm(date.getHours())
            if (a === 'A')
                return amPm.toUpperCase();
            return amPm;
        })
        format = self.getFullOr3Letters(format, /d+/gi, self.dayNames, date.getDay())
        format = self.getFullOr3Letters(format, /M+/g, self.monthNames, date.getMonth())
        return format;
    },
    getProperDigits: function (format, regex, value) {
        return format.replace(regex, function (m) {
            var length = m.length;
            if (length == 1)
                return value;
            else if (length == 2)
                return ('0' + value).slice(-2);
            return m;
        })
    },
    getHours12: function (hours) {
        // https://stackoverflow.com/questions/10556879/changing-the-1-24-hour-to-1-12-hour-for-the-gethours-method
        return (hours + 24) % 12 || 12;
    },
    getAmPm: function (hours) {
        // https://stackoverflow.com/questions/8888491/how-do-you-display-javascript-datetime-in-12-hour-am-pm-format
        return hours >= 12 ? 'pm' : 'am';
    },
    getFullOr3Letters: function (format, regex, nameArray, value) {
        return format.replace(regex, function (s) {
            var len = s.length;
            if (len == 3)
                return nameArray[value].substr(0, 3);
            else if (len == 4)
                return nameArray[value];
            return s;
        })
    }
}

/**
 * Removes all the children within the given element
 * @param {HTMLElement} parent 
 */
function removeAllChildNodes(parent) {
    while (parent.firstChild) {
        parent.removeChild(parent.firstChild);
    }
}

function hideModal(modalId) {
    $("#" + modalId).removeClass("in");
    $("#" + modalId).removeClass("show");
    $(".modal-backdrop").remove();
    $('body').removeClass('modal-open');
    $('body').css('padding-right', '');
    $("#"+ modalId).hide();
}
function calculateAge(dobString){
    let dob = new Date(dobString)
    var diff_ms = Date.now() - dob.getTime();
    var age_dt = new Date(diff_ms);
    return Math.abs(age_dt.getUTCFullYear() - 1970);
}
toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-bottom-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}