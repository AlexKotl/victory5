export default class Compare {
    
    constructor(config) {
        this.config = config
    }

    getAllDates() {

        return fetch(this.config.url + '/api/list')
            .then(r => r.json())
            .catch(alert)

    }
    
}