const API_URL = "http:localhost:3000/Wail";

const wailContainer = document.querySelector(".wailer_container");
const createWailForm = document.querySelector(".wailer_form");

var sample = document.getElementById("loonSound");
sample.play();

createWailForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    let formData = new FormData(createWailForm);
    let payload = {
        name: formData.get("name"),
        content: formData.get("content"),
    };
    let response = await fetch(API_URL, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(payload),
    });

    if (response.status == 200) {
        createWailForm.reset();
        getAllWails();
    } else {
        console.error(response.statusText);
        return;
    }
});

// Get all
async function getAllWails() {
    let response = await fetch(API_URL);
    let wails = await response.json();

    // Display wails
    displayWails(wails);
}

//Get by tag
async function getWailsByTag(tag) {
    let response = await fetch(API_URL + `?tags=${tag}`);
    let wails = await response.json();

    // Display wails
    displayWails(wails);
}

//Get by name
async function getWailsByName(name) {
    let response = await fetch(API_URL + `?name=${name}`);
    let wails = await response.json();

    // Display wails
    displayWails(wails);
}

function displayWails(data) {
    wailContainer.innerHTML = "";
    if (data.count > 0) {
        data.wail.forEach((record) => {
            let wail = document.createElement("div");
            wail.classList.add("wail");
            let name = document.createElement("h3");
            name.textContent = record.name;
            let wailContent = document.createElement("div");
            wailContent.classList.add("wail_content");
            let content = document.createElement("p");
            content.textContent = record.content;
            wailContent.appendChild(content);
            let date = document.createElement("span");
            date.classList.add("date");
            date.textContent = new Date(record.createdAt).toDateString();
            wailContent.appendChild(date);

            wail.appendChild(name);
            wail.appendChild(wailContent);

            wailContainer.appendChild(wail);
        });
    } else {
        return;
    }
}