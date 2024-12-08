document.addEventListener('DOMContentLoaded', () => {

    let project_description_area = document.querySelector('textarea#project_description');

    if (project_description_area) {
        tinymce.init({
            selector: 'textarea#project_description',
            height: 500,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | removeformat | help',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
        });
    }

    // Handle form submission
    document.querySelector('#loginForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const projectTitle = document.querySelector('#project_title').value;
        const serviceName = document.querySelector('#service_name').value;
        const projectDescription = tinymce.get('project_description').getContent();

        // Convert images to base64 if they exist
        const convertedDescription = convertImagesToBase64(projectDescription);

        const formData = new FormData();
        formData.append('title', projectTitle);
        formData.append('service_name', serviceName);
        formData.append('description', convertedDescription);

        // Send data to server via AJAX
        fetch('./backend/projects/add-project.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.status == "success") {
                    alert("Project submitted successfully!");
                    window.location.reload();
                } else {
                    alert('something went wrong.')
                }
            })
            .catch(error => {
                console.error(error);
                alert("There was an error submitting the project.");
            });
    });

});

// Function to convert image URLs to Base64
function convertImagesToBase64(content) {
    const images = content.match(/<img[^>]+src="([^">]+)"/g);

    if (!images) return content;

    images.forEach((imgTag) => {
        const imgUrl = imgTag.match(/src="([^">]+)"/)[1];
        if (imgUrl && imgUrl.startsWith('data:')) return;

        fetch(imgUrl)
            .then(res => res.blob())
            .then(blob => {
                const reader = new FileReader();
                reader.onloadend = function () {
                    const base64Image = reader.result;
                    content = content.replace(imgUrl, base64Image);
                };
                reader.readAsDataURL(blob);
            })
            .catch(err => console.error('Error converting image to Base64', err));
    });

    return content;
}