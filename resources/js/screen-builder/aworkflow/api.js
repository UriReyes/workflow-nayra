
const BASE_URL = 'http://workflow-nayra.test';


export const saveFormScreen = async (screenId, { computed, customCSS, savedConfig, savedWatchers }) => {
    const url = `${BASE_URL}/screens/${screenId}`;
    const response = await fetch(url, {
        mode: 'cors', // this cannot be 'no-cors'
        headers: {
            'X-CSRF-TOKEN': window.Laravel.csrfToken,
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        method: 'PUT',
        body: JSON.stringify({ computed, customCSS, savedConfig, savedWatchers })
    });
    const data = await response.json();
    return data;
}

export const loadFormScreen = async (screenId) => {
    const url = `${BASE_URL}/screens/${screenId}/get-form`;
    const response = await fetch(url);
    const data = await response.json();
    return data;
}

