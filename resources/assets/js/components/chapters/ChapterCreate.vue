
<template>
    <div>
        <div class="form-group">
            <router-link :to="{ name: 'chapter', params: { id: book_id }}" class="btn btn-default">Back</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Create new chapter</div>
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
    	mounted() {
    		let app = this;
    	},
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
            	book_id: this.$route.params.id,
                chapter: {
                	title: '',
                    price: '',
                    content: '',
                    sequence: '',
                    book_id: this.$route.params.id,
                }
            }
        },
        methods: {
            saveForm() {
                var app = this;
                var newChapter = app.chapter;
                var validate = this.validateInput(newChapter);
                
                if (validate) {
                	axios.post('/api/v1/chapters/store', newChapter)
                    .then(function (resp) {
                    	var book_id = resp.data.book_id;
                        app.$router.push({path: '/admin/books/'+book_id});
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not create your book");
                    });
                }
            },
            validateInput(chapter) {
            	if (this.isEmpty(chapter.price) || $.isNumeric(chapter.price) == false) {
            		alert("Price must be numeric!");
            		return false;
            	}
            	if (this.isEmpty(chapter.content)) {
            		alert("Content must fill!");
            		return false;
            	}
            	if (this.isEmpty(chapter.sequence) || $.isNumeric(chapter.sequence) == false) {
            		alert("Sequence must be numeric!");
            		return false;
            	}

            	return true;
            },
            isEmpty( value ){
			    return !$.trim(value);
			}
        }
    }
</script>

