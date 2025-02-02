document.addEventListener('DOMContentLoaded', () => {
    const workSection = document.querySelector('#work_section .work-list-wrapper .work-list');

    if (window.location.href.includes("/work")) {
        fetch('backend/get_projects.php') // Adjust the path to your PHP script
            .then(response => response.json())
            .then(data => {
                // Access the rows array from the response
                if (data.rows && Array.isArray(data.rows)) {
                    workSection.innerHTML = ''; // Clear existing demo items

                    data.rows.forEach(project => {
                        const projectElement = `
                            <div role="listitem" class="work-item w-dyn-item w-col w-col-4">
                                <a href="./single-work?id=${project.id}" class="work-item-inner w-inline-block">
                                    <h4 class="work-title">${project.name}</h4>
                                    <div class="work-category">
                                        <span class="cat-link">${project.category}</span>
                                    </div>
                                    <div class="image-holder">
                                        <img decoding="async"
                                             src="${project.image}" 
                                             loading="lazy" 
                                             alt="${project.name}" 
                                             class="work-image">
                                    </div>
                                </a>
                            </div>
                        `;
                        workSection.insertAdjacentHTML('beforeend', projectElement);
                    });
                } else {
                    console.error('Invalid data format:', data);
                }
            })
            .catch(err => console.error("Error fetching projects:", err));
    } else if(window.location.href.includes("/single-work")) {
        const projectId = new URLSearchParams(window.location.search).get("id"); // Get 'id' from URL
        if (projectId) {
            fetch(`backend/get-single-project.php?id=${projectId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.querySelector(".sitemap-title").textContent = data.project.name;
                        document.querySelector(".single-work-title").textContent = data.project.name;
                        document.querySelector(".sitemap-text").textContent = data.project.service_category;
                        document.querySelector(".single-text-style").innerHTML = data.project.content;
                        document.querySelector(".single-work-image").src = data.project.image;
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
});
