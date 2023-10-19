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
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" id="update_name">
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
        let res=await axios.post("/skill-by-id",{id:id})
        hideLoader();
        document.getElementById('update_name').value=res.data['name'];
    }

    async function Update() {
        let update_name = document.getElementById('update_name').value;
        let updateID = document.getElementById('updateID').value;
        if (update_name.length === 0) {
            errorToast("Required !")
        }
        else {
            document.getElementById('update-modal-close').click();
            showLoader();
            let res = await axios.post("/update-skill",{
                update_name:update_name,
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
