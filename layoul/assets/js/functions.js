function loadScriptIf(condition, scriptUrl) {
    if (condition) {
        const script = document.createElement('script');
        script.src = scriptUrl;
        script.type = 'text/javascript';
        document.body.appendChild(script);
    }
}

function emptyForm(formId) {
    let form = document.getElementById(formId);

    if (form) {
        Array.from(form.elements).forEach(element => {
            if (element.tagName === "INPUT") {
                if (["text", "password", "email", "number", "date", "url", "tel"].includes(element.type)) {
                    element.value = "";
                } else if (element.type === "checkbox" || element.type === "radio") {
                    element.checked = false;
                } else if (element.type === "file") {
                    const newInput = element.cloneNode(true);
                    newInput.value = ""; // Clear any lingering value (just in case)
                    element.parentNode.replaceChild(newInput, element);
                }
            } else if (element.tagName === "TEXTAREA") {
                element.value = "";

                if (tinymce.get(element.id)) {
                    tinymce.get(element.id).setContent('');
                }
            } else if (element.tagName === "SELECT") {
                element.selectedIndex = 0;
            }
        });
    }
}