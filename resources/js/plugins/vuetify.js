import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

const opts = {
    "dataIterator": {
        "rowsPerPageText": "Items por pagina:",
        "rowsPerPageAll": "Todos",
        "pageText": "{0}-{1} de {2}",
        "noResultsText": "No se encontraron conincidencias",
        "nextPage": "Proxima pagina",
        "prevPage": "Previous Pagina anterior"
    },
    "dataTable": {
        "rowsPerPageText": "Items por pagina:",
        "rowsPerPageAll": "Todos",
        "pageText": "{0}-{1} de {2}",
        "noResultsText": "No se encontraron conincidencias",
        "nextPage": "Proxima pagina",
        "prevPage": "Previous Pagina anterior"
    },
    "noDataText": "No hay datos disponibles"
}

Vue.use(Vuetify)

export default new Vuetify(opts)