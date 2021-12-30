
function _populate(elem, arrayOptions) {
    arrayOptions.forEach(o => {
        const option = document.createElement('option');
        option.classList.add('red');
        option.value = o.entry_uid;
        option.textContent = o.time;
        elem.appendChild(option);
    })
}


export function useTimeslots(selector, config) {


    const el = document.querySelector(selector);
    _populate(el, config.arrayOptions)


    // methods that are exposed outside.
    const self = {
        populate: (arrayOptions) => {
            while (el.childNodes.length > 2) {
                el.removeChild(el.lastChild);
            }
            _populate(el, arrayOptions)
        },

        onChange: (callback) => {
            el.addEventListener('change', callback)
        },

        display: (uid) => {
            if (!uid) return;
            console.log(uid);
            el.value = uid;
        },

        onFocus: () => {
            console.log(el.parentElement);
            el.parentElement.classList.add('select--focus');

            el.addEventListener('focus', function () {
                el.parentElement.classList.remove("select--focus");
            })
        },

        setDefault: (msg) => {
            el.querySelector("option[default]").text = msg;
        }
    }

    return self
}


