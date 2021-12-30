export const Toast = {
    init() {
        this.el = document.createElement("div");
        this.el.className = "toast";

        this.p = document.createElement("p");

        this.btn = document.createElement("span");
        this.btn.className = "toast--btn";
        this.btn.innerHTML = "&times;";

        this.el.appendChild(this.p);
        this.el.appendChild(this.btn);
        document.body.appendChild(this.el);

        this.btn.addEventListener('click', function () {
            Toast.hide();
        })

    },

    hide() {
        this.el.className = "toast";
    },

    show(message, state) {

        this.p.textContent = message;
        this.el.classList.add("toast--visible");
        if (state) {
            this.el.classList.add(`toast--${state}`);
        }
    }
};

export const LoadingToast = {
    init() {
        this.el = document.createElement("div");
        this.el.className = "toast--loading";

        this.p = document.createElement("p");

        this.spinning = document.createElement("span");
        this.spinning.className = "spinning";

        this.el.appendChild(this.p);
        this.el.appendChild(this.spinning);
        document.body.appendChild(this.el);
    },

    hide() {
        this.el.className = "toast--loading";
    },

    show(message) {

        this.p.textContent = message;
        this.el.classList.add("toast--visible");
    }
};

