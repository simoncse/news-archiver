// (function setTimeZoneCookie() {
//     //get timezone and set the cookie;

//     const tz = Intl.DateTimeFormat().resolvedOptions().timeZone;
//     console.log('Timezone is: ' + tz);
//     document.cookie = "timezone=" + tz
// })();



export function populateTimeslots(elem, config) {

    config.arrayOptions.forEach(o => {
        const option = document.createElement('option');
        option.value = o.entry_uid;
        option.textContent = o.time;
        elem.appendChild(option);
    })

    elem.addEventListener('change', config.onChange)

}

const _URL = new URL(window.location.href);
export function setURLParams(key, value) {
    _URL.searchParams.set(key, value)
    window.location.href = _URL.href;
}




