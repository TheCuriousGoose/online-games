import './bootstrap';


export async function executeGetFetch(url) {
    const response = await fetch(url);
    return response.json();
}

export async function executePostFetch(url, data) {
    const response = await fetch(url, {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
            "Content-type": "application/json; charset=UTF-8"
        }
    });
    return response.json();
}

export function updateCreditsDisplay(credits) {
    const creditsDisplay = document.getElementById('user-credits');
    creditsDisplay.innerHTML = credits;
}
