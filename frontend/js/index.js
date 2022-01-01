// import { populateTimeslots, setURLParams } from './helpers'
import { getEntriesByDate } from './data';
import { useTimeslots } from './Timeslots';
import Session from './Session';
import { Toast, LoadingToast } from "./toast";



let currentDate;
let latestDate;
let earliestDate;
let timeslots;
//Load latest and earliest date from _info (echo from php)
if (!Session.exists() || !window.location.search) {
    // console.log("Session not exists");
    latestDate = new Date(context.date);
    currentDate = new Date(context.date);
    earliestDate = new Date(context.earliestDate);
    timeslots = context.timeslots;
    Session.setLatestDate(latestDate);
    Session.setCurrentDate(currentDate);
    Session.setEarliestDate(earliestDate);
    Session.setTimeslots(timeslots);
    Session.clearPreference();
} else {
    // console.log("Session exists")
    currentDate = new Date(Session.currentDate());
    latestDate = new Date(Session.latestDate());
    earliestDate = new Date(Session.earliestDate());
    timeslots = Session.timeslots();
}





import flatpickr from 'flatpickr';
// require("flatpickr/dist/flatpickr.min.css")

//Load available times 
const timeslotsControl = useTimeslots("#timeslots", {
    arrayOptions: timeslots,
});

const checkboxes = document.querySelectorAll('.channel__options input[type="checkbox"]')
const searchForm = document.querySelector("#search");
const searchBtn = searchForm.querySelector("button");

document.addEventListener("DOMContentLoaded", function () {

    Toast.init();
    LoadingToast.init();

    //Load and config datepicker 
    flatpickr("#datePicker", {
        defaultDate: currentDate,
        minDate: earliestDate,
        maxDate: latestDate,
        dateFormat: "M d Y",

        onChange: handleDateSelected
    })

    timeslotsControl.display(Session.entryID());

    timeslotsControl.onChange(function (e) {
        const uid = e.target.value
        Session.setEntryID(uid);
    })



    const checkboxesOpt = new Set();
    checkboxes.forEach(c => {
        checkboxesOpt.add(c.value);
    })

    const savedOpt = Session.checkboxes();

    if (savedOpt) {
        checkboxes.forEach(c => {
            c.checked = savedOpt.includes(c.value) ? true : false;
        })
    }

    checkboxes.forEach(c => {
        c.addEventListener('change', function () {
            if (this.checked) {
                checkboxesOpt.add(this.value);
                Session.setCheckboxes(Array.from(checkboxesOpt));
            } else {
                checkboxesOpt.delete(this.value);
                Session.setCheckboxes(Array.from(checkboxesOpt));

            }
        })
    })


    searchForm.addEventListener("submit", validateSearch)


})






async function handleDateSelected(d) {
    searchBtn.disabled = false;
    Toast.hide();

    // changed back to the string format that are used by the api => e.g. 2000-10-10 
    const dateString = flatpickr.formatDate(new Date(d), 'Y-m-d');
    const dateUI = flatpickr.formatDate(new Date(d), "M d Y");

    let data;
    LoadingToast.show(`Getting entries at ${dateUI} `);
    data = await getEntriesByDate(dateString)
    LoadingToast.hide();

    if (data) {
        timeslotsControl.setDefault("Select a time:");
        timeslotsControl.onFocus();
        timeslotsControl.populate(data.context.timeslots);
        Session.setCurrentDate(new Date(dateString));
        Session.setTimeslots(data.context.timeslots);

    } else {
        Toast.show(`Entries at ${dateUI} not found.`, "error");
        timeslotsControl.populate([]);
        timeslotsControl.setDefault("No entries for this date.");
        // console.log(searchBtn)
        searchBtn.disabled = true;
    }

}




function validateSearch(e) {
    // console.log(atLeastOneCheckbox());
    if (!atLeastOneCheckbox()) {
        e.preventDefault();
        console.log("Please select at least one news channels");
        Toast.show("Please select at least one news channels", "error")
    }
}

function atLeastOneCheckbox() {
    let arr = [];
    checkboxes.forEach(c => {
        arr.push(c.checked);
    })

    console.log(arr)
    console.log(arr.includes(true))
    return arr.includes(true);
}











