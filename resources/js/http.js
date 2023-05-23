// Helper methods for Fetch API

export function request(method, url, data = {}) {
    return fetch(url, {
        method,
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
            "X-CSRF-TOKEN": document.head.querySelector("meta[name=csrf-token]")
                .content,
            // 'Content-Type': 'application/x-www-form-urlencoded',
        },
        ...(method  === "GET" ? {} : { body: JSON.stringify(data) }), // destructure the object we get
    })
    .then(async(response) => {
        if (response.status >= 200 && response.status < 300) {
            return response.json();
        }
        throw await response.json();
    })
}

export function get(url) {
    return request('GET', url);
}

export function post(url, data) {
    return request('POST', url, data);
}