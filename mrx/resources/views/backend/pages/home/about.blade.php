@extends('backend.layout.sidenav-layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section_header">
                    <h3>About Me</h3>
                </div>
                <div class="card">
                    <form id="save-form">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 p-1">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" value="">
                                    <label class="form-label">Details</label>
                                    <input type="text" class="form-control" id="details" value="">
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
            FillAboutData();
            async function FillAboutData() {
                try {
                    showLoader();
                    let res = await axios.get("/about-data");
                    hideLoader();

                    document.getElementById('title').value = res.data['data']['title'];
                    document.getElementById('details').value = res.data['data']['details'];
                } catch (error) {
                    console.error('Error fetching about data:', error);
                }
            }

            async function update() {
                const update_title = document.getElementById('title').value;
                const update_details = document.getElementById('details').value;

                if (!update_title || !update_details) {
                    errorToast("Title and Details are required!");
                    return;
                }

                try {
                    showLoader();
                    const response = await axios.post("/update-about", {
                        title: update_title,
                        details: update_details,
                    });
                    hideLoader();

                    if (response.status === 200 && response.data.status === 'ok') {
                        successToast('About data updated successfully');
                        document.getElementById("save-form").reset();
                        FillAboutData();
                    } else {
                        errorToast("Request failed!");
                    }
                } catch (error) {
                    console.error('Error updating about data:', error);
                    errorToast("Request failed!");
                }
            }
 </script>
@endsection
