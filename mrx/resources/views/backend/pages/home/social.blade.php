@extends('backend.layout.sidenav-layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section_header">
                    <h3>Social Link</h3>
                </div>
                <div class="card">
                    <form id="save-form">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 p-1">


                                    <label class="form-label">Githubr Link</label>
                                    <input type="text" class="form-control" id="githubrLink" value="">

                                    <label class="form-label">Twitter</label>
                                    <input type="text" class="form-control" id="twitterLink" value="">

                                    <label class="form-label">Linkedin Link</label>
                                    <input type="text" class="form-control" id="linkedinLink" value="">
                                    <input type="text" class="d-none" id="updateID">

                                    <button onclick="update()" class="btn btn-sm btn-success mt-3">Update</button>

                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
 FillSocialData();
        async function FillSocialData() {
            try {
                showLoader();
                let res = await axios.get("/social-link-data");
                hideLoader();

                document.getElementById('twitterLink').value = res.data['data']['twitterLink'];

                document.getElementById('linkedinLink').value = res.data['data']['linkedinLink'];

                document.getElementById('githubrLink').value = res.data['data']['githubrLink'];

            } catch (error) {
                console.error('Error fetching hero data:', error);
            }
        }







        // async function Update() {


        //     let update_twitterLink = document.getElementById('twitterLink').value;
        //     let update_linkedinLink = document.getElementById('linkedinLink').value;
        //     let update_githubrLink = document.getElementById('githubrLink').value;

        //     if (!update_twitterLink || !update_linkedinLink || !update_githubrLink) {
        //             errorToast( "Please select a link to update");
        //             return;
        //         }


        //         try {
        //             showLoader();
        //             const response = await axios.post("/update-sociallink", {
        //                 twitterLink: update_twitterLink,
        //                 linkedinLink: update_linkedinLink,
        //                 githubrLink: update_githubrLink,
        //             });
        //             hideLoader();

        //             if (response.status === 200 && response.data.status === 'ok') {
        //                 successToast('social url updated successfully');
        //                 document.getElementById("save-form").reset();
        //                 FillSocialData();
        //             } else {
        //                 errorToast("Request failed!");
        //             }
        //         } catch (error) {
        //             console.error('Error updating about data:', error);
        //             errorToast("Request failed!");
        //         }
        // }

        async function Update() {
    let update_twitterLink = document.getElementById('twitterLink').value;
    let update_linkedinLink = document.getElementById('linkedinLink').value;
    let update_githubrLink = document.getElementById('githubrLink').value;

    if (!update_twitterLink || !update_linkedinLink || !update_githubrLink) {
        errorToast("Please provide all social links to update");
        return;
    }

    try {
        showLoader();
        const response = await axios.post("/update-sociallink", {
            twitterLink: update_twitterLink,
            linkedinLink: update_linkedinLink,
            githubrLink: update_githubrLink,
        });
        hideLoader();

        if (response.status === 200 && response.data.status === 'ok') {
            successToast('Social links updated successfully');
            // You can reset the form or perform any other actions here
        } else {
            errorToast("Request failed!");
        }
    } catch (error) {
        console.error('Error updating social links:', error);
        errorToast("Request failed!");
    }
}
    </script>
@endsection
