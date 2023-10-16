
<section class="py-5">
    <div class="container px-5 mb-5">
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bolder mb-0"><span class="text-gradient d-inline">Projects</span></h1>
        </div>
        <div class="row gx-5 justify-content-center">
            <div id="project-list" class="col-lg-11 col-xl-9 col-xxl-8">
                <!-- Project Card 1-->
                {{-- <div class="card overflow-hidden shadow rounded-4 border-0 mb-5">
                    <div class="card-body p-0">
                        <div class="d-flex align-items-center">
                            <div class="p-5">
                                <h2 class="fw-bolder">Project Name 1</h2>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius at enim eum illum aperiam placeat esse? Mollitia omnis minima saepe recusandae libero, iste ad asperiores! Explicabo commodi quo itaque! Ipsam!</p>
                            </div>
                            <img class="img-fluid" src="{{ asset('https://dummyimage.com/300x400/343a40/6c757d') }}" alt="..." />
                        </div>
                    </div>
                </div> --}}
                <!-- Project Card 2-->
                {{-- <div class="card overflow-hidden shadow rounded-4 border-0">
                    <div class="card-body p-0">
                        <div class="d-flex align-items-center">
                            <div class="p-5">
                                <h2 class="fw-bolder">Project Name 2</h2>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius at enim eum illum aperiam placeat esse? Mollitia omnis minima saepe recusandae libero, iste ad asperiores! Explicabo commodi quo itaque! Ipsam!</p>
                            </div>
                            <img class="img-fluid" src="{{ asset('https://dummyimage.com/300x400/343a40/6c757d') }}" alt="..." />
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</section>
<script>
    GetProject();
    async function GetProject(){
        let URL="/projectData"
        try{

        //loaer show
        document.getElementById('loading-div').classList.remove('d-none')
        document.getElementById('content-div').classList.add('d-none')

            const response = await axios.get(URL);

        //loaer hide
        document.getElementById('loading-div').classList.add('d-none')
        document.getElementById('content-div').classList.remove('d-none')

            response.data.forEach((item)=>{
                document.getElementById('project-list').innerHTML+=(`
                <div class="card overflow-hidden shadow rounded-4 border-0 mb-5">
                    <div class="card-body p-0">
                        <div class="d-flex align-items-center">
                            <div class="p-5">
                                <h2 class="fw-bolder"> ${item['title']}</h2>
                                <p> ${item['details']}</p>
                                <a class="text-deceoration-none" target="_blank" href=" ${item['previewLink']}">Preview Link</a>
                            </div>
                            <img class="img-fluid" src=" ${item['thumbnailLink']}" alt="aaaaaaaaaaaaaaaa" />

                        </div>
                    </div>
                </div>

                `)
            })
        }catch(error){
            alert(error)
        }
    }
</script>
