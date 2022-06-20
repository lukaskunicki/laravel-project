require('./bootstrap');
import {getCardTemplate, validationRules} from './config';

const runApiQuery = async (value, endpoint) => {
	try {
		const response = await fetch(endpoint + value);
		const result = await response.json();
		return result;
	} catch (e) {
		console.error('Error occured while fetching search results', e);
	}
};

const populateSearchResults = (results, targetContainer) => {
	if (!results?.length) {
		targetContainer.innerHTML = '<span>Nothing found, sorry!</span>';
		return;
	}
	const {
		dataset: {template}
	} = targetContainer;
	targetContainer.innerHTML = '';

	results.forEach((card) => {
		targetContainer.innerHTML += getCardTemplate(template, card);
	});
};

const runSearchQuery = async (searchContainer, targetContainer) => {
	const searchInput = searchContainer.querySelector('input[type="search"]');
	if (!searchInput) return;
	const {
		value,
		dataset: {endpoint}
	} = searchInput;
	if (!value) return;
	targetContainer.innerHTML =
		'<span class="searching-animation">Searching...</span>';
	const searchResults = await runApiQuery(value, endpoint);
	populateSearchResults(searchResults, targetContainer);
};
const handleSearch = () => {
	const searchContainer = document.querySelector('#search-container');
	const targetContainer = document.querySelector('#search-results');
	if (!searchContainer || !targetContainer) return;
	const submitBtn = searchContainer.querySelector('button');
	submitBtn.addEventListener('click', () =>
		runSearchQuery(searchContainer, targetContainer)
	);
};

const validateField = (input) => {
	const entry = validationRules.find(rule => rule.name === input.name);
	if (!entry) return;
	const isValid = entry.regex.test(input.value);
	const btn = input.closest('form').querySelector('button[type="submit"]');
	if (!btn) return;
	if (!isValid) {
		input.classList.add('invalid');
		btn.disabled = true;
		return;
	}
	input.classList.remove('invalid');
	const invalidInputs = input.closest('form').querySelectorAll('input.invalid');
	if (!invalidInputs.length) {
		btn.removeAttribute('disabled');
	}
};

const initializeValidation = () => {
	const form = document.querySelector('.validate-form');
	if (!form) return;
	const inputs = form.querySelectorAll('input');
	inputs.forEach(input => input.addEventListener('focusout', () => validateField(input)));
	form.addEventListener('submit', (e) => validateField(e.target));
};
initializeValidation();
handleSearch();
