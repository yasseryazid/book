<template>
    <div>
        <div class="form-group">
            <router-link :to="{name: 'addChapter'}" class="btn btn-success">Create new chapter</router-link>
            <router-link to="/" class="btn btn-default">Back</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Chapter list</div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Price</th>
                        <th>Sequence</th>
                        <th width="100">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="chapter, index in chapters">
                        <td>{{ chapter.title }}</td>
                        <td><froalaView v-model="chapter.content"></froalaView></td>
                        <td>{{ rupiahFormat(chapter.price) }}</td>
                        <td>{{ chapter.sequence }}</td>
                        <td>
                            <router-link :to="{name: 'editChapter', params: {chapterId: chapter.id, bookId: bookId}}" class="btn btn-xs btn-default">
                                Edit
                            </router-link>
                            <a href="#"
                               class="btn btn-xs btn-danger"
                               v-on:click="deleteEntry(chapter.id, index)">
                                Delete
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import VueFroala from 'vue-froala-wysiwyg';
    export default {
        data: function () {
            return {
                bookId: this.$route.params.id,
                chapters: []
            }
        },
        mounted() {
            var app = this;
            axios.get('/api/v1/chapters')
                .then(function (resp) {
                    $.each(resp.data, function (index, chapter) {
                        chapter.content = jQuery.trim(chapter.content).substring(0, 50).split(" ").slice(0, -1).join(" ") + "...";
                    });
                    app.chapters = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load chapters");
                });
        },
        methods: {
            deleteEntry(id, index) {
                if (confirm("Do you really want to delete it?")) {
                    var app = this;
                    axios.delete('/api/v1/chapters/' + id)
                        .then(function (resp) {
                            app.chapters.splice(index, 1);
                        })
                        .catch(function (resp) {
                            alert("Could not delete chapter");
                        });
                }
            },
            rupiahFormat(value) {
                return 'Rp'+(value/1000).toFixed(3)+',-';
            }
        }
    }
</script>