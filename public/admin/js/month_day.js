//Create references to the dropdown's
const yearSelect = document.getElementById("year");
const monthSelect = document.getElementById("month");
const daySelect = document.getElementById("day");

const months = ['1月', '2月', '3月', '4月',
    '5月', '6月', '7月', '8月', '9月', '10月',
    '11月', '12月'
];

//Months are always the same
(function populateMonths() {
    for (let i = 0; i < months.length; i++) {
        const option = document.createElement('option');
        option.textContent = months[i];
        monthSelect.appendChild(option);
    }
    monthSelect.value = "1月";
})();

let previousDay;

function populateDays(month) {
    //Delete all of the children of the day dropdown
    //if they do exist
    while (daySelect.firstChild) {
        daySelect.removeChild(daySelect.firstChild);
    }
    //Holds the number of days in the month
    let dayNum;
    //Get the current year
    let year = yearSelect.value;

    if (month === '1月' || month === '3月' ||
        month === '5月' || month === '7月' || month === '8月' ||
        month === '10月' || month === '12月') {
        dayNum = 31;
    } else if (month === '4月' || month === '6月' ||
        month === '9月' || month === '11月') {
        dayNum = 30;
    } else {
        //Check for a leap year
        if (new Date(year, 1, 29).getMonth() === 1) {
            dayNum = 29;
        } else {
            dayNum = 28;
        }
    }
    //Insert the correct days into the day <select>
    for (let i = 1; i <= dayNum; i++) {
        const option = document.createElement("option");
        option.textContent = i;
        daySelect.appendChild(option);
    }
    if (previousDay) {
        daySelect.value = previousDay;
        if (daySelect.value === "") {
            daySelect.value = previousDay - 1;
        }
        if (daySelect.value === "") {
            daySelect.value = previousDay - 2;
        }
        if (daySelect.value === "") {
            daySelect.value = previousDay - 3;
        }
    }
}

function populateYears() {
    //Get the current year as a number
    let year = new Date().getFullYear();
    //Make the previous 100 years be an option
    for (let i = 0; i < 101; i++) {
        const option = document.createElement("option");
        option.textContent = year - i;
        yearSelect.appendChild(option);
    }
}

populateDays(monthSelect.value);
populateYears();

yearSelect.onchange = function() {
    populateDays(monthSelect.value);
}
monthSelect.onchange = function() {
    populateDays(monthSelect.value);
}
daySelect.onchange = function() {
    previousDay = daySelect.value;
}