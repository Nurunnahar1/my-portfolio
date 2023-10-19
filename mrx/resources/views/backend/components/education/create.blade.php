<div class="modal" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Education</h5>
            </div>
            <div class="modal-body">
                <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">

                                <label class="form-label">Duration</label>
                                <input type="text" class="form-control" id="duration">

                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" id="title">

                                <label class="form-label">Institution Name</label>
                                <input type="text" class="form-control" id="institutionName">

                                <label class="form-label">Field</label>
                                <textarea class="form-control" name="" id="field" cols="30" rows="10"></textarea>

                                <label class="form-label">Details</label>
                                <textarea class="form-control" name="" id="details" cols="30" rows="10"></textarea>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal"
                    aria-label="Close">Close</button>
                <button onclick="create()" id="save-btn" class="btn btn-sm  btn-success">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    async function create() {

        let create_duration = document.getElementById('duration').value;
        let create_title = document.getElementById('title').value;
        let create_institutionName = document.getElementById('institutionName').value;
        let create_field = document.getElementById('field').value;
        let create_details = document.getElementById('details').value;


        if (create_duration.length === 0) {
            errorToast("Required !")
        } else if (create_title.length === 0) {
            errorToast("Required !")
        } else if (create_institutionName.length === 0) {
            errorToast("Required !")
        }else if (create_field.length === 0) {
            errorToast("Required !")
        }else if (create_details.length === 0) {
            errorToast("Required !")
        } else {

            document.getElementById('modal-close').click();
            showLoader();
            let res = await axios.post("/create-education", {
                duration: create_duration,
                title: create_title,
                institutionName: create_institutionName,
                field: create_field,
                details: create_details
            });
            hideLoader();

            if (res.data['status'] == 'ok') {
                successToast('Request completed');
                document.getElementById("save-form").reset();
                getList();
            } else {
                errorToast("Request fail !")
            }
        }
    }
</script>
