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
            method: 'GET',
        })
            .then(response => response.text())
            .then(html => {
                // Directly insert the HTML response
                const startTag = '<div class="list-group rounded-0" data-search-target="searchResults" id="searchResults">';
                const endTag = '</div>';
                const startIndex = html.indexOf(startTag);
                console.log("startIndex:"+startIndex)
                const endIndex = html.indexOf(endTag, startIndex);
                console.log("endIndex:"+endIndex)
                if (startIndex !== -1 && endIndex !== -1) {
                    const contentStart = startIndex + startTag.length;
                    console.log("contentStart:"+contentStart)
                    const divContent = html.substring(contentStart, endIndex);
                    console.log(divContent)
                    this.searchResultsTarget.innerHTML = divContent;
                }
            })
            .catch(error => {
                console.error('Error en la petición AJAX:', error);
            });
    }
}
