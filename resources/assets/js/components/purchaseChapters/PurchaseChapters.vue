<template>
    <div>

        <div class="panel panel-default">
            <div class="panel-heading">Purchase Chapters</div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Total Chapter</th>
                        <th>Royalty</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="book, index in books">
                        <td>
                            <router-link :to="{name: 'purchaseChapterDetail', params: {id: book.id}}">
                                {{ book.title }}
                            </router-link>
                        </td>
                        <td>{{ book.total_chapters }}</td>
                        <td>{{ rupiahFormat(book.total_royalty) }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                books: []
            }
        },
        mounted() {
            var app = this;
            axios.get('/api/v1/purchase')
                .then(function (resp) {
                    app.books = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load purchase");
                });
        },
        methods: {
            rupiahFormat(value) {
                return 'Rp'+(value/1000).toFixed(3)+',-';
            }
        }
    }
</script> 
