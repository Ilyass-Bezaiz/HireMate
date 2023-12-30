import './bootstrap';



// ----------------------------------- VARIABLES --------------------------------------------------------

// { VIEW: employer-home }
let offerDescription = document.getElementById('offer-description');
let listOffersContainer = document.getElementById('offers-list-container');

// ----------------------------------- LISTENERS --------------------------------------------------------

// { VIEW: employer-home }
offerDescription.addEventListener("scroll", (e) => blurDev(e));
listOffersContainer.addEventListener("scroll", (e) => blurDev(e));

// ----------------------------------- FUNCTIONS --------------------------------------------------------

// { VIEW: employer-home }
let blurDev = (e) => {
    let scrollPos = e.target.scrollTop;
    if (scrollPos == 0) {
        e.target.classList.replace("not-blur-dev", "blur-dev");
    } else if (scrollPos == e.target.clientHeight) {
        e.target.classList.replace("not-blur-dev", "blur-dev");
    } else {
        e.target.classList.replace("blur-dev", "not-blur-dev");
    }
}

