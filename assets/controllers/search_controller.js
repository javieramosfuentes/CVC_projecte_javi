// search_controller.js
import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['inputSearch', 'searchResults'];
    connect() {
        console.log('Search controller connected!');
    }

    search(event) {
        event.preventDefault();
        const searchTerm = this.inputSearchTarget.value;

        fetch(`/?q=${encodeURIComponent(searchTerm)}`, {
            method: 'GET', // Asegúrate de que el método corresponda con tu controlador PHP
        })
            .then(response => response.text())
            .then(html => {
                this.searchResultsTarget.innerHTML = html;
            })
            .catch(error => {
                console.error('Error en la petición AJAX:', error);
            });
    }
}
