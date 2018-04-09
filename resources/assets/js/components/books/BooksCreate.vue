
<template>
    <div>
        <div class="form-group">
            <router-link to="/" class="btn btn-default">Back</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Create new book</div>
            <div class="panel-body">
                <form v-on:submit="saveForm()">
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Title</label>
                            <input type="text" v-model="book.title" class="form-control">
                        </div>
                    </div>
                   
                   <div class="row">
                        <div class="col-xs-12 form-group" >
                             <label class="control-label">Synopsis</label>                         
                            <froala :tag="'textarea'" :config="config" rows="30" v-model="book.synopsis" class="form-control">
                             </froala>
                             
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Cover</label>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-2">
                                        <img :src="book.cover" class="img-responsive">
                                    </div>
                                    <div class="col-md-8">
                                        <input type="file" v-on:change="onFileChange" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <button class="btn btn-success" >Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import VueFroala from 'vue-froala-wysiwyg';
    export default {
        data: function () {
            return {
                config: {
                    events: {
                        'froalaEditor.initialized': function () {
                            // console.log('initialized')
                        }
                    },
                    heightMin: 200,
                },


                book: {
                    title: '',
                    synopsis: '',
                    cover: '',
                    user_id: document.querySelector("input[name=example]").value,
                }
            }
        },
        methods: {
            saveForm() {
                var app = this;
                var newBook = app.book;
                    console.log(newBook);
                axios.post('/api/v1/books/store', newBook)
                    .then(function (resp) {
                        app.$router.push({path: '/'});
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not create your book");
                    });
            },

            onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.book.cover = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            
            uploadImage(event) {

                const URL = '/api/v1/books/store'; 

                let data = new FormData();
                data.append('name', 'cover');
              //  data.append('file', event.target.cover[0]); 

                let config = {
                  header : {
                    'Content-Type' : 'image/png'
                  }
                }

                axios.put(
                  URL, 
                  data,
                  config
                ).then(
                  response => {
                    console.log('image upload response > ', response)
                  }
                )
              }
        }
    }
</script>

