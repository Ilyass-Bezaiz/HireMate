import './bootstrap';



// ----------------------------------- VARUABLES --------------------------------------------------------

// { VIEW: employer-home }
let offerDescription = document.getElementById('offer-description');
let icLike = document.querySelectorAll('.ic-heart');
let listOffers = document.querySelectorAll('li');
let listOffersContainer = document.getElementById('offers-list-container');
// let filtersCard = document.getElementById('filters-card');
let btnFilters = document.getElementById('btn-filters');
// let btnCloseFiltersCard = document.getElementById('btn-close-filters-card');
// let rangeSalary = document.getElementById('range-salary');
// let valueRangeSalary = document.getElementById('value-range-salary');
// let rangeExperience = document.getElementById('range-experience');
// let valueExperienceSalary = document.getElementById('value-range-experience');

// ----------------------------------- LISTNERS --------------------------------------------------------

// { VIEW: employer-home }
offerDescription.addEventListener("scroll", (e) => blurDev(e));
listOffersContainer.addEventListener("scroll", (e) => blurDev(e));
icLike.forEach((e, index) => e.addEventListener("click", (e) => likeOffer(e, index)));
listOffers.forEach((element, index) => element.addEventListener("click", (e) => showOfferDetails(e, index)));
btnFilters.addEventListener("click", () => toggleFiltersCard());
// btnCloseFiltersCard.addEventListener("click", () => toggleFiltersCard());
// rangeSalary.addEventListener('input', () => valueRangeSalary.innerHTML = "$" + rangeSalary.value + " +");
// rangeExperience.addEventListener('input', () => valueExperienceSalary.innerHTML =  rangeExperience.value + "+ years");

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

// { VIEW: employer-home }
let likeOffer = (e, postId) => {
    e.target.getAttribute('src') == "images/ic-empty-heart.png" ? e.target.src = "images/ic-full-heart.png" : e.target.src = "images/ic-empty-heart.png";
    // e.target.setAttribute("wire:init", 'addFav');
}

// { VIEW: employer-home }
let showOfferDetails = (e, postId) => {
    if (e.target.tagName.toLowerCase() != 'img') {
        listOffers.forEach((element) => {
            element.classList.remove("checked");
            // e.target.setAttribute("wire:init", 'showOfferDetails');
        });
        if(e.target.tagName.toLowerCase() === 'li') {
            e.target.classList.add("checked");
            // e.target.setAttribute("wire:init", 'showOfferDetails');
        } else if (e.target.parentElement.tagName.toLowerCase() === "li") {
            e.target.parentElement.classList.add("checked");
            // e.target.setAttribute("wire:init", 'showOfferDetails');
        } else if (e.target.parentElement.parentElement.tagName.toLowerCase() === "li") {
            e.target.parentElement.parentElement.classList.add("checked");
            // e.target.setAttribute("wire:init", 'showOfferDetails');
        } else if (e.target.parentElement.parentElement.parentElement.tagName.toLowerCase() === "li") {
            e.target.parentElement.parentElement.parentElement.classList.add("checked");
            // e.target.setAttribute("wire:init", 'showOfferDetails');
        }
    }
}

// { VIEW: employer-home }
let toggleFiltersCard = () => {
    filtersCard.classList.contains("hidden") ? 
    filtersCard.classList.replace("hidden", "block") : 
    filtersCard.classList.replace("block", "hidden");
}
