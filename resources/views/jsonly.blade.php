<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Algolia</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <style>
        em {
            background: #eceff1;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="row">
                <label for="query"></label>
                <input type="text" id="query" name="query" v-model="query" v-on="keyup: search | key 'enter'" class="form-control">
            </div>
            <div class="row">
                <div class="results">
                    <article v-repeat="user: users">
                        <h2 v-html="user._highlightResult.name.value"></h2>
                        <h4 v-html="user._highlightResult.company.value"></h4>
                    </article>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/0.12.12/vue.min.js"></script>
<script src="//cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>

<script>
    new Vue({
        el: 'body',

        data: {
            query: '',
            users: []
        },

        ready: function() {
            this.client = algoliasearch("02T94JSIW0", "d866daeab49969b88ab26e562503ac08");
            this.index = this.client.initIndex('test_drive_contacts');
        },

        methods: {
            search: function () {
                this.index.search(this.query, function (error, results) {
                    this.users = results.hits;
                }.bind(this));
            }
        }
    });
</script>
</body>
</html>