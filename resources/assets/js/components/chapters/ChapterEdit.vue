
<template>
    <div>
        <div class="form-group">
            <router-link :to="{ name: 'chapter', params: { id: bookId }}" class="btn btn-default">Back</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Edit chapter</div>
            <div class="panel-body">
                <form v-on:submit="saveForm()">
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Title</label>
                            <input type="text" v-model="chapter.title" class="form-control">
                        </div>
                    </div>

                   <div class="row">
                        <div class="col-xs-12 form-group" >
                             <label class="control-label">Content</label>
                             <froala :tag="'textarea'" :config="config" rows="30" v-model="chapter.content" class="form-control">
                             </froala>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Price</label>
                            <input type="text" v-model="chapter.price" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Sequence</label>
                            <input type="text" v-model="chapter.sequence" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <button class="btn btn-success" >Update</button>
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
    	mounted() {
    		this.setValue();
    	},
        data: function () {
            return {
			    bookId:'',
            	chapterId: '',
                chapter: {
                	title: '',
                    price: '',
                    content: '',
                    sequence: ''
                },
            	config: {
			        events: {
			          	'froalaEditor.initialized': function () {

			          	}
			        },
			        heightMin: 200,
			    }
            }
        },
        methods: {
        	setValue() {
        		let app = this;
	    		let id = app.$route.params.chapterId;
	            app.chapterId = id;
	            app.bookId = app.$route.params.bookId;
	            axios.get('/api/v1/chapters/' + id)
	                .then(function (resp) {
	                    app.chapter = resp.data;
	                })
	                .catch(function () {
	                    alert("Could not load your company")
	                });
        	},
            saveForm() {
                var app = this;
                var newChapter = app.chapter;
                axios.patch('/api/v1/chapters/'+app.chapterId, newChapter)
                    .then(function (resp) {
                    	var book_id = resp.data.book_id;
                        app.$router.push({path: '/admin/books/'+book_id});
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not create your book");
                    });
            }
        }
    }
</script>

