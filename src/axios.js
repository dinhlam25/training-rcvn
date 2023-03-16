import axios from 'axios'

const API_URL = 'http://127.0.0.1:8000/api'

// Set default API URL for axios requests
axios.defaults.baseURL = API_URL
axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token');
axios.defaults.headers.post['Content-Type'] = 'application/json';
export default { axios }