document.addEventListener('DOMContentLoaded', () => {
    if (page_location == 'add-project') {
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

            // Handle file input
            const projectImage = document.querySelector('#project_image').files[0];

            if (projectImage && projectImage.size > 1024 * 1024) {
                alert('File size exceeds the 1MB limit.');
                return;
            }

            const formData = new FormData();
            formData.append('title', projectTitle);
            formData.append('service_name', serviceName);
            formData.append('description', projectDescription);

            if (projectImage) {
                const reader = new FileReader();
                reader.onloadend = function () {
                    const base64Image = reader.result;
                    formData.append('image', base64Image);
                    submitForm(formData);
                };
                reader.readAsDataURL(projectImage);
            } else {
                submitForm(formData);
            }
        });

        function submitForm(formData) {
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
                        alert('Something went wrong.')
                    }
                })
                .catch(error => {
                    console.error(error);
                    alert("There was an error submitting the project.");
                });
        }
    } else if (page_location == "projects") {
        
    }

});
