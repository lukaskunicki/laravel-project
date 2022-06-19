require("./bootstrap");
import { getCardTemplate } from "./config";

const runApiQuery = async (value, endpoint) => {
    try {
        const response = await fetch(endpoint + value);
        const result = await response.json();
        return result;
    } catch (e) {
        console.error("Error occured while fetching search results", e);
    }
};

const populateSearchResults = (results, targetContainer) => {
    if (!results?.length) {
        targetContainer.innerHTML = "<span>Nothing found, sorry!</span>";
        return;
    }
    const {
        dataset: { template },
    } = targetContainer;
    targetContainer.innerHTML = "";

    results.forEach((card) => {
        targetContainer.innerHTML += getCardTemplate(template, card);
    });
};

const runSearchQuery = async (searchContainer, targetContainer) => {
    const searchInput = searchContainer.querySelector('input[type="search"]');
    if (!searchInput) return;
    const {
        value,
        dataset: { endpoint },
    } = searchInput;
    if (!value) return;
    targetContainer.innerHTML =
        '<span class="searching-animation">Searching...</span>';
    const searchResults = await runApiQuery(value, endpoint);
    populateSearchResults(searchResults, targetContainer);
};
const handleSearch = () => {
    const searchContainer = document.querySelector("#search-container");
    const targetContainer = document.querySelector("#search-results");
    if (!searchContainer || !targetContainer) return;
    const submitBtn = searchContainer.querySelector("button");
    submitBtn.addEventListener("click", () =>
        runSearchQuery(searchContainer, targetContainer)
    );
};

handleSearch();
