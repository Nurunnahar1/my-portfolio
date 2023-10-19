<div class="modal" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add experience</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">

                                <label class="form-label">Duration</label>
                                <input type="text" class="form-control" id="update_duration">

                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" id="update_title">

                                <label class="form-label">Institution Name</label>
                                <input type="text" class="form-control" id="update_institutionName">

                                <label class="form-label">Field</label>
                                <textarea class="form-control" name="" id="update_field" cols="30" rows="10"></textarea>

                                <label class="form-label">Details</label>
                                <textarea class="form-control" name="" id="update_details" cols="30" rows="10"></textarea>

                                <input type="text" class=" hidden" id="updateID">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal"
                    aria-label="Close">Close</button>
                <button onclick="Update()" id="save-btn" class="btn btn-sm  btn-success">Save</button>
            </div>
        </div>
    </div>
</div>
<script>

    async function FillUpUpdateForm(id){
        document.getElementById('updateID').value=id;
        showLoader();
        let res=await axios.post("/education-by-id",{id:id})
        hideLoader();
        document.getElementById('update_duration').value=res.data['duration'];
        document.getElementById('update_title').value=res.data['title'];
        document.getElementById('update_institutionName').value=res.data['institutionName'];
        document.getElementById('update_field').value=res.data['field'];
        document.getElementById('update_details').value=res.data['details'];

    }


    async function Update() {

let update_duration = document.getElementById('update_duration').value;
let update_title = document.getElementById('update_title').value;
let update_institutionName = document.getElementById('update_institutionName').value;
let update_field = document.getElementById('update_field').value;
let update_details = document.getElementById('update_details').value;
let updateID = document.getElementById('updateID').value;


if (update_duration.length === 0) {
    errorToast("Required !")
}
else if(update_title.length===0){
    errorToast("Required !")
}
else if(update_institutionName.length===0){
    errorToast("Required !")
}
else if(update_field.length===0){
    errorToast("Required !")
}
else if(update_details.length===0){
    errorToast("Required !")
}
else {

    document.getElementById('update-modal-close').click();

    showLoader();

    let res = await axios.post("/update-education",{
        update_duration:update_duration,
        update_title:update_title,
        update_institutionName:update_institutionName,
        update_field:update_field,
        update_details:update_details,
        id:updateID})

    hideLoader();

    if(res.status===200 && res.data===1){

        successToast('Request completed');

        document.getElementById("update-form").reset();

        await getList();
    }
    else{
        errorToast("Request fail !")
    }
}
}

</script>
