function SubmitForm(formId, submitId, execute) {
    const form = document.getElementById(formId);
    const submit = document.getElementById(submitId);
    submit.addEventListener("click", function (event) {
        event.preventDefault();
        submitResult(form, execute);
    });
}

function submitResult(form, execute) {
    const formData = new FormData(form);

    const xhr = new XMLHttpRequest();
    xhr.open("POST", form.action, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            try {
                const response = JSON.parse(xhr.responseText);
                execute(response);
            } catch (e) {
                showBox("<h3 class='w3-text-red'>Echo JSON is not found</h3>", xhr.responseText);
            }
        }
    };
    xhr.send(formData);
}

function showBox(title, description) {
    const newDiv = document.createElement("div");
    newDiv.innerHTML = `
       <style>
            .showTextBox {
                animation: showTextBox 0.3s forwards;
            }
            .showDivBox {
                animation: showDivBox 0.3s forwards;
            }
            @keyframes showTextBox {
                from { transform: scale(0.2) translateX(-50%) translateY(-50%); opacity: 0; }
                to { transform: scale(1) translateX(-50%) translateY(-50%); }
            }
            @keyframes showDivBox {
                from { opacity: 0; }
                to { }
            }
            @keyframes hideTextBox {
                from { transform: scale(1) translateX(-50%) translateY(-50%); }
                to { transform: scale(0.2) translateX(-50%) translateY(-50%); opacity: 0; }
            }
            @keyframes hideDivBox {
                from { }
                to { opacity: 0; }
            }
        </style>
        <div class="showDivBox w3-black w3-opacity w3-display-container"
        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 998;">
        </div>
        <div class="showDivBox w3-display-container"
        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 999;">
            <div class="showTextBox w3-white w3-display-middle w3-center w3-round-large w3-container"
            style="min-width: 200px; max-width: 40%; overflow: auto;
                    position: absolute; top: 50%; left: 50%;
                    transform: translateX(-50%) translateY(-50%)">
                ${title}
                ${description}
            </div>
        </div>
    `;
    document.body.appendChild(newDiv);

    newDiv.addEventListener('click', () => removeNewDiv(newDiv));
}

function removeNewDiv(newDiv) {
    let i;
    const showTextBox = document.getElementsByClassName("showTextBox");
    const showDivBox = document.getElementsByClassName("showDivBox");
    for (i = showTextBox.length - 1; i >= 0; i--) {
        showTextBox[i].style.animation = 'hideTextBox 0.3s forwards';
    }
    for (i = showDivBox.length - 1; i >= 0; i--) {
        showDivBox[i].style.animation = 'hideDivBox 0.3s forwards';
    }
    setTimeout(function () {
        newDiv.remove();
    }, 300);
}