<template>
    <div>
    	<div class="form-group">
            <router-link :to="{ name: 'purchaseChapters'}" class="btn btn-default">Back</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Purchase Chapters</div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th rowspan="2">Title</th>
                        <th rowspan="2">Price</th>
                        <th rowspan="2">Royalty</th>
                        <th rowspan="2">Transaksi</th>                        
                        <th colspan="4" align="center"><center>Periode</center></th>
                        <th rowspan="2">Sub Total</th>
                    </tr>
                    <tr>
                    	<th>Periode 1</th>
                    	<th>Periode 2</th>
                    	<th>Periode 3</th>
                    	<th>Periode 4</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="chapter, index in chapters">
                        <td>{{ chapter.title }}</td>
                        <td>{{ rupiahFormat(chapter.price) }}</td>
                        <td>30%</td>
                        <td>10</td>
                        <td v-for="royalty, index in chapter.quartals">
                        	{{ rupiahFormat(royalty.royalty) }}
                        </td>
                        <td>{{ chapter.subtotal }}</td>
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
                chapters: []
            }
        },
        mounted() {
            var app = this;
            var book_id = app.$route.params.id;
            axios.get('/api/v1/purchase-by-book/'+book_id)
                .then(function (resp) {
                    app.chapters = resp.data.chapters;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load companies");
                });
        },
        methods: {
            rupiahFormat(value) {
                return 'Rp'+(value/1000).toFixed(3)+',-';
            }
        }
    }
</script> 
