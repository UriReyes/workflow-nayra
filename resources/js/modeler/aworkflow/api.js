
const BASE_URL = 'http://workflow-nayra.test';

export const retrieveXMLDesignOfProcess = async (processId) => {
    if (processId) {
        const url = `${BASE_URL}/process/${processId}/xml`;
        const response = await fetch(url);
        const data = await response.json();
        return data;
    }
}

export const saveProcess = async (processId, bpmn, svg) => {
    const url = `${BASE_URL}/designer/${processId}`;
    const response = await fetch(url, {
        mode: 'cors', // this cannot be 'no-cors'
        headers: {
            'X-CSRF-TOKEN': window.Laravel.csrfToken,
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        method: 'PUT',
        body: JSON.stringify({ bpmn, svg })
    });
    const data = await response.json();
    return data;
}

export const getUsers = async () => {
    const url = `${BASE_URL}/users/get`;
    const response = await fetch(url);
    const data = await response.json();//return {value:'test',content:'test'}
    return data;
}


export const getForms = async () => {
    const url = `${BASE_URL}/screens/get-forms`;
    const response = await fetch(url);
    const data = await response.json();//return {value:'test',content:'test'}
    return data;
}

