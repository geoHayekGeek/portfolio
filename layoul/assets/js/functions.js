function loadScriptIf(condition, scriptUrl) {
    if (condition) {
        const script = document.createElement('script');
        script.src = scriptUrl;
        script.type = 'text/javascript';
        document.body.appendChild(script);
    }
} 