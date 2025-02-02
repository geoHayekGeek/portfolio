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

        const projectId = new URLSearchParams(window.location.search).get("id"); // Get 'id' from URL
        if (projectId) {
            fetch(`./backend/projects/get-single-project.php?id=${projectId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById("project_title").value = data.project.name;
                        document.getElementById("service_name").value = data.project.service_category;

                        // Set content in TinyMCE editor
                        tinymce.get('project_description').setContent(data.project.content);

                        // Convert Base64 to Blob (File object)
                        const base64ToFile = (base64, filename) => {
                            const byteString = atob(base64.split(',')[1]); // Decode base64 string
                            const mimeString = base64.split(',')[0].split(':')[1].split(';')[0]; // Extract MIME type
                            const ab = new ArrayBuffer(byteString.length);
                            const ia = new Uint8Array(ab);

                            for (let i = 0; i < byteString.length; i++) {
                                ia[i] = byteString.charCodeAt(i);
                            }

                            return new File([ab], filename, { type: mimeString });
                        };

                        // Convert the base64 string to a File object
                        const projectImageFile = base64ToFile(data.project.image, 'project_image.png');

                        // Simulate file upload by creating a DataTransfer object
                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(projectImageFile);

                        // Assign the File object to the file input
                        const projectImageInput = document.getElementById("project_image");
                        projectImageInput.files = dataTransfer.files;

                        // Optional: Display the current image preview
                        const projectImagePreview = document.createElement("div");
                        projectImagePreview.style.display = "flex";
                        projectImagePreview.style.flexDirection = "column";
                        projectImagePreview.classList.add('mt-3');
                        projectImagePreview.innerHTML = `
                            <p>Current Image:</p>
                            <img src="${data.project.image}" alt="Project Image" style="max-width: 30%; margin-bottom: 10px; align-self: center;">
                        `;
                        projectImageInput.parentNode.insertBefore(projectImagePreview, projectImageInput);
                    } else {
                        alert(data.message || "Failed to fetch project details.");
                    }
                })
                .catch(error => console.error("Error:", error));
        }
        else {
            // alert("Project ID is missing in the URL.");
        }
    }

    // Handle form submission
    let addProjectBtn = document.querySelector('#addProjectBtn')

    if (addProjectBtn) {
        addProjectBtn.addEventListener('click', function (e) {
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
                    submitForm(formData, 'add-project.php', 'addProject');
                };
                reader.readAsDataURL(projectImage);
            } else {
                submitForm(formData, 'add-project.php', 'addProject');
            }
        });
    }

    let editProjectBtn = document.querySelector('#editProjectBtn');

    if (editProjectBtn) {
        editProjectBtn.addEventListener('submit', function (e) {
            e.preventDefault();

            const projectTitle = document.querySelector('#project_title').value;
            const serviceName = document.querySelector('#service_name').value;
            const projectDescription = tinymce.get('project_description').getContent();

            // Extract project ID from the URL
            const projectId = new URLSearchParams(window.location.search).get("id");
            if (!projectId) {
                alert("Project ID is missing in the URL.");
                return;
            }

            // Handle file input
            const projectImage = document.querySelector('#project_image').files[0];

            if (projectImage && projectImage.size > 1024 * 1024) {
                alert('File size exceeds the 1MB limit.');
                return;
            }

            const formData = new FormData();
            formData.append('id', projectId); // Add project ID to the form data
            formData.append('title', projectTitle);
            formData.append('service_name', serviceName);
            formData.append('description', projectDescription);

            if (projectImage) {
                const reader = new FileReader();
                reader.onloadend = function () {
                    const base64Image = reader.result;
                    formData.append('image', base64Image);
                    submitForm(formData, 'edit-project.php');
                    window.location.href = "./projects.php";
                };
                reader.readAsDataURL(projectImage);
            } else {
                submitForm(formData, 'edit-project.php');
            }
        });
    }


    function submitForm(formData, api, formId) {
        fetch(`./backend/projects/${api}`, {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.status == "success") {
                    alert("Project submitted successfully!");
                    if(formId) {
                        emptyForm(formId);
                    }
                } else {
                    alert('Something went wrong.')
                }
            })
            .catch(error => {
                console.error(error);
                alert("There was an error submitting the project.");
            });
    }
});
