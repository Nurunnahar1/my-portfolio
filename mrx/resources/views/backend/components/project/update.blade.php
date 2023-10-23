<div class="modal" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">update Project</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">

                                <label class="form-label">Project Title</label>
                                <input type="text" class="form-control" id="update_title">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <br/>
                                        <img class="img-fluid" id="oldThumbImg"
                                            src="">
                                        <br/>

                                        <label class="form-label">Image</label>
                                        <input oninput="oldThumbImg.src=window.URL.createObjectURL(this.files[0])"
                                            type="file" class="form-control" id="update_thumbnailLink">
                                    </div>

                                    <div class="col-sm-6">
                                        <br />
                                        <img class="img-fluid" id="oldprevImg"
                                            src="">
                                        <br />

                                        <label class="form-label">Image</label>
                                        <input oninput="oldprevImg.src=window.URL.createObjectURL(this.files[0])"
                                            type="file" class="form-control" id="update_previewLink">
                                    </div>
                                </div>

                                <label class="form-label">Project Details</label>
                                <textarea name="" id="update_details" cols="30" rows="10" class="form-control"></textarea>

                                <input type="text" name="" id="updateByID">
                                <input type="text" class="" id="thumbPath">
                                <input type="text" class="" id="prevPath">

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal"
                    aria-label="Close">Close</button>
                <button onclick="Update()"  class="btn btn-sm  btn-success">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
async function FillUpUpdateForm(id, thumbPath, prevPath) {

    document.getElementById('updateByID').value = id;
    document.getElementById('thumbPath').value = thumbPath;
    document.getElementById('prevPath').value = prevPath;

    document.getElementById('oldThumbImg').src = thumbPath;
    document.getElementById('oldprevImg').src = prevPath;

    showLoader();

        let res = await axios.post("/project-by-id", { id: id });
        hideLoader();
        document.getElementById('update_title').value = res.data['title'];
        document.getElementById('update_details').value = res.data['details'];

}


async function Update() {
    let update_title = document.getElementById('update_title').value;
    let update_thumbnailLink = document.getElementById('update_thumbnailLink').files[0];
    let update_previewLink = document.getElementById('update_previewLink').files[0];
    let Update_details = document.getElementById('update_details').value;
    let thumbPath = document.getElementById('thumbPath').value;
    let prevPath = document.getElementById('prevPath').value;
    let updateByID = document.getElementById('updateByID').value;

    if (update_title.length === 0) {
        errorToast("Title is required!");
    } else if (!update_thumbnailLink) {
        errorToast("Thumbnail is required!");
    } else if (!update_previewLink) {
        errorToast("Preview is required!");
    } else if (thumbPath.length === 0) {
        errorToast("Thumb path is required!");
    } else if (prevPath.length === 0) {
        errorToast("Prev path is required!");
    } else if (Update_details.length === 0) {
        errorToast("Details are required!");
    } else {
        document.getElementById('update-modal-close').click();

        let formData = new FormData();
        formData.append('update_thumbnailLink', update_thumbnailLink);
        formData.append('update_previewLink', update_previewLink);
        formData.append('id', updateByID);
        formData.append('title', update_title);
        formData.append('details', Update_details);
        formData.append('thumb_filePath', thumbPath);
        formData.append('prev_filePath', prevPath);

        const config = {
            headers: {
                'content-type': 'multipart/form-data'
            }
        };

        showLoader();
        try {
            let res = await axios.post("/update-project", formData, config);
            hideLoader();

            if (res.data === 1) {
                document.getElementById("update-form").reset();
                successToast(res.data.message);
                await getList();
            } else {
                errorToast("Request failed!");
            }
        } catch (error) {
            console.error('Error:', error);
            hideLoader();
            errorToast("An error occurred. Please try again.");
        }
    }
}
</script>
