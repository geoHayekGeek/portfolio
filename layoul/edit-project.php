<?php
include_once "./layout/header.php";
?>

<h1 class="mb-4">Edit Project</h1>

<div class="row w-100 justify-content-center pb-5">
    <div class="col-12 col-md-9 col-lg-6">
        <form id="editProjectBtn">
            <div class="row mb-4">
                <div class="col-md">
                    <label for="project_title">Title</label>
                    <input type="text" class="form-control" placeholder="Project Title" id="project_title">
                </div>
                <div class="col-md">
                    <label for="inputState">Service Name</label>
                    <select id="service_name" class="form-control">
                        <option selected>Choose Service...</option>
                        <option>...</option>
                    </select>
                </div>
            </div>

            <textarea id="project_description"></textarea>

            <input type="file" class="mt-4" id="project_image" required>

            <div class="d-flex justify-content-center mt-4">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>

<?php
include_once "./layout/footer.php";
?>