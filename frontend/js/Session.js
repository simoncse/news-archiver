export default class Session {
    static datePicker = {};


    static earliestDate() {
        return sessionStorage.getItem("earliestDate") ?? null;
    }
    static setEarliestDate(dateObj) {
        sessionStorage.setItem("earliestDate", dateObj);
    }

    static latestDate() {
        return sessionStorage.getItem("latestDate") ?? null;
    }

    static setLatestDate(dateObj) {
        sessionStorage.setItem("latestDate", dateObj);
    }

    static timeslots() {
        const store = sessionStorage.getItem("timeslots");
        if (store) {
            return JSON.parse(store);
        }
        return null;
    }

    static setTimeslots(arr) {
        sessionStorage.setItem("timeslots", JSON.stringify(arr));
    }

    static currentDate() {
        return sessionStorage.getItem("currentDate") ?? null;
    }
    static setCurrentDate(dateObj) {
        sessionStorage.setItem("currentDate", dateObj);
    }

    static entryID() {
        return sessionStorage.getItem("entry") ?? null;
    }

    static setEntryID(uid) {
        // if (uid == false) {
        //     sessionStorage.removeItem("entry");
        //     return;
        // }
        sessionStorage.setItem("entry", uid)
    }

    static checkboxes() {
        const store = sessionStorage.getItem("checkboxes");
        if (store) {
            return JSON.parse(store);
        }
        return null;
    }

    static setCheckboxes(arr) {
        sessionStorage.setItem("checkboxes", JSON.stringify(arr));
    }

    static clearPreference() {
        sessionStorage.removeItem("entry");
        sessionStorage.removeItem("checkboxes");
    }


    static exists() {
        return this.earliestDate() !== null &&
            this.latestDate() !== null &&
            this.timeslots() !== null &&
            this.currentDate() !== null;
    }

}