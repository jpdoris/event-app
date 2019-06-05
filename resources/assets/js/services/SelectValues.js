import axios from 'axios';

export default {
    getStates () {
        return axios.get('/api/states')
            .then(response => {
                return response.data
            })
    },

    getCountries () {
        return axios.get('/api/countries')
            .then(response => {
                return response.data
            })
    },
}
