const burger = document.querySelector("#burger");
const siteLinks = document.querySelector(".site-links")

burger.addEventListener("click", function () {
    if (siteLinks.classList.contains("site-links--show")) {
        siteLinks.classList.remove("site-links--show")
    } else {
        siteLinks.classList.add("site-links--show")

    }
})
